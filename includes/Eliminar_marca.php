<?php
include 'conecta.php';
$id = $_GET['Id_Marca'];
$b = "DELETE FROM Marcas WHERE Id_Marca = '$id'";
$r = $conecta->query($b);
header("location:../CMarcas.php");
$conecta->close();
 ?>
