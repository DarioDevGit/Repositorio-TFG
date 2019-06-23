<?php

$nombre=$_POST['nombre'];
$descripcion=$_POST['descripcion'];
$color=$_POST['color'];
$origen=$_POST['origen'];
$graduacion=$_POST['graduacion'];
$estilo=$_POST['estilo'];

$hora=strftime("%Y-%m-%d %I:%M:%S", time());

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

$sql2="SELECT * FROM cervezas WHERE nombre='$nombre'";

$result = $conn->query($sql2);

if ($result->num_rows > 0) {
    echo'<script type="text/javascript">
			alert("¡LA CERVEZA YA EXISTE!");
			window.location.href="insertarPeli.html";
			</script>';
} else {
	
	$nombre_archivo=basename($_FILES["fileToUpload"]["name"]);
	
	if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"./imagenes/".$nombre_archivo)){
		echo'<script type="text/javascript">
			alert("¡FOTO ARCHIVADA!'.$nombre_archivo.'");
			</script>';
	}
	
	
    $sql="INSERT INTO cervezas(estilo,color,origen,graduacion,nombre,descripcion,
	foto) VALUES ('$estilo','$color','$origen','$graduacion','$nombre','$descripcion','$nombre_archivo')";
	
	
	if ($conn->query($sql)==true){
		echo'<script type="text/javascript">
			alert("CERVEZA AÑADIDA CORRECTAMENTE!");
			window.location.href="insertarPelicula.php";
			</script>';
	}else{
		echo'<script type="text/javascript">
			alert("¡NO SE HA PODIDO AÑADIR LA CERVEZA!");
			window.location.href="insertarPelicula.php";
			</script>';
	}
}
	

$conn->close();
?>