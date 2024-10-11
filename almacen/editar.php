<?php
require_once 'almacen.php';
$objecto = new almacen();
if(isset($_POST['id']) && !empty($_POST['id']))
 {
    $provincia_id= $_POST['provincia_id'];
    $tiempo= $_POST['tiempo'];
    $espacio= $_POST['espacio'];
    $fechaingreso= $_POST['fechaingreso'];
    $fechasalida= $_POST['fechasalida'];
    $estado= $_POST['estado'];
    $registros=$objecto->obtenerId($id);
    while( $item = mysqli_fetch_array($registros))
    {
 ?>

 <div class="container">

 <div class="row">

 <div class="col-md-12">

 <h4>Editar Acoplado</h4>

 <form class="form-horizontal" role="form" method="POST" action="editar.php">

 <input type="hidden" name="idAcoplado" value="<?echo $item['id']; ?>" />

  <div class="col-md-8">

    <label >Interno</label>

    <input name="interno"  class="form-control" type="text" tabindex="1" autofocus required value="<?echo utf8_encode($item['interno']); ?>"/>

  </div>

   <div class="col-md-8">
    <label >Marca</label>
    <input name="marca"  class="form-control" type="text" tabindex="3" required value="<?echo utf8_encode($item['marca']); ?>"/>
  </div>
   <div class="col-md-8">
    <label >Modelo</label>
    <input name="modelo"  class="form-control" type="text" tabindex="4" required value="<?echo utf8_encode($item['modelo']); ?>"/>
  </div>
   <div class="col-md-8">

    <label >Patente </label>

    <input name="patente "  class="form-control" type="text" tabindex="4" required value="<?echo utf8_encode($item['patente']); ?>"/>

  </div>

  <div class="col-md-8">

    <label >Provincia</label>

    <input name="provincia"  class="form-control" type="text" tabindex="4"  value="<?echo utf8_encode($item['provincia']); ?>"/>

  </div>

  <div class="col-md-8">

    <label >Aseguradora</label>

    <input name="aseguradora"  class="form-control" type="text" value="<?echo utf8_encode($item['aseguradora']); ?>"/>

  </div>

  <div class="col-md-8">

    <label >Vigenciadesde </label>

    <input name="vigenciadesde "  class="form-control" type="text" value="<?echo utf8_encode($item['vigenciadesde']); ?>"/>

  </div>

  <div class="col-md-8">

    <label >Vigenciahasta </label>

    <input name="vigenciahasta "  class="form-control" type="text"  value="<?echo utf8_encode($item['vigenciahasta']); ?>"/>

  </div>

  <div class="col-md-8">

    <label >Reviciòn Tècnica </label>

    <input name="reviciontecnica "  class="form-control" type="text"  value="<?echo utf8_encode($item['reviciontecnica']); ?>"/>

  </div>



  <div class="col-md-8">

    <label >Vence Revision </label>

    <input name="vencerevision "  class="form-control" type="text"  value="<?echo utf8_encode($item['vencerevision']); ?>"/>

  </div>



  <div class="col-md-8">

    <label >Observaciones </label>

    <input name="observaciones "  class="form-control" type="text"  value="<?echo utf8_encode($item['observaciones']); ?>"/>

  </div>



  <div class="col-md-8">

    <label >Fecha Ruta </label>

    <input name="fecharuta "  class="form-control" type="text"  value="<?echo utf8_encode($item['fecharuta']); ?>"/>

  </div>



  <div class="col-md-8">

    <label >Fecha Ruta Vence </label>

    <input name="fecharutavence "  class="form-control" type="text" value="<?echo utf8_encode($item['fecharutavence']); ?>"/>

  </div>



  <div class="col-md-8">

    <label >Activo </label>

    <input name="activo "  class="form-control" type="text" value="<?echo utf8_encode($item['activo']); ?>"/>

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
}//fin del while
}// fin del if

if( isset($_POST['idAcoplado']) && !empty($_POST['idAcoplado']) )
 {

  $idAcoplado=$_POST['idAcoplado'];

   $interno= $_POST['interno'];

  $marca= $_POST['marca'];

  $modelo= $_POST['modelo'];

  $patente= $_POST['patente'];

  $provincia= $_POST['provincia'];

  $aseguradora= $_POST['aseguradora'];

  $vigenciadesde= $_POST['vigenciadesde'];

  $vigenciahasta= $_POST['vigenciahasta'];

  $reviciontecnica= $_POST['reviciontecnica'];

  $vencerevision= $_POST['vencerevision'];

  $observaciones= $_POST['observaciones'];

  $fecharuta= $_POST['fecharuta'];

  $fecharutavence= $_POST['fecharutavence'];
  $activo= $_POST['activo'];
  $todobien = $objecto->editar($id,$interno,$marca,$modelo,$patente,$provincia,$aseguradora,$vigenciadesde,$vigenciahasta,$reviciontecnica,
      $vencerevision,$observaciones,$fecharuta,$fecharutavence,$activo);

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
