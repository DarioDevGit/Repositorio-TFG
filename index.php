<?php
session_start();
error_reporting(0);
if($_SESSION["rol"]=="user"){
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
    .pelis{
        background-color: white;
        float: left;
        width: 74%;
        margin-left: 1%;
    }

    .piePagina{
    	float: left; 
    	width: 100%; 
    	background-color: #ff751a; 
    	text-align: center; 
    	margin-top: 1%;
    	padding: 5%;
    }

    .mapa{
    	width: 60%;
    	height: 30%;
    }
    
</style>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<script type="text/javascript">

function MostrarConsulta(datos){

	ajax = new XMLHttpRequest();

	ajax.open("GET", datos);
	ajax.onreadystatechange=mostrarPelicula;
	ajax.send(null);
}

function mostrarPelicula(){
	if(ajax.readyState==4 && ajax.status==200){
		var txt="";

		var documento_json=ajax.responseText;
        var objeto_json=eval("("+documento_json+")");
        
        for(var x=0;x<objeto_json.length;x++){
            var id=objeto_json[x].id;
            var titulo=objeto_json[x].titulo;
            var descripcion=objeto_json[x].descripcion;
            var foto=objeto_json[x].foto;
            
            txt=txt+"<table style='margin-left:1%;'><tr><td colspan='2'><b>Titulo:</b>"+titulo+"</td></tr><tr><td><a href='./muestraInfoPelis.php?id="+id+"'><img src='./imagenes/"+foto+"' style='width:100px; height:160px;'></a></td><td style='margin-left:5%;'><b>Sinopsis:</b>"+descripcion+"</td></tr></table><br>";
        }
        document.getElementById("peliculas").innerHTML=txt;

	}
}

</script>

<script type="text/javascript">
	  
	  function initMap() {
		
		var miPosicion={lat: 36.915878, lng: -6.076972};
		  
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: miPosicion
        });

        var image = {
        	url:'./imagenes/banner2.png',
        	scaledSize: new google.maps.Size(50, 35),

        };
        var beachMarker = new google.maps.Marker({
          position: miPosicion,
          map: map,
          icon: image
        });
      }
	  
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOqoVjFL8zuvtO7rx3Q2Dd_owvhOOkxh4&callback=initMap"
    async defer></script>

</head>

<body onload="MostrarConsulta('muestraPeli.php'); return false">

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
		<a href="./index.php"><img src="./imagenes/banner2.png" style="width:;height:150px; float:left;"></a>
	  </div>
    </div>
<br><br><br><br><br><br><br><br>
<div class="collapse navbar-collapse" id="myNavbar" style="background-color:#99ff99;">
	<form action="./filtrarPorNombre.php" method="POST">
      <ul class="nav navbar-nav navbar-left">
      	<li style="margin-top:3.7%;"><input type="text" placeholder="Buscar..." id="busqueda" name="busqueda"></li>
		<li><button type="submit" style="margin-top:22%;">Buscar</button></li>
		<li><a href="./insertarPelicula.php">Añadir pelicula</a></li>
      </ul>      
      <ul class="nav navbar-nav navbar-right">
        <li><b><p style="margin-top: 12%;">Bienvenido <?php echo $_SESSION["nombre"] ?></p></b></li>
        <li><a href="./salir.php"><span class="glyphicon glyphicon-log-in"></span>Salir</a></li>
      </ul>
      </form>
    </div>
  </div>
</nav>

<div class="busqueda">
    <ol class="busquedas">
        <p style="color:white;"><strong>Películas por categorias:</strong></p>
        <hr>
        <li class="busquedas"><a href="./muestraPeliPorCategoria.php?categoria=1">Accion</a></li>
        <li class="busquedas"><a href="./muestraPeliPorCategoria.php?categoria=2">Comedia</a></li>
        <li class="busquedas"><a href="./muestraPeliPorCategoria.php?categoria=3">Ciencia ficción</a></li>
        <li class="busquedas"><a href="./muestraPeliPorCategoria.php?categoria=4">Terror</a></li>
        <li class="busquedas"><a href="./muestraPeliPorCategoria.php?categoria=5">Drama</a></li>
        <li class="busquedas"><a href="./muestraPeliPorCategoria.php?categoria=6">Romance</a></li>
    </ol> 
