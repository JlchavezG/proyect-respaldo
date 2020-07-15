<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fontello.css">
    <title>Inicio | Proyecto</title>
  </head>
  <body>
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
               <div class="container-fluid">
                   <div class="text text-right">
                      <p class="nav-link"><span class="icon-calendar"></span> Fecha :<?php echo date("d")."de el " .date("m"). " de " .date("Y");?></p>
                   </div>
                   <h1 class="mt-4 text text-center">Dashboard de <?php echo $TDasboard; ?></h1>
                   <?php
                      $dasboard = $user['Id_Nivel']; if ($dasboard == 1) { include 'includes/dashboardS.php'; } elseif ($dasboard == 2) { include 'includes/dashboardA.php';} else { include 'includes/dashboardU.php'; }
                   ?>
               </div>
         </div>
        <!-- Termina Contenido de la pagina -->
     </div>
  <!-- script -->   
  <script src="js/bootstrap.js"></script>
  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  </body>
</html>
