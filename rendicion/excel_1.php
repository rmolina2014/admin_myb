<?
/*01-01-2017 consulta para exportar a excel por fechas */
require_once 'rendicion.php';
$fecha = date("d-m-Y");
if(isset($_POST['desde']) && !empty($_POST['desde']))
{
  $fechaDesde=$_POST['desde'];
  $fechaHasta=$_POST['hasta'];
  //Inicio de la instancia para la exportación en Excel
  header('Content-type: application/vnd.ms-excel');
  header("Content-Disposition: attachment; filename=Rendiciones_$fecha.xls");
  header("Pragma: no-cache");
  header("Expires: 0"); 
  ?>
   <div class="container-fluid">
     <div class="row">
      <div class="col-md-12">
       <h3>Rendiciones - Fecha Informe <? echo $fecha; ?></h3>
       <h4>Fecha Desde <? echo $fechaDesde?> - Fecha Hasta <? echo $fechaHasta;?> </h4>
        <hr>
        <div id="div_dinamico">
         
           <table id="listado" class="table table-striped table-bordered table-hover table-condensed" >
            <thead>
               <tr>
                <th>Rend.</th>
                <th>Fecha</th>
                <th>Chofer</th>
                <th>Patente</th>
                <th>Comision</th>
                <th>Flete</th>
                <th>Km Salida</th>
                <th>Km Llegada</th>
                <th>Total Km</th>
                <th>Total GAS OIL</th>
                <th>Estado</th>
               
               </tr>
             <thead>
             <tbody>
            <?php
            $objecto = new rendicion();
            $listado = $objecto->listaExcel($fechaDesde,$fechaHasta);
            while( $item = mysqli_fetch_array($listado))
            {
            ?>
             <tr>
                <td> <?php echo $item['id'];?></td>
                <td><?php echo $item['fecha'];?></td>
                <td><?php echo $item['nombrechofer'];?></td>
                <td><?php echo $item['patente'];?></td>
                <td><?php echo $item['comision'];?></td>
                <td><?php echo $item['flete'];?></td>
                <td><?php echo $item['kmsalida'];?></td>
                <td><?php echo $item['kmllegada'];?></td>
                <td><?php echo $totalKM= $item['kmllegada']-$item['kmsalida'];?></td>
                <td><?php echo $item['totalGO'];?></td>
                <td><?php echo $item['estado'];?></td>
                
            </tr>
            <?php
             }
         }
          ?>
          </tbody>
         </table>
         </div>
         </div>
</div>
</div>

 