<?php
include 'conecta.php';
$Fecha1 = $_POST['fecha1'];
$Fecha2 = $_POST['fecha2'];
if (isset($_POST['generar'])) {
  // nombre de el archivo
  header('Content-Type: text/csv; charset-latin1');
  header('Content-Disposition: attachment; filename = "Reporte_Fecha_Equipos.csv"');
  // salida de el archivo
  $salida = fopen('php://output','w');
  // encabezados
  fputcsv($salida,array('Modelo','Marca','Numero de Serie','Key','Reset','Fecha','Folio','Estatus'));
  // consulta para el reporte
  $reporte = "SELECT * FROM Laptop WHERE Fecha BETWEEN '$Fecha1' and '$Fecha2' ORDER BY Id_laptop";
  $respuesta = $conecta->query($reporte);
  while($filaR = $respuesta->fetch_assoc()){
    fputcsv($salida, array($filaR['Modelo'],$filaR['Id_marca'],$filaR['Nserie'],$filaR['NKey'],$filaR['Reset'],$filaR['Fecha'],$filaR['RegAuto'],$filaR['Estatus']));
  }
}

 ?>
