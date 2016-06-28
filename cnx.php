<?php
ini_set('default_charset','UTF8');
global $cadena;
$cadena = " host='localhost' port='5432' dbname='libro_unco' user='postgres' password='1234' ";
$con = pg_connect($cadena)
        or die('No se ha podido conectar: ' . pg_last_error());
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
    $sql = "SELECT localidad.nombre, sede.direccion, sede.telefono_1, localidad.caracteristica from localidad inner join sede on (sede.id_localidad=localidad.id_localidad) inner join se_dicta on (sede.id_sede=se_dicta.id_sede) where se_dicta.id_plan=" .  $_GET['carrera'];
    $result = pg_query($sql) or die("Error query " . pg_last_error());
    $cont = pg_num_rows($result);
    
    if ($cont != 0) {
        while ($raw = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $ciudad = $ciudad . $raw["nombre"]. ", ".$raw["direccion"].", Tel: (".($raw["caracteristica"]).") ".($raw["telefono_1"]);
            if($cont>1){
                $ciudad = $ciudad . "<br>- ";
                $cont = $cont -1;
            }
        }
    }
    return $ciudad;
}

function unition() {
    $sql = "select unidad_academica.* from unidad_academica inner join plan_estudio on (unidad_academica.sigla=plan_estudio.id_unidad_academica) where plan_estudio.id_plan=" . $_GET['carrera'];
    $result = pg_query($sql) or die("Error query " . pg_last_error());
    $cont = pg_num_rows($result);
    $unidadcompleta = '';
    if ($cont != 0) {
        $row = pg_fetch_array($result, null, PGSQL_ASSOC);
        $unidadcompleta = "<a style='color:#0064ad;text-decoration: none;' title='Ver información de la Unidad Académica' href='?sigla=" . $row["sigla"] . "'> " . $row["nombre"] . "</a>";
    }
    return $unidadcompleta;
}

