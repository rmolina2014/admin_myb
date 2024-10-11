<?php
  require_once '../conexion.php';
        	//24112015 clientes con remitos 
                  $sql="SELECT fecha,fechaestado,fechaingreso FROM remito"; 
          	  $registro = consulta_mysql($sql);
                  while( $item = mysqli_fetch_array($registro))
                  {
                    $fechaNueva=$item['fecha'];
                    $sql2="UPDATE `remito` SET `fechaingreso` = '$fechaNueva' WHERE `fechaingreso` = '0000-00-00' "; 
                    consulta_mysql($sql2);
                  }
                  ?>