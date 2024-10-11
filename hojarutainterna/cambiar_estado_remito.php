<?php
require_once '../conexion.php';
if( isset($_POST['id']) && !empty($_POST['id']) )
 {
  $idremito=$_POST['id'];
  $estado=$_POST['estado'];
  $fechaestado=date('Y-m-d');
    /*actualizar estado remito*/
  $sql="UPDATE `remito`
          SET  `estado` = '$estado',
               `fechaestado` ='$fechaestado'
          WHERE `id` = '$idremito'"; 
  $registro = consulta_mysql($sql);
  if ($registro)
  {
    echo "Se cambio Estado";
    exit();
  }else {
           echo 'error no guarda';
           exit();
        }
  }else { echo 'sin id';}
  exit;
?>