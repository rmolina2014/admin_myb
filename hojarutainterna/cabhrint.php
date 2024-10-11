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
require_once 'hojarutainterna.php';
include '../cabecera.php';

$objecto = new hojarutainterna();
if( isset($_POST['idchofer']) && !empty($_POST['idchofer']) )
 {
  $fecha= date('Y-m-d');
  $idchofer= $_POST['idchofer'];
  $idcamion= $_POST['idcamion'];
  $estado= "Iniciada";

  $idhrint = $objecto->nuevo($fecha,$estado,$idchofer,$idcamion);
  echo "<script language=Javascript> location.href=\"listado.php?\"; </script>";
  //echo "<script language=Javascript> location.href=\"dethr.php?\"; </script>";
  //header('Location: dethrinterna.php?id='.$idhrint);
  exit;

}
else
{
?>
 <div class="container">
 <div class="row">
 <div class="col-md-12">
  <h4>Hoja de Ruta Interna</h4>
  <form role="form" method="POST" action="cabhrint.php">

  <div class="col-md-8">
    <label> Chofer </label>
      <select name="idchofer" class="form-control">
         <option value="" >Seleccionar...</option>
     <?
     $sql="SELECT id,nombre FROM chofer";
     $listado = consulta_mysql($sql);
     while( $item = mysqli_fetch_array($listado))
     {
     ?>
      <option value="<?echo $item['id'];?>"> <?echo $item['nombre'];?> </option>
      <?
    }
    ?>
    </select>
   </div>

   <div class="col-md-8">
    <label> Camion </label>
      <select name="idcamion" class="form-control">
           <option value="" >Seleccionar...</option>
     <?
     $sql="SELECT id,patente FROM camion";
     $listado = consulta_mysql($sql);
     while( $item = mysqli_fetch_array($listado))
     {
     ?>
      <option value="<?echo $item['id']?>"><?echo $item['patente']?></option>
      <?
    }
    ?>
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
<?}?>
