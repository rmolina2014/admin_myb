<?php
require_once 'cliente.php';
$objecto = new cliente();
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
 <h4>Editar Cliente</h4>
 <form class="form-horizontal" role="form" method="POST" action="editar.php">
 <input type="hidden" name="idremito" value="<?echo $item['id']; ?>" />


   <div class="col-md-8">
     <label >Nombre de Fantasia</label>
     <input name="nombrefantasia" class="form-control" type="text" tabindex="1" VALUE='<? echo $item['nombrefantasia']?>' required />
   </div>

    <div class="col-md-8">
     <label >Nombre Real</label>
     <input name="nombrereal"  class="form-control" type="text" tabindex="2"  VALUE='<? echo $item['nombrereal']?>' required />
   </div>

    <div class="col-md-8">
     <label >Responsable</label>
     <input name="responsable"  class="form-control" type="text" tabindex="3"  VALUE='<? echo $item['responsable']?>' required />
   </div>

   <div class="col-md-8">
     <label >Situacion IVA</label>
     <select class="form-control" name="situacioniva">
      <option value="<? echo $item['situacioniva']?>"><? echo $item['situacioniva']?></option>
      <option value="RESP.INSCRIPTO">RESP.INSCRIPTO</option>
      <option value="MONOTRIBUTO">MONOTRIBUTO</option>
      <option value="CONSUMIDOR FINAL">CONSUMIDOR FINAL</option>
      <option value="EXENTO">EXENTO</option>
    </select>
  </div>
    

    <div class="col-md-8">
     <label >CUIT</label>
     <input name="cuit"  class="form-control" type="text" tabindex="4"  VALUE='<? echo $item['cuit']?>' required />
   </div>

 <div class="col-md-8">
     <label >Nº Ing. Brutos</label>
     <input name="numerobrutos"  class="form-control" type="text" tabindex="5"  VALUE='<? echo $item['numerobrutos'];?>' required />
   </div>

   <div class="col-md-8">
     <label >E-mail</label>
     <input name="email"  class="form-control" type="text" tabindex="6"  VALUE='<? echo $item['email']?>' required />
   </div>

   <div class="col-md-8">
     <label >Observaciones</label>
     <input name="observaciones"  class="form-control" type="text" tabindex="7"  VALUE='<? echo $item['observaciones']?>' required />
   </div>

  <div class="col-md-8">
     <label >Domicilio</label>
     <input name="domicilio"  class="form-control" type="text" tabindex="8"  VALUE='<? echo $item['domicilio']?>' required />
   </div>

    <div class="col-md-8">
     <label >Localidad</label>
     <input name="localidad"  class="form-control" type="text" tabindex="9"  VALUE='<? echo $item['localidad']?>' required />
   </div>

    <div class="col-md-8">
     <label >Zona</label>
     <input name="zona"  class="form-control" type="text" tabindex="10"  VALUE='<? echo $item['zona']?>' required />
   </div>


  <div class="col-md-12">
  <div class="modal-footer clearfix">
      <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" onclick="location.href='listado.php';"><i class="fa fa-times"></i> Cancelar</button>
      <button type="submit" class="btn btn-primary "><i class="fa fa-floppy-o"></i> Guardar</button>
  </div>
</div>
</form>
</div>
</div>
</div>
<?
}//fin del while
}// fin del if
if( isset($_POST['idremito']) && !empty($_POST['idremito']) )
 {
  $nombrefantasia= $_POST['nombrefantasia'];
  $nombrereal= $_POST['nombrereal'];
  $responsable= $_POST['responsable'];
  $activo= $_POST['activo'];
  $situacioniva= $_POST['situacioniva'];
  $cuit= $_POST['cuit'];
  $email= $_POST['email'];
  $observaciones= $_POST['observaciones'];
  $domicilio= $_POST['domicilio'];
  $localidad= $_POST['localidad'];
  $zona= $_POST['zona'];
  $id=$_POST['idremito'];
   $numerobrutos=$_POST['numerobrutos'];

  $todobien = $objecto->editar($id,$nombrefantasia,$nombrereal,$responsable,$situacioniva,$cuit,
        $numerobrutos,$email,$observaciones,$domicilio,$localidad,$zona);
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
<script src="../js/jquery-1.10.2.js"></script>
 <script src="../js/bootstrap.min.js" type="text/javascript"></script>
 <script src="../js/jquery.maskedinput.js" type="text/javascript"></script>
 <script type="text/javascript">
$(document).ready(function()
 {
   $("#cuit").mask("99-99999999-9");

});
</script>