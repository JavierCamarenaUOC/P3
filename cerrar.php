<?php session_start();
//destruye las variables de sesión y redirige a la página principal
session_destroy();
header("Location: index.html");				
?>