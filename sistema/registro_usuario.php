<?php

include "../sistema/bd/conexion.php";

if(!empty($_POST)) {
	$alert = '';
	if(empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['correo'])
	|| empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['rol']))
	{	
		$alert='<p class="msg_error"> Todos los campos son obligatorios</p>';
	}
	else
	{
		
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$email = $_POST['correo'];
		$user = $_POST['usuario'];
		$clave = md5($_POST['clave']);
		$rol = $_POST['rol'];

$query = mysqli_query($con, "SELECT * FROM usuarios WHERE usuario = '$user' OR correo = '$email'");
$result = mysqli_fetch_array($query);
	
if($result > 0){
	$alert = '<p class="msg_error"> El correo o el usuario ya existe </p>';
}else{
	$query_insert = mysqli_query($con, "INSERT INTO usuarios(nombre, apellido, correo, usuario, clave, rol)
										VALUES ('$nombre','$apellido', '$email', '$user', '$clave', '$rol')");
	if($query_insert){
		$alert= '<p class= "msg_save"> Usuario creado correctamente.</p>';
	}else{
		$alert= '<p class= "msg_error"> Error al crear usuario.</p>';
	}

}
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";?>
	<title>Registro de Usuario</title>
</head>
<body>
<?php include "includes/header.php";?>
	<section id="container">
		<div class="form_register">
		<h1>Registrar usuario</h1>
		<hr>
		
		<div class="alert"><?php echo isset($alert) ? $alert: ''; ?></div> 

	<form action="" method="post">
		<label for="nombre">Nombre</label>
		<input type="text" name="nombre" id="nombre" placeholder="Ingrese el nombre">
		<label for="apellido">Apellido</label>
		<input type="text" name="apellido" id="apellido" placeholder="Ingrese apellido">
		<label for="correo">Correo Electronico</label>
		<input type="email" name="correo" id="correo" placeholder="Ingrese correo electronico">
		<label for="usuario">Usuario</label>
		<input type="text" name="usuario" id="usuario" placeholder="Ingrese usuario">
		<label for="clave">Contraseña</label>
		<input type="password" name="clave" id="clave" placeholder="Ingrese contraseña">
		<label for="rol">Tipo de Usuario</label>

		<?php
			$query_rol = mysqli_query($con, "SELECT * FROM rol");
			$result_rol = mysqli_num_rows($query_rol);
		?>

		<select name="rol" id="rol">

		<?php
			if($result_rol > 0) {
				while ($rol = mysqli_fetch_array($query_rol)) {
		?>
			<option value="<php? echo $rol["idrol"]; ?><?php echo $rol["rol"]?></option>
		<?php
			}
		}
		?>

		</select>
		
		<input type="submit" value="Crear usuario" class="btn_save">
	
	</form>

		</div>
	</section>
	<?php include "includes/footer.php";?>
</body>
</html>
