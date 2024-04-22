<?php
session_start();

// Verifica si el usuario está logueado y es un admin
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'admin') {
    // Si no es admin o no está logueado, redirige al login
    header('Location: login.php');
    exit;
}

// Definir las credenciales de la base de datos
$host = 'localhost';
$db   = 'veterinaria';
$user = 'root'; 
$pass = ''; 
$charset = 'utf8mb4';

// Opciones de PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    // Conexión a la base de datos
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass, $options);

    // Recibe los datos del formulario
    $id_cita = $_POST['id_cita'] ?? '';
    $nombre_cliente = $_POST['nombre_cliente'] ?? '';
    $nombre_mascota = $_POST['nombre_mascota'] ?? '';
    $fecha_hora = $_POST['fecha_hora'] ?? '';
    $servicio = $_POST['servicio'] ?? '';
    $estado = $_POST['estado'] ?? '';

    // Actualiza la cita en la base de datos
    $stmt = $pdo->prepare("UPDATE citas SET nombre_cliente=?, nombre_mascota=?, fecha_hora=?, servicio=?, estado_cita=? WHERE id_cita=?");
    $stmt->execute([$nombre_cliente, $nombre_mascota, $fecha_hora, $servicio, $estado, $id_cita]);
    
    // Redirecciona al dashboard con un mensaje de éxito
    header('Location: ../views/dashboard.php?status=success');
    exit;
} catch (\PDOException $e) {
    // En caso de error, muestra un mensaje de error
    error_log("Error: " . $e->getMessage());
    // Redirecciona al dashboard con un mensaje de error
    header('Location: ../views/dashboard.php?status=error');
    exit;
}
?>
