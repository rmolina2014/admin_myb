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
   <h3>Consulta de Rendiciones</h3>
     
   <select name="idviaje" id="idviaje" class="form-control" required>
    <option value="" >Seleccionar...</option>
    <?  
     $sql="SELECT id FROM viaje where estado='Rendicion'";
     $listado = consulta_mysql($sql);
     while( $item = mysqli_fetch_array($listado))
     {
     ?>
      <option value="<?echo $item['id'];?>"> <?echo $item['id'];?> </option>
      <?
    } 
    ?>
    </select> 
    <hr>
   </div>
   </div>

<div class="row" id="tabla">
<div class="col-md-2">
    <ul style="list-style:none;">  
    <li>Rend. N°</li> 
    <li><hr></li>
    <li>Combustible</li> 
    <li>Contado</li> 
    <li>Cta Corriente</li> 
    <li>Total</li> 
    <li><hr></li>
    <li>Gastos Varios</li> 
    <?
     $objecto = new rendicion();
     $totalCombustible=0;
     $listadoTipoGasto = $objecto->listarTipoGastos();
     while($item = mysqli_fetch_array($listadoTipoGasto))
     {
      ?>
        <li><? echo $item['descripcion']?></li>
      <?
     }
  
    ?>
    <li>Total Gastos</li>
    <li><hr></li>
    <li>Total</li>
    </ul>
</div>
</div>
</div>
 <script src="../js/jquery-1.10.2.js"></script>
 <script src="../js/bootstrap.min.js" type="text/javascript"></script>
 <script type="text/javascript">
 $(document).ready(function()
  {
      var valor=0; 
     // llamada ajax
      $('#idviaje').change(function(){
        var vid=$(this).val();
        valor++;
        if (valor<10) {

           $.ajax({
                      url: 'consultaRendicion.php',
                      data: { id:vid },
                      success: function(data) {
                          $('#tabla').append(data);
                      }
                  });
        }
    });

 });
</script>
</body>
</html>
