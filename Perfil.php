<?php
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
$id = $fila['Id_Usuario'];
// consulta para verificar asignaciones d equipo dentro de el perfil
$asig = "SELECT * FROM Asignaciones WHERE Id_Usuario = '$id'";
$asigna = $conecta->query($asig);
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
    <title>Inicio | Plantilla</title>
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
                 <h1 class="mt-4 text text-center">Perfil de Usuario</h1>
                  <!--  inicia información de el perfil-->
                  <div class="container py-4">
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                         <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Datos de Usuario</a>
                         </li>
                         <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Asignación de Equipo</a>
                         </li>
                         <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contacto</a>
                         </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="container py-4">
                          <div class="container">
                          <div class="row">
                               <div class="col row justify-content-center h-100">
                                    <div class="col-lg-3">
                                         <img alt="User Pic" src="img/users/<?php echo $user['Imagen']; ?>" class="img-responsive img-fluid rounded-circle">
                                     </div>
                               </div>
                         </div>
                      </div><br>
                         <table class="table table-sm  table-hover">
                           <thead>
                               <tr>
                                 <th scope="col">Nombre</th>
                                 <th scope="col">Apellidos</th>
                                 <th scope="col">Perfil</th>
                                 <th scope="col">UserName</th>
                               </tr>
                           </thead>
                           <tbody>
                                <tr>
                                     <td  scope="col"><?php echo $user['Nombre'];?></td>
                                     <td  scope="col"><?php echo $user['ApellidoP'];?> <?php echo $user['ApellidoM'];?></td>
                                     <?php $tipo = $user['Id_Nivel']; if ($tipo == 1) { $tipo = 'Sistemas';} elseif ($tipo == 2) { $tipo = 'Administrador'; } else { $tipo = 'Usuario'; } ?>
                                     <td  scope="col"><?php echo $tipo; ?></td>
                                     <td  scope="col"><?php echo $usuario; ?></td>
                                </tr>
                           </tbody>
                         </table>
                       </div>

                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                      <div class="py-3">

                      <table class="table table-sm  table-hover">
                        <thead>
                            <tr>
                              <th scope="col">No de Asignación</th>
                              <th scope="col">N0 de Laptop</th>
                              <th scope="col">Fecha de Asignación</th>
                              </tr>
                        </thead>
                        <tbody>
                             <?php while($linea = $asigna->fetch_assoc()) { ?>
                             <tr>
                                  <td  scope="col"><?php echo $linea['Id_asignacion'];?></td>
                                  <td  scope="col"><?php echo $linea['Id_Laptop'];?></td>
                                  <td  scope="col"><?php echo $linea['Fecha'];?></td>
                             </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                   </div>
                   </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                      <div class="container py-4">
                       <table class="table table-sm  table-hover">
                         <thead>
                             <tr>
                               <th scope="col">Telefono</th>
                               <th scope="col">Email</th>
                               </tr>
                         </thead>
                         <tbody>
                              <tr>
                                   <td  scope="col"><?php echo $user['Telefono'];?></td>
                                   <td  scope="col"><?php echo $user['Email'];?> </td>
                              </tr>
                         </tbody>
                       </table>
                     </div>
                    </div>
                  </div>
                  <!-- termina -->
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
