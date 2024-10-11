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
  $idhr=$_GET['id'];
  
?>
 <div class="container">
 <div class="row">
  <h4>Hoja de Ruta</h4>
  <div class="col-md-12">
   <?
     $objecto = new hojaruta();
     $usuarios = $objecto->cabecerahr($idhr);
     while( $item = mysqli_fetch_array($usuarios))
     {
     ?>
      <div class="row">
         <label> Numero : <?echo $numeroHR=$item['numero'];?> </label><br>
        <div class="col-md-4">
       <label> Chofer : <?echo $item['nombrechofer'];?> </label><br>
       <label> Carnet : <?echo $item['carnetchofer'];?> </label><br>
       </div>
        <div class="col-md-4">
        <label> Patente Camion : <?echo $item['patentecamion'];?> </label><br>
        <label> Patente Acoplado : <?echo $item['patenteacoplado'];?> </label><br>
        </div>
        <div class="col-md-4">
          <label> Fecha : <?echo cambiaf_mysql($item['fecha']) ;?> </label><br>
          <label> Destino : <?echo $item['provincia'];?> </label><br>
        </div>
      <?}?>
     </div>
<h3>Detalle</h3>
<div class="col-md-12">
<!-- Listado de remitos -->
<table id="listado" class="table" >
      <thead>
             <tr>
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
              <td><?php echo cambiaf_mysql($item['fecha']);?></td>
              <td><?php echo $item['numeroremito'];?></td>
              <td><?php echo $item['nombrecliente'];?></td>
              <td><?php echo $item['nombreproveedor'];?></td>
              <td><?php echo $item['bultos'];?></td>
             <td><?php echo $item['descripcion'];?></td>
             <!--td> x </td-->
          </tr>
          <?
           }
          ?>
          </tbody>
         </table>
<div>
  <a href="imprimir.php?idhr=<? echo $idhr; ?>" class="btn btn-primary btn-sm"> Imprimir</a>
</div>

</div>
</div>
</div>
</div>
</div>
</div>
<?}?>
