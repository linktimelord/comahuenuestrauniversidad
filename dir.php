<?php
function isInteger($input){
    return(ctype_digit(strval($input)));
}
$raqui = '<script>function raqui() {}</script>';
if(isset($_GET['carrera'])){
	if(isInteger($_GET['carrera'])){
	$raqui =  '<script>function raqui() {Mostrarcar(' . $_GET['carrera'] . ');}</script>';	
}}
elseif(isset($_GET['duracion'])){
	$salida = 'realizaProceso(-1, -1, 4, -1, -1, -1);';
	switch($_GET['duracion']){
		case 1: $salida = 'realizaProceso(-1, -1, 1, -1, -1, -1);'; break;
		case 2: $salida = 'realizaProceso(-1, -1, 2, -1, -1, -1);'; break;
		case 3: $salida = 'realizaProceso(-1, -1, 3, -1, -1, -1);'; break;
	}
	$raqui = '<script>function raqui() {'. $salida .'}</script>';	
}
elseif(isset($_GET['area'])){
	if(isInteger($_GET['area'])){
	$salida = 'realizaProceso('. ($_GET['area']).', -1, -1, -1, -1, -1);';
	$raqui = '<script>function raqui() {'. $salida .'}</script>';	
}}
elseif(isset($_GET['ubicacion'])){
	if(isInteger($_GET['ubicacion'])){
	$salida = 'realizaProceso(-1, '. ($_GET['ubicacion']).', -1, -1, -1, -1);';
	$raqui = '<script>function raqui() {'. $salida .'}</script>';	
}}
elseif(isset($_GET['facultad'])){
	$salida = strtoupper($_GET['facultad']);
	$salida = 'realizaProceso(-1, -1, -1, -1,'. ($salida).', -1);';
	$raqui = '<script>function raqui() {'. $salida .'}</script>';	
}
elseif(isset($_GET['nivel'])){
	$salida = 'realizaProceso(-1, -1, -1, -1, -1, 0);';
	switch($_GET['nivel']){
		case 1: $salida = 'realizaProceso(-1, -1, -1, -1, -1, 1);'; break;
		case 2: $salida = 'realizaProceso(-1, -1, -1, -1, -1, 2);'; break;
	}
	$raqui = '<script>function raqui() {'. $salida .'}</script>';	
}
echo ($raqui);
?>