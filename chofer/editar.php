<?php
require_once 'chofer.php';
$objecto = new chofer();
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
 <h4>Editar Chofer</h4>

 <form class="form-horizontal" role="form" method="POST" action="editar.php">
 <input type="hidden" name="idchofer" value="<?echo $item['id']; ?>" />

   <div class="col-md-8">
    <label >Nombre </label>
    <input name="nombre"  class="form-control" type="text" tabindex="1" required value="<?echo utf8_encode($item['nombre']); ?>"/>
  </div>

   <div class="col-md-8">
    <label >Carnet </label>
    <input name="carnet"  class="form-control" type="text" tabindex="2" value="<?echo utf8_encode($item['carnet']); ?>"/>
  </div>

   <div class="col-md-8">
    <label >Vence Carnet </label>
    <input name="vencecarnet"  class="form-control" type="text" tabindex="3" value="<?echo utf8_encode($item['vencecarnet']); ?>"/>
  </div>

   <div class="col-md-8">
    <label >Dni </label>
    <input name="dni"  class="form-control" type="text" tabindex="4" value="<?echo utf8_encode($item['dni']); ?>"/>
    </div>

   <div class="col-md-8">
    <label >Domicilio </label>
    <input name="domicilio"  class="form-control" type="text" tabindex="5" value="<?echo utf8_encode($item['domicilio']); ?>"/>
  </div>

   <div class="col-md-8">
    <label >Localidad </label>
    <input name="localidad"  class="form-control" type="text" tabindex="6" value="<?echo utf8_encode($item['localidad']); ?>"/>
  </div>

   <div class="col-md-8">
    <label >Provincia </label>
    <input name="provincia"  class="form-control" type="text" tabindex="7" value="<?echo utf8_encode($item['provincia']); ?>"/>
  </div>

    <div class="col-md-8">
    <label >Telèfonos </label>
    <input name="telefonos"  class="form-control" type="text" tabindex="8" value="<?echo utf8_encode($item['telefonos']); ?>"/>
  </div>

    <div class="col-md-8">
    <label >E-mail </label>
    <input name="email"  class="form-control" type="text" tabindex="9" value="<?echo utf8_encode($item['email']); ?>"/>
  </div>

    <div class="col-md-8">
    <label >Art </label>
    <input name="art"  class="form-control" type="text" tabindex="10" value="<?echo utf8_encode($item['<art']); ?>"/>
  </div>

  <div class="col-md-8">
    <label >Polizart </label>
    <input name="polizart"  class="form-control" type="text" tabindex="11" value="<?echo utf8_encode($item['polizart']); ?>"/>
  </div>  
  <div class="col-md-8">
    <label >Observaciones </label>
    <input name="observaciones"  class="form-control" type="text" tabindex="12" value="<?echo utf8_encode($item['observaciones']); ?>"/>
  </div>
  <div class="col-md-8">
    <label >Visacionanual </label>
    <input name="visacionanual"  class="form-control" type="text" tabindex="13" value="<?echo utf8_encode($item['visacionanual']); ?>"/>
  </div>

  <div class="col-md-8">
    <label >Categoria Carnet </label>
    <input name="categoriacarnet"   class="form-control" type="text" tabindex="14" value="<?echo utf8_encode($item['categoriacarnet']); ?>"/>
  </div>

  <div class="col-md-8">
    <label >MI Vencimiento </label>
    <input name="MIVencimiento"  class="form-control" type="text" tabindex="15" value="<?echo utf8_encode($item['MIVencimiento']); ?>"/>
  </div>

    <div class="col-md-8">
    <label >MI Categoría </label>
    <input name="MICategoria"  class="form-control" type="text" tabindex="16" value="<?echo utf8_encode($item['MICategoria']); ?>"/>
  </div>

    <div class="col-md-8">
    <label >Curso Induccion </label>
    <input name="cursoinduccion"  class="form-control" type="text" tabindex="17" value="<?echo utf8_encode($item['cursoinduccion']); ?>"/>
  </div>

    <div class="col-md-8">
    <label >CNRT Vencimiento </label>
    <input name="CNRTVencimiento"  class="form-control" type="text" tabindex="18" value="<?echo utf8_encode($item['CNRTVencimiento']); ?>"/>
  </div>

    <div class="col-md-8">
    <label >CNRT Categoría </label>
    <input name="CNRTCategoria"  class="form-control" type="text" tabindex="19" value="<?echo utf8_encode($item['CNRTCategoria']); ?>"/>
  </div>

   <div class="col-md-8">
    <label >Activo</label>
    <input name="Activo"  class="form-control" type="text" tabindex="20" value="<?echo utf8_encode($item['Activo']); ?>"/>
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
if( isset($_POST['idchofer']) && !empty($_POST['idchofer']) )
 {
  $idchofer =$_POST['idchofer']; 
  $nombre= $_POST['nombre'];
  $carnet= $_POST['carnet'];
  $vencecarnet= $_POST['vencecarnet'];
  $dni= $_POST['dni'];
  $domicilio= $_POST['domicilio'];
  $localidad= $_POST['localidad'];
  $provincia= $_POST['provincia'];
  $telefonos= $_POST['telefonos'];
  $email= $_POST['email'];
  $art= $_POST['art'];
  $polizart= $_POST['polizart'];
  $observaciones= $_POST['observaciones'];
  $visacionanual= $_POST['visacionanual'];
  $categoriacarnet= $_POST['categoriacarnet'];
  $MIVencimiento= $_POST['MIVencimiento'];
  $MICategoria= $_POST['MICategoria'];
  $cursoinduccion= $_POST['cursoinduccion'];
  $CNRTVencimiento= $_POST['CNRTVencimiento'];
  $CNRTCategoria= $_POST['CNRTCategoria'];
  $Activo= $_POST['Activo'];
 
  $todobien = $objecto->editar($idchofer,$nombre,$carnet,$vencecarnet,$dni,$domicilio,$localidad,$provincia,$telefonos,$email,$art,$polizart,$observaciones,$visacionanual,$categoriacarnet,$MIVencimiento,$MICategoria,$cursoinduccion,$CNRTVencimiento,$CNRTCategoria,$Activo);
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
   