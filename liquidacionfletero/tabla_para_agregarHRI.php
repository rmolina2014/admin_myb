<?
require_once 'rendicion.php';
if( isset($_GET['id']) && !empty($_GET['id']) )
{
 $id_hri= $_GET['id'];
 $contador=0;
 ?>
 <style type="text/css">
  #listas ul {
  border: 1px solid #7C7C7C;
  border-bottom: none;  
  list-style: none;
  margin: 0;
  padding: 0;
  width: 100px;
  font-size: 14px;
}
#listas ul. li {
  background: #F4F4F4;
  border-bottom: 1px solid #7C7C7C;
  border-top: 1px solid #FFF;
}

ul.menu {
  border: 1px solid #7C7C7C;
  border-bottom: none;  
  list-style: none;
  margin: 0;
  padding: 0;
  width: 280px;
}
ul.menu li {
  background: #F4F4F4;
  border-bottom: 1px solid #7C7C7C;
  border-top: 1px solid #FFF;
}
 </style>
 <div id="listas">
 <div class="container-fluid">
 <div class="row" >
 <!-- 1° columnna de titulos -->
 <div class="col-md-1">
    <ul id="menu" >  
    <li >HRI. N°</li> 
    <li><hr></li>
    <li>Chofer</li> 
    <li>Contado</li> 
    <li>Cta Corriente</li> 
    <li>Total</li> 
    <li><hr></li>
    <li>Gastos Varios</li> 
    <?
     $objecto = new rendicion();
     $totalCombustible=0;
     $listadoTipoGasto = $objecto->listarTipoGastos();
     while($item = mysqli_fetch_array($listadoTipoGasto))
     {
      ?>
        <li><? echo $item['descripcion']?></li>
      <?
     }
  
    ?>
    <li>Total Gastos</li>
    <li><hr></li>
    <li>Total</li>
    </ul>

</div>
<!-- 1° columnna de titulos -->

<? 
// sacar todas las rendiciones de un chofer
  $objecto = new rendicion();
  $totalCombustible=0;
  $listado1 = $objecto->buscarRendicionesChofer($chofer_id);
  while($item1 = mysqli_fetch_array($listado1))
  {
    $rendicion_id=$item1['id'];
    $objecto = new rendicion();
     $listado2 = $objecto->datosCombustible($rendicion_id);
     $contado=0;
     $cuentacorriente=0;
     while($item2 = mysqli_fetch_array($listado2))
     {
      if ($item2['pago']=='NO') {
         $contado=$contado+$item2['importe'];
       }
       if ($item2['pago']=='SI') {
         $cuentacorriente=$cuentacorriente+$item2['importe'];
       }
      }
     
?>

<div class="col-md-1">
<ul >   
 <li><? echo $rendicion_id; ?></li>
  <li><hr></li> 
  <!--li>&nbsp;</li-->
 <li><? echo $contado; ?></li> 
 <li><? echo $cuentacorriente; ?></li>
 <li><? echo $totalCombustible=$cuentacorriente+$contado; ?></li>
 <li><hr></li>
 <!--li>&nbsp;</li-->
<?
$totalGastos=0;
// array asociativo en cero
$listadoTipoGasto = $objecto->listarTipoGastos();
$arregloGastos = array();
while($item3 = mysqli_fetch_array($listadoTipoGasto))
     {
      $clave=$item3['descripcion'];
      $arregloGastos[$clave] = 0;
     }
//recorrer los datos de la bd para cargar el arreglo
 $listadoTipoGastoBD = $objecto->datosGastosVarios($rendicion_id);
 while($item4 = mysqli_fetch_array($listadoTipoGastoBD))
 {  
   $clave=$item4['gasto'];
   $arregloGastos[$clave] = $arregloGastos[$clave]+$item4['importe']; 
   $totalGastos=$totalGastos+$arregloGastos[$clave] ;
 }  
 foreach( $arregloGastos as $clave => $valor) {
    echo "<li>".$valor."</li>";
 }
 echo "<li>".$totalGastos."</li>";
 echo "  <li><hr></li>";
 echo "<li>".$tg=$totalGastos+$totalCombustible."</li>";

?>
</ul>
</div>
<?
$contador++;
   if ($contador==10) {
          $contador=0;
        ?>
    </div>
    <hr>
    </div>    
    <div class="container-fluid">
    <div class="row" >
    <div class="col-md-1">
   <ul id="menu" > 
    <li>Rend. N°</li> 
    <li><hr></li>
    <li>Combustible</li> 
    <li>Contado</li> 
    <li>Cta Corriente</li> 
    <li>Total</li> 
    <li><hr></li>
    <li>Gastos Varios</li> 
    <?
     $objecto = new rendicion();
     $totalCombustible=0;
     $listadoTipoGasto = $objecto->listarTipoGastos();
     while($item = mysqli_fetch_array($listadoTipoGasto))
     {
      ?>
        <li><? echo $item['descripcion']?></li>
      <?
     }
  
    ?>
    <li>Total Gastos</li>
    <li><hr></li>
    <li>Total</li>
    </ul>

</div>
<?
      }



}
 }?>
</div>
</div>
