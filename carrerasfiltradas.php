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

                $result2 = consulta($sql2);
                $cont2 = pg_num_rows($result2);
                $ubicacion = '';
                if ($cont2 > 0) {
                    $ubicacion = '<br> - ';
                    while ($rew = pg_fetch_array($result2, null, PGSQL_ASSOC)) {
                        $ubicacion = $ubicacion . " " . $rew['nombre'];
                        $cont2 = $cont2 - 1;
                        if ($cont2 > 0) {
                            $ubicacion .= "<br> - ";
                        }
                    }
                }

                print "<li>&nbsp;&nbsp;<a href='#' title='" . $salida . "' onclick=\"Mostrarcar(" . $plan . ");return false;\">" . $salida . "</a>" . $area . " (" . $unit . ")" . $ubicacion . $duracion . "</li>";
            }echo '</ul>';
        }
        pg_close();
    } else {


        $sql = "SELECT nombre FROM area where id_area='" . $_GET['id_area'] . "'";

        $result = consulta($sql);


        $cont = pg_num_rows($result);

        if ($cont != 0) {
            $row = pg_fetch_array($result, null, PGSQL_ASSOC);
            echo "<h2>-- " . $row["nombre"] . " --</h2>";
        }
        $sql = "SELECT plan_estudio.*, area.nombre AS nomarea, unidad_academica.nombre AS unita FROM plan_estudio inner join unidad_academica on (unidad_academica.sigla = plan_estudio.id_unidad_academica) inner join pertenece on (pertenece.id_plan = plan_estudio.id_plan) inner join area  on (area.id_area=pertenece.id_area) order by nombre asc";

        $result = consulta($sql);


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
                    $duracion = ' &nbsp; ' . ($duracion / 2) . " años";
                }
                $plan = $row["id_plan"];

                $sql2 = "SELECT localidad.nombre, sede.direccion from localidad inner join sede on (sede.id_localidad=localidad.id_localidad) inner join se_dicta on (sede.id_sede=se_dicta.id_sede) where se_dicta.id_plan='" . $plan . "'";

                $result2 = consulta($sql2);
                $cont2 = pg_num_rows($result2);
                $ubicacion = '';
                if ($cont2 > 0) {
                    $ubicacion = '<br> - ';
                    while ($rew = pg_fetch_array($result2, null, PGSQL_ASSOC)) {
                        $ubicacion = $ubicacion . " " . $rew['nombre'];
                        $cont2 = $cont2 - 1;
                        if ($cont2 > 0) {
                            $ubicacion .= "<br> - ";
                        }
                    }
                }

                print "<li>&nbsp;&nbsp;<a href='#' title='" . $salida . "' onclick=\"Mostrarcar(" . $plan . ");return false;\">" . $salida . "</a>" . $area . " (" . $unit . ")" . $ubicacion . "<br>" . $duracion . "</li>";
            }echo '</ul>';
        }
        pg_close();
    }
} else {
    if ($_GET['id_localidad'] != '-1') {


        $sql = "SELECT nombre from localidad where id_localidad='" . $_GET['id_localidad'] . "'";

        $result = consulta($sql);


        $cont = pg_num_rows($result);

        if ($cont != 0) {
            $row = pg_fetch_array($result, null, PGSQL_ASSOC);
            echo "<h2>-- " . $row["nombre"] . " --</h2>";
        }


        $sql = "SELECT plan_estudio.*, area.nombre AS nomarea, unidad_academica.nombre AS unita FROM plan_estudio inner join se_dicta on (se_dicta.id_plan=plan_estudio.id_plan) inner join sede on (sede.id_sede=se_dicta.id_sede) inner join unidad_academica on (unidad_academica.sigla = plan_estudio.id_unidad_academica) inner join pertenece on (pertenece.id_plan = plan_estudio.id_plan) inner join area on (area.id_area=pertenece.id_area) where sede.id_localidad='" . $_GET['id_localidad'] . "'";

        $result = consulta($sql);


        $cont = pg_num_rows($result);

        if ($cont == 0) {
            print 'No hay carreras en esta sede';
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

                $result2 = consulta($sql2);
                $cont2 = pg_num_rows($result2);
                $ubicacion = '';
                if ($cont2 > 0) {
                    $ubicacion = '<br> - ';
                    while ($rew = pg_fetch_array($result2, null, PGSQL_ASSOC)) {
                        $ubicacion = $ubicacion . " " . $rew['nombre'];
                        $cont2 = $cont2 - 1;
                        if ($cont2 > 0) {
                            $ubicacion .= "<br> - ";
                        }
                    }
                }

                print "<li>&nbsp;&nbsp;<a href='#' title='" . $salida . "' onclick=\"Mostrarcar(" . $plan . ");return false;\">" . $salida . "</a>" . $area . " (" . $unit . ")" . $ubicacion . $duracion . "</li>";
            }echo '</ul>';
        }
        pg_close();
    } else {
        if ($_GET['tiempo'] != '-1') {

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

            $result = consulta($sql);


            $cont = pg_num_rows($result);

            if ($cont == 0) {
                print 'No hay carreras en esta sede';
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

                    $result2 = consulta($sql2);
                    $cont2 = pg_num_rows($result2);
                    $ubicacion = '';
                    if ($cont2 > 0) {
                        $ubicacion = '<br> - ';
                        while ($rew = pg_fetch_array($result2, null, PGSQL_ASSOC)) {
                            $ubicacion = $ubicacion . " " . $rew['nombre'];
                            $cont2 = $cont2 - 1;
                            if ($cont2 > 0) {
                                $ubicacion .= "<br> - ";
                            }
                        }
                    }

                    print "<li>&nbsp;&nbsp;<a href='#' title='" . $salida . "' onclick=\"Mostrarcar(" . $plan . ");return false;\">" . $salida . "</a>" . $area . " (" . $unit . ")" . $ubicacion . $duracion . "</li>";
                }echo '</ul>';
            }
            pg_close();
        } else {
            if ($_GET['siglas'] != '-1') {
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
                        $arrv = ['http://', '/#fin', '#fin'];
                        $arrn = ['', '', ''];
                        $pagina1 = str_replace($arrv, $arrn, $pagina1);

                        $salida = $salida . "<div class='resalta2'>Página Web:</div><a target='_blank' href='http://" . $pagina1 . "'>http://" . $pagina1 . "</a><br>";
                    }
                    if ($pagina2 != '') {
                        $pagina2 .= '#fin';
                        $arrv = ['http://', '/#fin', '#fin'];
                        $arrn = ['', '', ''];
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
                        $arrv = ['http://', 'https://', 'www.', 'facebook.com/', '/#fin', '#fin'];
                        $arrn = ['', '', '', '', '', ''];
                        $facebook = str_replace($arrv, $arrn, $facebook);
                        $salida = $salida . "<div class='resalta2'>Facebook:</div><a target='_blank' href='http://www.facebook.com/" . $facebook . "'>" . $facebook . "</a><br>";
                    }

                    if ($twitter != '') {
                        $twitter .= '#fin';
                        $arrv = ['http://', 'https://', 'www.', 'twitter.com/', '/#fin', '#fin', '@'];
                        $arrn = ['', '', '', '', '', '', ''];
                        $twitter = str_replace($arrv, $arrn, $twitter);
                        $salida = $salida . "<div class='resalta2'>Twitter:</div><a target='_blank' href='http://www.twitter.com/" . $twitter . "'>@" . $twitter . "</a><br>";
                    }

                    if ($linkedin != '') {
                        $linkedin .= '#fin';
                        $arrv = ['http://', 'https://', 'www.', 'ar.linkedin.com/', 'linkedin.com/', '/#fin', '#fin', '@'];
                        $arrn = ['', '', '', '', '', '', '', ''];
                        $linkedin = str_replace($arrv, $arrn, $linkedin);
                        $salida = $salida . "<div class='resalta2'>Linkedin:</div><a target='_blank' href='http://ar.linkedin.com/" . $linkedin . "'>" . $linkedin . "</a><br>";
                    }

                    if ($imagen != '') {
                        $salida = $salida . "<img class='adapta' src='" . $imagen . "' alt='facultad' title='facultad'><br>";
                    }


                    echo $salida;
                }
            } else {
                // from here
                if ($_GET['facultad'] != '-1') {


                    $sql = "SELECT nombre from unidad_academica where sigla='" . $_GET['facultad'] . "'";

                    $result = consulta($sql);


                    $cont = pg_num_rows($result);

                    if ($cont != 0) {
                        $row = pg_fetch_array($result, null, PGSQL_ASSOC);
                        echo "<h2>-- " . $row["nombre"] . " --</h2>";
                    }


                    $sql = "SELECT plan_estudio.*, area.nombre AS nomarea, unidad_academica.nombre AS unita FROM plan_estudio inner join se_dicta on (se_dicta.id_plan=plan_estudio.id_plan) inner join sede on (sede.id_sede=se_dicta.id_sede) inner join unidad_academica on (unidad_academica.sigla = plan_estudio.id_unidad_academica) join pertenece on (pertenece.id_plan = plan_estudio.id_plan) inner join area on (area.id_area=pertenece.id_area) where unidad_academica.sigla='" . $_GET['facultad'] . "'";

                    $result = consulta($sql);


                    $cont = pg_num_rows($result);

                    if ($cont == 0) {
                        print 'No hay carreras registradas en esta facultad';
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

                            $result2 = consulta($sql2);
                            $cont2 = pg_num_rows($result2);
                            $ubicacion = '';
                            if ($cont2 > 0) {
                                $ubicacion = '<br> - ';
                                while ($rew = pg_fetch_array($result2, null, PGSQL_ASSOC)) {
                                    $ubicacion = $ubicacion . " " . $rew['nombre'];
                                    $cont2 = $cont2 - 1;
                                    if ($cont2 > 0) {
                                        $ubicacion .= "<br> - ";
                                    }
                                }
                            }

                            print "<li>&nbsp;&nbsp;<a href='#' title='" . $salida . "' onclick=\"Mostrarcar(" . $plan . ");return false;\">" . $salida . "</a>" . $area . " (" . $unit . ")" . $ubicacion . $duracion . "</li>";
                        }echo '</ul>';
                    }
                    pg_close();
                }
            }
        }
    }
}