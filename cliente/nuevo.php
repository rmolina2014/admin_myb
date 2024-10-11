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
//require_once 'remito.php';
 include '../cabecera.php';
 require_once '../conexion.php';
 
require_once 'cliente.php';

$objecto = new cliente();

if( isset($_POST['nombrefantasia']) && !empty($_POST['nombrefantasia']) )
 {
  $nombrefantasia= $_POST['nombrefantasia'];
  $nombrereal= $_POST['nombrereal'];
  $responsable= $_POST['responsable'];
  $situacioniva= $_POST['situacioniva'];
  $cuit= $_POST['cuit'];
  $email= $_POST['email'];
  $observaciones= $_POST['observaciones'];

  $domicilio= $_POST['domicilio'];

  $localidad= $_POST['localidad'];

  $zona= $_POST['zona'];

  $numerobrutos= $_POST['numerobrutos'];

  $origen= $sucursal;
  

  $todobien = $objecto->nuevo($nombrefantasia,$nombrereal,$responsable,$situacioniva,$cuit,$numerobrutos,$email,$observaciones,$domicilio,$localidad,$zona,$origen);

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

  <h4>Agregar Cliente</h4>

  <form role="form" method="POST" action="nuevo.php">



   <div class="col-md-8">

    <label >CUIT</label>

    <input name="cuit" id="cuit" class="form-control" type="text" tabindex="4" required autofocus />

    <div id="Info"></div>

  </div>



  <div class="col-md-8">

    <label >Nombre de Fantasia</label>

    <input name="nombrefantasia"  class="form-control" type="text" tabindex="1"  required />

  </div>

  <div class="col-md-8">
    <label >Nombre Real</label>
    <input name="nombrereal"  class="form-control" type="text" tabindex="2" required />
  </div>

  <div class="col-md-8">
    <label >Responsable</label>
    <input name="responsable"  class="form-control" type="text" tabindex="3"  />
  </div>


 <div class="col-md-8">

  <label >Situacion IVA</label>

  <select class="form-control" name="situacioniva">

      <option value="RESP.INSCRIPTO">Seleccionar.....</option>

    <option value="RESP.INSCRIPTO">RESP.INSCRIPTO</option>

    <option value="MONOTRIBUTO">MONOTRIBUTO</option>

    <option value="CONSUMIDOR FINAL">CONSUMIDOR FINAL</option>

    <option value="EXENTO">EXENTO</option>

  </select>

</div>



  



<div class="col-md-8">

    <label >Nº Ingresos Brutos</label>

    <input name="numerobrutos"  class="form-control" type="text" tabindex="4"  />

  </div>



  <div class="col-md-8">

    <label >E-mail</label>

    <input name="email"  class="form-control" type="text" tabindex="4"  />

  </div>



  <div class="col-md-8">

    <label >Observaciones</label>

    <input name="observaciones"  class="form-control" type="text" tabindex="4" />

  </div>



 <div class="col-md-8">

    <label >Domicilio</label>

    <input name="domicilio"  class="form-control" type="text" tabindex="4"  />

  </div>



   <div class="col-md-8">

    <label >Localidad</label>

    <input name="localidad"  class="form-control" type="text" tabindex="4" />

  </div>



   <div class="col-md-8">

    <label >Zona</label>

    <input name="zona"  class="form-control" type="text" tabindex="4" />

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

 <!-- /. ROW  -->

 <footer><p> Admin -2015 </p></footer>

 </div><!-- /. PAGE INNER  -->

 </div><!-- /. PAGE WRAPPER  -->

 </div> <!-- /. WRAPPER  -->

  <script src="../js/jquery-1.10.2.js"></script>

  <script src="../js/bootstrap.min.js" type="text/javascript"></script>

  <script src="../js/jquery.maskedinput.js" type="text/javascript"></script>

  <script type="text/javascript">

 $(document).ready(function()

  {

    $("#cuit").mask("99-99999999-9");



    //validar que el cuit no este repetido

     $("#cuit").blur(function(){

        $('#Info').html('<img src="loader.gif" alt="" />').fadeOut(1000);

        var cuit = $(this).val();        

        var dataString = 'cuit='+cuit;

        $.ajax({

            type: "POST",

            url: "validarCuit.php",

            data: dataString,

            success: function(data) {
               // alert(data);
                if (data > 0) {
                   alert("CUIT Repetido.");
                $('#Info').fadeIn(6000).html('<div class="alert alert-danger">CUIT ya existente. </div>');
                window.location="listado.php";
                }
               

            }

        });

    });           

   

 });

</script>

</body>

</html>

