<?
require_once 'chofer.php';
$objecto = new chofer();
if( isset($_POST['nombre']) && !empty($_POST['nombre']) )
 {
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
  $todobien = $objecto->nuevo($nombre,$carnet,$vencecarnet,$dni,$domicilio,$localidad,$provincia,$telefonos,$email,$art,$polizart,$observaciones,$visacionanual,$categoriacarnet,$MIVencimiento,$MICategoria,$cursoinduccion,$CNRTVencimiento,$CNRTCategoria,$Activo);

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
  <h4>Agregar Chofer</h4>
  <form role="form" method="POST" action="nuevo.php">
  <div class="col-md-8">
    <label >Nombre </label>
    <input name="nombre"  class="form-control" type="text" tabindex="1" autofocus required />
  </div>

   <div class="col-md-8">
    <label >Carnet </label>
    <input name="carnet"  class="form-control" type="text" tabindex="2"  />
  </div>

   <div class="col-md-8">
    <label >Vence Carnet </label>
    <input name="vencecarnet"  class="form-control" type="text" tabindex="3"  />
  </div>

   <div class="col-md-8">
    <label >Dni </label>
    <input name="dni"  class="form-control" type="text" tabindex="4" />
  </div>

   <div class="col-md-8">
    <label >Domicilio </label>
    <input name="domicilio"  class="form-control" type="text" tabindex="5" />
  </div>

   <div class="col-md-8">
    <label >Localidad </label>
    <input name="localidad"  class="form-control" type="text" tabindex="6" />
  </div>

   <div class="col-md-8">
    <label >Provincia </label>
    <input name="provincia"  class="form-control" type="text" tabindex="7" />
  </div>

    <div class="col-md-8">
    <label >Teléfonos </label>
    <input name="telefonos" class="form-control" type="text" tabindex="8"  />
  </div>

    <div class="col-md-8">
    <label >E-mail </label>
    <input name="email"  class="form-control" type="text" tabindex="9" />
  </div>

    <div class="col-md-8">
    <label >ART </label>
    <input name="art"  class="form-control" type="text" tabindex="10"  />
  </div>

    <div class="col-md-8">
    <label >Poliza ART </label>
    <input name="polizart"  class="form-control" type="text" tabindex="11" />
  </div>

    <div class="col-md-8">
    <label >Observaciones </label>
    <input name="observaciones"  class="form-control" type="text" tabindex="12"  />
  </div>

    <div class="col-md-8">
    <label >Visacion Anual </label>
    <input name="visacionanual"  class="form-control" type="text" tabindex="13" />
  </div>

    <div class="col-md-8">
    <label >Categoria Carnet </label>
    <input name="categoriacarnet"  class="form-control" type="text" tabindex="14" />
  </div>

    <div class="col-md-8">
    <label >MI Vencimiento </label>
    <input name="MIVencimiento"  class="form-control" type="text" tabindex="15" />
  </div>

    <div class="col-md-8">
    <label >MI Categoria </label>
    <input name="MICategoria"  class="form-control" type="text" tabindex="16" />
  </div>

    <div class="col-md-8">
    <label >Curso Induccion </label>
    <input name="cursoinduccion"  class="form-control" type="text" tabindex="17" />
  </div>

    <div class="col-md-8">
    <label >CNRT Vencimiento </label>
    <input name="CNRTVencimiento"  class="form-control" type="text" tabindex="18" />
  </div>

    <div class="col-md-8">
    <label >CNRT Categoría </label>
    <input name="CNRTCategoria"  class="form-control" type="text" tabindex="19"  />
  </div>

   <div class="col-md-8">
    <label >Activo</label>
    <input name="Activo"  class="form-control" type="text" tabindex="20"  />
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
