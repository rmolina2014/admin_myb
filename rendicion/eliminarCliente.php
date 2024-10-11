<?php
require_once 'rendicion.php';
$objecto = new rendicion();
if( isset($_POST['viajecliente_id']) && !empty($_POST['viajecliente_id']) ) {
	$viajecliente_id = $_POST['viajecliente_id'];
	$viaje_id=$_POST['viaje_id'];
	$todobien = $objecto->eliminarCliente($viajecliente_id,$viaje_id);
	if($todobien){
			$mensaje = 'Se elimino un registro ...';
		} else {
			$mensaje = 'Lo sentimos, no se pudo eliminar ...';
		}
	echo $mensaje;
	}
?>

