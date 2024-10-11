<?php
require_once 'rendicion.php';
$objecto = new rendicion();
if( isset($_POST['viaje_id']) && !empty($_POST['viaje_id']) )
 {
  $viaje_id= $_POST['viaje_id'];
  $fecha= $_POST['fecha'];
  $tipogasto_id= $_POST['tipogasto_id'];
  $numerocomprobante= $_POST['numerocomprobante'];
  $importe= $_POST['importe'];
  
  $idViaje = $objecto->insertarGastosVarios($fecha,$tipogasto_id,$numerocomprobante,$importe,$viaje_id);
echo "<script language=Javascript> location.href=\"controlRendicion.php?idviaje=".$viaje_id."\"; </script>";

  //header('Location: controlRendicion.php?idviaje='.$viaje_id);
  exit;
}
else echo "error";
?>
