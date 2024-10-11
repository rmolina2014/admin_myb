<?php
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
 if( isset($_POST['idhri']) && !empty($_POST['idhri']) )
 {
	$idhri = $_POST['idhri'];
	$idremito = $_POST['idremito'];
	$sql="DELETE FROM `detalleinterna` WHERE idremito='$idremito' and idinterna='$idhri'";
  $resultado = consulta_mysql($sql);
  /* 17092015 se deberia agregar una campo en la base de datos para la sucursal de origen y de destino*/
  $estado='En Deposito Destino';
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
 echo 'Sin Datos';
?>
