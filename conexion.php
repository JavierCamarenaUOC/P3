<?php
//conecta con la base de datos 
//el root no tiene contraseña
$conectar = new mysqli ("localhost","root","1984", "allyournews");
if ($conectar->connect_errno) {
    trigger_error("Fallo en la conexión con MySQL, tipo de error= ($conexion->connect_error())");
}
$conectar->set_charset('utf8');
?>