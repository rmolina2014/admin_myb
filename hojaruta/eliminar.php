<?
session_name("sesion_prest");
session_start();
if (isset($_SESSION['sesion_usuario']))
 {
  $ID= $_SESSION['sesion_id'];
   $nombre=$_SESSION['sesion_usuario'];
   $sucursal=$_SESSION['sesion_sucursal'];
   $permiso=$_SESSION['sesion_permisos'];
 } else { header ("Location: ../index.php"); }

require_once '../conexion.php';
require_once 'hojaruta.php';
if( isset($_POST['id']) && !empty($_POST['id']) )
{
  $idhr = $_POST['id'];
  $objecto = new hojaruta();
  //antes de eliminar debe cambiar el stado a los remitos
  $sql="SELECT * FROM detallehr where idhojaruta=".$idhr;
  $listado = consulta_mysql($sql);
  while( $item = mysqli_fetch_array($listado))
  {
     $idremito=$item['idremito'];
     $estado="Desposito Origen ".$sucursal;
     $sql="UPDATE `remito`
           SET
            `estado` = '$estado'
             WHERE `id` = '$idremito' ";
     consulta_mysql($sql);
     // eliminar detalle de hr
     $sql="DELETE FROM detallehr WHERE id =".$item['id'];
     consulta_mysql($sql);
   }//finwhile
    
	$todobien = $objecto->eliminar($idhr);
	if($todobien)
    {
			$mensaje = 'Se elimino un registro ...';
		} else {
			$mensaje = 'Lo sentimos, no se pudo eliminar ...';
		}
	echo $mensaje;
	}
?>
