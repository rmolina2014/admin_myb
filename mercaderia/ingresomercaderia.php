<?
require_once 'mercaderia.php';
$objeto = new mercaderia();
if( isset($_POST['almacen_id']) && !empty($_POST['almacen_id']) )
 {
  $cliente_id= $_POST['cliente_id'];
  $tipomercaderia= $_POST['tipomercaderia'];
  $cantidad= $_POST['cantidad'];
  $almacen_id= $_POST['almacen_id'];
  $espacio= $_POST['espacio'];
  $unidad=$_POST['unidad'];
  $fechaingreso=$_POST['fechaingreso'];
  $fechasalida=$_POST['fechasalida'];
  $estado= $_POST['estado'];
  

   /* validar el espacio disponible*/
   
   if ($objeto->validarEspacio($almacen_id,$espacio) == 0) {
        echo 'No hay Espacio Disponible';
          echo "<script language=Javascript> location.href=\"listado.php\"; </script>";
        exit();
      }   
    
   /*fin validar */


  $todobien = $objeto->nuevo($cliente_id,$tipomercaderia,$cantidad,$almacen_id,$espacio,$unidad,$fechaingreso,$fechasalida,$estado);

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

  <form role="form" method="POST" action="ingresomercaderia.php">
   
     <div class="col-md-8">
      <label >Cliente</label>
      <input type="text" id="cliente" name="cliente" placeholder="Ingresar nombre Cliente" onkeyup="autocomplet()" class="form-control" tabindex="1" autofocus required>
      <ul id="listacliente"></ul>
      <input type="hidden" id="cliente_id" name="cliente_id" />
    </div>

   <div class="col-md-8">
    <label> Tipo de Mercaderia </label>
      <select name="tipomercaderia" class="form-control">
       <option value="Cajas">Cajas</option>
       <option value="Bultos">Bultos</option>
       <option value="Otros">Otros</option>
      </select>
   </div>

   <div class="col-md-8">
    <label>Cantidad</label>
    <input name="cantidad"  class="form-control" type="text" tabindex="4" required />
   </div>

   <div class="col-md-8">
    <label>Almacen </label>
    <select name="almacen_id" class="form-control">
       <option value="1">Plano</option>
       <option value="2">Estanteria</option>
     </select>
   </div>

  <div class="col-md-8">
    <label>Espacio</label>
    <input name="espacio"  class="form-control" type="text" tabindex="4" required />
  </div>

  <div class="col-md-8">
    <label>Unidad</label>
     <select name="unidad" class="form-control">
       <option value="m2">m2</option>
       <option value="m3">m3</option>
     </select>
   </div>

  <div class="col-md-8">
    <label >Fecha Ingreso </label>
    <input name="fechaingreso"  class="form-control" type="date" tabindex="4" required />
  </div>

  <div class="col-md-8">
    <label>Fecha Salida </label>
    <input name="fechasalida"  class="form-control" type="date" tabindex="4" required />
  </div>

  <div class="col-md-8">
    <label>Estado </label>
     <select name="estado" class="form-control">
       <option value="Ingreso">Ingreso</option>
       <option value="Salida">Salida</option>
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

     //validar que el cuit no este repetido
     $("#espacio").blur(function(){
        $('#Info').html('<img src="loader.gif" alt="" />').fadeOut(1000);
        var espacio = $(this).val();        
        var dataString = 'numero='+numero;
        $.ajax({
            type: "POST",
            url: "validarNumeroRemito.php",
            data: dataString,
            success: function(data) {
                 //alert(data);
                $('#Info').fadeIn(1000).html(data);
            }
        });
    });       


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

   $('#cliente_id').val(item);

  // hide proposition list

  $('#listacliente').hide();

}




</script>
