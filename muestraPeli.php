<?php
// Rescatamos el parámetro que nos llega mediante la url que invoca xmlhttp
$resultadoConsulta = '';

$servername = "localhost";
$username = "id7272900_dario";
$password = "12345";	
$dbname = "id7272900_prueba";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql2="SELECT * FROM cervezas";

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