<?php
require_once '../conexion.php';
if( isset($_GET['hr']) && !empty($_GET['remito']) )
 {
  $idhojaruta= $_GET['hr'];
  $idremito=$_GET['remito'];
  
  $sql="INSERT INTO `detallehr`
            (`idhojaruta`,
             `idremito`)
   VALUES ('$idhojaruta','$idremito')";
  $registro = consulta_mysql($sql);
  /*actualizar estado remito*/
  $sql="UPDATE `remito`
          SET  `estado` = 'En Transito'
          WHERE `id` = '$idremito'; ";
  $registro = consulta_mysql($sql);
  header ("Location: dethr.php?id=".$idhojaruta);
  exit;
	 }
?>