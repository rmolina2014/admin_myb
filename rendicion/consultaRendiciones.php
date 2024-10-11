 <?
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

 $objecto = new rendicion();
 $listado = $objecto->datosCombustible(1919);
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
<div class="container-fluid">
<div class="row">
<div class="col-md-2">
    <ul style="list-style:none;">  
    <li>Rendicion N°</li> 
    <li><hr></li>
    <li>Combustible</li> 
    <li>Contado</li> 
    <li>Cta Corriente</li> 
    <li>Total</li> 
    <li><hr></li>
    <li>Gastos Varios</li> 
    
    <?
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

<div class="col-md-2">
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
 $listadoTipoGastoBD = $objecto->datosGastosVarios(1919);
 while($item = mysqli_fetch_array($listadoTipoGastoBD))
 {  
   $clave=$item['gasto'];
   $arregloGastos[$clave] = $arregloGastos[$clave]+$item['importe']; 
   $totalGastos=$totalGastos+$arregloGastos[$clave] ;
 }  
/*var_dump($arregloGastos);
     foreach( $arregloGastos as $clave => $valor) {
    echo "Clave: " . $clave . ", Valor: " . $valor . "</br>";
}
//var_dump($arregloGastos);
 foreach( $arregloGastos as $clave => $valor) {
    echo $clave."-".$valor."</br>";
 }*/

 foreach( $arregloGastos as $clave => $valor) {
    echo "<li>".$valor."</li>";
 }
 echo "<li>".$totalGastos."</li>";
 echo "  <li><hr></li>";
 echo "<li>".$tg=$totalGastos+$totalCombustible."</li>";
?>
</ul>
</div>

