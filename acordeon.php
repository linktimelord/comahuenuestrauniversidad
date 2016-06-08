<div data-role="collapsibleset" data-theme="a" data-inset="false" data-content-theme="a" data-collapsed-icon="arrow-r" data-expanded-icon="arrow-d" data-mini="true">

    <div data-role="collapsible">
        <h3 title="Buscar por &aacute;rea" >&Aacute;REA</h3>
            <?php
        aarea();
        ?>
    </div>



    <div data-role="collapsible" style="text-align: center;">
        <h3 title="Buscar por nombre">NOMBRE</h3>
            <form id="busqueda" action="#" onsubmit="Buscar();
                return false;">


            <input title="Ingrese carrera" type="text" id="texto" onclick = "if (this.value === 'Ingrese carrera...')
                        this.value = ''" value="Ingrese carrera..." onkeypress="Buscar();" autocomplete="off">
            <a style="text-decoration: none;display:inline;color:#880000;background: #fff;border-bottom:none;" href="#" onclick="Borrar()"><span class="icon-cross" title="Borrar busqueda"></span></a>
        </form>
    </div>

    <div data-role="collapsible">
        <h3 title="Buscar por ubicaci&oacute;n">UBICACI&Oacute;N</h3>
            <?php
        aubicacion();
        ?>
    </div>

    <div data-role="collapsible">
        <h3 title="Buscar por duraci&oacute;n">DURACI&Oacute;N</h3>
            <ul data-role="listview" style="list-style: none;">
			<li><a style='font-size:0.8em;color:#0064ad;text-decoration: none;' title='Todas las carreras' href='?todos=1'>Todas las carreras</a></li>
			<li><a style='font-size:0.8em;color:#0064ad;text-decoration: none;' title="Menor a 3 años" href='?duracion=1'>Menor a 3 años</a></li>
            <li><a style='font-size:0.8em;color:#0064ad;text-decoration: none;' title="De 3 a 4 años" href='?duracion=2'>De 3 a 4 años</a></li>
            <li><a style='font-size:0.8em;color:#0064ad;text-decoration: none;' title="De 4 a 5 años" href='?duracion=3'>De 4 a 5 años</a></li>
            <li><a style='font-size:0.8em;color:#0064ad;text-decoration: none;' title="Mayor a 5 años" href='?duracion=4'>Mayor a 5 años</a></li>
			</ul>
    </div>

    <div data-role="collapsible">
        <h3 title="Buscar por facultad">FACULTAD</h3>
            <?php
        afacultad();
        ?>
    </div>
	
	<div data-role="collapsible" style="text-align: center;">
        <h3 title="Buscar por nivel">NIVEL</h3>
            <ul data-role="listview" style="list-style: none;">
            <li><a style='font-size:0.8em;color:#0064ad;text-decoration: none;' title='Todas las carreras' href='?todos=1'>Todas las carreras</a></li>
			<li><a style='font-size:0.8em;color:#0064ad;text-decoration: none;' title="Pregrado y Grado" href='?nivel=1'>Pregrado / Grado</a></li>
			<li><a style='font-size:0.8em;color:#0064ad;text-decoration: none;' title="Posgrado" href='?nivel=2'>Posgrado</a></li>
        </ul>
    </div>
	<br>
</div>