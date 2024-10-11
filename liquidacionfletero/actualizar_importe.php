<?php
require_once 'liquidacionfletero.php';
if( isset($_POST['id']) && !empty($_POST['id']) )
{
  $objeto = new liquidacionfletero();
  $id= $_POST['id'];
  $importe= $_POST['importe'];
  $listado = $objeto->actualizar_importe($id,$importe);
  if ($listado)
  {
  	echo "Actualizado";
  } else echo "No se Pudo actualizar Detalle HRI ".$id;

}

?>