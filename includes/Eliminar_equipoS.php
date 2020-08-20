<?php
include 'conecta.php';
$id = $_GET['Id_laptop'];
$b = "DELETE FROM Laptop WHERE Id_laptop = '$id'";
$r = $conecta->query($b);
header("location:../EquiposS.php");
$conecta->close();
 ?>