</div>

<div class="pelis">
    <h2>Añadidas recientemente:</h2>
    <hr>

    <div id="peliculas"></div>

</div>

<footer class="piePagina">
<center>
  <div class="mapa" id="map"></div>
</center>
</footer>


</body>

</html>

<?php

}else if($_SESSION["rol"]=="admin"){

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
    .pelis{
        background-color: white;
        float: left;
        width: 74%;
        margin-left: 1%;
    }

    .piePagina{
    	float: left; 
    	width: 100%; 
    	background-color: #ff751a; 
    	text-align: center; 
    	margin-top: 1%;
    	padding: 3%;
    }

    .mapa{
    	width: 60%;
    	height: 30%;
    }
    
</style>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<script type="text/javascript">

function MostrarConsulta(datos){

	ajax = new XMLHttpRequest();

	ajax.open("GET", datos);
	ajax.onreadystatechange=mostrarPelicula;
	ajax.send(null);
}

function mostrarPelicula(){
	if(ajax.readyState==4 && ajax.status==200){
		var txt="";

		var documento_json=ajax.responseText;
        var objeto_json=eval("("+documento_json+")");
        
        for(var x=0;x<objeto_json.length;x++){
            var id=objeto_json[x].id;
            var titulo=objeto_json[x].titulo;
            var descripcion=objeto_json[x].descripcion;
            var foto=objeto_json[x].foto;
            
            txt=txt+"<table style='margin-left:1%;'><tr><td colspan='2'><b>Titulo:</b>"+titulo+"</td></tr><tr><td><a href='./muestraInfoPelis.php?id="+id+"'><img src='./imagenes/"+foto+"' style='width:100px; height:160px;'></a></td><td style='margin-left:5%;'><b>Sinopsis:</b>"+descripcion+"</td></tr></table><br>";
        }
        document.getElementById("peliculas").innerHTML=txt;

	}
}

</script>

<script type="text/javascript">
	  
	  function initMap() {
		
		var miPosicion={lat: 36.915878, lng: -6.076972};
		  
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: miPosicion
        });

        var image = {
        	url:'./imagenes/banner2.png',
        	scaledSize: new google.maps.Size(150, 100),

        };
        var beachMarker = new google.maps.Marker({
          position: miPosicion,
          map: map,
          icon: image
        });
      }
	  
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOqoVjFL8zuvtO7rx3Q2Dd_owvhOOkxh4&callback=initMap"
    async defer></script>

</head>

<body onload="MostrarConsulta('muestraPeli.php'); return false">

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
	<form action="./filtrarPorNombre.php" method="POST">
      <ul class="nav navbar-nav navbar-left">
      	<li style="margin-top:2.5%;"><input type="text" placeholder="Buscar..." id="busqueda" name="busqueda"></li>
		<li><button type="submit" style="margin-top:22%;">Buscar</button></li>
		<li><a href="./insertarPelicula.php">Añadir pelicula</a></li>
		<li><a href="./listadoPeliculas.php">Listado de peliculas</a></li>
      </ul>      
      <ul class="nav navbar-nav navbar-right">
        <li><b><p style="margin-top: 12%;">Bienvenido <?php echo $_SESSION["nombre"] ?></p></b></li>
        <li><a href="./salir.php"><span class="glyphicon glyphicon-log-in"></span>Salir</a></li>
      </ul>
      </form>
    </div>
  </div>
</nav>

<div class="busqueda">
    <ol class="busquedas">
        <p style="color:white;"><strong>Películas por categorias:</strong></p>
        <hr>
        <li class="busquedas"><a href="./muestraPeliPorCategoria.php?categoria=1">Accion</a></li>
        <li class="busquedas"><a href="./muestraPeliPorCategoria.php?categoria=2">Comedia</a></li>
        <li class="busquedas"><a href="./muestraPeliPorCategoria.php?categoria=3">Ciencia ficción</a></li>
        <li class="busquedas"><a href="./muestraPeliPorCategoria.php?categoria=4">Terror</a></li>
        <li class="busquedas"><a href="./muestraPeliPorCategoria.php?categoria=5">Drama</a></li>
        <li class="busquedas"><a href="./muestraPeliPorCategoria.php?categoria=6">Romance</a></li>
    </ol> 
