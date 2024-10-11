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

 require_once 'rendicion.php';
 include '../cabecera.php';
 ?>

 <div class="container-fluid">
   <div class="row" >
   <div class="col-md-4">
   <h3>Consulta de Rendiciones por Chofer</h3>
     
   <select name="idchofer" id="idchofer" class="form-control" required>
    <option value="" >Seleccionar...</option>
    <?  
     $sql="SELECT id, nombre FROM chofer order by nombre ASC";
     $listado = consulta_mysql($sql);
     while( $item = mysqli_fetch_array($listado))
     {
     ?>
      <option value="<?echo $item['id'];?>"> <?echo $item['nombre'];?> </option>
      <?
    } 
    ?>
    </select> 
    <hr>
   </div>
   </div>

<div class="row" id="tabla">

</div>
</div>

 <script src="../js/jquery-1.10.2.js"></script>
 <script src="../js/bootstrap.min.js" type="text/javascript"></script>
 <script type="text/javascript">
 $(document).ready(function()
  {
     $('#idchofer').change(function(){
        $('#tabla').empty();
        var vid=$(this).val();
        $.ajax({
                url: 'c_RendicionChofer.php',
                data: { id:vid },
                success: function(data) {
                          $('#tabla').append(data);
                      }
                  });
        });
 });
</script>
</body>
</html>
