<?php
 //------------------
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
 require_once 'factura_proveedor.php';
 include '../cabecera.php';

 function cambiaf_mysql($fechadb){
    list($yy,$mm,$dd)=explode("-",$fechadb);
    $fecha = new DateTime();
    $fecha->setDate($yy, $mm, $dd);
    echo $fecha->format('d-m-Y');
}

 if( isset($_GET['factura_id']) && !empty($_GET['factura_id']) )
 {
  $factura_id= $_GET['factura_id'];
 ?>
 <div class="container-fluid">
   <div class="row">
    <div class="col-md-12">
     <h3>Datos Factura</h3>
     <hr>
     
     <?
     $objecto = new factura_proveedor();
     $usuarios = $objecto->datos_factura($factura_id);
     while( $item = mysqli_fetch_array($usuarios))
     {
      $proveedor_id=$item['proveedor_id'];
     ?>
        <div class="row">
         <input type="hidden" name="id_factura" value="<? echo $factura_id;?>" >
         <div class="col-md-4">
          <h4> N° Factura : <?echo $numeroHR=$item['numero'];?> </h4>
         </div>

         <div class="col-md-4">
          <h4> Proveedor : <?echo $item['nombre'];?> </h4>
         </div>

        <div class="col-md-4">
         <h4> Monto : <?echo $item['monto'];?> </h4>
        </div>

        <div class="col-md-4">
          <h4> Fecha : <?echo cambiaf_mysql($item['fecha']) ;?> </h4>
        </div>

        <div class="col-md-4">
          <h4> Detalle : <?echo $item['detalle'];?> </h4>
        </div>

      <?}?>

     </div>

     <h3>Control Detalle</h3>
     <hr>
      <div class="col-md-12">
        <!-- Listado de remitos -->
      <table id="listado" class="table" >
      <thead>
             <tr>
              <th>Nº Remito</th>
              <TH> Detalle </TH>
              <TH> Fecha </TH>
              <TH> Monto </TH>  
              <TH> Estado</TH>  
              <th></th>
             </tr>
           <thead>
           <tbody>
          <?php
          $objecto = new factura_proveedor();
          $usuarios = $objecto->buscar_remito_proveedor($proveedor_id);
          $i=1;
          while( $item = mysqli_fetch_array($usuarios))
          {
          ?>
           <tr>
              <td><?php echo $item['numero'];?></td>
              <td><?php echo $item['detalle'];?></td>
              <td><?php echo $item['fecha'];?></td>
              <td><?php echo $item['monto'];?></td>
              <td><?php echo $item['estado'];?></td>
              <td>
                <a class="btn btn-primary btn-sm" id="marcar<?php echo $item['id'];?>" > Marcar</a>
              </td>
          </tr>
          <?php
           }
          ?>
          </tbody>
         </table>
         </div>
         </div>
</div>
</div>
<? }?>
 <!-- /. ROW  -->

 <script src="../js/jquery-1.10.2.js"></script>
 <script src="../js/bootstrap.min.js" type="text/javascript"></script>
 <script type="text/javascript">
 $(document).ready(function()
  {
     $("a[id^='marcar']").click(function(evento)
       {
        evento.preventDefault();
        var vid = this.id.substr(6,5);
        var vid_factura= <? echo $factura_id;?>;
        alert(vid_factura);
        $.ajax({
          type: "POST",
          cache: false,
          async: false,
          url: 'marcar_remito.php',
          data: { id_remito: vid, id_factura: vid_factura},
          success: function(data){
            if (data)
            {
             //$('#div_dinamico').hide();
            // $('#div_dinamico').html(data);
             alert('Se cancelo un Remito');
             location.reload(true);
            }
        }
        })//fin ajax
        });//fin


 });
</script>
</body>
</html>
