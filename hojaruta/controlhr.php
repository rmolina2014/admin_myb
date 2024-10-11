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
require_once 'hojaruta.php';
require_once '../remito/remito.php';
include '../cabecera.php';

function cambiaf_mysql($fechadb){
    list($yy,$mm,$dd)=explode("-",$fechadb);
    $fecha = new DateTime();
    $fecha->setDate($yy, $mm, $dd);
    echo $fecha->format('d-m-Y');
}

if( isset($_GET['id']) && !empty($_GET['id']) )
{
  $idhr= $_GET['id'];
?>
 <div class="container">
 <div class="row">
  <h4>Control de Hoja de Ruta</h4>
  <div class="col-md-12">
   <?
     $objecto = new hojaruta();
     $usuarios = $objecto->cabecerahr($idhr);
     while( $item = mysqli_fetch_array($usuarios))
     {
     ?>
        <div class="row">
         <label> Número : <?echo $numeroHR=$item['numero'];?> </label><br>
         <div class="col-md-4">
          <label> Chofer : <?echo $item['nombrechofer'];?> </label><br>

        </div>
        <div class="col-md-4">
         <label> Patente Camion : <?echo $item['patentecamion'];?> </label><br>

        </div>
        <div class="col-md-4">
          <label> Fecha : <?echo cambiaf_mysql($item['fecha']) ;?> </label><br>
          <label> Destino : <?echo $sucursal;?> </label><br>
        </div>
      <?}?>
     </div>
     <h3>Control Detalle</h3>
<div class="col-md-12">
 <!-- Listado de remitos -->
 <table id="listado" class="table" >
      <thead>
             <tr>
              <th>Control</th>
              <th>Fecha</th>
              <th>Nº</th>
              <TH>Cliente </TH>
              <TH>Proveedor </TH>
              <TH>Bultos</TH>
              <th>Descripción</th>
              <th></th>
             </tr>
       <thead>
       <tbody>
        <?
          $usuarios = $objecto->listaremito($idhr);
          while( $item = mysqli_fetch_array($usuarios))
          {
         ?>
           <tr>
              <td>
               <select id="control<?php echo $item['remitoid'];?>" name="control">
                <option value='En Transito'>En Transito </option>
                <option value='En Deposito Destino'>En Deposito Destino</option>
               </select>
              </td>
              <td><?php echo cambiaf_mysql($item['fecha']);?></td>
              <td><?php echo $item['numeroremito'];?></td>
              <td><?php echo $item['nombrecliente'];?></td>
              <td><?php echo $item['nombreproveedor'];?></td>
              <td><?php echo $item['bultos'];?></td>
             <td><?php echo $item['descripcion'];?></td>
          </tr>
          <?
           }
          ?>
          </tbody>
         </table>
        <!--fin listado remitos-->
       <hr>
       <h4>Total Declarado : <?
       $totalvalordeclarado = $objecto->valordeclarado($idhr);

                        echo '$ '.number_format($totalvalordeclarado,2,",", ".");;
       ?></h4>
        <div>
         <a href="cambiarestadoHR.php?id=<? echo $numeroHR;?>&estado=Terminada" class="btn btn-primary btn-sm">Guardar</a>
        </div>
 <!--fin listado remitos-->
<script src="../js/jquery-1.10.2.js"></script>
<script src="../js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">
 $(document).ready(function()
  {
    //cambiar estado select
    $("select[id^='control']").change(function()
       {
        vid = this.id.substr(7,6);
        vestado=$(this).val();
        $.ajax({
          type: "POST",
          cache: false,
          async: false,
          url: 'cambiarestadoremito.php',
          data: { id: vid, estado: vestado},
          success: function(data){
          if (data)
            {
             alert(data);
            }
        }
        })//fin

    });//fin
 });
</script>
</div>
</div>
</div>
</div>
<?}?>
