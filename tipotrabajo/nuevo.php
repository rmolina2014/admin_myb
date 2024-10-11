<?
require_once 'tipotrabajo.php';
$objecto = new tipotrabajo();
if( isset($_POST['nombre']) && !empty($_POST['nombre']) )
 {
  $nombre= $_POST['nombre'];
  $todobien = $objecto->nuevo($nombre);
  if($todobien){
      echo "se Registro en la BD";
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
else
{
 ?>
 <div class="container">
 <div class="row">
 <div class="col-md-12">
  <form role="form" method="POST" action="nuevo.php">
  <div class="col-md-8">
    <label >Nombre del Trabajo</label>
    <input name="nombre"  class="form-control" type="text" tabindex="1" autofocus required />
  </div>
  <div class="col-md-8">
  <hr>
      <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" onclick="location.href='listado.php';"><i class="fa fa-times"></i> Cancelar</button>
      <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i> Guardar</button>
  </div>
</form>
</div>
</div>
</div>
 <?
 }
 ?>
