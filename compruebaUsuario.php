<?php
session_start();

$email=$_POST['email'];
$clave=$_POST['clave'];

$servername = "localhost";
$username = "id7272900_dario";
$password = "12345";	
$dbname = "id7272900_prueba";

$claveHash=md5($clave);

// $secretKey = '6LfjeKQUAAAAALULfGUoG6_mZQC92b6d6PIDRmv9';
// $captcha = $_POST['g-recaptcha-response'];

// if(!$captcha){
//     echo'<script type="text/javascript">
// 			alert("¿NO ERES HUMANO?");
// 			window.location.href="index.php";
// 			</script>';
//     exit;
// }

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// $ip = $_SERVER['REMOTE_ADDR'];
// $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
// $responseKeys = json_decode($response,true);

// if(intval($responseKeys["success"]) !== 1) {
//     echo'<script type="text/javascript">
// 			alert("¿NO ERES HUMANO?");
// 			window.location.href="index.php";
// 			</script>';
// }else{

$sql1="SELECT * FROM usuarios WHERE email='$email' AND clave='$claveHash'";

$result = $conn->query($sql1);

$rowsB= mysqli_fetch_array($result);

if ($result->num_rows != 0) {

	$_SESSION["nombre"]=$rowsB['nombre'];
	$_SESSION["email"]=$rowsB['email'];
	$_SESSION["rol"]=$rowsB['rol'];

	echo'<script type="text/javascript">
			window.location.href="index.php";
			</script>';

}else{
	echo'<script type="text/javascript">
			alert("¡EL USUARIO NO EXISTE!");
			window.location.href="index.php";
			</script>';
}
	
//}
$conn->close();

?>