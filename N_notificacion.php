<?php
  error_reporting(0);
  session_start();
  include 'includes/conecta.php';
  $usuario = $_SESSION['Usuario'];
  if(!isset($usuario)){
    header("location:index.php");
  }
  if (isset($_POST['submit'])) {
    $count = 0;
    $autor = $conecta->real_escape_string($_POST['autor']);
    $mensaje = $conecta->real_escape_string($_POST['mensaje']);
    $fecha = date('Y-m-d');
    $estado = 0;
    $registro = "INSERT INTO notificaciones(Mensaje,Estado,Usuario,Fecha)VALUES('$mensaje','$estado','$usuario','$fecha')";
    $nuevo = $conecta->query($registro);
    if ($nuevo >0) {
      $alert.="<div class='alert alert-success alert-dismissible fade show' role='alert'>
                  <strong>Notificación Exitosa</strong> Tu mensaje se envio a todos los usuarios.
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                   <span aria-hidden='true'>&times;</span>
                  </button>
               </div>";
    }
    $contar = "SELECT * FROM notificaciones WHERE Estado = 0";
    $ejecuta = $conecta->query($contar);
    $count = $ejecuta->num_rows;
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
    <title>Inicio | Sistemas de Control</title>
  </head>
  <body>
    <div class="d-flex" id="wrapper">

      <!-- Sidebar -->
      <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading">IscjlchavezG </div>
        <div class="list-group list-group-flush">
          <a href="#" class="list-group-item list-group-item-action bg-light"><span class="icon-gauge"></span> Dashboard</a>
          <a href="#" class="list-group-item list-group-item-action bg-light"><span class="icon-folder-open"></span> Registros</a>
          <a href="#" class="list-group-item list-group-item-action bg-light"><span class="icon-search"></span> Consultas</a>
          <a href="#" class="list-group-item list-group-item-action bg-light"><span class="icon-users"></span> Usuarios</a>
          <a href="#" class="list-group-item list-group-item-action bg-light"><span class="icon-tags"></span> Inventario</a>
          <a href="#" class="list-group-item list-group-item-action bg-light"><span class="icon-bell-alt"></span> Notificaciones</a>
          <a href="#" class="list-group-item list-group-item-action bg-light"><span class="icon-coffee"></span> Status</a>
        </div>
      </div>
      <!-- termina sidebar -->

      <!-- Contenido de la pagina -->
      <div id="page-content-wrapper">

        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
          <span class="icon-menu" id="menu-toggle"> Menu</span>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
              <li class="nav-item active">
                <a class="nav-link" href="#"><span class="icon-home"></span> Inicio |<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="icon-user-1"></span> Usuario
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">Perfil</a>
                  <a class="dropdown-item" href="#">Configuración</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Cerrar Sesión</a>
                </div>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" > | <span class="icon-bell-alt"></span><?php echo $count; ?><span class="badge badge-danger" onclick="vernotifica()">0</span></a>
              </li>
              <li class="nav-item">
                <p class="nav-link"> | <span class="icon-calendar"></span> Fecha :<?php echo date("d")."de el " .date("m"). " de " .date("Y");?></p>
              </li>
            </ul>
          </div>
        </nav>

        <div class="container-fluid">
          <h1 class="mt-4 text text-center">Nueva Notificación</h1>
          <div class="container py-4">
                 <form name="notificacion" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                   <div class="row">
                      <div class="col-lg-6">
                          <input type="text" class="form-control" placeholder="Autor" name="autor" value="<?php echo $usuario; ?>">
                      </div>
                      <div class="col-lg-6">
                          <input type="text" class="form-control" name="mensaje" placeholder="Mensaje">
                      </div>
                   </div>
                   <div class="col-lg-12 py-3">
                     <input type="submit" name="submit" value="Enviar" class="btn btn-success  btn-block">
                   </div>
                </form>
                <hr><?php echo $alert; ?>
         </div>
      <!-- Termina Contenido de la pagina -->

    </div>
    <!-- /#wrapper -->
  <script src="js/bootstrap.js"></script>
  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>
  </body>
</html>
