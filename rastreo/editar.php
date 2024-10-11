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
 <h4>Editar Usuario</h4> 
 <form class="form-horizontal" role="form" method="POST" action="editar.php">
 <input type="hidden" name="id" value="<?echo $item['id']; ?>" />

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
    <label for="exampleInputEmail1" >Password</label>
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
}//fin del while
}// fin del if
if( isset($_POST['idUsuario']) && !empty($_POST['idUsuario']) )
 {
  $id=$_POST['idUsuario'];
  $usuario= $_POST['usuario'];
  $email= $_POST['email'];
  $nombre= $_POST['nombre'];
  $sucursal=$_POST['sucursal'];
  $todobien = $objecto->editar($id,$usuario,$nombre,$email,$sucursal);
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
