<?php
// ruta_para_procesar_cita.php

session_start();

// Verifica si el usuario está logueado y es un admin
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'admin') {
    // Si no es admin o no está logueado, redirige al login
    header('Location: login.php');
    exit;
}

$host = 'localhost';
$db   = 'veterinaria';
$user = 'root'; // Cambia esto por tu nombre de usuario de base de datos
$pass = ''; // Cambia esto por tu contraseña de base de datos real
$charset = 'utf8mb4';

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass, $options);

    $nombre_cliente = $_POST['nombre_cliente'] ?? '';
    $nombre_mascota = $_POST['nombre_mascota'] ?? '';
    $fecha_hora = $_POST['fecha_hora'] ?? '';
    $servicio = $_POST['servicio'] ?? '';

    $stmt = $pdo->prepare("INSERT INTO citas (nombre_cliente, nombre_mascota, fecha_hora, servicio, estado_cita) VALUES (?, ?, ?, ?, 'pendiente')");
    $stmt->execute([$nombre_cliente, $nombre_mascota, $fecha_hora, $servicio]);
    
    // Redireccionar al dashboard con un mensaje de éxito
    // Redireccionar al dashboard con un mensaje de éxito
header('Location: ../views/dashboard.php?status=success');
    exit;
} catch (\PDOException $e) {
    error_log("Error: " . $e->getMessage());
    // Redireccionar al dashboard con un mensaje de error
    header('Location: ../views/dashboard.php?status=error');
    exit;
}
?>
