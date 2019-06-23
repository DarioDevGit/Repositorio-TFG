<?php
session_start();
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

    th,td{
        padding: 2%;
    }
    
</style>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<script type="text/javascript">

function crea_query(){
    return "id="+<?php echo $_GET['id'] ?>;
}

function MostrarConsulta(datos){

    ajax = new XMLHttpRequest();

    ajax.open("POST", datos);
    ajax.onreadystatechange=mostrarPelicula;
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var query=crea_query();
    ajax.send(query);
}

function mostrarPelicula(){
    if(ajax.readyState==4 && ajax.status==200){
        var txt="";
        var fot="";
        var trai="";

        var documento_json=ajax.responseText;
        var objeto_json=eval("("+documento_json+")");
        
        for(var x=0;x<objeto_json.length;x++){
            var id=objeto_json[x].id;
            var titulo=objeto_json[x].titulo;
            var descripcion=objeto_json[x].descripcion;
            var foto=objeto_json[x].foto;
            var duracion=objeto_json[x].duracion;
            var genero=objeto_json[x].genero;
            var director=objeto_json[x].director;
            var actores=objeto_json[x].actores;
            var trailer=objeto_json[x].trailer;
            
            document.getElementById("titulo").innerHTML="Modificar "+titulo+":";

            txt=txt+"<form method='POST' action='./sqlModificar.php'><table><input type='hidden' name='id' id='id' value='"+id+"'><tr><th>Título:</th><td><input type='text' value='"+titulo+"' id='titulo' name='titulo'></td></tr><tr><th>Sinopsis:</th><td><input type='text' value='"+descripcion+"' id='descripcion' name='descripcion'></td></tr><tr><th>Duración:</th><td><input type='number' value='"+duracion+"' id='duracion' name='duracion'> minutos.</td></tr><tr><th>Genero:</th><td><input type='text' value='"+genero+"' id='genero' name='genero'></td></tr><tr><th>Director:</th><td><input type='text' value='"+director+"' id='director' name='director'></td></tr><tr><th>Actores:</th><td><input type='text' value='"+actores+"' id='actores' name='actores'></td><tr><td colspan='2' style='text-align:center;'><input type='submit' value='Guardar cambios'></td><td></td></tr></table></form>";
        }
        document.getElementById("peliculas").innerHTML=txt;

    }
}

</script>

</head>

<body onload="MostrarConsulta('muestraPeliInfo.php'); return false">

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
    <h2 id="titulo"></h2>
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

    echo'<script type="text/javascript">
            alert("¡DEBES SER ADMINISTRADOR!");
            window.location.href="index.php";
            </script>';
}
?>