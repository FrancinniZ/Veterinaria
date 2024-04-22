<?php
header('Content-Type: application/json');

$host = 'localhost';
$db   = 'veterinaria';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

$data = json_decode(file_get_contents('php://input'), true);

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass, $options);
    $stmt = $pdo->prepare("INSERT INTO emergencias (nombre_canino, contacto_propietario, fecha_emergencia) VALUES (?, ?, ?)");
    $stmt->execute([$data['petName'], $data['ownerContact'], $data['emergencyDate']]);
    echo json_encode(['status' => 'success']);
} catch (\PDOException $e) {
    error_log("Error: " . $e->getMessage());
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
