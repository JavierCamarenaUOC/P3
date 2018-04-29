<?php include("conexion.php"); 
session_start(); 
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
    <link rel="stylesheet" type="text/css" href="css/panel.css" />
  
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
	<div id="barrasuperior5">&nbsp;
	</div>

	<section>
	<div id="menu">	  
		<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
			<ul class="nav navbar-nav" >
			  <li><a href="index.html">Presentación</a></li>
			  <li><a href="registro.html">Inicio</a></li>
			  <li  class="active"><a href="panel.php">Noticias</a></li>
			  <li><a href="administracion1.php">Administración</a></li>
			</ul>
			<a href="login.html" class="btn btn-success navbar-btn" style="float:right" role="button">Login</a>
		  </div>
		</nav>
	</div>
	</section>

	<!--Noticias a gogo. Primero consultamos las noticias favoritas del usuario introducido, si no tiene ninguna ofrecemos cinco de ejemplo-->
	
	   <!--Capturamos la variable de sesión y buscamos noticias
            asociadas a este usuario en la base de datos.-->
 <?php 
        if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
            $descripcion_larga=140;
            $num_noticias=3;
            $username=$_SESSION['username'];
            $querynoticias="SELECT * FROM noticias WHERE noticias.usuario = (SELECT codigo FROM usuario WHERE username='$username')";
            // echo $querynoticias;
            $news=$conectar->prepare($querynoticias);
            // Si no tiene noticias favoritas se le asignan las de ejemplo.
            // Por tanto, siempre tendrá algo que cargar.
            $news->execute();
            $news->bind_result($idnoticias, $pais, $nombre, $categoria, $link, $fecha, $usuario, $descripcion);
            ?> <div class="container"> 
                <section><?php
                while ($news->fetch()) {
                    //Sentencia temporal hasta que se implementen los filtros.
                    $filtro=$categoria;
                    //Ponemos a 0 el número de noticias
                    $n=0;
                    ?><div><?php
                    echo '<p>'.$filtro.'</p>';
                    ?></div> <div class="row"> <?php
                    if ($noticias=simplexml_load_file($link)) {
                        // echo '<p>Carga correcta RSS:'.$link.'</p>';
                    } else {
                        echo "<p>Error al cargar noticia</p>";
                    }
                    foreach ($noticias as $noticia) {
                        foreach ($noticia as $reg) {
                            if ($reg->title!=NULL && $reg->title!='' && $reg->description!=NULL && $reg->description!='' && $n<$num_noticias) {
                                ?><div class="col-lg-4"><?php
                                // echo 'Entro en el bucle'.$n;
                                $n++;
                                echo '<h4><a href="'.$reg->link.'" target="_blank">'.$reg->title.'</a></h4>';
                                if (strlen($reg->description)>$descripcion_larga) {
                                    echo '<p>'.substr($reg->description,0,$descripcion_larga).'...</p>';
                                } else if ($reg->description==NULL || $reg->description=='') {
                                } else {
                                    echo '<p>'.$reg->description.'</p>';
                                }
                    ?></div><?php
                                }
                            
                            }
                        }
                            ?> </div> <?php
                } ?> </section></div> <?php
} else {
            echo '<p>Error de acceso. Pulse Login o Inicio para empezar.</p>'; 
}?>
           
		   
		<div class="w3-container w3-half">
			
		</div>
	

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

    <div style="display: none;"></div>
</body>
</html>