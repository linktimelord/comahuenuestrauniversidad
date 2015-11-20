<?php
include './cnx.php';

if ($_GET['id_area'] != '-1') {
    if ($_GET['id_area'] != '-2') {

        $sql = "SELECT nombre FROM area where id_area='" . $_GET['id_area'] . "'";

        $result = consulta($sql);

//usar esto
        $cont = pg_num_rows($result);

        if ($cont != 0) {
            $row = pg_fetch_array($result, null, PGSQL_ASSOC);
            echo "<h2>-- " . $row["nombre"] . " --</h2>";
        }



        $sql = "SELECT plan_estudio.*, area.nombre AS nomarea, unidad_academica.nombre AS unita FROM plan_estudio inner join unidad_academica on (unidad_academica.sigla = plan_estudio.id_unidad_academica) inner join pertenece on (pertenece.id_plan = plan_estudio.id_plan) inner join area  on (area.id_area=pertenece.id_area) where pertenece.id_area='" . $_GET['id_area'] . "'";

        $result = consulta($sql);

include('funciones.php');

    } else {


        $sql = "SELECT nombre FROM area where id_area='" . $_GET['id_area'] . "'";

        $result = consulta($sql);


        $cont = pg_num_rows($result);

        if ($cont != 0) {
            $row = pg_fetch_array($result, null, PGSQL_ASSOC);
            echo "<h2>-- " . $row["nombre"] . " --</h2>";
        }
        $sql = "SELECT plan_estudio.*, area.nombre AS nomarea, unidad_academica.nombre AS unita FROM plan_estudio inner join unidad_academica on (unidad_academica.sigla = plan_estudio.id_unidad_academica) inner join pertenece on (pertenece.id_plan = plan_estudio.id_plan) inner join area  on (area.id_area=pertenece.id_area) order by nombre asc";


        include('funciones.php');

    }
} elseif ($_GET['id_localidad'] != '-1') {


        $sql = "SELECT nombre from localidad where id_localidad='" . $_GET['id_localidad'] . "'";

        $result = consulta($sql);


        $cont = pg_num_rows($result);

        if ($cont != 0) {
            $row = pg_fetch_array($result, null, PGSQL_ASSOC);
            echo "<h2>-- " . $row["nombre"] . " --</h2>";
        }


        $sql = "SELECT plan_estudio.*, area.nombre AS nomarea, unidad_academica.nombre AS unita FROM plan_estudio inner join se_dicta on (se_dicta.id_plan=plan_estudio.id_plan) inner join sede on (sede.id_sede=se_dicta.id_sede) inner join unidad_academica on (unidad_academica.sigla = plan_estudio.id_unidad_academica) inner join pertenece on (pertenece.id_plan = plan_estudio.id_plan) inner join area on (area.id_area=pertenece.id_area) where sede.id_localidad='" . $_GET['id_localidad'] . "'";


	include('funciones.php');

    }
elseif ($_GET['tiempo'] != '-1') {

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

            echo "<h2>-- " . $tiempo . " --</h2>";

          
             include('funciones.php');

        } 
elseif (isset($_GET['facultad'])&&$_GET['facultad'] != '-1') {


                    $sql = "SELECT nombre from unidad_academica where sigla='" . $_GET['facultad'] . "'";

                    $result = consulta($sql);


                    $cont = pg_num_rows($result);

                    if ($cont != 0) {
                        $row = pg_fetch_array($result, null, PGSQL_ASSOC);
                        echo "<h2>-- " . $row["nombre"] . " --</h2>";
                    }


                    $sql = "SELECT plan_estudio.*, area.nombre AS nomarea, unidad_academica.nombre AS unita FROM plan_estudio inner join se_dicta on (se_dicta.id_plan=plan_estudio.id_plan) inner join sede on (sede.id_sede=se_dicta.id_sede) inner join unidad_academica on (unidad_academica.sigla = plan_estudio.id_unidad_academica) join pertenece on (pertenece.id_plan = plan_estudio.id_plan) inner join area on (area.id_area=pertenece.id_area) where unidad_academica.sigla='" . $_GET['facultad'] . "'";


		    include("funciones.php");
                }        
        

        elseif ($_GET['siglas'] != '-1') {
                $siglas = $_GET['siglas'];


                $sql = "SELECT * FROM unidad_academica where unidad_academica.sigla='" . $siglas . "'";

                $result = consulta($sql);

//usar esto
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
                        $salida = $salida . "<img class='adapta' src='" . $imagen . "' alt='facultad' title='facultad'><br>";
                    }


                    echo $salida;
                }
            } 
            
