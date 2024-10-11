<?
 session_name("sesion_prest");
 session_start();
 if (isset($_SESSION['sesion_usuario']))
 {
   $ID= $_SESSION['sesion_id'];
   $nombre=$_SESSION['sesion_usuario'];
   $sucursal=$_SESSION['sesion_sucursal'];
   $permiso=$_SESSION['sesion_permisos'];
 }
 require_once '../conexion.php';
 //idhr: vidhr, idremito:vidremito },
 if( isset($_POST['idhr']) && !empty($_POST['idhr']) )
 {
	$idhr = $_POST['idhr'];
	$idremito = $_POST['idremito'];
	$sql="DELETE FROM `detallehr` WHERE idremito='$idremito' and idhojaruta='$idhr'";
  $resultado = consulta_mysql($sql);
  /* 17092015 se deberia agregar una campo en la base de datos para la sucursal de origen y de destino*/
  $estado='Deposito Origen'.$sucursal;
  $sql="UPDATE `remito` SET `estado` = '$estado' WHERE `id` = '$idremito'";
  $resultado = consulta_mysql($sql);
  if ($resultado) {
     	echo 'Se cancelo un Remito.';
     	exit;
     }
     else{
         echo 'Faltan datos.';
         exit;
     } 
 
 }
?>
