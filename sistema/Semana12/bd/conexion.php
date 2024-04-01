<?php
$usuario  = "root";
$password = "";
$servidor = "localhost";
$basededatos = "veterinaria";
$con = mysqli_connect($servidor, $usuario, $password) or die("Sin conexion al servidor");
$db = mysqli_select_db($con, $basededatos) or die("Error al conectar a BD");
?>

