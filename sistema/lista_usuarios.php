<?php
include "../Semana12/bd/conexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";?>
	<title>Lista de usuarios</title>
</head>
<body>
<?php include "includes/header.php";?>
	<section id="container">
		<h1>Lista de usuarios</h1>
        <a href="registro_usuario.php" class="btn_new">Crear usuario</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
            <?php

            $query = mysqli_query($con, "SELECT u.idusuario, u.nombre, u.apellido, u.correo, u.usuario, r.rol
                                FROM usuarios u INNER JOIN rol r ON u.rol  = r.idrol");

            $result = mysqli_num_rows($query);
            if ($result > 0) {
                while ($data = mysqli_fetch_array($query)){
            
            ?>
                    <tr>
                    <td><?php echo $data["idusuario"] ?></td>
                    <td><?php echo $data["nombre"] ?></td>
                    <td><?php echo $data["apellido"] ?></td>
                    <td><?php echo $data["correo"] ?></td>
                    <td><?php echo $data["rol"] ?></td>
                    
                    <td>
                        <a class ="link_edit" href="#">Editar</a>
    
                        <a class ="link_delete" href ="#">Eliminar</a>
                    </td>
                </tr>
            <?php

                }
            }

            ?>
        </table>
	</section>
	<?php include "includes/footer.php";?>	
</body>
</html>