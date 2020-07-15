<?php
error_reporting(0);
session_start();
require('includes/conecta.php');
$usuario = $_POST['usuario'];
$password = md5($_POST['password']);
// consulta para ingresar al sistema y detrminar la variable de session
if(isset($_POST['submit'])){
$consulta = "SELECT * FROM Usuarios WHERE Usuario = '$usuario' and Password= '$password'";
if($resultado = $conecta->query($consulta)){
  while($row = $resultado->fetch_array()){
    $userok = $row['Usuario'];
    $passwordok = $row['Password'];
  }
    $resultado->close();
}
$conecta->close();
if (isset($usuario) && isset($password)) {
  if ($usuario == $userok && $password == $passwordok) {
     $_SESSION['login'] = TRUE;
     $_SESSION['Usuario'] = $usuario;
     header("location:sistema.php");
  }
  else {
    $alerta.="<div class='alert alert-danger alert-dismissible fade show' role='alert'>
               <strong>Usuario Incorrecto!</strong> Por favor verifica tu usuario y password.
               <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                 <span aria-hidden='true'>&times;</span>
               </button>
              </div>";
  }
} else {
  $alerta.="<div class='alert alert-danger alert-dismissible fade show' role='alert'>
              <strong>Debes colocar datos</strong> no hay usuario y password dentro de el sistema.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                   <span aria-hidden='true'>&times;</span>
                </button>
             </div>";
}}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" href="css/pace.css">
    <title>Inicio | Login sistema</title>
  </head>
  <body>
  <!-- inicio maqueta sistema -->
  <div class="container py-4">
    <?php include 'includes/form_login.php'; ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="login" method="POST">
    <div class="form-group">
    <input type="text" class="form-control" name="usuario" placeholder="Usuario" id="user" required>
    <small id="emailHelp" class="form-text text-muted"><span class="icon-user-1"></span> Ingresa tu usuario establecido.</small>
    </div>
    <div class="form-group">
    <input type="password" class="form-control" name="password" placeholder="password" id="pwd" required>
    <small id="emailHelp" class="form-text text-muted"><span class="icon-lock"></span> Ingresa el password asignado en el sistema.</small>
    </div>
    <div class="custom-control custom-switch">
      <input type="checkbox" class="custom-control-input" id="ver" onclick="verpass(this);">
      <label class="custom-control-label" for="ver">Ver Password</label>
    </div><hr>
    <button type="submit" name="submit" class="btn btn-success btn-lg btn-block">Ingresar</button>
  </form><br>
    <?php echo $alerta;?>
 </div>
  <script src="js/main.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/pace.min.js"></script>
  </body>
</html>
