<!-- views/login.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../css/styles.css"> 
</head>
<body>
    <form action="../php/authenticate.php" method="post"> 
        <h2>Inicia Sesion</h2>
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit">Iniciar Sesión</button>
    </form>
</body>
</html>
