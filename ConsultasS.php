<?php
session_start();
include 'includes/conecta.php';
// validación de usuario y acceso al modulo de dashboard
$usuario = $_SESSION['Usuario'];
if (!isset($usuario)) {
   header("location:sistema.php");
}
// consulta para extrar datos de usuario
$consulta = "SELECT * FROM Usuarios WHERE Usuario = '".$usuario."'";
$respuesta = $conecta->query($consulta);
$fila = $respuesta->fetch_array();
if ($fila > 0) {
  $user = $fila;
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
    <title>Inicio | Consulta de sistemas</title>
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
                 <h3 class="mt-4 text text-center">Consultas de <?php echo $TDasboard; ?></h3>
                 <!-- inicia tarjetas para link de funciones -->
                 <div class="container py-4">
                      <div class="row">
                           <div class="col-sm">
                             <div class="card mb-3" style="max-width: 540px;">
                                <div class="row no-gutters">
                                   <div class="col-md-4">
                                      <h2 class="text text-center py-2"><span class="icon-monitor"></span></h2>
                                   </div>
                                   <div class="col-md-8">
                                   <div class="card-body">
                                      <h5 class="card-title"><a href="EquiposS.php" class="text-secondary text-decoration-none"><span class="icon-search"></span> Equipos</h5></a>
                                      <p class="card-text"><small class="text-muted">Consultar equipo en el sistema.</small></p>
                                   </div>
                                </div>
                           </div>
                         </div>
                         </div>
                         <div class="col-sm">
                           <div class="card mb-3" style="max-width: 540px;">
                               <div class="row no-gutters">
                                  <div class="col-md-4">
                                     <h2 class="text text-center py-2"><span class="icon-bell"></span></h2>
                                  </div>
                                  <div class="col-md-8">
                                  <div class="card-body">
                                      <h5 class="card-title"><a href="Notificaciones.php" class="text-secondary text-decoration-none"><span class="icon-search"></span> Notificación</h5></a>
                                      <p class="card-text"><small class="text-muted">Consultar Notificaciones</small></p>
                                  </div>
                              </div>
                          </div>
                        </div>
                       </div>
                           <div class="col-sm">
                             <div class="card mb-3" style="max-width: 540px;">
                                 <div class="row no-gutters">
                                    <div class="col-md-4">
                                        <h2 class="text text-center py-2"><span class="icon-binoculars"></span></h2>
                                    </div>
                                    <div class="col-md-8">
                                    <div class="card-body">
                                       <h5 class="card-title"><a href="CMarcas.php" class="text-secondary text-decoration-none"><span class="icon-search"></span> Marcas</h5></a>
                                          <p class="card-text"><small class="text-muted">Consultar marcas de equipos</small></p>
                                    </div>
                                 </div>
                              </div>
                             </div>
                           </div>
                        </div>
                     </div>
                     <!-- segunda fila del dashboard -->
                     <div class="container py-4">
                          <div class="row">
                               <div class="col-sm">
                                 <div class="card mb-3" style="max-width: 540px;">
                                     <div class="row no-gutters">
                                        <div class="col-md-4">
                                          <h2 class="text text-center py-2"><span class="icon-user-1"></span></h2>
                                        </div>
                                        <div class="col-md-8">
                                        <div class="card-body">
                                           <h5 class="card-title"><a href="UsuariosS.php" class="text-secondary text-decoration-none"><span class="icon-search"></span> Usuarios</h5></a>
                                              <p class="card-text"><small class="text-muted">Consultar Usuarios</small></p>
                                        </div>
                                     </div>
                                  </div>
                                 </div>
                               </div>
                               <div class="col-sm">
                                 <div class="card mb-3" style="max-width: 540px;">
                                     <div class="row no-gutters">
                                        <div class="col-md-4">
                                            <h2 class="text text-center py-2"><span class="icon-resize-full"></span></h2>
                                        </div>
                                        <div class="col-md-8">
                                        <div class="card-body">
                                           <h5 class="card-title"><a href="CAsignacion.php" class="text-secondary text-decoration-none"><span class="icon-search"></span> Asignaciones</h5></a>
                                              <p class="card-text"><small class="text-muted">Consultar Asignaciones</small></p>
                                        </div>
                                     </div>
                                  </div>
                                 </div>
                               </div>
                            </div>
                         </div>
                            </div>
                         </div>
                        <!-- termina dashboard -->
                 <!-- termina tarjetas de funciones -->
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
