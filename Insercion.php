<!DOCTYPE html>
<html lang="en">
<head>
  <title>Insertado</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  
  <style>
	body{
		background-color:#ccffff;
		color:#ffc266;
		font-weight: bold;
		font-family:cursive;
	}
  </style>
  
</head>
<body>

<?php
$nombre=$_POST['Usuario_nombre'];
$apellido1=$_POST['Usuario_apellido1'];
$apellido2=$_POST['Usuario_apellido2'];
$nick=$_POST['Usuario_nick'];
$clave=$_POST['Usuario_clave'];
$email=$_POST['Usuario_email'];
$domicilio=$_POST['Usuario_domicilio'];
$poblacion=$_POST['Usuario_poblacion'];
$provincia=$_POST['Usuario_provincia'];
$nif=$_POST['Usuario_nif'];
$telefono=$_POST['Usuario_numero_telefono'];

$hora=strftime("%Y-%m-%d %I:%M:%S", time());

$bloqueado=1;
$numIntento=0;

$servername = "localhost";
$username = "id7354974_nano";
$password = "Un8eterno";	
$dbname = "id7354974_prueba";

$token=md5('$clave');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql2="SELECT * FROM usuarios WHERE Usuario_email='$email'";

$result = $conn->query($sql2);

if ($result->num_rows > 0) {
    echo "El usuario ya existe!";
} else {
	
	$nombre_archivo=$nick."_".basename($_FILES["fileToUpload"]["name"]);
	
	if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"./imagenes/".$nombre_archivo)){
		echo "El archivo ".basename($_FILES["fileToUpload"]["name"])." ha sido subida";
		echo "<img src='./imagenes/".$nombre_archivo."'></img>";
	}
	
	
    $sql="INSERT INTO usuarios(Usuario_nombre,Usuario_apellido1,Usuario_apellido2,Usuario_nick,Usuario_clave,Usuario_fecha_alta,Usuario_email,
	Usuario_bloqueado,Usuario_numero_intentos,Usuario_token_aleatorio,Usuario_domicilio,Usuario_poblacion,Usuario_provincia, Usuario_nif,Usuario_numero_telefono,
	Usuario_fotografia) VALUES ('$nombre','$apellido1','$apellido2','$nick',md5('$clave'),'$hora','$email','$bloqueado','$numIntento','$token','$domicilio',
	'$poblacion','$provincia','$nif','$telefono','$nombre_archivo')";
	
	$titulo="VERIFICACIÓN DE CUENTA";
	$mensaje="Haz click en el siguiente enlace para verificar la cuenta: https://giganteelite.000webhostapp.com/Validar.php?token=".$token;
	$cabezera="From: juegodetronos@gmail.com";
	
	mail($email, $titulo, $mensaje, $cabezera);

	
	if ($conn->query($sql)==true){
		echo "<h2>Revise su correo electronico para verificar su cuenta</h2>";
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=https://tronodejuegos.000webhostapp.com/inicioSesion.html'>";
	}else{
		echo "Error al crear usuario";
	}
}
	

$conn->close();
?>

</body>
</html>