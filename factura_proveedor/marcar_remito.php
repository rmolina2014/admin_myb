<?
//15042017 marcar los remitos que estan cancelados con una factura
require_once 'factura_proveedor.php';
if( isset($_POST['id_remito']) && !empty($_POST['id_remito']) )
{
	$id_factura = $_POST['id_factura'];
    $id_remito = $_POST['id_remito'];
	$objecto = new factura_proveedor();
	$todobien = $objecto->marcar($id_remito,$id_factura);
	if($todobien){
			$mensaje = 'Se elimino un registro ...';
		} else {
			$mensaje = 'Lo sentimos, no se pudo eliminar ...';
		}
	echo $mensaje;
}
?>

