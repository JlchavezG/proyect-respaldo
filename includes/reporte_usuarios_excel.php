<?php
include 'conecta.php';
$Fecha1 = $_POST['fecha1'];
$Fecha2 = $_POST['fecha2'];
if (isset($_POST['generar'])) {
  // nombre de el archivo
  header('Content-Type: text/csv; charset-latin1');
  header('Content-Disposition: attachment; filename = "Reporte_Fecha_Usuarios.csv"');
  // salida de el archivo
  $salida = fopen('php://output','w');
  // encabezados
  fputcsv($salida,array('Nombre','Apellido Paterno','Apellido Materno','Nivel','Telefono','Email','Usuario',));
  // consulta para el reporte
  $reporte = "SELECT * FROM Usuarios WHERE Fecha BETWEEN '$Fecha1' and '$Fecha2' ORDER BY Id_Usuario";
  $respuesta = $conecta->query($reporte);
  while($filaR = $respuesta->fetch_assoc()){
    fputcsv($salida, array($filaR['Nombre'],$filaR['ApellidoP'],$filaR['ApellidoM'],$filaR['Id_Nivel'],$filaR['Telefono'],$filaR['Email'],$filaR['Usuario']));
  }
}

 ?>
