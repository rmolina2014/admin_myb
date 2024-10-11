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
<style type="text/css" media="print">
@media print {
  body { font-size:10px;
         }
#noimprimir {display:none;}
#parte2 {display:none;}
}
</style>
<?

function cambiaf_mysql($fechadb){
    list($yy,$mm,$dd)=explode("-",$fechadb);
//si viniera en otro formato, adaptad el explode y el orden de las variables a lo que necesitéis
//creamos un objeto DateTime (existe desde PHP 5.2)
    $fecha = new DateTime();
//definimos la fecha pasándole las variabes antes extraídas
    $fecha->setDate($yy, $mm, $dd);
//y ahora el propio objeto nos permite definir el formato de fecha para imprimir que queramos       
    echo $fecha->format('d-m-Y');
}

if( isset($_GET['idviaje']) && !empty($_GET['idviaje']) )
{

  $idViaje= $_GET['idviaje'];
?>
 <div class="container">
 
 <div class="row">
      <?
         $objecto = new rendicion();
         $listado = $objecto->cabeceraRendicion($idViaje);
         while( $item = mysqli_fetch_array($listado))
         {
           $kmsalida=$item['kmsalida'];
           $kmllegada=$item['kmllegada'];
         ?>
       <div class="col-xs-6">
       <h4> Chofer : <?echo $item['nombrechofer'];?> </h4>
       </div>
       <div class="col-xs-6">
       <h4> Rend. N° : <? echo $idViaje;?> </h4>
       </div>
   </div>
   <hr>
   <div class="row" >
        <div class="col-xs-2">
          <label> Fecha : <?echo cambiaf_mysql($item['fecha']) ;?> </label><br>
        </div>
         <div class="col-xs-2">
          <label> Patente: <?echo $item['patente'] ;?> </label><br>
        </div>
        <div class="col-xs-2">
          <label> KM Salida : <?echo $item['kmsalida'] ;?> </label><br>
        </div>
        <div class="col-xs-2">
          <label> Flete : <?echo '$ '.$item['flete'];?> </label><br>
        </div>
         <div class="col-xs-2">
          <label> Porcentaje : <?echo $item['porcentaje'];?> </label><br>
        </div>
        <div class="col-xs-2">
          <label> Comision : <?echo '$ '.$item['comision'];
                   $comision=$item['comision'];
         ?> </label><br>
        </div>
    </div>
   <?}?>
      <hr>
 


 <!-- Listado de clientes -->
<h4>Clientes</h4>
<div class="col-xd-12">
   <table id="listado1" class="table" >
    <thead>
             <tr>
              <th>Cliente</th>
              <th>Destino</th>
               <th>Fecha</th>
              <th>Remitos</th>

              <th></th>
             </tr>
       </thead>
       <tbody>
        <?
          $listarCliente = $objecto->listarCliente($idViaje);
          while( $item = mysqli_fetch_array($listarCliente))
          {
         ?>
           <tr>
              <td><?php echo $item['nombrereal'];?></td>
              <td><?php echo $item['provincia'];?></td>
              <td><?php echo $item['fecha'];?></td>
              <td><?php echo $item['remitos'];?></td>
             
             
          </tr>
          <?
           }
          ?>
          </tbody>
         </table>
         <hr>
 </div>
<!--div id='noimprimir'-->
 <!-- Listado de a cuenta -->
 <h5>Items a Cuenta</h5>
 <div class="col-xd-12">
  <table id="listado1" class="table table-condensed">
    <thead>
             <tr>
              <th>N°</th>
              <th>Descripción</th>
              <th>N° Cheque</th>
              <th>Banco</th>
              <th>Importe</th>
             </tr>
       <thead>
       <tbody>
        <?
          $listarCliente = $objecto->listarACuenta($idViaje);
          $i=0;
          $totalACuenta=0;
          while( $item = mysqli_fetch_array($listarCliente))
          {
            $i++;
         ?>
           <tr> 
              <td><? echo $i;?></td>
              <td><?php echo $item['descripcion'];?></td>
              <td><?php echo $item['numero'];?></td>
              <td><?php echo $item['banco'];?></td>
              <td><?php echo '$ '.$item['importe'];?></td>
          </tr>
          <?
           $totalACuenta=$totalACuenta+$item['importe'];
           }
          ?>
           <tr> 
              <td></td>
              <td></td>
              <td></td>
              <td><?php echo 'Total :';?></td>
              <td><?php echo '$ '.$totalACuenta;?></td>
          </tr>
          </tbody>
         </table>
       <hr>
 </div>

  <!-- Listado de gastos varios -->
 <h5>Gastos Varios</h5>
 <div class="col-xd-12">
   <table id="listado1" class="table table-condensed">
    <thead>
             <tr>
              <th>N°</th>
              <th>Fecha</th>
              <th>Descripción</th>
              <th>Comprobante N°</th>
              <th>Importe</th>
             </tr>
       </thead>
       <tbody>
        <? $i=0;
          $totalGV=0;
          $listar = $objecto->listarGastosVarios($idViaje);
          while( $item = mysqli_fetch_array($listar))
          {
             $i++;
         ?>
           <tr>
           <td><? echo $i;?></td>
              <td><?php echo $item['fecha'];?></td>
              <td><?php echo $item['descripcion'];?></td>
              <td><?php echo $item['comprobante'];?></td>
              <td><?php echo '$ '.$item['importe'];?></td>
             
          </tr>
          <?
           $totalGV=$totalGV+$item['importe'];
           }
          ?>
           <tr> 
              <td></td>
              <td></td>
              <td></td>
              <td><?php echo 'Total :';?></td>
              <td><?php echo '$ '.$totalGV;?></td>
          </tr>
          </tbody>
      </table>

  </div>
  <hr>
<div class="col-xd-12">
<h5>Gastos Combustible</h5>
 <table id="listado1" class="table table-condensed">
     <thead>
             <tr>
             <th>N°</th>
              <th>Fecha</th>
              <th>Nombre</th>
              <th>Comprobante N°</th>
              <th>Litros GAS OIL</th>
              <th>Importe</th>
              <th>Cuenta Corriente</th>
              </tr>
     </thead>
     <tbody>
     <?$i=0;
          $totalGC=0;
          $totallitros=0;
          $listar2 = $objecto->listarGastosComb($idViaje);
          while( $item = mysqli_fetch_array($listar2))
          {
             $i++;
         ?>
           <tr>
            <td><? echo $i;?></td>
              <td><?php echo $item['fecha'];?></td>
              <td><?php echo $item['nombre'];?></td>
              <td><?php echo $item['numerocomprobante'];?></td>
              <td><?php echo $item['litros'];?></td>
              <td><?php echo '$ '.$item['importe'];?></td>
              <td><?php echo $item['cuentacorriente'];?></td>
             
          </tr>
          <?
            if ($item['cuentacorriente'] <>'SI') {
           $totalGC=$totalGC+$item['importe'];
           }
           $totallitros=$totallitros+$item['litros'];
           }
          ?>
           <tr> 
              <td></td>
              <td></td>
             <td></td>
              <td><?php echo 'Total :';?></td>
              <td><?php echo $totallitros;?></td>
              <td><?php echo '$ '.$totalGC;?></td>
               <td></td>
          </tr>
          </tbody>
         </table>
</div> 

<div class="col-xd-12">
<table class="table table-condensed">
<thead>
  <tr>
  <th>Total Gastos</th>
  <th>Excedente</th>
  <th>Total Km Llegada</th>
  <th>Total Km</th>
  <th>Consumo Estimado (Km Recorridos/Litros Gas Oil)</th>
  </tr>
  </thead>
  <tbody>
  <tr>
    <td><? echo '$ '.$tg=($totalGV +$totalGC);?></td>
    <td><? echo '$ '.$ex=(($comision+$totalACuenta)-$tg);?></td>
    <td><? echo $kmllegada;?></td>
    <td><? echo $totalKM=($kmllegada-$kmsalida)?></td>
    <td><? if ($totallitros > 0 )
            {
              $estimado=($totalKM / $totallitros);
              echo number_format($estimado, 2, ',', ' ');
            }
            ?></td>
  </tr>
</tbody>
</table>
</div>
 <!--fin listado remitos-->
 <div id='noimprimir'>
 <a href="listado.php">Listado de Rendiciones</a>

</div>
</div>
</div>
<?}?>



