<?php

require_once 'acoplado.php';

$objecto = new acoplado();

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

 <h4>Editar Acoplado</h4>

 <form class="form-horizontal" role="form" method="POST" action="editar.php">

 <input type="hidden" name="idAcoplado" value="<?echo $item['id']; ?>" />

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
    <input name="patente"  class="form-control" type="text" tabindex="4" required value="<?echo utf8_encode($item['patente']); ?>"/>
  </div>

  <div class="col-md-8">
    <label >Provincia</label>
    <input name="provincia"  class="form-control" type="text" tabindex="4"  value="<?echo utf8_encode($item['provincia']); ?>"/>
  </div>

 <div class="col-md-8">
    <label >Fecha Compra </label>
    <input name="fechacompra"  class="form-control" type="date"  value="<?echo utf8_encode($item['fechacompra']); ?>"/>
  </div>
  <div class="col-md-8">
    <label >Aseguradora</label>
    <input name="aseguradora"  class="form-control" type="text" value="<?echo utf8_encode($item['aseguradora']); ?>"/>
  </div>

  <div class="col-md-8">
    <label >Vence Seguro </label>
    <input name="vencseguro"  class="form-control" type="date" value="<?echo utf8_encode($item['vencseguro']); ?>"/>

  </div>

  <div class="col-md-8">
    <label >Vence Reviciòn Tècnica </label>
    <input name="vencreviciontecnica"  class="form-control" type="date"  value="<?echo utf8_encode($item['vencreviciontecnica']); ?>"/>
  </div>

 <div class="col-md-8">
    <label >Vence Ruta </label>
    <input name="vencruta"  class="form-control" type="date"  value="<?echo utf8_encode($item['vencruta']); ?>"/>
  </div>

  <div class="col-md-8">
    <label >Observaciones </label>
    <input name="observaciones"  class="form-control" type="text"  value="<?echo utf8_encode($item['observaciones']); ?>"/>
  </div>


<div class="col-md-8">
    <label >Activo </label>
    <select name="activo" class="form-control" tabindex="13" >
       <option value="<? echo utf8_encode($item['activo']); ?>">
       <? echo utf8_encode($item['activo']); ?>
         
       </option>
      <option value="SI">SI</option>
      <option value="NO">NO</option>
    </select>
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
  $marca= $_POST['marca'];
  $modelo= $_POST['modelo'];
  $patente= $_POST['patente'];
  $provincia= $_POST['provincia'];
  $aseguradora= $_POST['aseguradora'];
  $vencseguro= $_POST['vencseguro'];
  $vencreviciontecnica= $_POST['vencreviciontecnica'];
  $observaciones= $_POST['observaciones'];
  $vencruta= $_POST['vencruta'];
  $activo= $_POST['activo'];
  $fecharuta= $_POST['fecharuta'];
$fechacompra= $_POST['fechacompra'];
  $todobien = $objecto->editar($idAcoplado,$fechacompra,$marca,$modelo,$fabricacion,$patente,
             $registroautomotor,$provincia,$aseguradora,$vencseguro,$vencreviciontecnica,
             $observaciones,$vencruta,
             $activo);

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

   