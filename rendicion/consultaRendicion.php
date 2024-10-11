<?php
require_once 'rendicion.php';
if( isset($_GET['id']) && !empty($_GET['id']) )
{
 $id= $_GET['id'];
 $objecto = new rendicion();
 $listado = $objecto->datosCombustible($id);
 $contado=0;
 $cuentacorriente=0;
 while($item = mysqli_fetch_array($listado))
 {
   $rendicion=$item['rendicion'];
   if ($item['pago']=='NO') {
     $contado=$contado+$item['importe'];
   }
   if ($item['pago']=='SI') {
     $cuentacorriente=$cuentacorriente+$item['importe'];
   }
  }
 ?>
<div class="col-md-1">
<ul style="list-style:none;">   
 <li><? echo $rendicion; ?></li>
  <li><hr></li> 
  <li>&nbsp;</li>
 <li><? echo $contado; ?></li> 
 <li><? echo $cuentacorriente; ?></li>
 <li><? echo $totalCombustible=$cuentacorriente+$contado; ?></li>
 
 <li><hr></li>
 <li>&nbsp;</li>

<?
$totalGastos=0;
// array asociativo en cero
$listadoTipoGasto = $objecto->listarTipoGastos();
$arregloGastos = array();
while($item = mysqli_fetch_array($listadoTipoGasto))
     {
      $clave=$item['descripcion'];
      $arregloGastos[$clave] = 0;
     }
//recorrer los datos de la bd para cargar el arreglo
 $listadoTipoGastoBD = $objecto->datosGastosVarios($id);
 while($item = mysqli_fetch_array($listadoTipoGastoBD))
 {  
   $clave=$item['gasto'];
   $arregloGastos[$clave] = $arregloGastos[$clave]+$item['importe']; 
   $totalGastos=$totalGastos+$arregloGastos[$clave] ;
 }  
 foreach( $arregloGastos as $clave => $valor) {
    echo "<li>".$valor."</li>";
 }
 echo "<li>".$totalGastos."</li>";
 echo "  <li><hr></li>";
 echo "<li>".$tg=$totalGastos+$totalCombustible."</li>";
}
?>
</ul>
</div>

