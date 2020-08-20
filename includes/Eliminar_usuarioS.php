<?php
include 'conecta.php';
$id = $_GET['Id_Usuario'];
$b = "DELETE FROM Usuarios WHERE Id_Usuario = '$id'";
$r = $conecta->query($b);
header("location:../UsuariosS.php");
$conecta->close();
 ?>
