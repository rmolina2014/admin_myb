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
       <div class="col-xs-8">
       <h3> Chofer : <?echo $item['nombrechofer'];?> </h3>
       </div>
       <div class="col-xs-4">
       <h3> Rendición N° : <? echo $idViaje;?> </h3>
       </div>
   </div>
   <hr>
   <div class="row" >
        <div class="col-xs-3">
          <label> Fecha : <?echo cambiaf_mysql($item['fecha']) ;?> </label><br>
        </div>
        <div class="col-xs-3">
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
 <!-- Listado de a cuenta -->
 <h4>Items a Cuenta</h4>
 <div class="col-xd-12">
  <table id="listado1" class="table" >
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
       <div class="col-xd-12">
  <h5> Total General :<? echo '$ '.$tg=($comision+$totalACuenta)?></h5>  
 </div>
 </div>
 <!--fin listado remitos-->
</div>


<div id='noimprimir'>
<a href="listado.php">Listado de Rendiciones</a>
</div>

</div>

<?}?>



