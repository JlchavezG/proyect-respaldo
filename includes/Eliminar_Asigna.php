<?php
include 'conecta.php';
$id = $_GET['Id_asignacion'];
$b = "DELETE FROM Asignaciones WHERE Id_asignacion = '$id'";
$r = $conecta->query($b);
header("location:../CAsignacion.php");
$conecta->close();
 ?>