</div>

<div class="pelis">
    <h2>Añadidas recientemente:</h2>
    <hr>

    <div id="peliculas"></div>

</div>

<footer class="piePagina">
<center>
  <div class="mapa" id="map"></div>
</center>
</footer>


</body>

</html>

<?php

}else{

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
    .pelis{
        background-color: white;
        float: left;
        width: 74%;
        margin-left: 1%;
    }

    .piePagina{
    	float: left; 
    	width: 100%; 
    	background-color: #ff751a; 
    	text-align: center; 
    	margin-top: 1%;
    	padding: 5%;
    }

    .mapa{
    	width: 60%;
    	height: 30%;
    }
    
</style>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<script type="text/javascript">

function MostrarConsulta(datos){

	ajax = new XMLHttpRequest();

	ajax.open("GET", datos);
	ajax.onreadystatechange=mostrarPelicula;
	ajax.send(null);
}

function mostrarPelicula(){
	if(ajax.readyState==4 && ajax.status==200){
		var txt="";

		var documento_json=ajax.responseText;
        var objeto_json=eval("("+documento_json+")");
        
        for(var x=0;x<objeto_json.length;x++){
            var id=objeto_json[x].id;
            var titulo=objeto_json[x].titulo;
            var descripcion=objeto_json[x].descripcion;
            var foto=objeto_json[x].foto;
            
            txt=txt+"<table style='margin-left:1%;'><tr><td colspan='2'><b>Titulo:</b>"+titulo+"</td></tr><tr><td><a href='./muestraInfoPelis.php?id="+id+"'><img src='./imagenes/"+foto+"' style='width:100px; height:160px;'></a></td><td style='margin-left:5%;'><b>Sinopsis:</b>"+descripcion+"</td></tr></table><br>";
        }
        document.getElementById("peliculas").innerHTML=txt;

	}
}

</script>

<script type="text/javascript">
	  
	  function initMap() {
		
		var miPosicion={lat: 36.915878, lng: -6.076972};
		  
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: miPosicion
        });

        var image = {
        	url:'./imagenes/banner2.png',
        	scaledSize: new google.maps.Size(150, 100),

        };
        var beachMarker = new google.maps.Marker({
          position: miPosicion,
          map: map,
          icon: image
        });
      }
	  
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOqoVjFL8zuvtO7rx3Q2Dd_owvhOOkxh4&callback=initMap"
    async defer></script>

</head>

<body onload="MostrarConsulta('muestraPeli.php'); return false">

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
      <form action="./filtrarPorNombre.php" method="POST">
      <ul class="nav navbar-nav navbar-left">
      	<li style="margin-top:5.5%;"><input type="text" placeholder="Buscar..." id="busqueda" name="busqueda"></li>
		<li><button type="submit" style="margin-top:22%;">Buscar</button></li>
      </ul>      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="./registrarUsuario.html"><span class="glyphicon glyphicon-user"></span>Registrar</a></li>
        <li><a href="./login.html"><span class="glyphicon glyphicon-log-in"></span>Acceder</a></li>
      </ul>
      </form>
    </div>
  </div>
</nav>

<div class="busqueda">
    <ol class="busquedas">
        <p style="color:white;"><strong>Películas por categorias:</strong></p>
        <hr>
        <li class="busquedas"><a href="./muestraPeliPorCategoria.php?categoria=1">Accion</a></li>
        <li class="busquedas"><a href="./muestraPeliPorCategoria.php?categoria=2">Comedia</a></li>
        <li class="busquedas"><a href="./muestraPeliPorCategoria.php?categoria=3">Ciencia ficción</a></li>
        <li class="busquedas"><a href="./muestraPeliPorCategoria.php?categoria=4">Terror</a></li>
        <li class="busquedas"><a href="./muestraPeliPorCategoria.php?categoria=5">Drama</a></li>
        <li class="busquedas"><a href="./muestraPeliPorCategoria.php?categoria=6">Romance</a></li>
    </ol> 
</div>

<div class="pelis">
    <h2>Añadidas recientemente:</h2>
    <hr>

    <div id="peliculas"></div>

</div>

<footer class="piePagina">
<center>
  <div class="mapa" id="map"></div>
</center>
</footer>

</body>

</html>

<?php
}
?>