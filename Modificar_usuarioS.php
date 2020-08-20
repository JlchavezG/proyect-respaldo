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
$nivel = "SELECT * FROM Niveles ORDER BY Id_Nivel";
$q = $conecta->query($nivel);
// recibir los datos por metodo get para la consulta
$id = $_GET['Id_Usuario'];
$recorrido = "SELECT * FROM Usuarios WHERE Id_Usuario = '$id'";
$resultado = $conecta->query($recorrido);
$modifica = $resultado->fetch_array(MYSQLI_ASSOC);
// consulta para modificar registro
if (isset($_POST['modificar'])) {
   $id = $_POST['id'];
   $nombre = $conecta->real_escape_string($_POST['nombre']);
   $apellidop = $conecta->real_escape_string($_POST['apellidop']);
   $apellidom = $conecta->real_escape_string($_POST['apellidom']);
   $nivel = $conecta->real_escape_string($_POST['tusuario']);
   $telefono = $conecta->real_escape_string($_POST['telefono']);
   $email = $conecta->real_escape_string($_POST['email']);
   $m = "UPDATE Usuarios SET Nombre = '$nombre',ApellidoP = '$apellidop',ApellidoM = '$apellidom',Id_Nivel = '$nivel', Telefono = '$telefono', Email = '$email' WHERE Id_Usuario = '$id'";
   $r = $conecta->query($m);
   if ($r > 0) {
      header("location:UsuariosS.php");
   }
   else {
     $mensaje.= "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                 <strong>Error al Actualizar!</strong> No se puede actualizar los datos por favor contacte a su proveedor.
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
    <meta name="description" content="sistema de almacenes e inventarios de equipo de computo laptops">
    <meta name="author" content="iscjlchavesg">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" href="css/simple-sidebar.css">
    <link rel="stylesheet" href="css/pace.css">
    <title>Modificar | Usuarios</title>
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
                 <h3 class="mt-4 text text-center">Modificando Usuario</h3>
                 <div class="container py-3">
                   <form name="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" id="form1">
                      <div class="row">
                             <div class="col">
                                  <input type="hidden" name="id" id="id" value="<?php echo $modifica['Id_Usuario']; ?>">
                                  <input type="text" class="form-control" value="<?php echo $modifica['Nombre']; ?>" name="nombre" placeholder="Nombre" required>
                             </div>
                             <div class="col">
                                  <input type="text" class="form-control" value="<?php echo $modifica['ApellidoP']; ?>" name="apellidop" placeholder="Apellido Paterno" required>
                             </div>
                             <div class="col">
                                  <input type="text" class="form-control" value="<?php echo $modifica['ApellidoM']; ?>" name="apellidom" placeholder="Apellido Materno" required>
                             </div>
                             <div class="col">
                                     <select class="custom-select" name="tusuario" value required>
                                          <option value="<?php echo $modifica['Id_Nivel'];?>"><?php echo $modifica['Id_Nivel'];?></option>
                                          <?php while($row = $q->fetch_assoc()) { ?>
                                          <option value="<?php echo $row['Id_Nivel'];?>"><?php echo $row['Nombre'];?></option>
                                          <?php } ?>
                                     </select>
                             </div>
                      </div>
                        <div class="row py-3">
                        <div class="col">
                                <input type="tel" class="form-control" value="<?php echo $modifica['Telefono']; ?>" name="telefono" placeholder="Telefono" required>
                        </div>
                        <div class="col">
                                <input type="email" class="form-control" value="<?php echo $modifica['Email']; ?>" name="email" placeholder="Email" required>
                        </div>
                      </div>
                        <div class="row py-3">
                          <input type="submit" name="modificar" value="Modificar" class="btn btn-success btn-sm btn-lg btn-block">
                        </div>
                        <div class="row">
                        <div class="col">
                            <?php echo $mensaje; ?>
                        </div>
                        </div>
                     </div>
                   </div>
                  </form>
                  <!-- termina formulario -->
             </div>
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
