<?php
require_once 'stock.php';
$objecto = new stock();
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
 <h4>Editar Registro</h4>
 <form class="form-horizontal" role="form" method="POST" action="editar.php">
  <input type="hidden" name="idstock" value="<?echo $item['id']; ?>" />

 <div class="col-md-8">
    <label >Cliente</label>
    <input type="text" id="cliente" name="cliente" value="<?echo utf8_encode($item['cliente_id']); ?>" tabindex="1" autofocus required>
    <ul id="listacliente"></ul>
    <input type="hidden" id="idcliente" name="idcliente" />
  </div>

   <div class="col-md-8">
    <label >Descripcion</label>
    <input name="descripcion"  class="form-control" type="text" value="<?echo utf8_encode($item['descripcion']); ?>" tabindex="4" required />
  </div>

   <div class="col-md-8">
    <label >Comprobante de Ingreso </label>
    <input name="comIngreso"  class="form-control" type="text" value="<?echo utf8_encode($item['comIngreso']); ?>" tabindex="4" required />
  </div>

  <div class="col-md-8">
    <label >Comprobante de Egreso </label>
    <input name="comIngreso"  class="form-control" type="text" value="<?echo utf8_encode($item['comEgreso']); ?>" tabindex="4" required />
  </div>

  <div class="col-md-8">
    <label >Fecha Ingreso</label>
    <input name="fechaingreso"  class="form-control" type="date" value="<?echo utf8_encode($item['fechaingreso']); ?>" tabindex="4" required />
  </div>

  <div class="col-md-8">
    <label >Fecha Salida</label>
    <input name="fechasalida"  class="form-control" type="date" value="<?echo utf8_encode($item['fechaEgreso']); ?>" tabindex="4" required />
  </div>

  <div class="col-md-8">
    <label >Estado </label>
    <input name="estado"  class="form-control" type="text" value="<?echo utf8_encode($item['estado']); ?>" tabindex="4" required />
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

if( isset($_POST['idstock']) && !empty($_POST['idstock']) )
 {

  $idstock=$_POST['idstock'];
  $cliente_id= $_POST['cliente_id'];
  $comIngreso= $_POST['comIngreso'];
  $comEgreso= $_POST['comEgreso'];
  $descripcion= $_POST['descripcion'];
  $fechaingreso= $_POST['fechaingreso'];
  $fechasalida= $_POST['fechasalida'];
  $estado= $_POST['estado'];

  $todobien = $objecto->editar($id,$cliente_id,$comIngreso,$comEgreso,$descripcion,$fechaIngreso,$fechaSalida,$estado);

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