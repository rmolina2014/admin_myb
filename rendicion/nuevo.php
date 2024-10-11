<?php
require_once 'rendicion.php';
$objecto = new rendicion();
if( isset($_POST['fecha']) && !empty($_POST['fecha']) )
 {
  $fecha= $_POST['fecha'];
  $chofer_id= $_POST['chofer_id'];
  $flete= $_POST['flete'];
  $porcentaje= $_POST['porcentaje'];
  $comision= ($porcentaje*$flete)/100;
  
  $kmsalida= $_POST['kmsalida'];
  $kmllegada= 0;
 
  $totalKM=0;
  $totalGO=0;

  $estado= 'Pendiente';
  $patente= $_POST['patente'];
  $idViaje = $objecto->nuevo($fecha,$chofer_id,$flete,$comision,$kmsalida,$kmllegada,$estado,$porcentaje,$totalKM,$totalGO,$patente);
   echo "<script language=Javascript> location.href=\"listado.php\"; </script>";
  //header('Location:listado.php');
  //header('Location: detalleRendicion.php?id='.$idViaje);
  exit;
}
else
{
 ?>

<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<div ng-app>
 
 <div class="container" ng-init="porcentaje=15;flete=0" >
 
 <h3>Datos del Viaje</h3>  
 <div class="row">
 <div class="col-md-12">
  <form role="form" method="POST" action="nuevo.php">
    
    <div class="col-md-3">
      <label>Fecha</label>
      <input name="fecha"  class="form-control" type="date" tabindex="1" autofocus required />
    </div>
    <div class="col-md-3">
      <label> Chofer </label>
        <select name="chofer_id" class="form-control" tabindex="2" required>
           <option value="" >Seleccionar...</option>
           <?  
           $sql="SELECT id,nombre FROM chofer";
           $listado = consulta_mysql($sql);
           while( $item = mysqli_fetch_array($listado))
           {
           ?>
            <option value="<?echo $item['id'];?>"> <?echo $item['nombre'];?> </option>
            <?
          } 
          ?>
      </select>
     </div>
     <div class="col-md-3">
      <label> Patente Camion </label>
        <select name="patente" class="form-control" tabindex="2" required>
           <option value="" >Seleccionar...</option>
           <?  
           $sql="SELECT patente FROM camion";
           $listado = consulta_mysql($sql);
           while( $item = mysqli_fetch_array($listado))
           {
           ?>
            <option value="<?echo $item['patente'];?>"> <?echo $item['patente'];?> </option>
            <?
          } 
          ?>
      </select>
     </div>
     <div class="col-md-3">
      <label>KM Salida</label>
      <input name="kmsalida"  class="form-control" type="number" tabindex="6" required />
     </div>
      
     <div class="col-md-4">
          <label>Flete</label>
          <input name="flete" class="form-control" type="number" min="0" tabindex="3" ng-model="flete" required />
        </div>
     <div class="col-md-4">
          <label>Portentaje</label>
          <input name="porcentaje" class="form-control" type="number" min="0" ng-model="porcentaje" tabindex="4" required />
        </div>
     <div class="col-md-4">
          <label>Comision : </label>
         
          <span class="form-control"> {{(porcentaje/100) * flete | currency}}</span>
          
        </div>
  
   
    
  </br>
   <div class="col-md-12">
    <hr>
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" onclick="location.href='listado.php';"><i class="fa fa-times"></i> Cancelar</button>
        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i> Guardar</button>
    </div>
</form>
</div>
</div>
</div>
</div>

 <?
 }
 ?>