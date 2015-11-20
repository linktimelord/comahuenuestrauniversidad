<?php
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