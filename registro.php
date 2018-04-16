<?php

$username=$_POST['usuario'];
$password=$_POST['password'];
$password2=$_POST['password2'];
$volver="<br><a href=registro.html>Volver</a>";


if($password != $password2){
	
	echo "<center>Introduzca la misma contraseña.$volver</center>";
	
}else{

$conectar= mysqli_connect('localhost','root','');
if(!$conectar){
	echo "No se pudo conectar con el servidor";
}else{
	$base=mysqli_select_db($conectar,'allyournews');
	if(!$base){
		echo "No se encuentra la base de datos";
	}
}


$sql="INSERT INTO usuario VALUES ('','$username','$password')";
$ejecutar=mysqli_query($conectar,$sql);

if(!$ejecutar){
	echo "<center>Nombre de usuario registrado, introduzca otro.$volver</center>";
}else{
	echo "<center>Datos guardados correctamente.$volver</center>";
}
}

?>