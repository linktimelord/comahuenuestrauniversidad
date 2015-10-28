<div data-role="collapsibleset" data-theme="a" data-inset="false" data-content-theme="a" data-collapsed-icon="arrow-r" data-expanded-icon="arrow-d" data-mini="true">
                        
                    <div data-role="collapsible">
                        <h3 title="Buscar por área" >ÁREA</h3>
                            <?php
                        aarea();
                        ?>
                    </div>

                    <div data-role="collapsible" style="text-align: center;">
                        <h3 title="Buscar por nombre">NOMBRE</h3>
                            <form id="busqueda" action="#" onsubmit="Borrar()">
                            

                            <input title="Ingrese carrera" type="text" id="texto" onclick = "if (this.value === 'Ingrese carrera...')
                                                                this.value = ''" value="Ingrese carrera..." onkeypress="Buscar();">
                            <a style="text-decoration: none;display:inline;color:#880000;background: #fff;border-bottom:none;" href="#" onclick="Borrar()"><span class="icon-cross" title="Borrar busqueda"></span></a>
                        </form>
                    </div>

                    <div data-role="collapsible">
                        <h3 title="Buscar por ubicación">UBICACIÓN</h3>
                            <?php
                        aubicacion();
                        ?>
                    </div>

                    <div data-role="collapsible">
                        <h3 title="Buscar por duración">DURACIÓN</h3>
                            <ul data-role="listview" style="list-style: none;">
                            <li><a style='font-size:0.8em;color:#0064ad;text-decoration: none;' title='Todas las carreras' href='#' onclick="realizaProceso(-2, -1, -1, -1);
                                    return false;">Todas las carreras</a></li>
                            <li><a style='font-size:0.8em;color:#0064ad;text-decoration: none;' onclick="realizaProceso(-1, -1, 1, -1);
                                    return false;" title="Menor a 3 años" href='#'>Menor a 3 años</a></li>
                            <li><a style='font-size:0.8em;color:#0064ad;text-decoration: none;' onclick="realizaProceso(-1, -1, 2, -1);
                                    return false;" title="De 3 a 4 años" href='#'>De 3 a 4 años</a></li>
                            <li><a style='font-size:0.8em;color:#0064ad;text-decoration: none;' onclick="realizaProceso(-1, -1, 3, -1);
                                    return false;" title="De 4 a 5 años" href='#'>De 4 a 5 años</a></li>
                            <li><a style='font-size:0.8em;color:#0064ad;text-decoration: none;' onclick="realizaProceso(-1, -1, 4, -1);
                                    return false;" title="Mayor a 5 años" href='#'>Mayor a 5 años</a></li>
                        </ul>
                    </div>

                </div>