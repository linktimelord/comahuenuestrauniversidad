
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Universidad Nacional del Comahue</title>
        <link rel="shortcut icon" href="./imgs/favicon.jpg">
        <link rel="icon" href="./imgs/favicon.jpg" type="image/x-icon">

        <link rel="stylesheet" href="jquery/demos/css/themes/default/jquery.mobile-1.4.5.min.css">
        <link rel="stylesheet" href="jquery/demo.css">
        <script src="jquery/jquery.js"></script>
        <script src="jquery/demos/_assets/js/index.js"></script>
        <script src="jquery/jquery.mobile-1.4.5.min.js"></script>
        <link rel="stylesheet" href="css/fonts.css" type="text/css" media="all">
        <script type="text/javascript" src="ajax.js" ></script>

        <script>
            function realizaProceso(id_area, id_localidad, tiempo, siglas, facultad) {
                        var parametros = {
                                    "id_area": id_area, "id_localidad": id_localidad, "tiempo": tiempo, "siglas": siglas, "facultad": facultad
                        };
                        $.ajax({
                                    data:  parametros,
                                    url:   'carrerasfiltradas.php',
                                    type:  'get',
                                    beforeSend: function () {
                                                $("#resultados").html("Procesando, espere por favor...");
                                    },
                                    success:  function (response) {
                        cerrarmenu();
                                                $("#resultados").html(response);
                                    }
                        });
            }
        </script>
        <script src="jquery/menu.js"></script>
        <script>
            function Mostrarcar(id) {
                        var parametros = {
                                    "id": id
                        };
                        $.ajax({
                                    data:  parametros,
                                    url:   'carreraencontrada.php',
                                    type:  'get',
                                    beforeSend: function () {
                                                $("#resultados").html("Procesando, espere por favor...");
                                    },
                                    success:  function (response) {
                                                $("#resultados").html(response);
                                    }
                        });
            }
        </script>

    </head>
    <body>
        <?php
        include("./cnx.php");
        ?>
        <div data-role="page" class="jqm-demos jqm-panel-page" data-quicklinks="true">

            <!-- default panel  -->
            <div data-role="panel" id="defaultpanel">



            </div><!-- /default panel -->

            <div class="wrapper col0">
                <div id="topline">
                    <div id="dv">
                        <p>Tel: +54-299-4490300 | e-mail: <a href="mailto: webinfo@dti.uncoma.edu.ar">webinfo@dti.uncoma.edu.ar</a></p>
                        <ul>
                            <li><a href="http://www.uncoma.edu.ar/webmail.html">WEBMAIL</a></li>
                            <li><a href="http://www.uncoma.edu.ar/academica/sedes.html">SEDES</a></li>
                            <li><a href="http://www.uncoma.edu.ar/novedades.html">NOVEDADES</a></li>
                            <li><a href="http://prensa.uncoma.edu.ar/index.php/es/">PRENSA</a></li>
                        </ul>
                        <br class="clear">
                    </div>
                </div>
            </div>
            <div data-role="header" class="jqm-header">
                <h2><a href="#" title="Universidad del Comahue"><img src="imgs/titulo.png" alt="Uncoma"></a></h2>
                <a href="#" class="jqm-navmenu-link ui-btn ui-btn-icon-notext ui-corner-all ui-icon-bars ui-nodisc-icon ui-alt-icon ui-btn-left">Menu</a>
                <a href="#" class="jqm-search-link ui-btn ui-btn-icon-notext ui-corner-all ui-icon-search ui-nodisc-icon ui-alt-icon ui-btn-right">Search</a>

                <div id="topbar">
                    <div id="topnav">
                        <ul>
                            <li class=""><a title="Buscar carreras" href="#">BUSCAR CARRERAS</a></li>
                            <li class=""><a title="Inicio" href="http://www.uncoma.edu.ar/index.html">INICIO</a></li>
                            <li><a title="Institucional" href="http://www.uncoma.edu.ar/institucional/historia.html">INSTITUCIONAL</a></li>
                            <li><a title="Academica" href="http://www.uncoma.edu.ar/academica/index.html">ACADÉMICA</a></li>
                            <li><a title="Ciencia y tecnología" href="http://www.uncoma.edu.ar/cyt/index.html">CIENCIA Y TECNICA</a>
                            </li><li title="Extensión" class="last"><a href="http://www.uncoma.edu.ar/extension/index.html">EXTENSIóN</a></li>
                        </ul>
                    </div>
                    <div id="search">
                        <form action="http://www.uncoma.edu.ar/institucional/historia.html#" method="post">
                            <fieldset>
                            </fieldset>
                        </form>
                    </div>
                    <br class="clear">
                </div>

            </div><!-- /header -->

            <div role="main" class="ui-content jqm-content">
                <!-- agregado  --><div class="content">
                    <?php include './androidapp.php'; ?>
                    <div id="titulo_seccion">
                        CARRERAS
                        <p style="font-size: 15px; padding-bottom: 0px; margin-bottom: 0px;padding-top: 0px; margin-top: 0px;">OFERTA ACAD&Eacute;MICA</p>
                    </div>

                    <div id="contenido_subtitulo" style="text-align:left;">
                    </div>
                    <div id="contenido_parrafos" style='text-align:left;'>

                        <div class="resultados" id="resultados">
                            <?php
                            areas1();
                            ?>
                        </div>
                        <hr>
                    </div><!-- Agregados  -->

                </div>
                <div class="column">
                    <div id="subnav" style="box-shadow:0px 5px 5px #0064AD">
                        <h2><strong>Buscar por...</strong></h2>
                        <?php
                        include("./acordeon.php");
                        ?>
                    </div>
                </div>
            </div>
            <!-- /content -->
            <!-- Menu de la izquierda -->
            <div data-role="panel" class="jqm-navmenu-panel" data-position="left" data-display="overlay" data-theme="a">
                <ul class="jqm-list ui-alt-icon ui-nodisc-icon">

                    <li data-filtertext="demos homepage" data-icon="home"><a href="http://uncoma.edu.ar" title="inicio">INICIO</a></li>
                    <li data-filtertext="buttons button markup buttonmarkup method anchor link button element"><a href="buscarcarrera.php" data-ajax="false">BUSCAR CARRERA</a></li>
                    <li data-role="collapsible" data-enhanced="true" data-collapsed-icon="carat-d" data-expanded-icon="carat-u" data-iconpos="right" data-inset="false" class="ui-collapsible ui-collapsible-themed-content ui-collapsible-collapsed">    

                        <h3 class="ui-collapsible-heading ui-collapsible-heading-collapsed">
                            <a href="#" class="ui-collapsible-heading-toggle ui-btn ui-btn-icon-right ui-btn-inherit ui-icon-carat-d">
                                INSTITUCIONAL<span class="ui-collapsible-heading-status"> click para expandir</span>
                            </a>
                        </h3>
                        <div class="ui-collapsible-content ui-body-inherit ui-collapsible-content-collapsed" aria-hidden="true">
                            <ul>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="institucional/historia.html" data-ajax="false">Historia</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="institucional/autoridades.html" data-ajax="false">Autoridades</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="institucional/consejo-superior.html" data-ajax="false">Consejo Superior</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="institucional/decanos.html" data-ajax="false">Decanos</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="institucional/areas-de-gestion.html" data-ajax="false">Areas de Gestión</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="general/personal/index.html" data-ajax="false">Dirección de Personal</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="academica/sedes.html" data-ajax="false">Unidades Académicas</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="http://127.0.0.1/UNCOMA-NUEVO/htdocs/ord_0470_2009.pdf" data-ajax="false">Estatuto de la Universidad</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="institucional/auditoria.html" data-ajax="false">Auditoría Interna</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="institucional/organizaciones.html" data-ajax="false">Organizaciones</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="http://prensa.uncoma.edu.ar/index.php/es/fotos" data-ajax="false">Prensa Universitaria</a></li>
                            </ul></div>
                    </li>

                    <li data-role="collapsible" data-enhanced="true" data-collapsed-icon="carat-d" data-expanded-icon="carat-u" data-iconpos="right" data-inset="false" class="ui-collapsible ui-collapsible-themed-content ui-collapsible-collapsed">    

                        <h3 class="ui-collapsible-heading ui-collapsible-heading-collapsed">
                            <a href="#" class="ui-collapsible-heading-toggle ui-btn ui-btn-icon-right ui-btn-inherit ui-icon-carat-d">
                                ACADÉMICA<span class="ui-collapsible-heading-status"> click para expandir</span>
                            </a>
                        </h3>
                        <div class="ui-collapsible-content ui-body-inherit ui-collapsible-content-collapsed" aria-hidden="true">
                            <ul>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="academica/index.html" data-ajax="false">Presentación</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="academica/sedes.html" data-ajax="false">Unidades Académicas</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="academica/oferta-academica.html" data-ajax="false">Oferta Académica</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="http://bibliocentral.uncoma.edu.ar/" data-ajax="false">Biblioteca Central</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="academica/orientacion.html" data-ajax="false">Orientación e Ingreso</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="academica/ingresantes.html" data-ajax="false">Ingresantes 2015</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="http://posgrado.uncoma.edu.ar/" data-ajax="false">Posgrado</a></li>
                            </ul></div>
                    </li>

                    <li data-role="collapsible" data-enhanced="true" data-collapsed-icon="carat-d" data-expanded-icon="carat-u" data-iconpos="right" data-inset="false" class="ui-collapsible ui-collapsible-themed-content ui-collapsible-collapsed">    

                        <h3 class="ui-collapsible-heading ui-collapsible-heading-collapsed">
                            <a href="#" class="ui-collapsible-heading-toggle ui-btn ui-btn-icon-right ui-btn-inherit ui-icon-carat-d">
                                CIENCIA Y TÉCNICA<span class="ui-collapsible-heading-status"> click para expandir</span>
                            </a>
                        </h3>
                        <div class="ui-collapsible-content ui-body-inherit ui-collapsible-content-collapsed" aria-hidden="true">
                            <ul>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="cyt/index.html" data-ajax="false">Presentación</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="cyt/consejo.html" data-ajax="false">Consejo de CyT</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="cyt/proyectos.html" data-ajax="false">Programas y Proyectos</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="cyt/estimulo.html" data-ajax="false">Estímulo a la Producción Científica</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="cyt/becas.html" data-ajax="false">Becas de Investigación</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="cyt/formacion.html" data-ajax="false">Formación RRHH</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="cyt/incentivos.html" data-ajax="false">Programa de Incentivos</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="cyt/convocatorias.html" data-ajax="false">Convocatorias</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="cyt/personal.html" data-ajax="false">Personal Técnico</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="cyt/links.html" data-ajax="false">Links de Interés</a></li> 
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="http://goo.gl/Vy5nJ0" data-ajax="false">Proyectos Vigentes</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="cyt/grupos.html" data-ajax="false">Grupos de Investigación</a></li> 
                            </ul></div>
                    </li>

                    <li data-role="collapsible" data-enhanced="true" data-collapsed-icon="carat-d" data-expanded-icon="carat-u" data-iconpos="right" data-inset="false" class="ui-collapsible ui-collapsible-themed-content ui-collapsible-collapsed">    

                        <h3 class="ui-collapsible-heading ui-collapsible-heading-collapsed">
                            <a href="#" class="ui-collapsible-heading-toggle ui-btn ui-btn-icon-right ui-btn-inherit ui-icon-carat-d">
                                EXTENSIÓN<span class="ui-collapsible-heading-status"> click para expandir</span>
                            </a>
                        </h3>
                        <div class="ui-collapsible-content ui-body-inherit ui-collapsible-content-collapsed" aria-hidden="true">
                            <ul>
                                <li><a href="extension/index.html">Presentación</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="extension/universidad-en-el-barrio.html" data-ajax="false">Universidad en el Barrio</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="http://editorialuniversitariaeduco.blogspot.com/" data-ajax="false">Editorial Universitaria</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="extension/mavis.html" data-ajax="false">Medios Audiovisuales</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="http://www.radiouncocalf.com.ar/"  data-ajax="false">Radio UNC-Calf</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="extension/imprenta.html" data-ajax="false">Imprenta Universitaria</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="extension/museo.html" data-ajax="false">Museo de Geología y Palentología</a></li>
                                <li data-filtertext="form checkboxradio widget checkbox input checkboxes controlgroups"><a href="extension/tecnica.html" data-ajax="false">Coordinación Técnico Operativo</a></li>
                            </ul></div>
                    </li>
                </ul>
            </div><!-- Fin del menu de la izquierda -->



            <!-- Este es el panel derecho -->
            <div data-role="panel" class="jqm-search-panel" data-position="right" data-display="overlay" data-theme="a" style="background:#f6f6f6;">
                <h2><strong>Buscar por...</strong></h2>
                <?php
                include("./menuacordeon.php");
                ?>
            </div><!-- Fin del panel derecho -->
            <?php
            echo '<br>';
            include ("./pie.php");
            ?>
        </div><!-- /page -->

    </body>
</html>
