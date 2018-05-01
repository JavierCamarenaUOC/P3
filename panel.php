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
                <?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])) { ?>
        <a href="cerrar.php" class="btn btn-danger navbar-btn" style="float:right" role="button">Logout</a>
<?php }
    ?>
		  </div>
		</nav>
	</div>
	</section>

	<!--Noticias a gogo. Primero consultamos las noticias favoritas del usuario introducido, si no tiene ninguna ofrecemos tres de ejemplo-->
	
	   <!--Capturamos la variable de sesión y buscamos noticias asociadas a este usuario en la base de datos.-->
 <?php 
        if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
            $descripcion_larga=200;
            $num_noticias=1;
            $username=$_SESSION['username'];
            $querynoticias="SELECT * FROM noticias WHERE noticias.usuario = (SELECT codigo FROM usuario WHERE username='$username')";
            // echo $querynoticias;
           
            ?> <div id="formulario_administracion">
    <form action="panel.php" method="post" name="filtro">
        <?php $querypais="SELECT DISTINCT pais FROM noticias";
            $querynombre="SELECT DISTINCT nombre FROM noticias";
            $querycategoria="SELECT DISTINCT categoria FROM noticias";
            $conectpais=$conectar->prepare($querypais);
        $conectpais->execute();
            $conectpais->bind_result($pais2);
        ?> <center><table><tr><td>
        <select name="pais">
            <option value="" selected>Filtro por país</option>
        <?php 
while ($conectpais->fetch()) {   
?> 
          <option value="<?php echo $pais2?>"><?php echo $pais2?></option> 
          <?php 
}  
            $conectpais->close(); 
            ?> </select>
        </td>
        <td><?php $conectnombre=$conectar->prepare($querynombre);
            $conectnombre->execute();
            $conectnombre->bind_result($nombre2);
            ?> <select name="nombre">
            <option value="" selected>Filtro por nombre</option>
            <?php
while ($conectnombre->fetch()) {
    ?>
            <option value="<?php echo $nombre2?>"><?php echo $nombre2?></option>
            <?php
}
            $conectnombre->close();
            ?>
            </select>
        </td>
        <td><?php $conectcategoria=$conectar->prepare($querycategoria);
            $conectcategoria->execute();
            $conectcategoria->bind_result($categoria2);
            ?> <select name="categoria">
            <option value="" selected>Filtro por categoría</option>
            <?php
while ($conectcategoria->fetch()) {
    ?>
            <option value"<?php echo $categoria2?>"><?php echo $categoria2?></option>
            <?php
}
            $conectcategoria->close();
            ?>
            </select>
        
        </td>
        <td>
        <input type="submit" class="btn btn-success navbar-btn" value="Actualizar Filtro" name="actualizar" style="margin-top: 9%; margin-right: 4%; float: right">
        </td>
        </tr></table></center></form>
    </div>
    <?php 
            $news=$conectar->prepare($querynoticias);
            // Si no tiene noticias favoritas se le asignan las de ejemplo.
            // Por tanto, siempre tendrá algo que cargar.
            $news->execute();
            $news->bind_result($idnoticias, $pais, $nombre, $categoria, $link, $usuario, $descripcion); 
    ?>
                <div class="container"> 
                <section><?php
           //Con este contador cambiamos de fila cada 3 noticias, para ello usamos un boolean de control.
                    $contador=0;
                    $salir=false;
            //Si hay filtro activado con esto sabemos si la noticia se publica o no
            $publicar=true;
            while ($news->fetch()) {
                $publicar=true;
                  if (!empty($_POST["actualizar"])) {
                if(isset($_POST["pais"])){
                $country=$_POST["pais"];
                    //echo "pais copiado".$country."=".$pais;
                }
                if(isset($_POST["nombre"])){
                $name=$_POST["nombre"];
                    //echo "nombre copiado".$name."=".$nombre;
                }
                if(isset($_POST["categoria"])){
                $category=$_POST["categoria"];
                    //echo "categoria copiada".$category."=".$categoria;
                }
                if (!empty($country) && !($country==$pais)) {
                    $publicar=false;
                    //echo "<br><p>".$publicar."</p>";
                }
                if (!empty($name) && !($name==$nombre)) {
                    $publicar=false;
                    //echo "<br><p>".$publicar."</p>";
                }
                if (!empty($category)&& !($category==$categoria)) {
                    $publicar=false;
                    //echo "<br><p>".$publicar."</p>";
                }
            }
            
if ($publicar) {
                    //*ponemos identificador al canal
                    $filtro=$categoria;
                    //Ponemos a 0 el número de noticias
                    $n=0;
                    if ($contador==0) {
                        ?> <div class="row"> <?php
                    }
                    if ($noticias=simplexml_load_file($link)) {
                        // echo '<p>Carga correcta RSS:'.$link.'</p>';
                    } else {
                        echo "<p>Error al cargar noticia</p>";
                    }
                    foreach ($noticias as $noticia) {
                        foreach ($noticia as $reg) {
                            if ($reg->title!=NULL && $reg->title!='' && $reg->description!=NULL && $reg->description!='' && $n<$num_noticias) {
                                ?><div class="col-lg-4"><?php
                                echo "<span>".$filtro."</span>";
                                // echo 'Entro en el bucle'.$n;
                                $contador++;
                                $n++;
                                if ($contador==3) {
                                    $salir=true;
                                    
                                }
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
                             if ($salir) {
                                ?></div><?php
                                 $salir=false;
                                 $contador=0;
                             }
                }
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