<?php
require_once 'rendicion.php';
$objecto = new rendicion();
if( isset($_POST['descripcion']) && !empty($_POST['descripcion']) )
 {
  $viaje_id= $_POST['viaje_id'];
  $descripcion= $_POST['descripcion'];
  $numero= $_POST['numero'];
  $banco= $_POST['banco'];
  $importe= $_POST['importe'];
  
  $idViaje = $objecto->insertarACuenta($descripcion,
        $numero,$banco,$importe,$viaje_id);
    echo "<script language=Javascript> location.href=\"detalleRendicion.php?id=".$viaje_id."\"; </script>";
  //header('Location: detalleRendicion.php?id='.$viaje_id);
  exit;
}
else echo "error";
?>
