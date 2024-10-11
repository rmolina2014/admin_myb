<?php
require_once '../conexion.php';
if( isset($_GET['hr']) && !empty($_GET['remito']) )
 {
  $idinterna= $_GET['hr'];
  $idremito=$_GET['remito'];
  $remitose=$_GET['remitose'];
  $importe=$_GET['importe'];
  $sql="INSERT INTO `detalleinterna`
            (`idinterna`,
             `idremito`,
              `remitose`,
             `importe`)
VALUES ('$idinterna',
        '$idremito',
        '$remitose',
        '$importe')";
       $registro = consulta_mysql($sql);
       /*actualizar estado remito*/
  $sql="UPDATE `remito`
          SET  `estado` = 'Reparto'
          WHERE `id` = '$idremito'; ";
  $registro = consulta_mysql($sql);
  header ("Location: dethrinterna.php?id=".$idinterna);
  exit;
 }
 ?>

