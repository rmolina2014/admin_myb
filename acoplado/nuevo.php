<?

require_once 'acoplado.php';

$objecto = new acoplado();

if( isset($_POST['patente']) && !empty($_POST['patente']) )
 {
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

  $fechacompra= $_POST['fechacompra'];

  $todobien = $objecto->nuevo($fechacompra,$marca,$modelo,$fabricacion,$patente,
             $registroautomotor,$provincia,$aseguradora,$vencseguro,$vencreviciontecnica,
             $observaciones,$vencruta,
             $activo);    

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

 <div class="col-md-8">

  <h4>Agregar Acoplado</h4>
  <form role="form" method="POST" action="nuevo.php">
  
   <div class="col-md-8">

    <label >Marca</label>

    <input name="marca"  class="form-control" type="text" tabindex="3" required />

  </div>



   <div class="col-md-8">

    <label >Modelo</label>

    <input name="modelo"  class="form-control" type="text" tabindex="4" required />

  </div>



   <div class="col-md-8">

    <label >Patente </label>

    <input name="patente"  class="form-control" type="text" tabindex="4" required />

  </div>

 

  <div class="col-md-8">

    <label >Provincia</label>

    <input name="provincia"  class="form-control" type="text" tabindex="4" required />

  </div>

  <div class="col-md-8">

    <label >Fecha Compra</label>

    <input name="fechacompra"  class="form-control" type="date" tabindex="4" required />

  </div>

  <div class="col-md-8">

    <label >Aseguradora</label>

    <input name="Aseguradora"  class="form-control" type="text" tabindex="4" required />

  </div>

  <div class="col-md-8">

    <label >Vence Seguro </label>

    <input name="vencseguro"  class="form-control" type="date" tabindex="4" required />

  </div>

  <div class="col-md-8">

    <label >Vence Revición Técnica </label>

    <input name="vencreviciontecnica"  class="form-control" type="date" tabindex="4" required />

  </div>



  <div class="col-md-8">

    <label >Vence Ruta </label>

    <input name="vencruta"  class="form-control" type="date" tabindex="4" required />

  </div>



  <div class="col-md-8">

    <label >Observaciones </label>

    <input name="observaciones"  class="form-control" type="text" tabindex="4" required />

  </div>



  <div class="col-md-8">
    <label >Activo </label>
    <select name="activo" class="form-control" tabindex="13" >
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

 }

 ?>

