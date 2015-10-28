<!DOCTYPE html>
<html lang="es"> <!--<![endif]-->
    <head>	
        <meta charset="UTF-8">
        <title>Universidad del Comahue - Buscar Carreras</title>

        <link rel="stylesheet" href="css/estilo2.css" type="text/css" media="all">
        <link rel="stylesheet" href="css/fonts.css" type="text/css" media="all">
        <script type="text/javascript" src="ajax.js" ></script>
        <script src="jquery/jquery.min.js" title="sc2"></script>
        <script type="text/javascript" src="js/pestana.js" title="sc3"></script>
        <script src="jquery/menu.js" title="sc4"></script>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    </head>
    <body onload="cambiarPestanna(pestanas, pestana1);">

        <header>
            <div class="menu_bar">

                <a href="#" class="bt-menu" style="color: #0064ad;">
                    <span style="font-size: 1.175em; margin-top: 1.8em;" title="menu" class="icon-menu"></span>
                    <img alt="Bienvenido a Unco" title="Bienvenido a la Unco" class="adapta" src="imgs/logouncoma2.png">
                    UNIVERSIDAD NACIONAL DEL COMAHUE
                </a>
            </div>
            <div class="titulonormal">

                <a href="#" class="tit" style="color: #0064ad;">
                    <img class="adapta" src="imgs/logouncoma2.png" width="60" alt="Bienvenido a la Unco" title="Bienvenido a la Unco">
                    UNIVERSIDAD NACIONAL DEL COMAHUE
                    <img class="adapta" src="imgs/argentina.png" width="70" alt="Argentina" title="Argentina">
                </a>
            </div>
            <nav>
                <ul>
                    <li><a href="buscarcarreras.php?#" title="Buscador de Carreras"><span class="icon-search"></span>Carreras</a></li>
                    <li><a href="institucional.php" title="Institucional"><span class="icon-briefcase"></span>Institucional</a></li>
                    <li><a href="becas.php" title="Becas"><span class="icon-pushpin"></span>Becas</a></li>
                    <li><a href="deportes.php" title="Deportes"><span class="icon-trophy"></span>Deportes</a></li>
                    <li><a href="radio.php" title="Radio"><span class="icon-music"></span>Radio</a></li>
                    <li><a href="prensa.php" title="Prensa"><span class="icon-newspaper"></span>Prensa</a></li>
                    <li><a href="http://pedco.fi.uncoma.edu.ar" title="Pedco"><span class="icon-library"></span>Pedco</a></li>
                    <li><a href="contacto.php" title="Contacto"><span class="icon-phone"></span>Contacto</a></li>
                    <li><a href="acercade.php" title="Acerca de"><span class="icon-info"></span>Acerca de</a></li>
                </ul>
            </nav>
        </header>



        <section>
            <div class="muestra" id="tlm">

                <div class="cont_tit" title="Buscar Carreras"><p class="titulo" >Buscar Carrera</p></div>

                <div id="ej3">
                    <div id="timeline" style="float: left;">

                        <div id="pestanas">
                            <ul id=lista>
                                <li id="pestana1" title="Carreras por nombre"><a href='javascript:cambiarPestanna(pestanas,pestana1);'>Carrera</a></li>
                                <li id="pestana2" title="Carreras por sede"><a href='javascript:cambiarPestanna(pestanas,pestana2);'>Sede</a></li>
                                <li id="pestana3" title="Carreras por área"><a href='javascript:cambiarPestanna(pestanas,pestana3);'>Área</a></li>
                                <li id="pestana4" title="Carreras por duración"><a href='javascript:cambiarPestanna(pestanas,pestana4);'>Duración</a></li>
                            </ul>
                        </div>



                        <div id="contenidopestanas">
                            <div id="cpestana1">
                                <form id="busqueda" action="#" onsubmit="Borrar()">
                                    <span class="icon-search" title="Buscar"></span>

                                    <input title="Ingrese carrera" type="text" id="texto" onclick = "if (this.value == 'Ingrese carrera...')
                                        this.value = ''" value="Ingrese carrera..." onkeypress="Buscar();">

                                    <a href="#" onclick="Borrar()"><span class="icon-cross" title="Borrar busqueda"></span></a>
                                </form>

                            </div>
                            <div id="cpestana2">
                                <?php
                                $cadena = " host='localhost' port='5432' dbname='asi_es_unco' user='postgres' password='1234' ";
                                $con = pg_connect($cadena)
                                        or die('No se ha podido conectar: ' . pg_last_error());

                                $sql = "select localidad.nombre from sede INNER join localidad on sede.id_localidad = localidad.id_localidad ";

                                $result = pg_query($sql) or die("Error query " . pg_last_error());


                                $cont = pg_num_rows($result);

                                if ($cont == 0) {
                                    print "En construcción";
                                } else {
                                    $salida = '';
                                    echo "<ul style='list-style: none;'>";
                                    while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
                                        $salida = utf8_decode($row["nombre"]);
                                        print "<li><span class='icon-circle-right' style='color:#0064ad;'></span> &nbsp;&nbsp;<a style='color:#0064ad;text-decoration: none;' title='$salida' href='revisararea.php?id=" . "'>" . $salida . "</a></li>";
                                    }echo '</ul>';
                                }
                                pg_close();
                                ?>
                                <br>&nbsp;
                            </div>
                            <div id="cpestana3">
                                <?php
                                $cadena = " host='localhost' port='5432' dbname='asi_es_unco' user='postgres' password='1234' ";
                                $con = pg_connect($cadena)
                                        or die('No se ha podido conectar: ' . pg_last_error());

                                $sql = "SELECT * FROM area";

                                $result = pg_query($sql) or die("Error query " . pg_last_error());


                                $cont = pg_num_rows($result);

                                if ($cont == 0) {
                                    print "En construcción";
                                } else {
                                    $salida = '';
                                    echo '<ul>';
                                    while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
                                        $salida = utf8_decode($row["nombre"]);
                                        print "<li><span class='icon-circle-right' style='color:#0064ad;'></span> &nbsp;&nbsp;<a style='color:#0064ad;text-decoration: none;' title='".$row["id_area"]."' href='revisararea.php?id=" . $row["id_area"] . "'>" . $salida . "</a></li>";
                                    }echo '</ul>';
                                }
                                pg_close();
                                ?>
                                <br>&nbsp;
                            </div>
                            <div id="cpestana4">
                                <span class='icon-circle-right' style='color:#0064ad;'></span> &nbsp;&nbsp;<a style='color:#0064ad;text-decoration: none;' title="Menor a 3 años" href='duracion.php?time=1'> Menor a 3 años</a><br>
                                <span class='icon-circle-right' style='color:#0064ad;'></span> &nbsp;&nbsp;<a style='color:#0064ad;text-decoration: none;' title="De 3 a 4 años" href='duracion.php?time=2'> De 3 a 4 años</a><br>
                                <span class='icon-circle-right' style='color:#0064ad;'></span> &nbsp;&nbsp;<a style='color:#0064ad;text-decoration: none;' title="De 4 a 5 años" href='duracion.php?time=3'> De 4 a 5 años</a><br>
                                <span class='icon-circle-right' style='color:#0064ad;'></span> &nbsp;&nbsp;<a style='color:#0064ad;text-decoration: none;' title="Mayor a 5 años" href='duracion.php?time=4'> Mayor a 5 años</a><br>&nbsp;

                            </div>
                        </div>

                        <div class="resultados" id="resultados"></div>
                    </div>

                </div>
            </div>

        </section>
        <footer role="contentinfo">
            <div id="pie" class="cl">
                <div class="note">
                    <ul>
                        <li>Asi es la UNCo</li>
                        <li>Universidad Nacional del Comahue</li>
                        <li>2015</li>
                    </ul>
                </div>

                <div id="logofoot" class="right">
                    <a href="index.php"><img width="130" height="67" src="imgs/sponsor1.jpg" alt="Sponsor" title="Credicoop"></a>		
                    <a href="index.php"><img width="130" height="67" src="imgs/sponsor2.jpg" alt="Sponsor" title="YPF"></a>		
                    <a href="index.php"><img width="130" height="67" src="imgs/sponsor3.jpg" alt="Sponsor" title="Sponsors"></a>		
                </div>

            </div>
        </footer>



    </body>
</html>

