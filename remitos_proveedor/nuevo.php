<?php
 session_name("sesion_prest");
 session_start();
 if (isset($_SESSION['sesion_usuario']))
 {
   $ID= $_SESSION['sesion_id'];
   $nombre=$_SESSION['sesion_usuario'];
   $sucursal=$_SESSION['sesion_sucursal'];
   $permiso=$_SESSION['sesion_permisos'];
 }
  else { header ("Location: ../index.php"); }
 //-----------------
 require_once 'remitosproveedor.php';
 include '../cabecera.php';
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
<?
$objecto = new remitosproveedor();
if( isset($_POST['proveedor_id']) && !empty($_POST['proveedor_id']) )
 {
 
  $proveedor_id= $_POST['proveedor_id'];
  $numero= $_POST['numero'];
  $detalle= $_POST['detalle'];
  $fecha= $_POST['fecha'];
  $monto= $_POST['monto'];
  $estado= 'Activo';
 
  
  $fechaestado=date('Y-m-d');
  
  $todobien = $objecto->nuevo($numero,$proveedor_id,$detalle,$fecha,$monto,$estado) ;

  if($todobien) {
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
     exit();
    }
}
else
{
?>
 <div class="container-fluid">
 <div class="row">
 <div class="col-md-12">
 <h3>Remito - Proveedores</h3>
  <hr>
 <div class="container">
 <div class="row">
 <div class="col-md-12">
 <h4>Agregar Remito - Proveedor</h4>
  <form role="form" method="POST" action="nuevo.php">
  
  <div class="col-md-8">
    <label >Número</label>
    <input type="text" id="numero" name="numero" class="form-control" tabindex="1" autofocus required/>
     <div id="Info"></div>
  </div>

  <div class="col-md-8">
    <label >Proveedor</label>
    <input type="text" id="proveedor_nombre" name="proveedor_nombre" placeholder="Ingresar nombre Proveedor" onkeyup="autocomplet()" class="form-control" tabindex="2">
    <ul id="listacliente"></ul>
    <input type="hidden" id="proveedor_id" name="proveedor_id" />
  </div>

  <div class="col-md-8">
    <label >Detalle</label>
    <input type="text" id="detalle" name="detalle" placeholder="Detalles" class="form-control" tabindex="3" required>
  </div>

   <div class="col-md-8">
    <label for="exampleInputEmail1">Fecha</label>
     <input name="fecha"  class="form-control" type="date" tabindex="4" required />
  </div>

   <div class="col-md-8">
    <label for="exampleInputEmail1" >Monto</label>
    <input name="monto" class="form-control" type="text" tabindex="5" required />
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
    $("#numero").mask("9999-99999999");
    //validar que el cuit no este repetido

     
  });

  //autocompletar proveedor
  function autocomplet(){
  var min_length = 0; // min caracters to display the autocomplete
  var keyword = $('#proveedor_nombre').val();
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
function set_proveedor(item,nombre) {
  // change input value
  $('#proveedor_nombre').val(nombre);
  $('#proveedor_id').val(item);
  // hide proposition list
  $('#listacliente').hide();
}

 
</script>


