<?php
require_once 'tipotrabajo.php';
$objecto = new tipotrabajo();
if(isset($_POST['id']) && !empty($_POST['id']))
 {
  $id= (int)$_POST['id'];
  $registros=$objecto->obtenerId($id);
  while( $item = mysqli_fetch_array($registros))
  {
 ?>

 <div class="container">

 <div class="row">

 <div class="col-md-12">

 <form class="form-horizontal" role="form" method="POST" action="editar.php">

 <input type="hidden" name="idtipogasto" value="<?echo $item['id']; ?>" />

  <div class="col-md-8">
    <label >Nombre del trabajo</label>
    <input name="descripcion"  class="form-control" type="text" tabindex="1" value="<?echo utf8_encode($item['nombre']); ?>" />
  </div>


  <div class="col-md-12">
  <div class="modal-footer clearfix">
      <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" onclick="location.href='listado.php';"><i class="fa fa-times"></i> Cancelar</button>
      <button type="submit" class="btn btn-primary "><i class="fa fa-floppy-o"></i> Guardar</button>
  </div>
</div>
</form>     
</div>
</div>
</div>
<?
}//fin del while

}// fin del if
if( isset($_POST['idtipogasto']) && !empty($_POST['idtipogasto']) )
 {
  $id=$_POST['idtipogasto']; 
  $descripcion= $_POST['descripcion']; 

  $todobien = $objecto->editar($id,$descripcion);

  if($todobien){

      echo "<script language=Javascript> location.href=\"listado.php\"; </script>"; 

      //header('Location: listado.php');

      exit;
    } 
    else {
    ?>      
         <div class="alert alert-block alert-error fade in" style="max-width: 220px; margin: 0px auto 20px;">
         <button data-dismiss="alert" class="close" type="button">×</button>
         Lo sentimos, no se pudo guardar ...
         </div> 
    <?
    }  
    }
?>
 