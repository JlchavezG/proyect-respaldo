<?php
include 'conecta.php';
$Fecha1 = $_POST['fecha1'];
$Fecha2 = $_POST['fecha2'];
if (isset($_POST['generar'])) {
  // nombre de el archivo
  header('Content-Type: text/csv; charset-latin1');
  header('Content-Disposition: attachment; filename = "Reporte_Fecha_Asignaciones.csv"');
  // salida de el archivo
  $salida = fopen('php://output','w');
  // encabezados
  fputcsv($salida,array('Id Asignacion','Id Laptop','Id_usuario','Fecha','Numero','Usuario'));
  // consulta para el reporte
  $reporte = "SELECT * FROM Asignaciones WHERE Fecha BETWEEN '$Fecha1' and '$Fecha2' ORDER BY Id_Asignacion";
  $respuesta = $conecta->query($reporte);
  while($filaR = $respuesta->fetch_assoc()){
    fputcsv($salida, array($filaR['Id_asignacion'],$filaR['Id_Laptop'],$filaR['Id_Usuario'],$filaR['Fecha'],$filaR['Numero'],$filaR['User_Reg']));
  }
}

 ?>
