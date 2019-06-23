<?php
// Rescatamos el parámetro que nos llega mediante la url que invoca xmlhttp
$id = $_POST['id'];
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$duracion = $_POST['duracion'];
$genero = $_POST['genero'];
$director = $_POST['director'];
$actores = $_POST['actores'];

$servername = "localhost";
$username = "id9664136_nano8";
$password = "Un8eterno";	
$dbname = "id9664136_proyecto_final";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql2="UPDATE peliculas SET titulo = '$titulo', descripcion= '$descripcion', duracion = '$duracion', genero= '$genero', director = '$director', actores= '$actores' WHERE id = $id";

$result = $conn->query($sql2);

$conn->close();

echo'<script type="text/javascript">
			window.location.href="listadoPeliculas.php";
			</script>';

?>