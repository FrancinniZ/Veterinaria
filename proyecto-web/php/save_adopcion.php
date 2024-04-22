<?php

// Obtener los datos enviados por POST
$nombreMascota = $_POST['nombreMascota'];
$edad = $_POST['edad'];
$contactoPropietario = $_POST['contactoPropietario'];
$fechaAdopcion = $_POST['fechaAdopcion'];

// Realizar la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "veterinaria";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

// Preparar la consulta SQL para insertar los datos en la tabla de adopciones
$sql = "INSERT INTO adopciones (nombre_mascota, edad, contacto_propietario, fecha_adopcion) VALUES ('$nombreMascota', $edad, '$contactoPropietario', '$fechaAdopcion')";

// Ejecutar la consulta y verificar si fue exitosa
if ($conn->query($sql) === TRUE) {
    echo "La adopción se registró correctamente.";
} else {
    echo "Error al registrar la adopción: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
