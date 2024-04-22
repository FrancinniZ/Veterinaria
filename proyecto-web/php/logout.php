<?php
// logout.php

session_start(); // Accede a la sesión actual

// Vaciar todas las variables de sesión
$_SESSION = array();

// Esto destruirá la sesión y no solo los datos de sesión.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destruye la sesión.
session_destroy();

// Redirigir al usuario a la página de login
header('Location: /views/login.php');
exit;
?>
