<?php
require_once 'rendicion.php';
$objecto = new rendicion();
if( isset($_POST['viaje_id']) && !empty($_POST['viaje_id']) )
 {
  $viaje_id= $_POST['viaje_id'];
  $fecha= $_POST['fecha'];
  $nombre= $_POST['nombre'];
  $numerocomprobante= $_POST['numerocomprobante'];
  $litros= $_POST['litros'];
  $importe= $_POST['importe'];
   $cuentacorriente= $_POST['cuentacorriente'];
  $id_viaje = $objecto->insertarGastosComb($fecha,$nombre,$numerocomprobante,$litros,$importe,$cuentacorriente,$viaje_id);

echo "<script language=Javascript> location.href=\"controlRendicion.php?idviaje=".$viaje_id."\"; </script>";
  //header('Location: controlRendicion.php?idviaje='.$viaje_id);
  exit;
}
else echo "error";
?>
