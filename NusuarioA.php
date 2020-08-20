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
if ($user == 3) {
  header("location:sistemas.php");
}
// validar que coinsidan los password
$pass = $_POST['password'];
$cpass = $_POST['cpassword'];
if (isset($_POST['registro'])) {
   if ($pass != $cpass) {
     $alerta.= "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                  <strong>Error al verificar Password</strong> Los passwords no coinciden por favor verificalo.
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
               </div>";
   }
else {
// recolectar datos para el registro
$Nombre = $conecta->real_escape_string($_POST['nombre']);
$Apellido1 = $conecta->real_escape_string($_POST['apellidop']);
$Apellido2 = $conecta->real_escape_string($_POST['apellidom']);
$Nivel = 3;
$Telefono = $conecta->real_escape_string($_POST['telefono']);
$Email = $conecta->real_escape_string($_POST['email']);
$Username = $conecta->real_escape_string($_POST['user']);
$Password = md5($_POST['password']);
// consulta para verificar usuarios registrados
$revisa = "SELECT * FROM Usuarios WHERE Usuario = '$Username'";
$checar = $conecta->query($revisa);
  if ($checar->num_rows > 0) {
    $alerta.= "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                 <strong>Error de nombre de Usuario</strong> El nombre de usuario ya se encuentra registrado en el sistema.
                 <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                   <span aria-hidden='true'>&times;</span>
                 </button>
              </div>";
  }
else {
// consulta para registro de usuarios
$nuevo = "INSERT INTO Usuarios(Nombre,ApellidoP,ApellidoM,Id_Nivel,Telefono,Email,Usuario,Password)VALUES('$Nombre','$Apellido1','$Apellido2','$Nivel','$Telefono','$Email','$Username','$Password')";
$registro= $conecta->query($nuevo);
if ($registro > 0) {
  $alerta.= "<div class='alert alert-success alert-dismissible fade show' role='alert'>
               <strong>Registro Exitoso</strong> El usuario ya esta registrado en el sistema.
               <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                 <span aria-hidden='true'>&times;</span>
               </button>
            </div>";
}}}}
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
                 <h4 class="mt-4 text text-center">Registro de Usuario </h4>
                 <div class="container py-3">
                   <!-- inicia formulario de registro -->
                   <form name="registroU" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                      <div class="row">
                             <div class="col">
                                  <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
                             </div>
                             <div class="col">
                                  <input type="text" class="form-control" name="apellidop" placeholder="Apellido Paterno" required>
                             </div>
                             <div class="col">
                                  <input type="text" class="form-control" name="apellidom" placeholder="Apellido Materno" required>
                             </div>
                      </div>
                      <div class="row py-3">
                        <div class="col">
                                <input type="tel" class="form-control" name="telefono" placeholder="Telefono" required>
                        </div>
                        <div class="col">
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                     </div>
                     <div class="row py-3">
                       <div class="col">
                               <input type="text" class="form-control" name="user" placeholder="Usuario" required>
                       </div>
                       <div class="col">
                               <input type="password" class="form-control" name="password" placeholder="Password" required>
                       </div>
                       <div class="col">
                               <input type="password" class="form-control" name="cpassword" placeholder="Confirma Password" required>
                       </div>
                     </div>
                     <div class="row py-3">
                          <input type="submit" name="registro" value="Registrar" class="btn btn-success btn-sm btn-lg btn-block">
                     </div>
                     <div class="row">
                        <div class="col">
                            <?php echo $alerta; ?>
                        </div>
                        <div class="container row py-3">
                             <span class="icon-left-big"></span> Regresar a Registros
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
