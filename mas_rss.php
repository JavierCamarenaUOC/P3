<?php include("conexion.php");
include("calcularusuario.php");
session_start();
//recogemos el dato del formulario
$enlace_rss= $_POST["rss1"];
$volver3="<br><a href='administracion2.html'>Volver</a>";
/* Comprobamos que hay sesión iniciada */
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
/*Cogemos el usuario que realiza la gestión*/
    $username=$_SESSION['username'];
    /*Calculamos su id a partir de su usuario*/
    $codig=codigo($username);
    /*Revisamos que es un enlace RSS válido*/
if ($canal=simplexml_load_file($enlace_rss)) {
    /* Comprobamos las variables xml */
    $pais=($canal->channel->language);
    if (empty($pais)) {
        $pais="No indicado";
    }
    $nombre=($canal->channel->link);
    $categoria=($canal->channel->title);
    $link=$enlace_rss;
    $usuario=$codig;
    $descripcion=($canal->channel->description);
    if (empty($descripcion)){
        $descripcion="No indicado";
    }
    $query="INSERT INTO noticias (pais, nombre, categoria, link, usuario, descripcion) VALUES ('$pais', '$nombre', '$categoria', '$link', $usuario, '$descripcion')";
    if ($ejecutarquery=$conectar->query($query)) {
    echo "<p>Canal añadido con éxito".$volver3;
    } else {
        echo "<p>No ha sido posible grabar el canal en la base de datos.".$volver3;
        echo $query;
    }
    
} else {
    echo "<p>El canal no se puede añadir temporalmente, inténtelo más tarde.".$volver3;
}
} else {
    header("Location: erroracceso.php");
}
?>
