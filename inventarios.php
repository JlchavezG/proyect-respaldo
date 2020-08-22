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
    <title>Inicio | inventarios</title>
    <style type="text/css">
.highcharts-figure, .highcharts-data-table table {
    min-width: 320px;
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
  font-family: Verdana, sans-serif;
  border-collapse: collapse;
  border: 1px solid #EBEBEB;
  margin: 10px auto;
  text-align: center;
  width: 100%;
  max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
  font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}


input[type="number"] {
  min-width: 50px;
}
    </style>
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
                 <h1 class="mt-4 text text-center">Dashboard de <?php echo $TDasboard; ?></h1>
                 <p class="text-muted text-center">Bienvenido a Inventarios <?php echo $usuario; ?></p>
             </div>
             <div class="container">
               <body>
             <script src="hc/code/highcharts.js"></script>
             <script src="hc/code/modules/exporting.js"></script>
             <script src="hc/code/modules/export-data.js"></script>
             <script src="hc/code/modules/accessibility.js"></script>

             <figure class="highcharts-figure">
                 <div id="container"></div>
                 <p class="highcharts-description">
                     Inventario de usuarios, equipos y reportes.
                 </p>
             </figure>



                <script type="text/javascript">
             Highcharts.chart('container', {
                 chart: {
                     plotBackgroundColor: null,
                     plotBorderWidth: null,
                     plotShadow: false,
                     type: 'pie'
                 },
                 title: {
                     text: 'Inventario, 2020'
                 },
                 tooltip: {
                     pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                 },
                 accessibility: {
                     point: {
                         valueSuffix: '%'
                     }
                 },
                 plotOptions: {
                     pie: {
                         allowPointSelect: true,
                         cursor: 'pointer',
                         dataLabels: {
                             enabled: true,
                             format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                         }
                     }
                 },
                 series: [{
                     name: 'Inventario',
                     colorByPoint: true,
                     data: [{
                         name: 'Usuarios',
                         y: 61.41,
                         sliced: true,
                         selected: true
                     }, {
                         name: 'Sistemas',
                         y: 11.84
                     }, {
                         name: 'Equipos Asignados',
                         y: 10.85
                     }, {
                         name: 'Equipos Aplee',
                         y: 4.67
                     }, {
                         name: 'En reparación',
                         y: 1.18
                     }, {
                         name: 'Sin Asignar',
                         y: 1.64
                     }, {
                         name: 'Mantenimiento',
                         y: 1.1
                     }, {
                         name: 'Sin Usuario',
                         y: 1.1
                     }]
                 }]
             });
                </script>
            </div>
       </div>
      <!-- Termina Contenido de la pagina -->
   </div>
   <!-- scripts -->
   <script src="js/funciones.js"></script>
   <script src="js/bootstrap.js"></script>
   <script src="js/jquery-3.5.1.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/pace.min.js"></script>
   <script src="js/main.js"></script>
   <!-- habilitar los toast -->
   <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
   </script>
   </body>
</html>
