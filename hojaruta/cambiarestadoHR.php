<?php
require_once 'hojaruta.php';
if( isset($_GET['id']) && !empty($_GET['id']) )
 {
  $idHR=$_GET['id'];
  $estado=$_GET['estado'];
  $objecto = new hojaruta();
  $listado = $objecto->cambiarEstado($idHR,$estado);
  if ($listado) {
     echo "<script language=Javascript> location.href=\"listado.php\"; </script>";
    exit;
  } else {
    echo 'error no guarda';
    exit;
  }

} else echo 'sin datos';
?>
