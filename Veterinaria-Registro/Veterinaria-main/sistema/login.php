<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/styleLogin.css">
</head>
<body>
    <section id="container">
        <form action="" method="post">
            <h3>Iniciar Sesión</h3>
            <img src="img/pet.png" alt="Login">
            <input type="text" name="correo" placeholder="Correo">
            <input type="password" name="password" placeholder="Contraseña">
            <div class="alert"><?php echo isset($alert)? $alert : ''?></div>
            <input type="submit" value="Ingresar">
        </form>
        <p>¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a></p> <!-- Enlace a la página de registro -->
    </section>
</body>
</html>