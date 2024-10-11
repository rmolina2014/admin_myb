<?
/*17-03-2017 consulta para exportar a excel listado de remitos por fechas */
require_once 'consulta.php';
$fecha = date("d-m-Y");
if(isset($_POST['desde']) && !empty($_POST['desde']))
{
  $fechaDesde=$_POST['desde'];
  $fechaHasta=$_POST['hasta'];
  //Inicio de la instancia para la exportación en Excel
  header('Content-type: application/vnd.ms-excel');
  header("Content-Disposition: attachment; filename=Listado_$fecha.xls");
  header("Pragma: no-cache");
  header("Expires: 0"); 
  ?>
   <div class="container-fluid">
     <div class="row">
      <div class="col-md-12">
       <h3>Remitos por Fecha - Fecha Informe <? echo $fecha; ?></h3>
       <h4>Fecha Desde <? echo $fechaDesde?> - Fecha Hasta <? echo $fechaHasta;?> </h4>
        <hr>
        <div id="div_dinamico">
         
           <table id="listado" class="table table-striped table-bordered table-hover table-condensed" >
            <thead>
               <tr>
                <th>N°.</th>
                 <th>nomcliente</th>
  <th>dircliente</th>
  <th>cuitcliente</th>
  <th>nomproveedor</th>
  <th>dirproveedor</th>
  <th>cuitproveedor</th>
  <th>valordeclarado</th>
  <th>tipocomprobante</th>
  <th>contrareembolso</th>
  <th>idcliente</th>
  <th>idproveedor</th>
  <th>numero</th>
  <th>fecha</th>
  <th>bultos</th>
  <th>descripcion</th>
  <th>estado</th>
  <th>fechaestado</th>
  <th>fechaingreso</th>
               
               </tr>
             <thead>
             <tbody>
            <?php
            $objecto = new consulta();
            $listado = $objecto->remitosPorFecha($fechaDesde,$fechaHasta);
            while( $item = mysqli_fetch_array($listado))
            {
            ?>
             <tr>
                <td> <?php echo $item['id'];?></td>
                <td><?php echo $item['nomcliente'];?></td>
                <td><?php echo $item['dircliente'];?></td>
                <td><?php echo $item['cuitcliente'];?></td>
                <td><?php echo $item['nomproveedor'];?></td>
                <td><?php echo $item['dirproveedor'];?></td>
                <td><?php echo $item['cuitproveedor'];?></td>
                <td><?php echo $item['valordeclarado'];?></td>
                <td><?php echo $item['tipocomprobante'];?></td>
                <td><?php echo $item['contrareembolso'];?></td>
                <td><?php echo $item['idcliente'];?></td>
                <td><?php echo $item['idproveedor'];?></td>
                <td><?php echo $item['numero'];?></td>
                <td><?php echo $item['fecha'];?></td>
                <td><?php echo $item['bultos'];?></td>
                <td><?php echo $item['descripcion'];?></td>
                <td><?php echo $item['estado'];?></td>
 <td><?php echo $item['fechaestado'];?></td>
 <td><?php echo $item['fechaingreso'];?></td>
                
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

 