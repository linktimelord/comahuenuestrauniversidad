/* global Resultados */

function Buscador() {
    var xmlhttp = false;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

function Buscar() {
	var cont1 = (document.getElementsByClassName('textobusca').length) - 1;
    var Texto = document.getElementsByClassName('textobusca')[cont1].value;
	var cont2 = (document.getElementsByClassName('resultados').length) - 1;
    var Resultados = document.getElementsByClassName('resultados')[cont2];
    ajax = Buscador();
    ajax.open("GET", "buscar.php?q=" + Texto);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            Resultados.innerHTML = ajax.responseText;
        }
    };
    ajax.send(null);

}

function Buscar2() {
	var cont3 = (document.getElementsByClassName('textobusca2').length) - 1;
    var Texto2 = document.getElementsByClassName('textobusca2')[cont3].value;
    var cont2 = (document.getElementsByClassName('resultados').length) - 1;
    var Resultados = document.getElementsByClassName('resultados')[cont2];
    ajax = Buscador();
    ajax.open("GET", "buscar.php?q=" + Texto2);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            Resultados.innerHTML = ajax.responseText;
        }
    };
    ajax.send(null);
}
function cerrarmenu(){
    $('#cerrare').trigger('click');
}

function Buscar3() {
    var Texto2 = document.getElementById('texto2').value;
    var Resultados = document.getElementById('resultados');
    ajax = Buscador();
    ajax.open("GET", "buscar.php?q=" + Texto2);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            Resultados.innerHTML = ajax.responseText;
        }
    };
    ajax.send(null);
$('#cerrare').trigger('click');
}

function Borrar() {
    var cont3 = (document.getElementsByClassName('textobusca').length) - 1;
    var Texto = document.getElementsByClassName('textobusca')[cont3];
	var cont2 = (document.getElementsByClassName('resultados').length) - 1;
    var Resultados = document.getElementsByClassName('resultados')[cont2];
    Resultados.innerHTML = "<div id='smallresp' title='Menu - Busqueda' style='font-size:1em;text-align:center;color: #059BD8; text-decoration: none;'><span class='icon-arrow-up' style='color:#0064ad;'></span> &nbsp;&nbsp;&nbsp;&nbsp;MENU    |    BUSCAR CARRERAS &nbsp;&nbsp;&nbsp;&nbsp;<span class='icon-arrow-up' style='color:#0064ad;'></span></div><br>\n\
<div id='bigresp' title='Menu - Busqueda' style='font-size:1.8em;text-align:center;color: #059BD8; text-decoration: none;'>BUSCAR CARRERAS &nbsp;&nbsp;&nbsp;&nbsp;<span class='icon-arrow-right' style='color:#0064ad;'></span></div><br>";
    Texto.value='';
}

function Borrar2() {
    var cont1 = (document.getElementsByClassName('textobusca2').length) - 1;
    var Texto = document.getElementsByClassName('textobusca2')[cont1];
    var cont2 = (document.getElementsByClassName('resultados').length) - 1;
    var Resultados = document.getElementsByClassName('resultados')[cont2];
    Resultados.innerHTML = "<div id='smallresp' title='Menu - Busqueda' style='font-size:1em;text-align:center;color: #059BD8; text-decoration: none;'><span class='icon-arrow-up' style='color:#0064ad;'></span> &nbsp;&nbsp;&nbsp;&nbsp;MENU    |    BUSCAR CARRERAS &nbsp;&nbsp;&nbsp;&nbsp;<span class='icon-arrow-up' style='color:#0064ad;'></span></div><br>\n\
<div id='bigresp' title='Menu - Busqueda' style='font-size:1.8em;text-align:center;color: #059BD8; text-decoration: none;'>BUSCAR CARRERAS &nbsp;&nbsp;&nbsp;&nbsp;<span class='icon-arrow-right' style='color:#0064ad;'></span></div><br>";
    Texto.value='';
}

function Mostrar(Texto) {
    var Resultados = document.getElementById('resultados');
    ajax = Buscador();
    ajax.open("GET", "mostrar.php?id=" + Texto);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            Resultados.innerHTML = ajax.responseText;
        }
    };
    ajax.send(null);

}