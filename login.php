<?php include("conexion.php"); ?>

<?php 

//recoge los datos del formulario
$username= $_POST["username"];
$password= $_POST["password"];

//Sentencia para buscar un username de la BD con esos datos 
$query = "SELECT * FROM usuario WHERE username='$username' and password='$password'"; 
$rs = $conectar->query($query);

//Compreuba si el username y contraseña es váildo 
//si la ejecución de la sentencia SQL devuelve algún resultado 
//es que que existe esa combinación username/contraseña 
if (mysqli_num_rows($rs)!=0)
	{ 
   	//username y contraseña válidos 
   	//defino una sesion y guardo datos 
   	session_start();
	$_SESSION['username'] = $username;

   	header ("Location: index.html");	
	}
	else 
	{ 
   	//si no existe reenvía a página de error
	header("Location: erroracceso.php"); 	
	} 

?>