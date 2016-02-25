<?php
ini_set('default_charset','UTF8');
global $cadena;
$cadena = " host='' port='' dbname='' user='' password='' ";
$con = pg_connect($cadena)
        or die('No se ha podido conectar: ' . pg_last_error());

function Extraer($q) {
    //filtro anti sql
    $arrv = array('*', '%', '=', '<', '>');
    $arrn = array('', '', '', '', '');
    $aux = str_replace($arrv, $arrn, strtolower($q));
    //fin de filtro


    $sql = "SELECT plan_estudio.*, area.nombre AS nomarea, unidad_academica.nombre AS unita FROM plan_estudio inner join unidad_academica on (unidad_academica.sigla = plan_estudio.id_unidad_academica) inner join pertenece on (pertenece.id_plan = plan_estudio.id_plan) inner join area  on (area.id_area=pertenece.id_area) WHERE LOWER(plan_estudio.nombre) LIKE '%$aux%'";

    $result = pg_query($sql) or die("Error query " . pg_last_error());


    $cont = pg_num_rows($result);

    if ($cont == 0) {
        print '';
    } else {
        $salida = '';
        echo '<ul>';
        while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $unit = "<a style='color:#0064ad;text-decoration: none;' title='Ver información de la Unidad Académica' href='#' onclick=\"realizaProceso(-1,-1,-1,'" . $row["id_unidad_academica"] . "' );return false;\"> " . $row["unita"] . "</a>";
            $salida = $row["nombre"];
            $area = $row["nomarea"];
            if ($area != '') {
                $area = '<br> &nbsp; ' . $area;
            }
            $duracion = $row["duracion"];
            if ($duracion != '') {
                $duracion = '<br> &nbsp; ' . ($duracion / 2) . " años";
            }
            $plan = $row["id_plan"];

            $sql2 = "SELECT localidad.nombre, sede.direccion from localidad inner join sede on (sede.id_localidad=localidad.id_localidad) inner join se_dicta on (sede.id_sede=se_dicta.id_sede) where se_dicta.id_plan='" . $plan . "'";

            $result2 = pg_query($sql2) or die("Error query " . pg_last_error());
            $cont2 = pg_num_rows($result2);
            $ubicacion = '';
            if ($cont2 > 0) {
                $ubicacion = '<br> &nbsp; ';
                while ($rew = pg_fetch_array($result2, null, PGSQL_ASSOC)) {
                    $ubicacion = $ubicacion . " " . $rew['nombre'] . " (" . $rew['direccion'] . ")";
                    $cont2 = $cont2 - 1;
                    if ($cont2 > 0) {
                        $ubicacion .= " - ";
                    }
                }
            }

            print "<li>&nbsp;&nbsp;<a href='#' title='" . $salida . "' onclick=\"Mostrarcar(" . $plan . ");return false;\">" . $salida . "</a>" . $area . " (" . $unit . ")" . $ubicacion . $duracion . "</li>";
        }echo '</ul>';
    }
    pg_close();
}

function areas1() {
    $sql = "SELECT * FROM area order by nombre asc";
    $result = consulta($sql);
    echo "<h2>-- Áreas --</h2>";

    $cont = pg_num_rows($result);

    if ($cont == 0) {
        print "En construcción";
    } else {
        $salida = '';
        echo '<ul>';
        echo "<li><a style='color:#0064ad;text-decoration: none;' title='Todas las carreras' href='#' onclick=\"realizaProceso(-2,-1,-1,-1,-1 );return false;\">" . " &nbsp;Todas las carreras</a></li>";
        while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $salida = $row["nombre"];
            $stringo = "realizaProceso(" . $row['id_area'] . ",'');return false;";
            print "<li><a style='color:#0064ad;text-decoration: none;' title='" . $salida . "' href='#' onclick=\"realizaProceso(" . $row["id_area"] . ",-1,-1,-1,-1 );return false;\">" . " &nbsp;" . $salida . "</a></li>";
        }echo '</ul>';
    }
    pg_close();
}

