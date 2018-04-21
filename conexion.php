<?php
//conecta con la base de datos 
//el root no tiene contraseña
$conectar = mysqli_connect("localhost","root","") or die('No se pudo conectar: ' . mysql_error()); 
mysqli_query($conectar,"SET NAMES 'utf8'");
//selecciona la BBDD electro_tienda
mysqli_select_db($conectar,"allyournews") or die('No se pudo seleccionar la base de datos');

?>