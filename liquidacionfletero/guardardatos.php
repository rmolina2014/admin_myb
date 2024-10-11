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

require_once 'liquidacionfletero.php';

require_once '../remito/remito.php';

include '../cabecera.php';

?>

<style type="text/css" media="print">

@media print {

body { font-size:10px; }

#noimprimir {display:none;}

#parte2 {display:none;}

}

</style>

<?

function cambiaf_mysql($fechadb)
{
    list($yy,$mm,$dd)=explode("-",$fechadb);
    $fecha = new DateTime();
    $fecha->setDate($yy, $mm, $dd);
    echo $fecha->format('d-m-Y');
}


if( isset($_GET['idhrint']) && !empty($_GET['idhrint']) )
{
  $objeto = new liquidacionfletero();
  
  $idhrint= $_GET['idhrint'];
  $porcentaje= $_GET['porcentaje'];
  $total= $_GET['total'];

  $listado = $objeto->actualizarhrint($idhrint,$porcentaje,$total);

?>

 <div class="container">
 <div class="row">
  <h3>Hoja de Ruta Interna Nº : <?echo $idhrint;?> Liquidación Fletero</h3>
  <div class="col-xs-12">
   <?
     $listado = $objeto->cabecerahri($idhrint);

     while( $item = mysqli_fetch_array($listado))

     {
     ?>
      <div class="row">

        <div class="col-xs-4">
        <label> Fecha : <?echo $item['fecha'];?> </label>
        </div>
         <div class="col-xs-4">
        <label> Chofer : <?echo $item['nombrechofer'];?> </label>
         </div>
         <div class="col-xs-4">
        <label> Patente Camion : <?echo $item['patentecamion'];?> </label>
        </div>

        <div class="col-xs-4">
        <label> Porcentaje : <?echo $item['porcentaje'];?> </label>
        </div>

      </div>

      <?

        $porcentaje=$item['porcentaje'];

       }?>

     </div>



  <h4>Detalle</h4>
  <div class="col-xs-12">
    <table id="listado" class="table" >
       <thead>
          <tr>
              <th>Fecha</th>
              <th>Nº guia</th>
              <TH>Destinatario </TH>
              <TH>Proveedor </TH>
              <TH>Bultos</TH>
              <th>Nº Sur Exp.</th>
              <th>Importe</th>
              <th>Importe Dividido en 1.21</th>
              <th>Importe Fletero</th>
           </tr>
       <thead>
       <tbody>
        <?php
            setlocale(LC_MONETARY,"es_AR");
          $sumatoria=0;
          $total_importe=0;
          $total_2=0;
          
          $usuarios = $objeto->listaremito($idhrint);
          while( $item = mysqli_fetch_array($usuarios))
          {
            $a=0;
             $neto=0;
         ?>
           <tr>
              <td><?php echo cambiaf_mysql($item['fecha']);?></td>
              <td><?php echo $item['numeroremito'];?></td>
              <td><?php echo $item['nombrecliente'];?></td>
              <td><?php echo $item['nombreproveedor'];?></td>
              <td><?php echo $item['bultos'];?></td>
              <td><?php echo $item['remitose'];?></td>
              <td>
                  <?php
                  echo money_format('%#10.2n',$item['importe']);
                  $total_importe=$total_importe+$item['importe'];
                  ?>
              </td>
              <td>
                <?php
                   if ($item['importe'] > 0)
                   {
                     $a = round(($item['importe']/1.21),2);
                     echo money_format('%#10.2n',$a);
                     $neto = $neto + $a;
                      $total_2=$total_2+$a;
                   }
                ?>
              </td>
              <td>
                 <?php 
                  if ($porcentaje > 0 and $a > 0)
                   {
                     $a = round((($neto*$porcentaje)/100),2);
                     echo money_format('%#10.2n',$a);
                     $sumatoria=$sumatoria+$a;
                   }
                    else echo money_format('%#10.2n',$a);
                  ?> 
              </td>
            </tr>
           
          <?
           }
          ?>
          <tr>
          <td colspan="6">TOTALES :</td>
          <td><?php echo money_format('%#12.2n',$total_importe);?></td>
          <td><?php echo money_format('%#12.2n',$total_2);?></td>
          <td><?php echo money_format('%#12.2n',$sumatoria);?></td>
          </tr>
          </tbody>
         </table>
        <!--fin listado remitos-->
</div>
<?
echo '<script> window.print();</script>';
?>

 <!--fin listado remitos-->
<div id='noimprimir'>
 <a href="listado.php">Listado</a>
</div>
</div>
<?}?>

