<?php
//20112015
//validar que no este repetido el numero de cuit
require_once 'remito.php';
if( isset($_POST['numero']) && !empty($_POST['numero']) )
 {
	$numero = $_POST['numero'];
	$objecto = new remito();
	$cantidad = $objecto->validarNumeroRemito($numero);
	if( $cantidad > 0)
        echo '<div class="alert alert-danger">Este Número de Remito ya existente. </div>';
        else
            echo '<div class="alert alert-success"> Disponible. </div>';
  }
?>