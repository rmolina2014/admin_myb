<?php
require_once 'rendicion.php';
$objecto = new rendicion();
if( isset($_POST['idcliente']) && !empty($_POST['idcliente']) )
 {
  $cliente_id= $_POST['idcliente'];
  $remitos= $_POST['remito'];
  $viaje_id= $_POST['viaje_id'];
  $provincia_id= $_POST['provincia_id'];
  $fecha= $_POST['fecha'];
  $idViaje = $objecto->insertarCliente($viaje_id,$cliente_id,$remitos,$provincia_id,$fecha);
  // $idhojaruta = $objecto->nuevo($fecha,$idchofer,$idcamion,$idacoplado,$iddestino,$observacion,$estado,$origen);
  echo "<script language=Javascript> location.href=\"detalleRendicion.php?id=".$viaje_id."\"; </script>";
  //header('Location: detalleRendicion.php?id='.$viaje_id);
  exit;
}
else echo "error";
?>
