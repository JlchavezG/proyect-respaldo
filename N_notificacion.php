<?php
  error_reporting(0);
  session_start();
  include 'includes/conecta.php';
  $usuario = $_SESSION['Usuario'];
  if(!isset($usuario)){
    header("location:index.php");
  }
  // consulta para extrar datos de usuario
  $consulta = "SELECT * FROM Usuarios WHERE Usuario = '".$usuario."'";
  $respuesta = $conecta->query($consulta);
  $fila = $respuesta->fetch_array();
  if ($fila > 0) {
    $user = $fila;
  }
  if (isset($_POST['submit'])) {
    $count = 0;
    $autor = $conecta->real_escape_string($_POST['autor']);
    $titulo = $conecta->real_escape_string($_POST['titulo']);
    $mensaje = $conecta->real_escape_string($_POST['mensaje']);
    $fecha = date('Y-m-d');
    $estado = 0;
    $registro = "INSERT INTO notificaciones(Titulo,Mensaje,Estado,Usuario,Fecha)VALUES('$titulo','$mensaje','$estado','$usuario','$fecha')";
    $nuevo = $conecta->query($registro);
    if ($nuevo >0) {
      $alert.="<div class='alert alert-success alert-dismissible fade show' role='alert'>
                  <strong>Notificación Exitosa</strong> Tu mensaje se envio a todos los usuarios.
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                   <span aria-hidden='true'>&times;</span>
                  </button>
               </div>";
    }
  }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" href="css/simple-sidebar.css">
    <link rel="stylesheet" href="css/pace.css">
    <title>Inicio | Sistemas de Control</title>
  </head>
  <body>
    <div class="d-flex" id="wrapper">
      <!-- Sidebar -->
         <?php
             // restriccion de siderbar segun nivel
              $sidebar = $user['Id_Nivel']; if ($sidebar == 1) { include 'includes/sidebarS.php'; } elseif ($sidebar == 2){ include 'includes/sidebarA.php'; } else { include 'includes/sidebarU.php';}
         ?>
      <!-- termina sidebar -->

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
          <h4 class="mt-4 text text-center">Nueva Notificación </h4>
          <div class="container py-4">
                 <form name="notificacion" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                   <div class="row">
                      <div class="col-lg-6">
                          <input type="text" class="form-control" placeholder="Autor" name="autor" value="<?php echo $usuario; ?>">
                      </div>
                      <div class="col-lg-6">
                          <input type="text" class="form-control" name="titulo" placeholder="Titulo">
                      </div>
                      <div class="col-lg-12 py-3">
                          <input type="text" class="form-control" name="mensaje" placeholder="Mensaje">
                      </div>
                   </div>
                   <div class="col-lg-12 py-3">
                     <input type="submit" name="submit" value="Enviar" class="btn btn-success  btn-block">
                   </div>
                </form>
                <hr><?php echo $alert; ?>
                <div class="container row py-3">
                    <a href="RegistroS.php"><span class="icon-left-big"></span></a> Regresar a Registros
                </div>
         </div>
      <!-- Termina Contenido de la pagina -->

    </div>
    <!-- /#wrapper -->
  <script src="js/bootstrap.js"></script>
  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/pace.min.js"></script>
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>
  </body>
</html>
