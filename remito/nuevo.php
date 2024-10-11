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
 require_once 'remito.php';
 include '../cabecera.php'; // antes cabecera.html
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

<?php
$objecto = new remito();
if( isset($_POST['idcliente']) && !empty($_POST['idcliente']) )
 {
  $idcliente= $_POST['idcliente'];
  $idproveedor= $_POST['idproveedor'];
  $valordeclarado= $_POST['valordeclarado'];
  $tipocomprobante= $_POST['tipocomprobante'];
  $contrareembolso=$_POST['contrareembolso'];
  $numero= $_POST['numero'];
  $fecha= $_POST['fecha'];
  $bultos= $_POST['bultos'];
  $descripcion= $_POST['descripcion'];
  $estado='Deposito Origen '.$sucursal;
  $origen=$sucursal;
  $marca='Activo';
  $fechaestado=date('Y-m-d');
  $fechaingreso=date('Y-m-d');
  $fechaMarca='0000-00-00';
  $peso= $_POST['peso'];
  $volumen= $_POST['volumen'];

  $todobien = $objecto->nuevo($valordeclarado,$tipocomprobante,$contrareembolso,$idcliente,$idproveedor,$numero,$fecha, $bultos,$peso,$volumen,$descripcion,$estado,$fechaestado,$fechaingreso,$marca,$fechaMarca,$origen);

  if($todobien) {
  //echo "<script language=Javascript> alert('Se Grabo en la Base de Datos.') </script>";
  //echo "<script language=Javascript> location.reload(); </script>";
  //antes echo "<script language=Javascript> location.href=\"nuevo.php\"; </script>";
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
       exit;
    }
}
else
{
?>
 <div class="container-fluid">
 <div class="row">
 <div class="col-md-12">
 <h3>Remito</h3>
     <hr>
     <div class="container">
 <div class="row">
 <div class="col-md-12">
 <h4>Agregar Remito</h4>
  <!--form role="form" method="POST" action="nuevo.php" autocomplete="off"-->
 <form method="post" id="formdata" autocomplete="off">
 <div class="col-md-8">
    <label >Número</label>
    <input type="text" id="numero" name="numero" class="form-control" tabindex="1" autofocus required/>
     <div id="Info"></div>
  </div>

  <div class="col-md-8">
    <label >Cliente</label>
    <input type="text" id="cliente" name="cliente" placeholder="Ingresar nombre Cliente" onkeyup="autocomplet()" class="form-control" tabindex="1" autofocus required>
    <ul id="listacliente"></ul>
    <input type="hidden" id="idcliente" name="idcliente" />
  </div>

  <div class="col-md-8">
    <label >Proveedor</label>
    <input type="text" id="proveedor" name="proveedor" placeholder="Ingresar nombre Proveedor" onkeyup="autocomplet2()" class="form-control" tabindex="2" required>
    <ul id="listaproveedor"></ul>
    <input type="hidden" id="idproveedor" name="idproveedor"/>
  </div>

  <div class="col-md-8">
    <label for="exampleInputEmail1">Valor Declarado</label>
    <input name="valordeclarado" class="form-control" type="number" step="0.01" tabindex="3" placeholder="ej: 15000.50" required />
  </div>

  <div class="col-md-8">
    <label for="exampleInputEmail1" >Tipo Comprobante</label>
    <select name="tipocomprobante" class="form-control" id="tipocomprobante" tabindex="4" required>

     <option value="Factura">Factura</option>
         <option value="Remito">Remito</option>
    </select>
  </div>

 <div class="col-md-8">
    <label for="exampleInputEmail1" >Fecha</label>
    <input name="fecha"  class="form-control" type="date" tabindex="5" required />
  </div>

  <div class="col-md-8">
    <label for="exampleInputEmail1" >Contrareembolso</label>
    <input name="contrareembolso"  class="form-control" type="text" tabindex="6" />
  </div>

</div>

<div class="col-md-12">

  
  <div class="col-md-4">
    <label for="exampleInputEmail1" >Bultos</label>
    <input name="bultos"  class="form-control" type="text" tabindex="7" />
  </div>

  <div class="col-md-2">
    <label for="exampleInputEmail1" >Peso (Kg)</label>
    <input name="peso"  class="form-control" type="text" tabindex="8" required />
  </div>

  <div class="col-md-2">
    <label for="exampleInputEmail1" >Volumen (m3)</label>
    <input name="volumen"  class="form-control" type="text" tabindex="9" required />
  </div>

  <div class="col-md-8">
    <label for="exampleInputEmail1" >Descripcion</label>
    <input name="descripcion"  class="form-control" type="text" tabindex="10"  />
  </div>

  <div class="col-md-8">
  <hr>
      <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" onclick="location.href='listado.php';"><i class="fa fa-times"></i> Cancelar</button>
      <!--button type="submit" id="botonguardar" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i> Guardar</button-->

      <button id="botonenviar" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i> Guardar</button>

 <div id="exito" style="display:none">
            Sus datos han sido recibidos con éxito.
        </div>
        <div id="fracaso" style="display:none">
            Se ha producido un error durante el envío de datos.
        </div>

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

    //validar el formulario antes de enviar
    $("#botonenviar").click( function() { 
      event.preventDefault();
        // Con esto establecemos la acción por defecto de nuestro botón de enviar.
        if(validaForm())
        {  
            // Primero validará el formulario.
            $.post("nuevo.php",$("#formdata").serialize(),function(res)
            {
               //alert(res);
               alert("Los Datos Fueron Guardados."); 
               location.reload();
            });


        }
    });  
    

    $("#proveedor446546546").blur(function(){
      var value=$.trim($("#idproveedor").val());
        if(value.length>0)
            {
                
                $("#botonguardar").attr('disabled', true);
            } else{
                alert('Volver a elegir el Proveedor.');
                $("#botonguardar").attr('disabled', false);
            }
     });
  
  
    $("#numero").mask("9999-99999999");
    //validar que el cuit no este repetido
     $("#numero").blur(function(){
        $('#Info').html('<img src="loader.gif" alt="" />').fadeOut(1000);
        var numero = $(this).val();        
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
  });// fin jquery

 function validaForm(){
    // Campos de texto
    if($("#idcliente").val() == ""){
        alert("Volver a seleccionar el Cliente.");
        $("#cliente").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#idproveedor").val() == ""){
        alert("Volver a seleccionar el Proveedor.");
        $("#idproveedor").focus();
        return false;
    }/*
    if($("#direccion").val() == ""){
        alert("El campo Dirección no puede estar vacío.");
        $("#direccion").focus();
        return false;
    }

    // Checkbox
    if(!$("#mayor").is(":checked")){
        alert("Debe confirmar que es mayor de 18 años.");
        return false;
    }
   */
    return true; // Si todo está correcto
}

  function autocomplet()
  {
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

 function autocomplet2(){
  var min_length = 0; // min caracters to display the autocomplete
  var keyword = $('#proveedor').val();
  if (keyword.length >= min_length) {
    $.ajax({
      url: 'ajax_refresh_proveedor.php',
      type: 'POST',
      data: {keyword:keyword},
      success:function(data){
        $('#listaproveedor').show();
        $('#listaproveedor').html(data);
      }
    });

  } else {
    $('#listaproveedor').hide();
  }

}

function set_proveedor(item,nombre) {
  // change input value
  $('#proveedor').val(nombre);
  $('#idproveedor').val(item);
  // hide proposition list
  $('#listaproveedor').hide();
}
</script>
