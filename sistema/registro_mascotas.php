<?php

include "../sistema/bd/conexion.php";

if(!empty($_POST)) {
	$alert = '';
	if(empty($_POST['mascota']) || empty($_POST['contacto']) || empty($_POST['direccion']))
	{	
		$alert='<p class="msg_error"> Todos los campos son obligatorios</p>';
	}
	else
	{
		
		$mascota = $_POST['mascota'];
		$contacto = $_POST['contacto'];
		$direccion = $_POST['direccion'];
		

$query = mysqli_query($con, "SELECT * FROM mascotas WHERE mascota = '$mascota' OR contacto = '$contacto'");
$result = mysqli_fetch_array($query);
	
if($result > 0){
	$alert = '<p class="msg_error"> El correo o el usuario ya existe </p>';
}else{
	$query_insert = mysqli_query($con, "INSERT INTO mascotas(mascota, contacto, direccion)
										VALUES ('$mascota','$contacto', '$direccion')");
	if($query_insert){
		$alert= '<p class= "msg_save"> Mascota nueva. Bienvenida.</p>';
	}else{
		$alert= '<p class= "msg_error"> Error al registrar mascota.</p>';
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
	<title>Registro de Mascota</title>
</head>
<body>
<?php include "includes/header.php";?>
	<section id="container">
		<div class="form_register">
		<h1>Registrar Mascotas</h1>
		<hr>
		
		<div class="alert"><?php echo isset($alert) ? $alert: ''; ?></div> 

	<form action="" method="post">
		<label for="mascota">Nombre Mascota</label>
		<input type="text" name="mascota" id="mascota" placeholder="Ingrese el nombre de mascota">
		<label for="contacto">Numero de Contacto</label>
		<input type="text" name="contacto" id="contacto" placeholder="Ingrese un contacto de mascota">
		<label for="direccion">Direccion de residencia</label>
		<input type="text" name="direccion" id="direccion" placeholder="Ingrese direccion">
		
		<?php
			$query_mascota = mysqli_query($con, "SELECT * FROM mascotas");
			$result_mascota = mysqli_num_rows($query_mascota);
		?>

		
		
		<input type="submit" value="Crear mascota" class="btn_save">
	
	</form>

		</div>
	</section>
	<?php include "includes/footer.php";?>
</body>
</html>
