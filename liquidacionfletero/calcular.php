<?php
require_once 'liquidacionfletero.php';
error_reporting(0);
function cambiaf_mysql($fechadb){
    list($yy,$mm,$dd)=explode("-",$fechadb);
    $fecha = new DateTime();
    $fecha->setDate($yy, $mm, $dd);
    echo $fecha->format('d-m-Y');
}

if( isset($_POST['id']) && !empty($_POST['id']) )
{
  $idhrint= $_POST['id'];
  $porcentaje= $_POST['porcentaje'];
  $objecto = new liquidacionfletero();
  ?>
    <div class="col-md-12">
     <!-- Listado de remitos -->
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
          
          $datos = $objecto->listaremito($idhrint);
          while( $item = mysqli_fetch_array($datos))
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
<!--fin listado remitos-->
 </div>
<div>
 <a href="guardardatos.php?porcentaje=<? echo $porcentaje; ?>&total=<? echo $sumatoria;?>&idhrint=<? echo $idhrint;?>" class="btn btn-primary btn-sm"> Guarda Datos e Imprimir</a>
</div>

<?
 }
?>
