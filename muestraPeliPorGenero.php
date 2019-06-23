<?php
// Rescatamos el parámetro que nos llega mediante la url que invoca xmlhttp
$resultadoConsulta = '';

$genero=$_POST['categoria'];

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

$sql2="SELECT * FROM peliculas WHERE genero like '%$genero%' ORDER BY fecha_subida DESC";

$result = $conn->query($sql2);

//echo $result->num_rows;

$json = array();

$cont=0;

while($row = mysqli_fetch_array($result))
    {
        $json[] = $row;
    }

//Creamos el JSON

 header("Content-type: application/json");

$json_string = json_encode($json);
json_encode($json_string);
echo $json_string;

$file = 'peliculas.json';
file_put_contents($file, $json_string);

?>