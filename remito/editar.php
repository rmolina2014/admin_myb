<?php
require_once 'usuario.php';
$objecto = new usuario();
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
 <form class="form-horizontal" role="form" method="POST" action="editar.php">
 <input type="hidden" name="idUsuario" value="<?echo $item['id']; ?>" />

  <div class="col-md-8">
    <label >Nombre Real</label>
    <input name="nombre"  class="form-control" type="text" tabindex="1" value="<?echo utf8_encode($item['nombre']); ?>" />
  </div>

    <div class="col-md-8">
    <label for="exampleInputEmail1" >Nombre de Usuario</label>
    <input name="usuario"  class="form-control" type="text" tabindex="2" value="<?echo utf8_encode($item['usuario']); ?>"  />
  </div>

   <!--div class="col-md-8">
    <label for="exampleInputEmail1" >Password</label>
    <input name="password"  class="form-control" type="text" tabindex="3" value="<?echo utf8_encode($item['password']); ?>" />
  </div-->

   <div class="col-md-8">
    <label for="exampleInputEmail1" >Email</label>
    <input name="email"  class="form-control" type="text" tabindex="4" value="<?echo utf8_encode($item['email']); ?>" />
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
if( isset($_POST['idUsuario']) && !empty($_POST['idUsuario']) )
 {
  $id=$_POST['idUsuario']; 
  $usuario= $_POST['usuario']; 
  $email= $_POST['email'];
  $password= $_POST['password'];
  $nombre= $_POST['nombre'];
  $todobien = $objecto->editar($id,$usuario,$password,$nombre,$email);
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
   