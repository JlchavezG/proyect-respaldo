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
// variable de busqueda para el usuario(Nombre)
$where = "";
if (empty($_POST['submit'])) {
    $valor = $_POST['Nombre'];
    if (!empty($valor)) {
       $where = "WHERE Email LIKE '%$valor%'";
    }
}
// consulta para extraer los datos de los usuarios
$buscar = "SELECT * FROM Usuarios $where";
$busca = $conecta->query($buscar);
$numero = $busca->num_rows;

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
    <title>Consulta | Usuarios</title>
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
                 <h3 class="mt-4 text text-center">Consulta de Usuarios</h3>
                       <div class="container py-3">
                          <a href="ConsultasS.php"><span class="icon-left-big"></span></a> Regresar a Consultas
                          <div class="row">
                              <div class="container">
                               <a href="UsuariosS.php">Buscar por Nombre</a> | <a href="Ue_Usuarios.php">Buscar por Email</a>
                              </div>
                          </div>
                           <div class="card-body">
                              <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <input type="text" name="Nombre" class="form-control" placeholder="Busqueda de usuario por Emeil">
                                <br><button type="submit" name="submit" class="btn btn-success btn-sm btn-block" id="dubmit">Buscar</button>
                              </form>
                           </div>
                            <div class="table-responsive py-3 table-hover" id="TablaUsuario">
                              <?php if ($busca > 0){ // si encuentra registros los presenta en la tabla ?>
                               <table class="table">
                                  <thead class="text-muted">
                                     <th>Nombre</th>
                                     <th>Apellido Paterno</th>
                                     <th>Apellido Materno</th>
                                     <th>Nivel</th>
                                     <th>Telefono</th>
                                     <th>Email</th>
                                     <th>Usuario</th>
                                     <th>Opciones</th>
                                  </thead>
                                  <tbody>
                                    <?php while($row = $busca->fetch_assoc()){ ?>
                                     <tr>
                                       <td><?php echo $row['Nombre']; ?></td>
                                       <td><?php echo $row['ApellidoP']; ?></td>
                                       <td><?php echo $row['ApellidoM']; ?></td>
                                       <td><?php echo $row['Id_Nivel']; ?></td>
                                       <td><?php echo $row['Telefono']; ?></td>
                                       <td><?php echo $row['Email']; ?></td>
                                       <td><?php echo $row['Usuario']; ?></td>
                                       <td><a href="Modificar_usuarioS.php?Id_Usuario=<?php echo $row['Id_Usuario'] ?>"><span class="icon-pencil"></span></a> - <a href="./includes/Eliminar_usuarioS.php?Id_Usuario=<?php echo $row['Id_Usuario'] ?>" onclick = "confirm(¿Estas Seguro de querer Eliminar el registro?);"><span class="icon-trash"></span></a></td>
                                     </tr>
                                   <?php } ?>
                                  </tbody>
                               </table>
                             <?php } else { // si no encuentra registros muestra la siguiente alerta?>
                               <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                   <strong>No se enciontraron registros</strong> Actualmente no hay resgistros en la base de datos.
                                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                   </button>
                               </div>
                               <?php } ?>
                            </div>
                            <div class="card">
                               <div class="card-header">
                                 <p class="text-muted text-right">Generar Reporte de Usuarios por rango de fecha de ingreso</p>
                               </div>
                               <div class="card-body">
                                 <form class="form-group" action="includes/reporte_usuarios_excel.php" method="post">
                                   <div class="form-row">
                                       <div class="col-lg-6 col-md-6 col-sm-6">
                                         <input type="date" name="fecha1" class="form-control" required>
                                       </div>
                                       <div class="col-lg-6 col-md-6 col-sm-6">
                                         <input type="date" name="fecha2" class="form-control" required>
                                       </div>
                                       <div class="col-lg-12 col-md-12 col-sm-12 py-2">
                                         <input type="submit" name="generar" value="Generar archivo en Excel" class="btn btn-warning btn-sm btn-block">
                                       </div>
                                   </div>
                                 </form>
                               </div>
                               </div>
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
