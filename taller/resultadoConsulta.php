<?
 require_once 'taller.php';

?>

<div class="row" id="tabla">
<div class="col-md-12">
  <table id="listado" class="table table-striped table-bordered table-hover table-condensed" >
          <thead>
             <tr>
              <th>N°</th>
              <th>Fecha Servicio</th>
              <th>Patente</th>
              <th>Tipo Trabajo</th>
              <th>Costo</th>
              <th>Realizado en</th>
              <th>Observación</th>
             </tr>
           <thead>
           <tbody>
          <?php
          if( isset($_POST['patente']) && !empty($_POST['patente']) )
 {
           $patente= $_POST['patente'];
            $fechaDesde= $_POST['fechaDesde'];
             $fechaHasta= $_POST['fechaHasta'];
}
          $objecto = new taller();
          $listado = $objecto->consultaPatente($patente,$fechaDesde,$fechaHasta);
          $i=1;
          while( $item = mysqli_fetch_array($listado))
          {

          ?>
           <tr>
              <td><?php echo $i++;?></td>
              <td><?php echo $item['fechaservicio'];?></td>
              <td><?php echo $item['patente'];?></td>
              <td><?php echo$item['tipotrabajo'];?></td>
              <td><?php echo$item['costo'];?></td>
              <td><?php echo$item['lugar'];?></td>
              <td><?php echo$item['observacion'];?></td>
          </tr>
          <?php
           }
          ?>
          </tbody>
         </table>
</div>
</div>