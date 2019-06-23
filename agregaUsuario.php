<?php
session_start();

$nombre=$_POST['nombre'];
$apellidos=$_POST['apellidos'];
$email=$_POST['email'];
$fecha_nacimiento=$_POST['fecha'];
$clave=$_POST['clave'];

$servername = "localhost";
$username = "id7272900_dario";
$password = "12345";	
$dbname = "id7272900_prueba";

$claveHash=md5($clave);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql1="SELECT * FROM usuarios WHERE email='$email'";
$sqlInsert="INSERT INTO usuarios (nombre,apellidos,email,fecha_nacimiento,clave,rol) VALUES ('$nombre','$apellidos','$email','$fecha_nacimiento','$claveHash','user')";

$result = $conn->query($sql1);

if ($result->num_rows == 0) {
	
	$resultInsert=$conn->query($sqlInsert);

	echo'<script type="text/javascript">
			alert("¡USUARIO AGREGADO!");
			window.location.href="index.php";
			</script>';

}else{
	echo'<script type="text/javascript">
			alert("¡EL USUARIO YA EXISTE!");
			window.location.href="index.php";
			</script>';
}
	
$conn->close();

?>