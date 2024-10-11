<?
require_once '../cliente/cliente.php';
if( isset($_POST['id']) && !empty($_POST['id']) ) {
	$id = $_POST['id'];
	$objecto = new cliente();
	$todobien = $objecto->obtenerId($id);
	if($todobien)
	{
       while( $item = mysqli_fetch_array($todobien))
       {	
         ?>
            <input type="text" value="<? echo $item['nombrereal']?>" >

         <?		
        }//fin del while
	} else {
			$mensaje = 'Lo sentimos, no se pudo traer ...';
	    	}
	
	}
?>
