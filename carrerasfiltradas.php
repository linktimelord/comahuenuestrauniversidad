<?php

include './cnx.php';

if ($_GET['id_area'] != '-1') {
    if ($_GET['id_area'] != '-2') {

        $sql = "SELECT nombre FROM area where id_area='" . $_GET['id_area'] . "'";

        $result = consulta($sql);

//usar esto
        $cont = pg_num_rows($result);
		$meh = "<div style='text-align: right !important;' class='fb-share-button fb_iframe_widget' data-href='http://www.uncoma.edu.ar/oferta/?area=". $_GET['id_area'] ." data-layout='button' fb-xfbml-state='rendered' fb-iframe-plugin-query='app_id=&amp;container_width=255&amp;href=http%3A%2F%2Fwww.uncoma.edu.ar%2Foferta%2F%3Farea%3D". $_GET['id_area'] ."&amp;layout=button&amp;locale=es_LA&amp;sdk=joey'>
		<span style='vertical-align: bottom; width: 80px; height: 20px;'>
		<iframe name='f39236a9e01d824' width='1000px' height='1000px' frameborder='0' allowtransparency='true' allowfullscreen='true' scrolling='no' title='fb:share_button Facebook Social Plugin' src='https://www.facebook.com/v2.5/plugins/share_button.php?app_id=&amp;channel=http%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D42%23cb%3Df361cbb29a0d4c4%26domain%3Dlocalhost%26origin%3Dhttp%253A%252F%252Flocalhost%252Ff21c91d922c6fa%26relation%3Dparent.parent&amp;container_width=255&amp;href=http%3A%2F%2Fwww.uncoma.edu.ar%2Foferta%2F%3Farea%3D". $_GET['id_area'] ."&amp;layout=button&amp;locale=es_LA&amp;sdk=joey' style='border: none; visibility: visible; width: 80px; height: 20px;' class=''>
		</iframe></span></div>";
        if ($cont != 0) {
            $row = pg_fetch_array($result, null, PGSQL_ASSOC);
            echo "<h2>-- " . $row["nombre"] . " --</h2>" . $meh;
        }

        $sql = "SELECT plan_estudio.*, area.nombre AS nomarea, unidad_academica.nombre AS unita FROM plan_estudio inner join unidad_academica on (unidad_academica.sigla = plan_estudio.id_unidad_academica) inner join pertenece on (pertenece.id_plan = plan_estudio.id_plan) inner join area  on (area.id_area=pertenece.id_area) where pertenece.id_area='" . $_GET['id_area'] . "'";

        $result = consulta($sql);
		
		
		
        include('funciones.php');
    } else {

		$meh = "<div class='fb-share-button fb_iframe_widget' data-href='http://www.uncoma.edu.ar/oferta/' data-layout='button' fb-xfbml-state='rendered' fb-iframe-plugin-query='app_id=&amp;container_width=255&amp;href=http%3A%2F%2Fwww.uncoma.edu.ar%2Foferta%2F&amp;layout=button&amp;locale=es_LA&amp;sdk=joey'>
		<span style='vertical-align: bottom; width: 80px; height: 20px;'>
		<iframe name='f35e9bfe130b114' width='1000px' height='1000px' frameborder='0' allowtransparency='true' allowfullscreen='true' scrolling='no' title='fb:share_button Facebook Social Plugin' src='https://www.facebook.com/v2.5/plugins/share_button.php?app_id=&amp;channel=http%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D42%23cb%3Dfc036aad53b13%26domain%3Dlocalhost%26origin%3Dhttp%253A%252F%252Flocalhost%252Ff3b6f015d0056b4%26relation%3Dparent.parent&amp;container_width=255&amp;href=http%3A%2F%2Fwww.uncoma.edu.ar%2Foferta%2F&amp;layout=button&amp;locale=es_LA&amp;sdk=joey' style='border: none; visibility: visible; width: 80px; height: 20px;' class=''>
		</iframe></span></div>";
        
        echo "<h2>-- Todas las carreras --</h2>" . $meh;
        
        $sql = "SELECT plan_estudio.*, area.nombre AS nomarea, unidad_academica.nombre AS unita FROM plan_estudio inner join unidad_academica on (unidad_academica.sigla = plan_estudio.id_unidad_academica) inner join pertenece on (pertenece.id_plan = plan_estudio.id_plan) inner join area  on (area.id_area=pertenece.id_area) order by nombre asc";


        include('funciones.php');
    }
} elseif ($_GET['id_localidad'] != '-1') {


    $sql = "SELECT nombre from localidad where id_localidad='" . $_GET['id_localidad'] . "'";

    $result = consulta($sql);
	
	$meh = "<div style='text-align: right !important;' class='fb-share-button fb_iframe_widget' data-href='http://www.uncoma.edu.ar/oferta/?ubicacion=". $_GET['id_localidad'] ." data-layout='button' fb-xfbml-state='rendered' fb-iframe-plugin-query='app_id=&amp;container_width=255&amp;href=http%3A%2F%2Fwww.uncoma.edu.ar%2Foferta%2F%3Fubicacion%3D". $_GET['id_localidad'] ."&amp;layout=button&amp;locale=es_LA&amp;sdk=joey'>
		<span style='vertical-align: bottom; width: 80px; height: 20px;'>
		<iframe name='f39236a9e01d824' width='1000px' height='1000px' frameborder='0' allowtransparency='true' allowfullscreen='true' scrolling='no' title='fb:share_button Facebook Social Plugin' src='https://www.facebook.com/v2.5/plugins/share_button.php?app_id=&amp;channel=http%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D42%23cb%3Df361cbb29a0d4c4%26domain%3Dlocalhost%26origin%3Dhttp%253A%252F%252Flocalhost%252Ff21c91d922c6fa%26relation%3Dparent.parent&amp;container_width=255&amp;href=http%3A%2F%2Fwww.uncoma.edu.ar%2Foferta%2F%3Fubicacion%3D". $_GET['id_localidad'] ."&amp;layout=button&amp;locale=es_LA&amp;sdk=joey' style='border: none; visibility: visible; width: 80px; height: 20px;' class=''>
		</iframe></span></div>";

    $cont = pg_num_rows($result);

    if ($cont != 0) {
        $row = pg_fetch_array($result, null, PGSQL_ASSOC);
        echo "<h2>-- " . $row["nombre"] . " --</h2>". $meh;
    }


    $sql = "SELECT plan_estudio.*, area.nombre AS nomarea, unidad_academica.nombre AS unita FROM plan_estudio inner join se_dicta on (se_dicta.id_plan=plan_estudio.id_plan) inner join sede on (sede.id_sede=se_dicta.id_sede) inner join unidad_academica on (unidad_academica.sigla = plan_estudio.id_unidad_academica) inner join pertenece on (pertenece.id_plan = plan_estudio.id_plan) inner join area on (area.id_area=pertenece.id_area) where sede.id_localidad='" . $_GET['id_localidad'] . "'";


    include('funciones.php');
}  elseif ($_GET['tiempo'] != '-1') {

    $tiempo = "";
    switch ($_GET['tiempo']) {
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
	
	$meh = "<div style='text-align: right !important;' class='fb-share-button fb_iframe_widget' data-href='http://www.uncoma.edu.ar/oferta/?duracion=". $_GET['tiempo'] ." data-layout='button' fb-xfbml-state='rendered' fb-iframe-plugin-query='app_id=&amp;container_width=255&amp;href=http%3A%2F%2Fwww.uncoma.edu.ar%2Foferta%2F%3Fduracion%3D". $_GET['tiempo'] ."&amp;layout=button&amp;locale=es_LA&amp;sdk=joey'>
		<span style='vertical-align: bottom; width: 80px; height: 20px;'>
		<iframe name='f39236a9e01d824' width='1000px' height='1000px' frameborder='0' allowtransparency='true' allowfullscreen='true' scrolling='no' title='fb:share_button Facebook Social Plugin' src='https://www.facebook.com/v2.5/plugins/share_button.php?app_id=&amp;channel=http%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D42%23cb%3Df361cbb29a0d4c4%26domain%3Dlocalhost%26origin%3Dhttp%253A%252F%252Flocalhost%252Ff21c91d922c6fa%26relation%3Dparent.parent&amp;container_width=255&amp;href=http%3A%2F%2Fwww.uncoma.edu.ar%2Foferta%2F%3Fduracion%3D". $_GET['tiempo'] ."&amp;layout=button&amp;locale=es_LA&amp;sdk=joey' style='border: none; visibility: visible; width: 80px; height: 20px;' class=''>
		</iframe></span></div>";

    echo "<h2>-- " . $tiempo . " --</h2>". $meh;


    include('funciones.php');
} elseif (isset($_GET['facultad']) && $_GET['facultad'] != '-1') {
	
	$arrv = array("'", '%27', ' ');
    $arrn = array('', '', '');
    $facu = str_replace($arrv, $arrn, $_GET['facultad']);
	

    $sql = "SELECT nombre from unidad_academica where sigla='" . $facu . "'";

	
	
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


    $sql = "SELECT plan_estudio.*, area.nombre AS nomarea, unidad_academica.nombre AS unita FROM plan_estudio inner join se_dicta on (se_dicta.id_plan=plan_estudio.id_plan) inner join sede on (sede.id_sede=se_dicta.id_sede) inner join unidad_academica on (unidad_academica.sigla = plan_estudio.id_unidad_academica) join pertenece on (pertenece.id_plan = plan_estudio.id_plan) inner join area on (area.id_area=pertenece.id_area) where unidad_academica.sigla='" . $_GET['facultad'] . "'";


    include("funciones.php");
}  elseif (isset($_GET['nivel']) && ($_GET['nivel'] != '-1')) {

    $tiempo = "";
    switch ($_GET['nivel']) {
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
	
	$meh = "<div style='text-align: right !important;' class='fb-share-button fb_iframe_widget' data-href='http://www.uncoma.edu.ar/oferta/?nivel=". $_GET['nivel'] ." data-layout='button' fb-xfbml-state='rendered' fb-iframe-plugin-query='app_id=&amp;container_width=255&amp;href=http%3A%2F%2Fwww.uncoma.edu.ar%2Foferta%2F%3Fnivel%3D". $_GET['nivel'] ."&amp;layout=button&amp;locale=es_LA&amp;sdk=joey'>
		<span style='vertical-align: bottom; width: 80px; height: 20px;'>
		<iframe name='f39236a9e01d824' width='1000px' height='1000px' frameborder='0' allowtransparency='true' allowfullscreen='true' scrolling='no' title='fb:share_button Facebook Social Plugin' src='https://www.facebook.com/v2.5/plugins/share_button.php?app_id=&amp;channel=http%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D42%23cb%3Df361cbb29a0d4c4%26domain%3Dlocalhost%26origin%3Dhttp%253A%252F%252Flocalhost%252Ff21c91d922c6fa%26relation%3Dparent.parent&amp;container_width=255&amp;href=http%3A%2F%2Fwww.uncoma.edu.ar%2Foferta%2F%3Fnivel%3D". $_GET['nivel'] ."&amp;layout=button&amp;locale=es_LA&amp;sdk=joey' style='border: none; visibility: visible; width: 80px; height: 20px;' class=''>
		</iframe></span></div>";
	
    echo "<h2>-- " . $tiempo . " --</h2>" . $meh;


    include('funciones.php');
}
elseif ($_GET['siglas'] != '-1') {
    $siglas = $_GET['siglas'];

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
            
