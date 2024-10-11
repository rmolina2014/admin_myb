<?php
//20112015
//validar que no este repetido el numero de cuit
require_once 'cliente.php';
if( isset($_POST['cuit']) && !empty($_POST['cuit']) )
 {
	$cuit = $_POST['cuit'];
	$objecto = new cliente();
	$cantidad = $objecto->validarcuit($cuit);
	
	/*if( $cantidad > 0)

       // echo '<div class="alert alert-danger">CUIT ya existente. </div>';
         echo 'CUIT ya existente.';
        else
             echo 'Disponible.';
            //echo '<div class="alert alert-success"> Disponible. </div>';-*/
echo $cantidad;
  }
  
?>