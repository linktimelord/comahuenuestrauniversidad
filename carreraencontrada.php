<?php
include './cnx.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $titular = 'No se encontraron datos';
    $cuerpo = 'No hay datos sobre la materia a la que intenta acceder';
    //echo $id;
    
    
    $result = consulta01($id);

    if ((pg_num_rows($result)) != 0) {
        $raw = pg_fetch_array($result, null, PGSQL_ASSOC);

        $titular = $raw["nombre"];



        $duracion = duration($raw["duracion"]);


        $titulo = $raw["titulo"];
        $area = sedetion($raw["id_area"]);

        $ciudad = ciudadtion();

        $unidadcompleta = unition();
        $observacion = observation();

        $descrip = "<div class='resalta2'>Descripción</div>" . description($id);

        $materias = materiation($id);

        //Va al final
        $cuerpo = "<div class='resalta2'>Área: $area</div><div class='resalta2'> $unidadcompleta</div> <div class='resalta2'>Ciudad:</div> $ciudad<div class='resalta2'>Duración: $duracion</div>"
                . "<div class='resalta2'>Titulo: $titulo</div>$descrip<hr><div class='conttit' title='Materias' Style='text-align:center; font-size: 2.5ex; text-transform: uppercase;text-decoration: underline;font-weight: bold;'>Materias</div>$materias<br>" . $observacion;
    }
    //select * from plan_estudio inner join unidad_academica on unidad_academica.sigla=plan_estudio.id_unidad_academica where plan_estudio.id_unidad_academica='FAIF'
    pg_close($con);
    //Fin
}
echo (salida($titular, $cuerpo));

function materiation($id) {
    $listado = '';
    $result = consulta02($id);
    $cont = pg_num_rows($result);
    $optativas = array();
    if ($cont != 0) {
        $listado = "<ul>";
        while ($raw = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            if ($raw["orden"] != '') {
                $listado = $listado . "<li>" . $raw["orden"] . " - " . $raw["nombre"] . "</li>";
            } else {
                array_push($optativas, $raw);
            }
        }
    }
    
    if(count($optativas)>0){
        $cont=0;
        
        $listado = $listado."</ul>Optativas<ul>";
        while ($cont<count($optativas)){
            $temp= $optativas[$cont];
        $listado = $listado. "<li>".$temp["nombre"]."</li>";
        $cont = $cont + 1;
        }
        
    }
    $listado = $listado . "</ul>";
    return $listado;
}

function description($id) {
    $desc = '';
    $result = consulta03($id);
    $cont = pg_num_rows($result);
    if ($cont != 0) {
        while ($raw = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $desc = $desc . $raw["contenido"];
        }
    }
    return $desc;
}

function duration($dur) {
    if ($dur != '') {
        $dur = $dur / 2;
        $dur = $dur . " años";
    }
    return $dur;
}

function titulation($tit, $ini) {
    if ($ini != '') {
        $tit = $tit . " ($ini)";
    }
    return $tit;
}

function sedetion($sedetemp) {
    $area = '';
    if ($sedetemp != '') {
        $result = consulta04($sedetemp);
        $cont = pg_num_rows($result);
        $raw = pg_fetch_array($result, null, PGSQL_ASSOC);
        if ($cont != 0) {
            $area = $raw["nombre"];
        }
    }
    return $area;
}

function ciudadtion() {
    $ciudad = '- ';
    $sql = "SELECT localidad.nombre, sede.direccion, sede.telefono_1 from localidad inner join sede on (sede.id_localidad=localidad.id_localidad) inner join se_dicta on (sede.id_sede=se_dicta.id_sede) where se_dicta.id_plan=" .  $_GET['id'];
    $result = pg_query($sql) or die("Error query " . pg_last_error());
    $cont = pg_num_rows($result);
    
    if ($cont != 0) {
        while ($raw = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $ciudad = $ciudad . $raw["nombre"]. ", ".$raw["direccion"].", Tel:".($raw["telefono_1"]);
            if($cont>1){
                $ciudad = $ciudad . "<br>- ";
                $cont = $cont -1;
            }
        }
    }
    return $ciudad;
}

function unition() {
    $sql = "select unidad_academica.* from unidad_academica inner join plan_estudio on (unidad_academica.sigla=plan_estudio.id_unidad_academica) where plan_estudio.id_plan=" . $_GET['id'];
    $result = pg_query($sql) or die("Error query " . pg_last_error());
    $cont = pg_num_rows($result);
    $unidadcompleta = '';
    if ($cont != 0) {
        $row = pg_fetch_array($result, null, PGSQL_ASSOC);
        $unidadcompleta = "<a style='color:#0064ad;text-decoration: none;' title='Ver información de la Unidad Académica' href='#' onclick=\"realizaProceso(-1,-1,-1,'" . $row["sigla"] . "' );return false;\"> " . $row["nombre"] . "</a>";
    }
    return $unidadcompleta;
}

function observation() {
    $sql = "select descripcion from plan_estudio inner join obs_plan on obs_plan.id_entidad=plan_estudio.id_plan and plan_estudio.id_plan='" . $_GET['id'] . "'";
    $result = pg_query($sql) or die("Error query " . pg_last_error());
    $observacion = '';

    $cont = pg_num_rows($result);
    if ($cont != 0) {
        $raw = pg_fetch_array($result, null, PGSQL_ASSOC);
        $arrv = ['ÃƒÂ¡c', 'ÃƒÂ©', 'ÃƒÂ­', 'ÃƒÂ³','rÃƒÂ¡','ÃƒÂ¡s,','ÃÂ­','ÃÂ©','rÃÂ¡','ÃÂ¡s','iÃÂ³n','ÃÂº'];
        $arrn = ['á', 'é', 'í', 'ó','ría','ás','í','é','ría','ás','ión','ú'];
        $temp = str_replace($arrv, $arrn, $raw["descripcion"]);
        $observacion = "<hr><div class='resalta'>Observación</div>-- $temp --";
    }
    return $observacion;
}

function salida($titular, $cuerpo) {
    return "<section>
            <div class='muestra' id='tlm'>

                <div class='conttit' title='$titular' Style='text-align:center; font-size: 3.5ex; text-transform: uppercase;text-decoration: underline;font-weight: bold;'>" . $titular . "</div>

                <div id='ej3'>
                    <div id='timeline'>
                    
                    " . $cuerpo . "

                    </div>
                    </div>
            </div>

        </section>";
}
