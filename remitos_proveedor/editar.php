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
 
 if(isset($_GET['id']) && !empty($_GET['id']))
 {
  $id=$_GET['id'];
  $objecto = new remitosproveedor();
  $registros=$objecto->obtenerId($id);
  while( $item = mysqli_fetch_array($registros))
  {
  ?>

 <div class="container">

 <div class="row">

 <div class="col-md-12">

 <h4>Editar Remito Proveedor</h4>

 <form class="form-horizontal" role="form" method="POST" action="editar.php">

 <input type="hidden" name="id" value="<?echo $item['id']; ?>" />

   
  <div class="col-md-8">
    <label >Número</label>
    <input type="text" id="numero" name="numero" class="form-control" tabindex="1" value="<?echo $item['numero']; ?>" />
    
  </div>

   <div class="col-md-8">
    <label >Proveedor</label>
    <input type="text" id="proveedor_nombre" name="proveedor_nombre" placeholder="Ingresar nombre Proveedor" onkeyup="autocomplet()" class="form-control" tabindex="2" value="<?echo $item['nombre']; ?>" />
    <ul id="listacliente"></ul>
    <input type="hidden" id="proveedor_id" name="proveedor_id" />
  </div>

  <div class="col-md-8">
    <label >Detalle</label>
    <input type="text" id="detalle" name="detalle" placeholder="Detalles" class="form-control" tabindex="3" required value="<?echo $item['detalle']; ?>" />
  </div>

   <div class="col-md-8">
    <label for="exampleInputEmail1">Fecha</label>
     <input name="fecha"  class="form-control" type="date" tabindex="4" required value="<?echo $item['fecha']; ?>"  />
  </div>

   <div class="col-md-8">
    <label for="exampleInputEmail1" >Monto</label>
    <input name="monto" class="form-control" type="text" tabindex="5" required value="<?echo $item['monto']; ?>" />
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

if( isset($_POST['idCamion']) && !empty($_POST['idCamion']) )
{
 $proveedor_id= $_POST['proveedor_id'];
  $numero= $_POST['numero'];
  $detalle= $_POST['detalle'];
  $fecha= $_POST['fecha'];
  $monto= $_POST['monto'];
  $estado= 'Iniciado';
 
  $todobien = $objecto->editar($idCamion,$marca,$modelo,$patente,$provincia,
        $aseguradora,$vencseguro,$vencrevisiontecnica,
        $observaciones,$vencruta,$activo);

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

 