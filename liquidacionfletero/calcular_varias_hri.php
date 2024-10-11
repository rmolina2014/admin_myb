<?php

require_once 'liquidacionfletero.php';

/*** CALCULAR LA LIQUIDACION FLETERO PARA VARIA HRI ***/

$objeto = new liquidacionfletero();

$data = json_decode($_POST['lista']);

$porcentaje=$_POST['porcentaje'];

$i=0; //contador de hri

/** realizar el calculo uno por uno**/

foreach ($data as $datos)

{

  $i++;

  $total_importe_sumatoria=0; // sumatoria del total fletero para las hri

  //echo $datos;

  $listaDHRI = $objeto->lista_detalleHRI($datos);

  while( $item = mysqli_fetch_array($listaDHRI))
  {

    $total_importe=0;

    $id_dhri=$item['detalleHRI'];

    $importe_fletero=$porcentaje+$item['importe'];

    $total_importe=$total_importe+$importe_fletero;

    $total_importe_sumatoria=$total_importe_sumatoria+$total_importe;
   
    // actualizar el detalle de HRI

    $actualizarDHRI=$objeto->actualizar_importe_fletero($id_dhri,$importe_fletero);
  }

   // actualizar la HRI con los datos del porcentaje y el total del iporte del fletero

  $actualizarDHRI=$objeto->actualizar_porcentaje_importe_fletero($datos,$total_importe_sumatoria,$porcentaje);

} 


//echo 'Hojas de Ruta Internas actualizadas:'.$i; 

// LISTADO DE HRI Y SU TOTAL FLETERO



function cambiaf_mysql($fechadb)
{
    list($yy,$mm,$dd)=explode("-",$fechadb);
    $fecha = new DateTime();
    $fecha->setDate($yy, $mm, $dd);
    echo $fecha->format('d-m-Y');
}

foreach ($data as $datos)
{
  //imprimir todas las plantillas
$idhrint= $datos;
?>

<style type="text/css" media="print">

@media print {

body { font-size:10px; }

#noimprimir {display:none;}

#parte2 {display:none;}

}

</style>



 <div class="container">
 <div class="row">
 <h3>Hoja de Ruta Interna Nº : <?echo $idhrint;?> Liquidación Fletero</h3>
 <div class="col-xs-12">
  <?php
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
          <?php
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
<?php
}
echo '<script> window.print();</script>';
?>
