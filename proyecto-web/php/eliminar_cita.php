<?php
session_start();

// Verifica si el usuario está logueado y es un admin
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'admin') {
    // Si no es admin o no está logueado, redirige al login
    header('Location: login.php');
    exit;
}

// Verifica si se recibió un ID de cita válido
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Si no se recibió un ID válido, redirige al dashboard con un mensaje de error
    header('Location: ../view/dashboard.php?status=error&id_missing=true');
    exit;
}

// Obtener el ID de la cita a eliminar
$id_cita = $_GET['id'];

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

    // Preparar y ejecutar la consulta para eliminar la cita
    $stmt = $pdo->prepare("DELETE FROM citas WHERE id_cita = ?");
    $stmt->execute([$id_cita]);

    // Redirigir al dashboard con un mensaje de éxito
    header('Location: ../views/dashboard.php?status=success');
    exit;
} catch (\PDOException $e) {
    // En caso de error, redirigir al dashboard con un mensaje de error
    header('Location: ../views/dashboard.php?status=error&message=' . urlencode($e->getMessage()));
    exit;
}
?>
