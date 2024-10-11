<?
require_once 'stock.php';
$objecto = new stock();
if( isset($_POST['idcliente']) && !empty($_POST['idcliente']) )
 { 
  $cliente_id= $_POST['idcliente'];
  $comIngreso= $_POST['comIngreso'];
  $comEgreso= $_POST['comEgreso'];
  $descripcion= $_POST['descripcion'];
  $fechaingreso= $_POST['fechaingreso'];
  $fechasalida= $_POST['fechasalida'];
  $estado= $_POST['estado'];

  $todobien = $objecto->nuevo($cliente_id,$comIngreso,$comEgreso,$descripcion,$fechaingreso,$fechasalida,$estado);

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
<style type="text/css">
  .input_container {
  height: 30px;
  float: left;
}
.input_container input {
  height: 20px;
  width: 200px;
  padding: 3px;
  border: 1px solid #cccccc;
  border-radius: 0;
}

.input_container ul {
  width: 206px;
  border: 1px solid #eaeaea;
  position: absolute;
  z-index: 9;
  background: #f3f3f3;
  list-style: none;
}

.input_container ul li {
  padding: 2px;
}

.input_container ul li:hover {
  background: #eaeaea;
}

#country_list_id {
  display: none;
}
</style>
 <div class="container">
 <div class="row">
 <div class="col-md-8">
  <h4>Agregar Registro</h4>

  <form role="form" method="POST" action="nuevo.php">
   <div class="col-md-8">
    <label >Cliente</label>
    <input type="text" id="cliente" name="cliente" placeholder="Ingresar nombre Cliente" onkeyup="autocomplet()" class="form-control" tabindex="1" autofocus required>
    <ul id="listacliente"></ul>
    <input type="hidden" id="idcliente" name="idcliente" />
  </div>

   <div class="col-md-8">
    <label >Descripcion</label>
    <input name="descripcion"  class="form-control" type="text" tabindex="4" required />
  </div>

   <div class="col-md-8">
    <label >Comprobante de Ingreso </label>
    <input name="comIngreso"  class="form-control" type="text" tabindex="4" required />
  </div>

  <div class="col-md-8">
    <label >Comprobante de Egreso </label>
    <input name="comEgreso"  class="form-control" type="text" tabindex="4" required />
  </div>

  <div class="col-md-8">
    <label >Fecha Ingreso</label>
    <input name="fechaingreso"  class="form-control" type="date" tabindex="4" required />
  </div>

  <div class="col-md-8">
    <label >Fecha Salida</label>
    <input name="fechasalida"  class="form-control" type="date" tabindex="4" required />
  </div>

  <div class="col-md-8">
    <label >Estado </label>
    <select name="estado" class="form-control" id="estado" tabindex="4" required>
      <option value="Ocupado">Ocupado</option>
     <option value="Terminado">Terminado</option>
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
 <script src="../js/jquery-1.10.2.js"></script>
 <script src="../js/bootstrap.min.js" type="text/javascript"></script>
 <script src="../js/jquery.maskedinput.js" type="text/javascript"></script>
 <script type="text/javascript">
 $(document).ready(function()
  {

        
  });

  function autocomplet(){
  var min_length = 0; // min caracters to display the autocomplete
  var keyword = $('#cliente').val();
  if (keyword.length >= min_length) {
    $.ajax({
      url: 'ajax_refresh.php',
      type: 'POST',
      data: {keyword:keyword},
      success:function(data){
        $('#listacliente').show();
        $('#listacliente').html(data);
      }
    });
  } else {
    $('#listacliente').hide();

  }

}

// set_item : this function will be executed when we select an item

function set_cliente(item,nombre) {
 // change input value
  $('#cliente').val(nombre);

   $('#idcliente').val(item);

  // hide proposition list

  $('#listacliente').hide();

}
</script>