function consulta($consulta) {
    global $cadena;
    $con = pg_connect($cadena)
            or die('No se ha podido conectar: ' . pg_last_error());

    $result = pg_query($consulta) or die("Error query " . pg_last_error());
    return $result;
}

function aarea() {
    $sql = "SELECT * FROM area order by nombre asc";
    $result = consulta($sql);


    $cont = pg_num_rows($result);

    if ($cont == 0) {
        print "En construcción";
    } else {
        $salida = '';
        echo '<ul data-role="listview">';
        echo "<li><a data-rel='close' style='font-size:0.8em;color:#0064ad;text-decoration: none;' title='Todas las carreras' href='#' onclick=\"realizaProceso(-2,-1,-1,-1,-1 );return false;\">Todas las carreras</a></li>";
        while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $salida = $row["nombre"];
            print "<li><a style='font-size:0.8em;color:#0064ad;text-decoration: none;' title='" . $salida . "' href='#' onclick=\"realizaProceso(" . $row["id_area"] . ",-1,-1,-1,-1 );return false;\">" . $salida . "</a></li>";
        }echo '</ul>';
    }
    pg_close();
}

function aubicacion() {
    $sql = "select localidad.nombre as a, provincia.nombre as b, id_localidad from localidad inner join provincia on localidad.id_provincia=provincia.id_provincia order by a asc";
    $result = consulta($sql);


    $cont = pg_num_rows($result);

    if ($cont == 0) {
        print "En construcción";
    } else {
        $salida = '';
        echo '<ul data-role="listview" style="list-style: none;">';
        echo "<li><a style='font-size:0.8em;color:#0064ad;text-decoration: none;' title='Todas las carreras' href='#' onclick=\"realizaProceso(-2,-1,-1,-1,-1 );return false;\">Todas las carreras</a></li>";
        while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $salida = $row["a"];
            $prov = $row["b"];
            print "<li><a style='font-size:0.8em;color:#0064ad;text-decoration: none;' title='$salida' href='#' onclick=\"realizaProceso(-1," . $row["id_localidad"] . ",-1,-1,-1 );return false;\">" . $salida . " (" . $prov . ")</a></li>";
        }echo '</ul>';
    }
    pg_close();
}

function afacultad() {
    $sql = "SELECT * FROM unidad_academica order by nombre asc";
    $result = consulta($sql);


    $cont = pg_num_rows($result);

    if ($cont == 0) {
        print "En construcción";
    } else {
        $salida = '';
        echo '<ul data-role="listview">';
        echo "<li><a data-rel='close' style='font-size:0.8em;color:#0064ad;text-decoration: none;' title='Todas las carreras' href='#' onclick=\"realizaProceso(-2,-1,-1,-1,-1 );return false;\">Todas las carreras</a></li>";
        while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $title = $row["nombre"];
            $salida = acortar($row["nombre"]);
            print "<li><a style='font-size:0.8em;color:#0064ad;text-decoration: none;' title='" . $title . "' href='#' onclick=\"realizaProceso(-1,-1,-1,-1,'" . $row["sigla"] . "' );return false;\">" . $salida . "</a></li>";
        }echo '</ul>';
    }
    pg_close();
}

function acortar($nombre) {
    $arrv = array('Facultad de ', 'Asentamiento Universitario ', 'Centro Universitario Regional ', 'Centro Regional Universitario ');
    $arrn = array('F. de ', 'A. U. ', 'C. U. R. ', 'C. R. U. ');
    $aux = str_replace($arrv, $arrn, $nombre);
    return $aux;
}

function consulta01($id) {
    $sale = consulta("SELECT * FROM plan_estudio inner join pertenece on plan_estudio.id_plan=pertenece.id_plan WHERE pertenece.id_plan='" . $id . "'");
    return $sale;
}

function consulta02($id) {
    $sale = consulta("SELECT * FROM materia where id_plan='" . $id . "' order by orden asc");
    return $sale;
}

function consulta03($id) {
    $sale = consulta("SELECT contenido FROM seccion WHERE id_plan='" . $id . "'");
    return $sale;
}

function consulta04($sedetemp) {
    $sale = consulta("SELECT area.nombre from area where area.id_area=" . $sedetemp);
    return $sale;
}
