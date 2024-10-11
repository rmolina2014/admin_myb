<?php
require_once '../conexion.php';
if( isset($_POST['hr']) && !empty($_POST['remito']) )
{
  $idinterna=$_POST['hr'];
  $idremito=$_POST['remito'];
  $remitose=$_POST['remitose'];
  
  $importe=(isset($_POST["importe"]) && !empty($_POST["importe"])) ? $_POST["importe"] : 0;
  
  $importefletero=0;//$_POST['importefletero'];
 
  $sql="INSERT INTO `detalleinterna`
            (`idinterna`,
             `idremito`,
              `remitose`,
             `importe`,
             `importefletero`)
VALUES ('$idinterna',
        '$idremito',
        '$remitose',
        '$importe',
         '$importefletero')";
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