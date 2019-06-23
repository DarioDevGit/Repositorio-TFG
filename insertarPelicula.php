<?php
session_start();
error_reporting(0);
if($_SESSION["rol"]=="admin"){
?>

<!DOCTYPE>
<html>

<head>
<title>Pipo Movie</title>
<meta charset="UTF-8">
<link rel="icon" type="image/png" href="./imagenes/banner2.png" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


<style>
    body{
        background-color: #99ccff;
    }
    .container{
        width: 100%;
        float: left;
    }
    .logo{
        width: 100%;
        float: left;
    }
    .cabezera{
        float: left;
        width: 100%;
    }
    ul.cabezeras {
		list-style-type: none;
		margin-left:5%;
		padding: 0;
		overflow: hidden;
		background-color:#ff751a;
		width:90%;
	}
    li.cabezeras {
		float: left;
	}
	li.cabezeras a {
		display: block;
		color: white;
		text-align: center;
		padding: 14px 16px;
		text-decoration: none;
	}
	li.cabezeras a:hover {
		background-color:#ffc266;
	}
    .busqueda{
        float: left;
        width: 15%;
        height: 100%;
        margin-left: 5%;
    }
    ol.busquedas {
        margin-top: 0%;
		padding: 2%;
		overflow: hidden;
		background-color:#ff751a;
		width:100%;
	}
	li.busquedas a {
		display: block;
		color: white;
		padding: 4% 4%;
	}
	li.busquedas a:hover {
		background-color:#ffc266;
	}
	
	.formulario{
		width: 55%;
		background-color: #ff751a;
		padding: 1%;
		font-weight: bold;
		border-radius: 5%;
	}

	.campos{
		font-weight: bold;
		padding-bottom: 1%;
	}

	.piePagina{
    	float: left; 
    	width: 100%; 
    	background-color: #ff751a; 
    	text-align: center; 
    	margin-top: 1%;
    }
    
</style>

</head>

<body>

      <!-- BOTÓN DE DESPLEGAR MENU RESPONSIVE -->	  
<nav class="navbar navbar-inverse">
  <div class="container-fluid" style="background-color:#ff751a;">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <div class="logo">
		<a href="./index.php"><img src="./imagenes/banner2.png" style="width:300px;height:150px; float:left;"></a>
	  </div>
    </div>
<br><br><br><br><br><br><br><br>
<div class="collapse navbar-collapse" id="myNavbar" style="background-color:#99ff99;">
      <ul class="nav navbar-nav navbar-left">
		<li style="margin-top:3.7%;"><input type="text" placeholder="Buscar..." id="busqueda"></li>
		<li><button style="margin-top:22%;">Buscar</button></li>
		<li><a href="./insertarPelicula.php">Añadir Cerveza</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><b><p style="margin-top: 12%;">Bienvenido <?php echo $_SESSION["nombre"] ?></p></b></li>
        <li><a href="./salir.php"><span class="glyphicon glyphicon-log-in"></span>Salir</a></li>
      </ul>
    </div>
  </div>
</nav>

<center>
<div class="formulario">
	<form method="POST" action="insertarPeli.php" enctype="multipart/form-data">

		<h3 style="color:#99ff99;"><u>Añadir pelicula:</u></h3>
		<br>
		<table>
		<tr><td class="campos" style="color:#99ff99;">Nombre: </td></tr><tr><td class="campos"><input type="text" name="nombre" id="nombre"></td></tr>
		<tr><td class="campos" style="color:#99ff99;">Descripción: </td></tr><tr><td class="campos"><textarea name="descripcion" id="descripcion"></textarea> </td></tr>
		<tr><td class="campos" style="color:#99ff99;">Color: </td></tr><tr><td class="campos"><input type="text" name="color" id="color"></td></tr>
		<tr><td class="campos" style="color:#99ff99;">Origen: </td></tr><tr><td class="campos"><input type="text" name="origen" id="origen"></td></tr>
		<tr><td class="campos" style="color:#99ff99;">Graduacion: </td></tr><tr><td class="campos"><input type="text" name="graduacion" id="graduacion"></td></tr>
		<tr><td class="campos" style="color:#99ff99;">Estilo: </td></tr><tr><td class="campos"><input type="text" name="estilo" id="estilo"></td></tr>
		<tr><td class="campos" style="color:#99ff99;">Foto: </td></tr><tr><td class="campos"><input type="file" id="fileToUpload" name="fileToUpload"></td></tr>
		</table>
		<h3 id="error" value=""></h3>
		<br>
		<input type="submit" value="Agregar" id="aceptar">
	</form>
</div>
</center>

<footer class="piePagina">
  <div class="mapa" id="map"></div>
    <script>
	  
	  function initMap() {
		
		var miPosicion={lat: 36.915878, lng: -6.076972};
		  
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: miPosicion
        });

        var image = './imagenes/banner2.png';
        var beachMarker = new google.maps.Marker({
          position: miPosicion,
          map: map,
          icon: image
        });
      }
	  
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOqoVjFL8zuvtO7rx3Q2Dd_owvhOOkxh4&callback=initMap"
    async defer></script>
</footer>


</body>

</html>

<?php 

}else{
echo'<script type="text/javascript">
			alert("¡NO ERES EL ADMINISTRADOR!");
			window.location.href="index.php";
			</script>';
}

?>