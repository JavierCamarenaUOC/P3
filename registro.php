<?php include("conexion.php");
include("canales.php");

$username=$_POST['usuario'];
$password=$_POST['password'];
$password2=$_POST['password2'];
$volver="<br><a href=registro.html>Volver</a>";
$volver2="<br><a href=login.html>Volver</a>";


if($password != $password2){
	
	echo "<center>Introduzca la misma contraseña.$volver</center>";
	
}else{

/*$conectar= mysqli_connect('localhost','root','1984');
if(!$conectar){
	echo "No se pudo conectar con el servidor";
}else{
$base=mysqli_select_db($conectar,'allyournews');
	if(!$base){
		echo "No se encuentra la base de datos";
	}
}*/
$sql="INSERT INTO usuario (username, password) VALUES ('$username','$password')";
if ($ejecutar=$conectar->prepare($sql)) {
    // echo $sql." es correcta";
    if ($ejecutar->execute()) {
    echo "<center>Datos guardados correctamente.$volver2</center>";
        /*Consultamos el código que se le ha dado al usuario nuevo para introducir también los canales de ejemplo */
$consulta2='SELECT codigo FROM usuario WHERE `username`="'.$username.'"';
$numerousu=$conectar->prepare($consulta2);
$numerousu->execute();
$numerousu->bind_result($codig);
$numerousu->fetch();
        $conectar->close();
        if (canales($username,$codig)){
            echo "<center>Canales de ejemplo añadidos con éxito.</center>";
        }
        }
    
} else {
    // echo "No va ni cara al viento";
    echo "<center>Nombre de usuario registrado, introduzca otro.$volver</center>";
}
}
?>