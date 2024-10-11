<?php
 //------------------
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
 require_once 'rastreo.php';
 include '../cabecera.html';
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
$objecto = new rastreo();
if( isset($_POST['idcliente']) && !empty($_POST['idcliente']) )
 {
  $idcliente= $_POST['idcliente'];
  $password= $_POST['password'];
  $nombreusuario= $_POST['nombreusuario'];
  $fecha=date('Y-m-d');
  $todobien = $objecto->nuevo($idcliente,$nombreusuario,$password,$fecha);
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
 <div class="container-fluid">
 <div class="row">
 <div class="col-md-12">
 <h3>Rastreo</h3>
 <hr>
 <div class="container">
 <div class="row">
 <div class="col-md-12">
 <h4>Agregar Cliente para Rastreo</h4>
 <form role="form" method="POST" action="nuevo.php">

  <div class="col-md-8">
    <label >Cliente</label>
    <input type="text" id="cliente" name="cliente" placeholder="Ingresar nombre Cliente" onkeyup="autocomplet()" class="form-control" tabindex="1" autofocus required>
    <ul id="listacliente"></ul>
    <input type="hidden" id="idcliente" name="idcliente" />
  </div>

    <div class="col-md-8">
    <label for="exampleInputEmail1" >Nombre de Usuario</label>
    <input name="nombreusuario"  class="form-control" type="text" tabindex="2" required />
  </div>

   <div class="col-md-8">
    <label for="exampleInputEmail1" >Contraseña</label>
    <input name="password"  class="form-control" type="text" tabindex="3" required />
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
    $("#numero").mask("9999-999999");
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
