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
$ejecuta = $conecta->query($marca);
// consulta para extraer estatus
$status = "SELECT * FROM Estatus ORDER BY Id_estatus";
$ejecuta2 = $conecta->query($status);
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
                                  <input type="text" class="form-control" name="modelo" placeholder="Modelo" required>
                             </div>
                      </div>
                      <div class="row py-3">
                        <div class="col">
                              <select class="custom-select" name="marca" required>
                                   <option value="">Selecciona la marca de el equipo</option>
                                   <?php while($row = $ejecuta->fetch_assoc()) { ?>
                                   <option value="<?php echo $row['Id_Marca'];?>"><?php echo $row['Nombre'];?></option>
                                   <?php } ?>
                              </select>
                        </div>
                        <div class="col">
                                <input type="text" class="form-control" name="serie" placeholder="Nº de serie" required>
                        </div>
                        <div class="col">
                                <input type="text" class="form-control" name="key" placeholder="Nkey" required>
                        </div>
                     </div>
                     <div class="row py-3">
                       <div class="col">
                         <select class="custom-select" name="marca" required>
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
             </div>
       </div>
      <!-- Termina Contenido de la pagina -->
   </div>
   <!-- scripts -->
   <script src="js/bootstrap.js"></script>
   <script src="js/jquery-3.5.1.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <!-- habilitar los toast -->
   <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
   </script>
   </body>
</html>
