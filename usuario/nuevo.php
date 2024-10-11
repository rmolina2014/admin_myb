<?
require_once 'usuario.php';
$objecto = new usuario();
if( isset($_POST['usuario']) && !empty($_POST['usuario']) )
 {
  $usuario= $_POST['usuario'];
  $email= $_POST['email'];
  $password= $_POST['password'];
  $nombre= $_POST['nombre'];
  $sucursal= $_POST['sucursal'];
  $todobien = $objecto->nuevo($usuario,$password,$nombre,$email,$sucursal);
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
 <h4>Agregar Usuario</h4>
 <form role="form" method="POST" action="nuevo.php">

  <div class="col-md-8">
    <label >Nombre Real</label>
    <input name="nombre"  class="form-control" type="text" tabindex="1" autofocus required />
  </div>

    <div class="col-md-8">
    <label for="exampleInputEmail1" >Nombre de Usuario</label>
    <input name="usuario"  class="form-control" type="text" tabindex="2" required />
  </div>

   <div class="col-md-8">
    <label for="exampleInputEmail1" >Contraseña</label>
    <input name="password"  class="form-control" type="text" tabindex="3" required />
  </div>

   <div class="col-md-8">
    <label for="exampleInputEmail1" >Email</label>
    <input name="email"  class="form-control" type="text" tabindex="4" required />
  </div>


  <div class="col-md-8">
    <label> Sucursal </label>
      <select name="sucursal" class="form-control">
     <?
     $sql="SELECT id, nombre FROM provincia";
     $listado = consulta_mysql($sql);
     while( $item = mysqli_fetch_array($listado))
     {
     ?>
      <option value="<?echo $item['nombre']?>"><?echo $item['nombre']?></option>
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
 <?
 }
 ?>
