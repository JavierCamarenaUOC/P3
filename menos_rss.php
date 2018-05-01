<?php include("conexion.php");
include("calcularusuario.php");
session_start();
//recogemos el dato del formulario
$enlace_rss= $_POST["rss2"];
$volver3="<br><a href='administracion2.html'>Volver</a>";
/* Comprobamos que hay sesión iniciada */
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
/*Cogemos el usuario que realiza la gestión*/
    $username=$_SESSION['username'];
    /*Calculamos su id a partir de su usuario*/
    $codig=codigo($username);
    /*Revisamos que es un enlace RSS válido*/
    $query="DELETE FROM noticias WHERE noticias.usuario=$codig AND noticias.link='$enlace_rss'";
    if ($ejecutarquery=$conectar->query($query)) {
    echo "<p>Canal borrado con éxito".$volver3;
    } else {
        echo "<p>No ha sido posible borrar el canal de la base de datos. Asegúrese de que lo ha introducido correctamente.".$volver3;
        echo $query;
    }
} else {
    header("Location: erroracceso.php");
}
?>