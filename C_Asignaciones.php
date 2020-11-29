<?php
error_reporting(0);
session_start();
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
// consulta para extraer los datos de asignacion
$asigna = "SELECT * FROM Asignaciones ORDER BY Id_asignacion";
$as = $conecta->query($asigna);
$numero = $as->num_rows;

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
    <title>Inicio | Asignaciones de Equipos</title>
  </head>
  <body>
    <div class="d-flex" id="wrapper">
      <!-- incluir sidebar -->
      <?php
             // restriccion de siderbar segun nivel
              $sidebar = $user['Id_Nivel']; if ($sidebar == 1) { include 'includes/sidebarS.php'; } elseif ($sidebar == 2){ include 'includes/sidebarA.php'; } else { include 'includes/sidebarU.php';}
              $TDasboard = $user['Id_Nivel'];if ($TDasboard == 1) { $TDasboard = "Sistemas"; } elseif ($TDasboard == 2 ) { $TDasboard = " Administrador"; } else { $TDasboard = " Usuario"; }
         ?>
      <!-- Contenido de la pagina -->
      <div id="page-content-wrapper">
           <?php include 'includes/barra.php'; ?>
           <?php include 'includes/mcerrar.php';?>
           <!-- calendario -->
           <?php include 'includes/calendario.php'; ?>
             <div class="container-fluid">
                 <div class="text text-right">
                 </div>
                 <h4 class="mt-4 text text-center">Lista de Asignación de Equipos</h4>
                       <div class="container py-4">
                           <?php  if($as > 0) { ?>
                          <p class="text-muted text-center">Total de Registros: <?php echo $numero; ?></p>
                        <div class="table-responsive">
                         <table class="table table-sm table-hover">
                             <thead>
                                <tr>
                                  <th scope="col">Asignacion</th>
                                  <th scope="col">Laptop</th>
                                  <th scope="col">Usuario</th>
                                  <th scope="col">Fecha</th>
                                  <th scope="col">Usuario que Asigno</th>
                                  <th scope="col">Qr</th>
                                </tr>
                             </thead>
                             <tbody>
                                  <?php while($row = $as->fetch_assoc()) { ?>
                                  <tr>
                                    <td><?php echo $row['Id_asignacion']; ?></td>
                                    <td><?php echo $row['Id_Laptop']; ?></td>
                                    <td><?php echo $row['Id_Usuario']; ?></td>
                                    <?php $FechaF = date('d-m-Y');
                                          $row['Fecha'] = $FechaF ;
                                     ?>
                                    <td><?php echo $FechaF; ?></td>
                                    <td><?php echo $row['User_Reg']; ?></td>
                                    <td><a href="qr/<?php echo $row['Numero'].'.png';?>" target="_blank" class="badge badge-pill badge-success"><?php echo $row['Numero']; ?></a></td>

                                  </tr>
                                   <?php } ?>
                             </tbody>
                        </table>
                      </div>
                    <?php } else {?>
                    <div class="container">
                       <div class="alert alert-danger">
                            <p class="text text-center"><span class="icon-calendar"></span> Aun no tienes ningun equipo asignado en el sistema. Puedes realizar tu primera Asignación<a href="N_Asignacion.php" class="link-item" >Aqui</a></p>
                       </div>
                    </div>
                    <?php } ?>
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
