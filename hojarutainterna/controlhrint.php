<?php
 session_name("sesion_prest");
 session_start();
 if (isset($_SESSION['sesion_usuario']))
 {
   $ID= $_SESSION['sesion_id'];
   $nombre=$_SESSION['sesion_usuario'];
   $sucursal=$_SESSION['sesion_sucursal'];
   $permiso=$_SESSION['sesion_permisos'];
 }else { header ("Location: ../index.php"); }

require_once 'hojarutainterna.php';
require_once '../remito/remito.php';
include '../cabecera.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
  <h4>Control de Hoja de Ruta Interna</h4>
  <div class="col-md-12">
   <?
     $objecto = new hojarutainterna();
     $usuarios = $objecto->cabecerahr($idhr);
     while( $item = mysqli_fetch_array($usuarios))
     {
     ?>
      <div class="row">
        <label> Numero : <?echo $numeroHRI=$item['numero'];?> </label>
        <label> Fecha : <?echo $item['fecha'];?> </label><br>
        <label> Chofer : <?echo $item['nombrechofer'];?> </label>
        <label> Patente Camion : <?echo $item['patentecamion'];?> </label><br>
      </div>
       
      <?}?>

     </div>

<h4>Detalle</h4>

<div class="col-md-12">

 <!-- Listado de remitos -->

 <table id="listado" class="table" >

      <thead>

              <tr>

     <th>Control</th>

              <th>Fecha</th>

              <th>Nº guia</th>

              <TH>Destinatario </TH>

              <TH>Proveedor </TH>

              <TH>Bultos</TH>

              <th>Descripción</th>

              <th>Nº Sur Exp.</th>

               <th>Importe</th>

     

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

                 <option value="En Reparto">En Reparto</option>

                 <option value="Entregado">Entregado</option>
                 
                 <option value="Pendiente">Pendiente</option>

               </select>

              </td>

              <td><?php echo cambiaf_mysql($item['fecha']);?></td>
              <td><?php echo $item['numeroremito'];?></td>
              <td><?php echo $item['nombrecliente'];?></td>
              <td><?php echo $item['nombreproveedor'];?></td>
             <td><?php echo $item['bultos'];?></td>
            <td><?php echo $item['descripcion'];?></td>
             <td><?php echo $item['remitose'];?></td>
             <td><?php echo $item['importe'];?></td>
          </tr>

          <?

           }

          ?>

          </tbody>

         </table>

        <!--fin listado remitos-->

</div>

 <!--fin listado remitos-->

 <hr>

<div>

 <a href="cambiarestadoHRI.php?id=<? echo $numeroHRI;?>&estado=Terminado" class="btn btn-primary btn-sm">Guardar hoja de Ruta Terminada</a>
</div>


<script type="text/javascript">
 $(document).ready(function()
  {
    $("select[id^='control']").change(function()
       {
        vid = this.id.substr(7,6);
        vestado=$(this).val();
        $.ajax({
          type: "POST",
          cache: false,
          async: false,
          url: 'cambiar_estado_remito.php',
          data: { id: vid, estado: vestado},
          success: function(data){
            if (data)
            {
             alert(data);
            }
        }
        })//fin
      });//fin cambiar estado
 });
</script>
</div>
</div>
</div>
</div>
<?}?>
