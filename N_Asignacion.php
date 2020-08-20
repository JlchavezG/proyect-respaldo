<?php
session_start();
error_reporting(0);
include 'includes/conecta.php';
// validación de usuario y acceso al modulo de dashboard
$usuario = $_SESSION['Usuario'];
if (!isset($usuario)) {
   header("location:index.php");
}
// consulta para extrar datos de usuario
$consulta = "SELECT * FROM Usuarios WHERE Usuario = '".$usuario."'";
$respuesta = $conecta->query($consulta);
$fila = $respuesta->fetch_array();
if ($fila > 0) {
  $user = $fila;
}
// consulta para extraer datos de laptop
$l = "SELECT * FROM Laptop WHERE Identificador = '0' ORDER BY Id_laptop";
$e = $conecta->query($l);
// consulta para extraer a los usuarios
$u = "SELECT * FROM Usuarios ORDER BY Id_Usuario";
$e1 = $conecta->query($u);

// sacar numero de asignación aleatorio
$caracteres ="123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-.#!";
for ($i=0; $i < 10 ; $i++) {
  $Nasigna = substr(str_shuffle($caracteres),0,10);
}

if (isset($_POST['registro'])) {
// recolectar datos para el registro
$laptop = $conecta->real_escape_string($_POST['laptop']);
$uasigna = $conecta->real_escape_string($_POST['usuario']);
$fecha = date('Y-m-d');
$estado = 1;
$usereg = $user['Usuario'] ;
// Generar codigo Qr
require 'phpqrcode/qrlib.php';
//declaramos la carpeta a contener los codigos
$dir = 'qr/';
// validar si existe la carpeta d elo contrario crearla
if (!file_exists($dir))
  mkdir($dir);
//ruta y nombre del archivo a generar
$filename = $dir.$Nasigna.'.png';
//Parametros de Condiguración
$tamaño = 10; //Tamaño de Pixel
$level = 'M'; //Precisión Media
$framSize = 3; //Tamaño en blanco
$contenido =('Id_Laptop: '.$laptop.' Usuario: '.$uasigna.'Fecha de Asignacion:'.$fecha.' Usuario que lo asigno: '.$user.'Folio de Asignacion: '.$Nasigna. 'Estatus: '.$estadoC) ; //Texto
//Enviamos los parametros a la Función para generar código QR
QRcode::png($contenido, $filename, $level, $tamaño, $framSize);
}
// verificar que el numero de asignacion no se repita
$Numeronuevo = "SELECT * FROM Asignaciones WHERE Numero = '$Nasigna'";
$nuevo = $conecta->query($Numeronuevo);
if ($nuevo ->num_rows > 0) {
  $alerta.="<div class='alert alert-danger alert-dismissible fade show' role='alert'>
    <strong>Ya existe el numero de Asignacion</strong> El Numero de asignación ya se encuentra en la base de datos de la aplicación verificala por Favor.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
    </div>";
}
else{
// inseratar la asignacion de equipos
$insertar = "INSERT INTO Asignaciones(Id_Laptop,Id_Usuario,Fecha,Numero,User_Reg,Id_Estado)VALUES('$laptop','$uasigna','$fecha','$Nasigna','$usereg','$estado')";
$in = $conecta->query($insertar);
if ($in > 0) {
  $alerta.="<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Se Asigno correctamente</strong> El equipo se asigno al usuario correctamente ya se encuentra en la base de datos de la aplicación.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
    </div>";
}
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="sistema de almacenes e inventarios de equipo de computo laptops">
    <meta name="author" content="iscjlchavesg">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" href="css/simple-sidebar.css">
    <link rel="stylesheet" href="css/pace.css">
    <title>Inicio | Sistemas de Control</title>
  </head>
  <body>
    <div class="d-flex" id="wrapper">
      <!-- incluir sidebar -->
      <?php
             // restriccion de siderbar segun nivel
              $sidebar = $user['Id_Nivel']; if ($sidebar == 1) { include 'includes/sidebarS.php'; } elseif ($sidebar == 2){ include 'includes/sidebarA.php'; } else { include 'includes/sidebarU.php';}
         ?>
      <!-- Contenido de la pagina -->
      <div id="page-content-wrapper">
           <?php include 'includes/barra.php'; ?>
           <?php include 'includes/mcerrar.php';?>
           <!-- calendario -->
           <?php include 'includes/calendario.php'; ?>
             <div class="container-fluid">
                 <div class="text text-right">
                    <p class="nav-link"><span class="icon-calendar"></span> Fecha :<?php echo date("d")."de el " .date("m"). " de " .date("Y");?></p>
                 </div>
                 <h4 class="mt-4 text text-center">Asignacion de equipo</h4>
                 <div class="container py-3">
                   <!-- inicia formulario de registro -->
                   <form name="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" id="form1">
                      <div class="row">
                             <div class="col">
                                 <select class="custom-select" name="laptop">
                                    <option value="">Selecciona una laptpo disponible</option>
                                    <?php while($row = $e->fetch_assoc()) { ?>
                                    <option value="<?php echo $row['Id_laptop'];?>"><?php echo $row['Modelo'];?></option>
                                    <?php } ?>
                                 </select>
                             </div>
                             <div class="col">
                               <select class="custom-select" name="usuario">
                                  <option value="">Selecciona un usuario a asignar</option>
                                  <?php while($row1 = $e1->fetch_assoc()) { ?>
                                  <option value="<?php echo $row1['Id_Usuario'];?>"><?php echo $row1['Nombre'];?> <?php echo $row1['ApellidoP'];?></option>
                                  <?php } ?>
                               </select>
                             </div>
                             <div class="col">
                                  <input type="date" class="form-control" name="fecha" placeholder="Fecha" required>
                             </div>
                      </div>
                     <div class="row py-3">
                          <input type="submit" name="registro" value="Registrar" class="btn btn-success btn-sm btn-lg btn-block">
                     </div>
                     <div class="row">
                        <div class="col">
                            <?php echo $alerta; ?>
                        </div>
                      </div>
                        <div class="container row py-3">
                             <a href="RegistroS.php"><span class="icon-left-big"></span></a> Regresar a Registros
                        </div>
                     </div>
                   </div>
                  </form>
                  <!-- termina formulario -->
             </div>
       </div>
      <!-- Termina Contenido de la pagina -->
   </div>
   <!-- scripts -->
   <script src="js/bootstrap.js"></script>
   <script src="js/jquery-3.5.1.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/pace.min.js"></script>
   <!-- habilitar los toast -->
   <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
   </script>
   </body>
</html>
