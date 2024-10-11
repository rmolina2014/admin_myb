<?
require_once 'acoplado.php';
if( isset($_POST['id']) && !empty($_POST['id']) ) {
	$id = $_POST['id'];
	$objecto = new acoplado();
	$todobien = $objecto->eliminar($id);
	if($todobien){
			$mensaje = 'Se elimino un registro ...';

		} else {
			$mensaje = 'Lo sentimos, no se pudo eliminar ...';
		}
	echo $mensaje;
	}
?>
