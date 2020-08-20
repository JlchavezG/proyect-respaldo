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
// consulta para extrar marcas de equipos
$marca = "SELECT * FROM Marcas ORDER BY Id_Marca";
$nmarca = $conecta->query($marca);
// consulta para extraer estatus
$status = "SELECT * FROM Estatus ORDER BY Id_estatus";
$ejecuta2 = $conecta->query($status);
// generar cadena de registro automatico
$caracteres = "123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-.#!";
for ($i=0; $i < 10 ; $i++) {
   $token = substr(str_shuffle($caracteres),0,10);
}
// recuerar datos para el registro de equipo
$Modelo = $conecta->real_escape_string($_POST['Modelo']);
$Marca = $conecta->real_escape_string($_POST['Marca']);
$Nserie = $conecta->real_escape_string($_POST['Serie']);
$Nkey = $conecta->real_escape_string($_POST['key']);
$reset = $conecta->real_escape_string($_POST['reset']);
$Fecha = date('Y-m-d');
$RegAuto = $token;
$Estatus = $conecta->real_escape_string($_POST['Estatus']);
$ident = 0;
// registro de un equipo en el sistema
$registro = "INSERT INTO Laptop(Modelo,Id_marca,Nserie,NKey,Reset,Fecha,RegAuto,Estatus,Identificador)VALUES('$Modelo','$Marca','$Nserie','$Nkey','$reset','$Fecha','$RegAuto','$Estatus','$ident')";
$registra = $conecta->query($registro);
if($registra > 0){
$alerta.= "<div class='alert alert-success alert-dismissible fade show' role='alert'>
             <strong>Registro Exitoso</strong> El equipo se registro dentro de el sistema.
             <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
               <span aria-hidden='true'>&times;</span>
             </button>
          </div>";
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
    <link rel="stylesheet" href="css/pace.css">
    <link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" href="css/simple-sidebar.css">
    <title>Inicio | Registro de Equipo</title>
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
                 <h4 class="mt-4 text text-center">Registro de Equipo </h4>
                 <div class="container py-3">
                   <!-- inicia formulario de registro -->
                   <form name="registro" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                      <div class="row">
                             <div class="col">
                                  <input type="text" class="form-control" name="Modelo" placeholder="Modelo" required>
                             </div>
                      </div>
                      <div class="row py-3">
                        <div class="col">
                              <select class="custom-select" name="Marca" required>
                                   <option value="">Selecciona la marca de el equipo</option>
                                   <?php while($row = $nmarca->fetch_assoc()) { ?>
                                   <option value="<?php echo $row['Id_Marca'];?>"><?php echo $row['Nombre'];?></option>
                                   <?php } ?>
                              </select>
                        </div>
                        <div class="col">
                                <input type="text" class="form-control" name="Serie" placeholder="Nº de serie" required>
                        </div>
                        <div class="col">
                                <input type="text" class="form-control" name="key" placeholder="Recovery" required>
                        </div>
                        <div class="col">
                                <input type="text" class="form-control" name="reset" placeholder="Reset" required>
                        </div>
                     </div>
                     <div class="row py-3">
                       <div class="col">
                         <select class="custom-select" name="Estatus" required>
                              <option value="">Selecciona Estatus</option>
                              <?php while($row1 = $ejecuta2->fetch_assoc()) { ?>
                              <option value="<?php echo $row1['Id_estatus'];?>"><?php echo $row1['Nombre'];?></option>
                              <?php } ?>
                         </select>
                       </div>
                     </div>
                     <div class="row py-3">
                               <input type="submit" name="submit" value="Registrar" class="btn btn-success btn-sm btn-lg btn-block">
                     </div>
                  </form>
                  <?php echo $alerta; ?>
                  <!-- termina formulario -->
                  <div class="container row py-3">
                       <a href="RegistroS.php"><span class="icon-left-big"></span></a> Regresar a Registros
                  </div>
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
