<?php
require_once 'rendicion.php';
$objecto = new rendicion();
if( isset($_POST['id']) && !empty($_POST['id']) ) {
	$id = $_POST['id'];
	
	$todobien = $objecto->eliminarGV($id);
	if($todobien){
			$mensaje = 'Se elimino un registro ...';
		} else {
			$mensaje = 'Lo sentimos, no se pudo eliminar ...';
		}
	echo $mensaje;
	}
?>

