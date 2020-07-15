<?php
$servidor = "localhost";
$usuario = "root";
$password = "";
$bd = "Proyect";
$conecta = mysqli_connect($servidor, $usuario, $password, $bd);
if ($conecta->connect_error) {
  die('Error al conectar la base de datos de proyect'.$conecta->connect_error);
}
 ?>