function observation() {
    $sql = "select descripcion from plan_estudio inner join obs_plan on obs_plan.id_entidad=plan_estudio.id_plan and plan_estudio.id_plan='" . $_GET['carrera'] . "'";
    $result = pg_query($sql) or die("Error query " . pg_last_error());
    $observacion = '';

    $cont = pg_num_rows($result);
    if ($cont != 0) {
        $raw = pg_fetch_array($result, null, PGSQL_ASSOC);
        /*$arrv = ['ÃƒÂ¡c', 'ÃƒÂ©', 'ÃƒÂ­', 'ÃƒÂ³','rÃƒÂ¡','ÃƒÂ¡s,','ÃÂ­','ÃÂ©','rÃÂ¡','ÃÂ¡s','iÃÂ³n','ÃÂº'];
        $arrn = ['á', 'é', 'í', 'ó','ría','ás','í','é','ría','ás','ión','ú'];
        $temp = str_replace($arrv, $arrn, $raw["descripcion"]);*/
        $temp=$raw["descripcion"];
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
function tomaget(){
	if(isset($_GET['duracion'])){
		switch ($_GET['duracion']) {
        case 1:
            $tiempo = "Menor a 3 años";
            //$sql = "SELECT * from plan_estudio where duracion<6";
            $sql = "SELECT plan_estudio.*, area.nombre AS nomarea, unidad_academica.nombre AS unita FROM plan_estudio inner join unidad_academica on (unidad_academica.sigla = plan_estudio.id_unidad_academica) inner join pertenece on (pertenece.id_plan = plan_estudio.id_plan) inner join area  on (area.id_area=pertenece.id_area) where duracion<6";
            break;
        case 2:
            $tiempo = "De 3 a 4 años";
            $sql = "SELECT plan_estudio.*, area.nombre AS nomarea, unidad_academica.nombre AS unita FROM plan_estudio inner join unidad_academica on (unidad_academica.sigla = plan_estudio.id_unidad_academica) inner join pertenece on (pertenece.id_plan = plan_estudio.id_plan) inner join area  on (area.id_area=pertenece.id_area) where duracion<9 and duracion>5";
            //$sql = "SELECT * from plan_estudio where duracion<9 and duracion>5";
            break;
        case 3:
            $tiempo = "De 4 a 5 años";
            $sql = "SELECT plan_estudio.*, area.nombre AS nomarea, unidad_academica.nombre AS unita FROM plan_estudio inner join unidad_academica on (unidad_academica.sigla = plan_estudio.id_unidad_academica) inner join pertenece on (pertenece.id_plan = plan_estudio.id_plan) inner join area  on (area.id_area=pertenece.id_area) where duracion>7 and duracion<11";
            //$sql = "SELECT * from plan_estudio where duracion>7 and duracion<11";
            break;
        case 4:
            $tiempo = "Mayor a 5 años";
            $sql = "SELECT plan_estudio.*, area.nombre AS nomarea, unidad_academica.nombre AS unita FROM plan_estudio inner join unidad_academica on (unidad_academica.sigla = plan_estudio.id_unidad_academica) inner join pertenece on (pertenece.id_plan = plan_estudio.id_plan) inner join area  on (area.id_area=pertenece.id_area) where duracion>10";
            //$sql = "SELECT * from plan_estudio where duracion>10";
            break;
        default:
            $tiempo = "Mayor a 5 años";
            $sql = "SELECT plan_estudio.*, area.nombre AS nomarea, unidad_academica.nombre AS unita FROM plan_estudio inner join unidad_academica on (unidad_academica.sigla = plan_estudio.id_unidad_academica) inner join pertenece on (pertenece.id_plan = plan_estudio.id_plan) inner join area  on (area.id_area=pertenece.id_area) where duracion>10";
            //$sql = "SELECT * from plan_estudio where duracion<6";
            break;
    }
	$meh = "<div style='text-align: right !important;' class='fb-share-button fb_iframe_widget' data-href='http://www.uncoma.edu.ar/oferta/?duracion=". $_GET['duracion'] ." data-layout='button' fb-xfbml-state='rendered' fb-iframe-plugin-query='app_id=&amp;container_width=255&amp;href=http%3A%2F%2Fwww.uncoma.edu.ar%2Foferta%2F%3Fduracion%3D". $_GET['duracion'] ."&amp;layout=button&amp;locale=es_LA&amp;sdk=joey'>
		<span style='vertical-align: bottom; width: 80px; height: 20px;'>
		<iframe name='f39236a9e01d824' width='1000px' height='1000px' frameborder='0' allowtransparency='true' allowfullscreen='true' scrolling='no' title='fb:share_button Facebook Social Plugin' src='https://www.facebook.com/v2.5/plugins/share_button.php?app_id=&amp;channel=http%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D42%23cb%3Df361cbb29a0d4c4%26domain%3Dlocalhost%26origin%3Dhttp%253A%252F%252Flocalhost%252Ff21c91d922c6fa%26relation%3Dparent.parent&amp;container_width=255&amp;href=http%3A%2F%2Fwww.uncoma.edu.ar%2Foferta%2F%3Fduracion%3D". $_GET['duracion'] ."&amp;layout=button&amp;locale=es_LA&amp;sdk=joey' style='border: none; visibility: visible; width: 80px; height: 20px;' class=''>
		</iframe></span></div>";
	echo "<h2>-- " . $tiempo . " --</h2>". $meh;
	include('funciones.php');
	}
	elseif(isset($_GET['facultad'])){
		$arrv = array("'", '%27', ' ', 'delete', 'drop');
		$arrn = array('', '', '', '', '');
		$facu = str_replace($arrv, $arrn, $_GET['facultad']);
		
		$sql = "SELECT nombre from unidad_academica where sigla='" . $facu . "'";
		
	//aca
		$result = consulta($sql);


		$cont = pg_num_rows($result);
		
		$meh = "<div style='text-align: right !important;' class='fb-share-button fb_iframe_widget' data-href='http://www.uncoma.edu.ar/oferta/?facultad=%27". $_GET['facultad'] ."%27 data-layout='button' fb-xfbml-state='rendered' fb-iframe-plugin-query='app_id=&amp;container_width=255&amp;href=http%3A%2F%2Fwww.uncoma.edu.ar%2Foferta%2F%3Ffacultad%3D%27". $_GET['facultad'] ."%27&amp;layout=button&amp;locale=es_LA&amp;sdk=joey'>
			<span style='vertical-align: bottom; width: 80px; height: 20px;'>
			<iframe name='f39236a9e01d824' width='1000px' height='1000px' frameborder='0' allowtransparency='true' allowfullscreen='true' scrolling='no' title='fb:share_button Facebook Social Plugin' src='https://www.facebook.com/v2.5/plugins/share_button.php?app_id=&amp;channel=http%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D42%23cb%3Df361cbb29a0d4c4%26domain%3Dlocalhost%26origin%3Dhttp%253A%252F%252Flocalhost%252Ff21c91d922c6fa%26relation%3Dparent.parent&amp;container_width=255&amp;href=http%3A%2F%2Fwww.uncoma.edu.ar%2Foferta%2F%3Ffacultad%3D%27". $_GET['facultad'] ."%27&amp;layout=button&amp;locale=es_LA&amp;sdk=joey' style='border: none; visibility: visible; width: 80px; height: 20px;' class=''>
			</iframe></span></div>";

		if ($cont != 0) {
			$row = pg_fetch_array($result, null, PGSQL_ASSOC);
			echo "<h2>-- " . $row["nombre"] . " --</h2>" . $meh;
		}


		$sql = "SELECT plan_estudio.*, area.nombre AS nomarea, unidad_academica.nombre AS unita FROM plan_estudio inner join se_dicta on (se_dicta.id_plan=plan_estudio.id_plan) inner join sede on (sede.id_sede=se_dicta.id_sede) inner join unidad_academica on (unidad_academica.sigla = plan_estudio.id_unidad_academica) join pertenece on (pertenece.id_plan = plan_estudio.id_plan) inner join area on (area.id_area=pertenece.id_area) where unidad_academica.sigla='" . $facu . "'";


		include("funciones.php");
	}
	elseif(isset($_GET['ubicacion'])){
			$arrv = array("'", '%27', ' ', 'delete', 'drop');
			$arrn = array('', '', '', '', '');
			$ubi = str_replace($arrv, $arrn, $_GET['ubicacion']);
			$sql = "SELECT nombre from localidad where id_localidad='" . $ubi . "'";

			$result = consulta($sql);
			
			$meh = "<div style='text-align: right !important;' class='fb-share-button fb_iframe_widget' data-href='http://www.uncoma.edu.ar/oferta/?ubicacion=". $ubi ." data-layout='button' fb-xfbml-state='rendered' fb-iframe-plugin-query='app_id=&amp;container_width=255&amp;href=http%3A%2F%2Fwww.uncoma.edu.ar%2Foferta%2F%3Fubicacion%3D". $ubi ."&amp;layout=button&amp;locale=es_LA&amp;sdk=joey'>
				<span style='vertical-align: bottom; width: 80px; height: 20px;'>
				<iframe name='f39236a9e01d824' width='1000px' height='1000px' frameborder='0' allowtransparency='true' allowfullscreen='true' scrolling='no' title='fb:share_button Facebook Social Plugin' src='https://www.facebook.com/v2.5/plugins/share_button.php?app_id=&amp;channel=http%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D42%23cb%3Df361cbb29a0d4c4%26domain%3Dlocalhost%26origin%3Dhttp%253A%252F%252Flocalhost%252Ff21c91d922c6fa%26relation%3Dparent.parent&amp;container_width=255&amp;href=http%3A%2F%2Fwww.uncoma.edu.ar%2Foferta%2F%3Fubicacion%3D". $ubi ."&amp;layout=button&amp;locale=es_LA&amp;sdk=joey' style='border: none; visibility: visible; width: 80px; height: 20px;' class=''>
				</iframe></span></div>";

			$cont = pg_num_rows($result);

			if ($cont != 0) {
				$row = pg_fetch_array($result, null, PGSQL_ASSOC);
				echo "<h2>-- " . $row["nombre"] . " --</h2>". $meh;
			}


			$sql = "SELECT plan_estudio.*, area.nombre AS nomarea, unidad_academica.nombre AS unita FROM plan_estudio inner join se_dicta on (se_dicta.id_plan=plan_estudio.id_plan) inner join sede on (sede.id_sede=se_dicta.id_sede) inner join unidad_academica on (unidad_academica.sigla = plan_estudio.id_unidad_academica) inner join pertenece on (pertenece.id_plan = plan_estudio.id_plan) inner join area on (area.id_area=pertenece.id_area) where sede.id_localidad='" . $ubi . "'";


			include('funciones.php');
	}
	elseif(isset($_GET['area'])){
			$arrv = array("'", '%27', ' ', 'delete', 'drop');
			$arrn = array('', '', '', '', '');
			$are = str_replace($arrv, $arrn, $_GET['area']);
			$sql = "SELECT nombre FROM area where id_area='" . $are . "'";

			$result = consulta($sql);

			$cont = pg_num_rows($result);
			$meh = "<div style='text-align: right !important;' class='fb-share-button fb_iframe_widget' data-href='http://www.uncoma.edu.ar/oferta/?area=". $are ." data-layout='button' fb-xfbml-state='rendered' fb-iframe-plugin-query='app_id=&amp;container_width=255&amp;href=http%3A%2F%2Fwww.uncoma.edu.ar%2Foferta%2F%3Farea%3D". $are ."&amp;layout=button&amp;locale=es_LA&amp;sdk=joey'>
			<span style='vertical-align: bottom; width: 80px; height: 20px;'>
			<iframe name='f39236a9e01d824' width='1000px' height='1000px' frameborder='0' allowtransparency='true' allowfullscreen='true' scrolling='no' title='fb:share_button Facebook Social Plugin' src='https://www.facebook.com/v2.5/plugins/share_button.php?app_id=&amp;channel=http%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D42%23cb%3Df361cbb29a0d4c4%26domain%3Dlocalhost%26origin%3Dhttp%253A%252F%252Flocalhost%252Ff21c91d922c6fa%26relation%3Dparent.parent&amp;container_width=255&amp;href=http%3A%2F%2Fwww.uncoma.edu.ar%2Foferta%2F%3Farea%3D". $are ."&amp;layout=button&amp;locale=es_LA&amp;sdk=joey' style='border: none; visibility: visible; width: 80px; height: 20px;' class=''>
			</iframe></span></div>";
			if ($cont != 0) {
				$row = pg_fetch_array($result, null, PGSQL_ASSOC);
				echo "<h2>-- " . $row["nombre"] . " --</h2>" . $meh;
			}

			$sql = "SELECT plan_estudio.*, area.nombre AS nomarea, unidad_academica.nombre AS unita FROM plan_estudio inner join unidad_academica on (unidad_academica.sigla = plan_estudio.id_unidad_academica) inner join pertenece on (pertenece.id_plan = plan_estudio.id_plan) inner join area  on (area.id_area=pertenece.id_area) where pertenece.id_area='" . $are . "'";

			$result = consulta($sql);
						
			include('funciones.php');
	}
	elseif(isset($_GET['nivel'])){
			$arrv = array("'", '%27', ' ', 'delete', 'drop');
			$arrn = array('', '', '', '', '');
			$niv = str_replace($arrv, $arrn, $_GET['nivel']);
			
			

			$tiempo = "";
			switch ($niv) {
				case 1:
					$tiempo = "Pregrado/Grado";
					$sql = "SELECT plan_estudio.*, area.nombre AS nomarea, unidad_academica.nombre AS unita FROM plan_estudio inner join unidad_academica on (unidad_academica.sigla = plan_estudio.id_unidad_academica) inner join pertenece on (pertenece.id_plan = plan_estudio.id_plan) inner join area  on (area.id_area=pertenece.id_area) where (nivel<1 or nivel is null)";
					break;
				case 2:
					$tiempo = "Posgrado";
					$sql = "SELECT plan_estudio.*, area.nombre AS nomarea, unidad_academica.nombre AS unita FROM plan_estudio inner join unidad_academica on (unidad_academica.sigla = plan_estudio.id_unidad_academica) inner join pertenece on (pertenece.id_plan = plan_estudio.id_plan) inner join area  on (area.id_area=pertenece.id_area) where nivel>0";
					break;
				default:
					$tiempo = "Grado";
					$sql = "SELECT plan_estudio.*, area.nombre AS nomarea, unidad_academica.nombre AS unita FROM plan_estudio inner join unidad_academica on (unidad_academica.sigla = plan_estudio.id_unidad_academica) inner join pertenece on (pertenece.id_plan = plan_estudio.id_plan) inner join area  on (area.id_area=pertenece.id_area) where nivel=0";
					break;
			}
			
			$meh = "<div style='text-align: right !important;' class='fb-share-button fb_iframe_widget' data-href='http://www.uncoma.edu.ar/oferta/?nivel=". $niv ." data-layout='button' fb-xfbml-state='rendered' fb-iframe-plugin-query='app_id=&amp;container_width=255&amp;href=http%3A%2F%2Fwww.uncoma.edu.ar%2Foferta%2F%3Fnivel%3D". $niv ."&amp;layout=button&amp;locale=es_LA&amp;sdk=joey'>
				<span style='vertical-align: bottom; width: 80px; height: 20px;'>
				<iframe name='f39236a9e01d824' width='1000px' height='1000px' frameborder='0' allowtransparency='true' allowfullscreen='true' scrolling='no' title='fb:share_button Facebook Social Plugin' src='https://www.facebook.com/v2.5/plugins/share_button.php?app_id=&amp;channel=http%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D42%23cb%3Df361cbb29a0d4c4%26domain%3Dlocalhost%26origin%3Dhttp%253A%252F%252Flocalhost%252Ff21c91d922c6fa%26relation%3Dparent.parent&amp;container_width=255&amp;href=http%3A%2F%2Fwww.uncoma.edu.ar%2Foferta%2F%3Fnivel%3D". $niv ."&amp;layout=button&amp;locale=es_LA&amp;sdk=joey' style='border: none; visibility: visible; width: 80px; height: 20px;' class=''>
				</iframe></span></div>";
			
			echo "<h2>-- " . $tiempo . " --</h2>" . $meh;


			include('funciones.php');
			
	}
	elseif(isset($_GET['sigla'])){
		$arrv = array("'", '%27', ' ', 'delete', 'drop');
		$arrn = array('', '', '', '', '');
		$sig = str_replace($arrv, $arrn, $_GET['sigla']);
		
		siglar($_GET['sigla']);
		//aca
		
	}
	elseif(isset($_GET['carrera'])){
		
    $id = $_GET['carrera'];
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
		$meh = "<div class='fb-share-button fb_iframe_widget' data-href='http://www.uncoma.edu.ar/oferta/?carrera=". $id ." data-layout='button' fb-xfbml-state='rendered' fb-iframe-plugin-query='app_id=&amp;container_width=255&amp;href=http%3A%2F%2Fwww.uncoma.edu.ar%2Foferta%2F%3Fcarrera%3D". $id ."&amp;layout=button&amp;locale=es_LA&amp;sdk=joey'>
		<span style='vertical-align: bottom; width: 80px; height: 20px;'>
		<iframe name='f39236a9e01d824' width='1000px' height='1000px' frameborder='0' allowtransparency='true' allowfullscreen='true' scrolling='no' title='fb:share_button Facebook Social Plugin' src='https://www.facebook.com/v2.5/plugins/share_button.php?app_id=&amp;channel=http%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D42%23cb%3Df361cbb29a0d4c4%26domain%3Dlocalhost%26origin%3Dhttp%253A%252F%252Flocalhost%252Ff21c91d922c6fa%26relation%3Dparent.parent&amp;container_width=255&amp;href=http%3A%2F%2Fwww.uncoma.edu.ar%2Foferta%2F%3Fcarrera%3D". $id ."&amp;layout=button&amp;locale=es_LA&amp;sdk=joey' style='border: none; visibility: visible; width: 80px; height: 20px;' class=''>
		</iframe></span></div>";

        //Va al final
        $cuerpo = "<div class='resalta2'>Área: $area</div><div class='resalta2'> $unidadcompleta</div> <div class='resalta2'>Ciudad:</div> $ciudad<div class='resalta2'>Duración: $duracion</div>"
                . "<div class='resalta2'>Titulo: $titulo</div>". $meh ."$descrip<hr><div class='conttit' title='Materias' Style='text-align:center; font-size: 2.5ex; text-transform: uppercase;text-decoration: underline;font-weight: bold;'>Materias</div>$materias<br>" . $observacion;
    }
    //select * from plan_estudio inner join unidad_academica on unidad_academica.sigla=plan_estudio.id_unidad_academica where plan_estudio.id_unidad_academica='FAIF'
    
    //Fin

echo (salida($titular, $cuerpo));

	}
	else{
		

		$meh = "<div style='text-align: right !important;' class='fb-share-button fb_iframe_widget' data-href='http://www.uncoma.edu.ar/oferta/?todos=1 data-layout='button' fb-xfbml-state='rendered' fb-iframe-plugin-query='app_id=&amp;container_width=255&amp;href=http%3A%2F%2Fwww.uncoma.edu.ar%2Foferta%2F%3Ftodos%3D1&amp;layout=button&amp;locale=es_LA&amp;sdk=joey'>
				<span style='vertical-align: bottom; width: 80px; height: 20px;'>
				<iframe name='f39236a9e01d824' width='1000px' height='1000px' frameborder='0' allowtransparency='true' allowfullscreen='true' scrolling='no' title='fb:share_button Facebook Social Plugin' src='https://www.facebook.com/v2.5/plugins/share_button.php?app_id=&amp;channel=http%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D42%23cb%3Df361cbb29a0d4c4%26domain%3Dlocalhost%26origin%3Dhttp%253A%252F%252Flocalhost%252Ff21c91d922c6fa%26relation%3Dparent.parent&amp;container_width=255&amp;href=http%3A%2F%2Fwww.uncoma.edu.ar%2Foferta%2F%3Ftodos%3D1&amp;layout=button&amp;locale=es_LA&amp;sdk=joey' style='border: none; visibility: visible; width: 80px; height: 20px;' class=''>
				</iframe></span></div>";
        
        echo "<h2>-- Todas las carreras --</h2>" . $meh;
        
        $sql = "SELECT plan_estudio.*, area.nombre AS nomarea, unidad_academica.nombre AS unita FROM plan_estudio inner join unidad_academica on (unidad_academica.sigla = plan_estudio.id_unidad_academica) inner join pertenece on (pertenece.id_plan = plan_estudio.id_plan) inner join area  on (area.id_area=pertenece.id_area) order by nombre asc";


        include('funciones.php');
	}
}
function siglar($sig){
	
    $siglas = $sig;

    $sql = "SELECT * FROM unidad_academica where unidad_academica.sigla='" . $siglas . "'";

    $result = consulta($sql);

//usar esto INNER JOIN sede ON (sede.)
    $cont = pg_num_rows($result);

    if ($cont != 0) {

        $row = pg_fetch_array($result, null, PGSQL_ASSOC);

        $correo1 = $row['correo_1'];
        $correo2 = $row['correo_2'];
        $correo3 = $row['correo_3'];
        $pagina1 = $row['pagina_1'];
        $nombre = $row['nombre'];
        $imagen = $row['imagen'];
        $facebook = $row['facebook'];
        $pagina2 = $row['pagina_2'];
        $twitter = $row['twitter'];
        $linkedin = $row['linkedin'];

        $salida = "<h2>-- " . $nombre . " --</h2><hr>";
        if ($pagina1 != '') {
            $pagina1 .= '#fin';
            $arrv = array('http://', '/#fin', '#fin');
            $arrn = array('', '', '');
            $pagina1 = str_replace($arrv, $arrn, $pagina1);

            $salida = $salida . "<div class='resalta2'>Página Web:</div><a target='_blank' href='http://" . $pagina1 . "'>http://" . $pagina1 . "</a><br>";
        }
        if ($pagina2 != '') {
            $pagina2 .= '#fin';
            $arrv = array('http://', '/#fin', '#fin');
            $arrn = array('', '', '');
            $pagina2 = str_replace($arrv, $arrn, $pagina2);

            $salida = $salida . "<a target='_blank' href='http://" . $pagina2 . "'>http://" . $pagina2 . "</a><br>";
        }

        if ($correo1 != '') {
            $salida = $salida . "<div class='resalta2'>Email:</div>" . $correo1 . "<br>";
        }
        if ($correo2 != '') {
            $salida = $salida . $correo2 . "<br>";
        }
        if ($correo3 != '') {
            $salida = $salida . $correo3 . "<br>";
        }

        if ($facebook != '') {
            $facebook .= '#fin';
            $arrv = array('http://', 'https://', 'www.', 'facebook.com/', '/#fin', '#fin');
            $arrn = array('', '', '', '', '', '');
            $facebook = str_replace($arrv, $arrn, $facebook);
            $salida = $salida . "<div class='resalta2'>Facebook:</div><a target='_blank' href='http://www.facebook.com/" . $facebook . "'>" . $facebook . "</a><br>";
        }

        if ($twitter != '') {
            $twitter .= '#fin';
            $arrv = array('http://', 'https://', 'www.', 'twitter.com/', '/#fin', '#fin', '@');
            $arrn = array('', '', '', '', '', '', '');
            $twitter = str_replace($arrv, $arrn, $twitter);
            $salida = $salida . "<div class='resalta2'>Twitter:</div><a target='_blank' href='http://www.twitter.com/" . $twitter . "'>@" . $twitter . "</a><br>";
        }

        if ($linkedin != '') {
            $linkedin .= '#fin';
            $arrv = array('http://', 'https://', 'www.', 'ar.linkedin.com/', 'linkedin.com/', '/#fin', '#fin', '@');
            $arrn = array('', '', '', '', '', '', '', '');
            $linkedin = str_replace($arrv, $arrn, $linkedin);
            $salida = $salida . "<div class='resalta2'>Linkedin:</div><a target='_blank' href='http://ar.linkedin.com/" . $linkedin . "'>" . $linkedin . "</a><br>";
        }

        if ($imagen != '') {
            //$salida = $salida . "<img class='adapta' src='" . $imagen . "' alt='facultad' title='facultad'>";

            $fp_imagen = $imagen;

            if (isset($fp_imagen)) {
                //-- Se necesita el path fisico y la url de una archivo temporal que va a contener la imagen
                $temp_nombre = 'img' . $siglas . '.jpg';
                $temp_archivo = "temp/" . $temp_nombre;

                //-- Se pasa el contenido al archivo temporal
                $temp_fp = fopen($temp_archivo, 'w');
                fwrite($temp_fp, $fp_imagen);
                
                fclose($temp_fp);
                $tamano = round(filesize($temp_archivo) / 1024);

                //-- Se muestra la imagen temporal
                $salida = $salida . "<img src='{$temp_archivo}' width=100 height=100>";
                //$ar['imagen'] = 'Tamaño: ' . $tamano . ' KB';
            }
        }
        $salida = $salida . "<div class='resalta2'>Contacto:</div>";
        $sql1 = "SELECT * FROM sede INNER JOIN localidad on (sede.id_localidad=localidad.id_localidad) WHERE sede.id_unidad_academica='" . $siglas . "'";


        $resulta = consulta($sql1);
        //aaaaaaaaaaaaallllalala
        while ($row = pg_fetch_array($resulta, null, PGSQL_ASSOC)) {

            $ctctemp = "-" . $row["nombre"] . '<br> Direcci&oacute;n: ' . $row["direccion"];
            //$salida = $salida . $ctctemp;
            if ($row["telefono_1"] != '') {
                $ctctemp = $ctctemp . '<br> tel: (' . $row["caracteristica"] . ') ' . $row["telefono_1"];

                if ($row["interno_1"] != '') {
                    $ctctemp = $ctctemp . ' (Interno ' . $row["interno_1"] . ')';
                }
            }

            if ($row["telefono_2"] != '') {
                $ctctemp = $ctctemp . '<br> tel2: (' . $row["caracteristica"] . ') ' . $row["telefono_2"];

                if ($row["interno_2"] != '') {
                    $ctctemp = $ctctemp . ' (Interno ' . $row["interno_2"] . ')';
                }
            }

            if ($row["telefono_3"] != '') {
                $ctctemp = $ctctemp . '<br> tel3: (' . $row["caracteristica"] . ') ' . $row["telefono_3"];

                if ($row["interno_3"] != '') {
                    $ctctemp = $ctctemp . ' (Interno ' . $row["interno_3"] . ')';
                }
            }

            if ($row["fax_1"] != '') {
                $ctctemp = $ctctemp . '<br> fax: (' . $row["caracteristica"] . ')' . $row["fax_1"];
            }

            if ($row["fax_2"] != '') {
                $ctctemp = $ctctemp . '<br> fax2: (' . $row["caracteristica"] . ')' . $row["fax_2"];
            }
            if ($row["fax_3"] != '') {
                $ctctemp = $ctctemp . '<br> fax3: (' . $row["caracteristica"] . ')' . $row["fax_3"];
            }
            $salida = $salida . $ctctemp . '<br><br>';
        }


        echo $salida;
    }
}
function Extraer($q) {
    //filtro anti sql
    $arrv = array('*', '%', '=', '<', '>');
    $arrn = array('', '', '', '', '');
    $aux = str_replace($arrv, $arrn, strtolower($q));
    //fin de filtro


    $sql = "SELECT plan_estudio.*, area.nombre AS nomarea, unidad_academica.nombre AS unita FROM plan_estudio inner join unidad_academica on (unidad_academica.sigla = plan_estudio.id_unidad_academica) inner join pertenece on (pertenece.id_plan = plan_estudio.id_plan) inner join area  on (area.id_area=pertenece.id_area) WHERE LOWER(plan_estudio.nombre) LIKE '%$aux%'";

    $result = pg_query($sql) or die();


    $cont = pg_num_rows($result);

    if ($cont == 0) {
        print '';
    } else {
        $salida = '';
        echo '<ul>';
        while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $unit = "<a style='color:#0064ad;text-decoration: none;' title='Ver información de la Unidad Académica' href='?sigla=" . $row["id_unidad_academica"] . "' > " . $row["unita"] . "</a>";
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

            $result2 = pg_query($sql2) or die();
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

    $result = pg_query($consulta) or die();
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
        echo "<li><a data-rel='close' style='font-size:0.8em;color:#0064ad;text-decoration: none;' title='Todas las carreras' href='?todos=1'>Todas las carreras</a></li>";
        while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $salida = $row["nombre"];
            print "<li><a style='font-size:0.8em;color:#0064ad;text-decoration: none;' title='" . $salida . "' href='?area=" . $row["id_area"] . "'>" . $salida . "</a></li>";
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
        echo "<li><a data-rel='close' style='font-size:0.8em;color:#0064ad;text-decoration: none;' title='Todas las carreras' href='?todos=1'>Todas las carreras</a></li>";
        while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $salida = $row["a"];
            $prov = $row["b"];
            print "<li><a style='font-size:0.8em;color:#0064ad;text-decoration: none;' title='$salida' href='?ubicacion=" . $row["id_localidad"] . "'>" . $salida . " (" . $prov . ")</a></li>";
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
        echo "<li><a data-rel='close' style='font-size:0.8em;color:#0064ad;text-decoration: none;' title='Todas las carreras' href='?todos=1'>Todas las carreras</a></li>";
        while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $title = $row["nombre"];
            $salida = acortar($row["nombre"]);
            print "<li><a style='font-size:0.8em;color:#0064ad;text-decoration: none;' title='" . $title . "' href='?facultad=" . $row["sigla"] . "'>" . $salida . "</a></li>";
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
