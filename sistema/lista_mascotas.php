<?php
include "../Semana12/bd/conexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";?>
	<title>Lista de Mascotas</title>
</head>
<body>
<?php include "includes/header.php";?>
	<section id="container">
		<h1>Lista de Mascotas</h1>
        <a href="registro_usuario.php" class="btn_new">Crear usuario</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Contacto</th>
                <th>Direccion</th>
            </tr>
            <?php

            $query = mysqli_query($con, "SELECT m.codmascota, m.mascota, m.contacto, m.direccion
                                FROM mascotas m");

            $result = mysqli_num_rows($query);
            if ($result > 0) {
                while ($data = mysqli_fetch_array($query)){
            
            ?>
                    <tr>
                    <td><?php echo $data["codmascota"] ?></td>
                    <td><?php echo $data["mascota"] ?></td>
                    <td><?php echo $data["contacto"] ?></td>
                    <td><?php echo $data["direccion"] ?></td>
                    
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