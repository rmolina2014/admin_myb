<?php
require_once 'taller.php';
$objecto = new taller();

if( isset($_POST['patente_id']) && !empty($_POST['patente_id']) )
 {
  
  $patente_id= $_POST['patente_id'];
  
  $tipo= $_POST['tipo'];
  $fechaservicio= $_POST['fechaservicio'];
  $kmingreso= $_POST['kmingreso'];
  $tipotrabajo_id= $_POST['tipotrabajo_id'];
  $costo= $_POST['costo'];
  $lugar= $_POST['lugar'];
  $observacion= $_POST['observacion'];
  $todobien = $objecto->nuevo($patente_id,$fechaservicio,$kmingreso,$tipotrabajo_id,$costo,$lugar,$observacion,$tipo);

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
  <h4>Agregar </h4>
  <form role="form" method="POST" action="nuevo.php">
 
   <div class="col-md-4">
    <label >Camion </label>
    <select name="camion" id="camion" class="form-control" tabindex="1" >
     <option value=""> </option>
     <?  
     $sql="SELECT id,patente FROM camion";
     $listado = consulta_mysql($sql);
     while( $item = mysqli_fetch_array($listado))
     {
     ?>
      <option value="<?echo $item['patente'];?>"> <?echo $item['patente'];?> </option>
      <?
    } 
    ?>
    </select>
  </div>
  <div class="col-md-4">
    <label >Acoplado </label>
    <select name="acoplado" id="acoplado" class="form-control" tabindex="1" >
    <option value=""> </option>
     <?  
     $sql="SELECT id,patente FROM acoplado";
     $listado = consulta_mysql($sql);
     while( $item = mysqli_fetch_array($listado))
     {
     ?>
      <option value="<?echo $item['patente'];?>"> <?echo $item['patente'];?> </option>
      <?
    } 
    ?>
    </select>
  </div>

  
  <input name="tipo" id="tipo" type="hidden" value="" />

  <div class="col-md-8">
    <label >Patente</label>
    <input name="patente_id" id="patente_id" class="form-control" type="text" required />
  </div>

  <div class="col-md-8">
    <label >Fecha</label>
    <input name="fechaservicio"  class="form-control" type="date" tabindex="2" required />
  </div>

  <div class="col-md-8">
    <label >KM Ingreso </label>
    <input name="kmingreso" class="form-control" type="text" tabindex="3" required />
  </div>

  <div class="col-md-8">
    <label>Tipo Trabajo </label>
    <select name="tipotrabajo_id" class="form-control" tabindex="4" >
     <?  
     $sql="SELECT id,nombre FROM tipotrabajo";
     $listado = consulta_mysql($sql);
     while( $item = mysqli_fetch_array($listado))
     {
     ?>
      <option value="<?echo $item['id'];?>"> <?echo $item['nombre'];?> </option>
      <?
    } 
    ?>
    </select>
  </div>

  <div class="col-md-8">
    <label>Costo</label>
    <input name="costo"  class="form-control" type="text" tabindex="5"  />
  </div>

  <div class="col-md-8">
    <label>Lugar</label>
    <input name="lugar" class="form-control" type="text" tabindex="6"  />
  </div>

  <div class="col-md-8">
    <label>Observación </label>
    <input name="observacion" class="form-control" type="text" tabindex="7"  />
  </div>
 
  <div class="col-md-8">
  <hr>
      <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" onclick="location.href='listado.php';"><i class="fa fa-times"></i> Cancelar</button>
      <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i> Guardar</button>
  </div>
</form>
<?
}
?>
</div>
</div>
</div>
<script src="../js/jquery-1.10.2.js"></script>
<script src="../js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function()
  {
      $('#camion').change(function(){
        var pat=$('#camion').val();
        $('#patente_id').val(pat);
         $('#tipo').val('camion');
      
      });

      $('#acoplado').change(function(){
       var pat=$('#acoplado').val();
        $('#patente_id').val(pat);
         $('#tipo').val('acoplado');
        
      });
 });
</script>

