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
// consulta para extrar el nivel de usuario
$marca = "SELECT * FROM Marcas ORDER BY Id_Nivel";
$ejecuta = $conecta->query($marca);

if (isset($_POST['submit'])) {
  $Marca = $conecta->real_escape_string($_POST['nombre']);
  $Codigo = $conecta->real_escape_string($_POST['codigo']);
  // consulta para verificiar si no existe la marca en el sistema
  $nmarca = "SELECT * FROM Marcas WHERE Nombre = '$Marca'";
  $ejecuta = $conecta->query($nmarca);
  if ($ejecuta->num_rows > 0) {
    $alerta.= "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                 <strong>Error al verificar la marca</strong> La marca de laptop ya se encuentra registrada en el sistema.
                 <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                   <span aria-hidden='true'>&times;</span>
                 </button>
              </div>";
  }
  else{
    $ncodigo = "SELECT * FROM Marcas WHERE Codigo = '$Codigo'";
    $ejecutar = $conecta->query($ncodigo);
    if ($ejecutar->num_rows > 0) {
      $alerta.= "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                   <strong>Error al verificar el codigo</strong> El codigo de laptop ya se encuentra registrada en el sistema.
                   <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                     <span aria-hidden='true'>&times;</span>
                   </button>
                </div>";
  }
  else {
  // consulta para registrar la nueva marca
  $insert = "INSERT INTO Marcas(Nombre,Codigo)VALUES('$Marca','$Codigo')";
  $inserta = $conecta->query($insert);
  $alerta.= "<div class='alert alert-success alert-dismissible fade show' role='alert'>
               <strong>Registro Exitoso</strong> La Marca de laptop se registro en el sistema.
               <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                 <span aria-hidden='true'>&times;</span>
               </button>
            </div>";
}
}}
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
    <title>Inicio | Nueva marca</title>
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
                 <h4 class="mt-4 text text-center">Registro de Marca </h4>
                 <div class="container py-3">
                   <!-- inicia formulario de registro -->
                   <form name="registro" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                      <div class="row">
                             <div class="col">
                                  <input type="text" class="form-control" name="nombre" placeholder="Nombre de Marca" required>
                             </div>
                             <div class="col">
                                  <input type="text" class="form-control" name="codigo" placeholder="codigo" required>
                             </div>
                      </div>
                     <div class="row py-3">
                               <input type="submit" name="submit" value="Registrar" class="btn btn-success btn-sm btn-lg btn-block">
                     </div>
                        <?php echo $alerta; ?>
                        <div class="container row py-3">
                             <a href="RegistroS.php"><span class="icon-left-big"></span></a> Regresar a Registros
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
