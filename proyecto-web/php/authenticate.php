<?php
session_start(); // Iniciar sesión para almacenar información del usuario

$host = 'localhost';
$db   = 'veterinaria';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass, $options);
} catch (\PDOException $e) {
    error_log("Error de conexión: " . $e->getMessage());
    exit('Error de conexión');
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Log para verificar que los datos enviados desde el formulario se reciben correctamente
error_log("Datos recibidos - Usuario: " . $username . ", Contraseña: " . (empty($password) ? 'No proporcionada' : 'Proporcionada'));

$stmt = $pdo->prepare("SELECT idusuario, clave, rol FROM usuarios WHERE usuario = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

// Log para verificar si se encontró un usuario con el nombre de usuario proporcionado
if ($user) {
    error_log("Usuario encontrado en la DB - ID: " . $user['idusuario'] . ", Rol: " . $user['rol']);
} else {
    error_log("No se encontró usuario con el nombre de usuario: " . $username);
}

// Verificar si encontramos al usuario y si la contraseña ingresada es igual a la almacenada
if ($user && $password === $user['clave']) {
    error_log("Contraseña correcta para usuario: " . $username);
    if ($user['rol'] === 'admin') {
        $_SESSION['user_id'] = $user['idusuario'];
        $_SESSION['rol'] = $user['rol'];
        header('Location: ../views/dashboard.php');
        exit;
    } else {
        error_log("Usuario no es administrador - Usuario: " . $username);
        header('Location: ../views/login.php?error=notadmin');
        exit;
    }
} else {
    error_log("Login fallido para usuario: " . $username . "; la contraseña no coincide.");
    header('Location: ../views/login.php?error=1');
    exit;
}
?>
