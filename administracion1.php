<?php include("conexion.php"); ?>

<?php
	//comprobamos que exista sesión de usuario para que nadie acceda
	//a la página sin autenticarse previamente.
	//el if se cierra al final de la pagina
session_start();
if(isset($_SESSION['username']))
{

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>NewsMakers</title>
  
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  
  <link rel="stylesheet" type="text/css" href="css/fonts.css" />
  <link rel="stylesheet" type="text/css" href="css/estilos.css" />
  <link rel="stylesheet" type="text/css" href="css/estilos_administracion2.css" />


</head>
<body>

<header>
	<div class="logoNewsmakers">	
	</div>	
	<div class="tituloNewsmakers">
		<div class="divTitulo">
			<h1>NEWSMAKERS</h1>
		</div>
	</div>
	<div class="tituloWeCollectNews">	
		<div class="divTitulo">
			<h1>WE COLLECT NEWS </h1>
		</div>
	</div>
	<div id="barrasuperior1">&nbsp;</div>
	<div id="barrasuperior2">&nbsp;</div>
	<div id="barrasuperior3">&nbsp;</div>
	<div id="barrasuperior4">&nbsp;</div>
	
</header>
<br>
<div id="barrasuperior5">&nbsp;</div>

<div id="menu">	  
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
		<ul class="nav navbar-nav" >
		  <li class="active"><a href="index.html">Presentación</a></li>
		  <li><a href="registro.html">Inicio</a></li>
		  <li><a href="#">Noticias</a></li>
		  <li><a href="administracion1.php">Administración</a></li>
		</ul>
		<a href="login.html" class="btn btn-success navbar-btn" style="float:right" role="button">Login</a>

	  </div>
	</nav>
</div>
<div id="inicio">
<section>
	
	<div id="formulario_administracion">
		<center><table>
				<tr><td><center><h1>PERFIL DE USUARIO</h1></center></td></tr>
				<form action="administracion1.php" method="post">
				<tr><td><center><strong>Nuevo email:</strong>     <input type="text" name="usuario" style=" text-align: center; margin: 0px auto;border-radius: 10px 10px 10px 10px;moz-border-radius: 10px 10px 10px 10px;webkit-border-radius:10px 10px 10px 10px;border: 1px solid #000000;"></center></td></tr>
				<tr><td><center><strong>Nuevo username:</strong>     <input type="email" name="usuario" style=" text-align: center; margin: 0px auto;border-radius: 10px 10px 10px 10px;moz-border-radius: 10px 10px 10px 10px;webkit-border-radius:10px 10px 10px 10px;border: 1px solid #000000;"></center></td></tr>
				<tr><td><center><strong>Nuevo password:</strong>         <input type="password" name="password" style=" text-align: center; margin: 0px auto;border-radius: 10px 10px 10px 10px;moz-border-radius: 10px 10px 10px 10px;webkit-border-radius:10px 10px 10px 10px;border: 1px solid #000000;"></center></td></tr>
				<tr><td><center><input type="submit" value="Confirmar" name="confirmar" style=" text-align: center; margin: 0px auto;border-radius: 10px 10px 10px 10px;moz-border-radius: 10px 10px 10px 10px;webkit-border-radius:10px 10px 10px 10px;border: 1px solid #000000;"></center></td></tr>
				<tr><td><center><input type="submit" value="Darse de baja" name="baja" style=" text-align: center; margin: 0px auto;border-radius: 10px 10px 10px 10px;moz-border-radius: 10px 10px 10px 10px;webkit-border-radius:10px 10px 10px 10px;border: 1px solid #000000;"></center></td></tr>
				</form>
		</table></center>
			
	</div>
	
	<a href="administracion2.html" class="btn btn-success navbar-btn" style="float:center" role="button">Siguiente</a>

	
</div>
</section>
  <div class="row"></div>
  
  <!--footer-->
  <section id="footer">
    <div class="col-sm-1">
		<div class="logoNewsmakers_gris">
		<div class="direccion_footer">
			<p>Tuset 3, Moià 1, 3ª planta 08006 Barcelona<br>(+34)934 969 200<br>contacto@newsmakers.com</p>	
		</div>		
		</div>
	</div>
  </section>

<div style="display: none;">
</body>
</html>

<?php
//cierra el primer if
	}
//si no existe usuario autenticado muestra error
	else
	{
		echo "Acceso denegado";
	}

?>