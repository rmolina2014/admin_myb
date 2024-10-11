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
echo 'Hojas de Ruta Internas actualizadas:'.$i;  
             
?>

