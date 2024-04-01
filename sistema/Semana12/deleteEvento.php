<?php
require_once('bd/conexion.php');
$id    		= $_REQUEST['id']; 

$sqlDeleteEvento = ("DELETE FROM calendario WHERE  id='" .$id. "'");
$resultProd = mysqli_query($con, $sqlDeleteEvento);

?>
  