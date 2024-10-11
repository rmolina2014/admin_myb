<?php
  require_once '../conexion.php';
        	//24112015 clientes con remitos 
                  $sql="SELECT fecha,fechaestado,fechaingreso FROM remito"; 
          				$registro = consulta_mysql($sql);
                  while( $item = mysqli_fetch_array($registro))
                  {
                    $fechaNueva=$item['fecha'];
                   $sql="UPDATE `remito` SET `fechaingreso` = '$fechaNueva' WHERE `fechaingreso` = '2015-08-30' "; 
                   consulta_mysql($sql);
                    }
                  ?>