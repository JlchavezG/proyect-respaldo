<?php
// consulta para contar las notificaciones
$contar = "SELECT * FROM notificaciones WHERE Estado = 0";
$ejecuta = $conecta->query($contar);
$count = $ejecuta->num_rows;
// consulta para extraer las notificaciones
$sql = "SELECT * FROM notificaciones  ORDER BY Id_notificacion DESC limit 5";
$result = $conecta->query($sql);
$response='';
 ?>
<!-- inicia navbar -->
<link rel="stylesheet" href="../css/bootstrap-datepicker.css">
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
          <span class="icon-user-1"></span> <?php echo $usuario; ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="perfil.php">Perfil</a>
          <a class="dropdown-item" href="#">Configuración</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#cerrars">Cerrar Sesión</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="icon-bell-alt"></span><span class="badge badge-danger" onclick="vernotifica()"><?php echo $count; ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
           <?php while($row = $result->fetch_array()) {
                $fecha = $row['Fecha'];
                $Fecha = date('d-m-Y');
                $fecha = $Fecha;
             ?>
                 <a href="Notificaciones.php" class="nav-link"><p class="text-muted text-center"><?php echo $row['Titulo']; ?></p></a>
                 <div class="dropdown-divider"></div>
           <?php } ?>
        </div>
      </li>
    </ul>
  </div>
</nav>
<!-- termina navbar -->
