<?php
require_once '../conexion.php';
if( isset($_GET['idviaje']) && !empty($_GET['idviaje']) )
 {
  $idviaje=$_GET['idviaje'];
  $kmLlegada=$_GET['km'];
  $litros=$_GET['litros'];
  
  /*actualizar kmllegada */
  $sql="UPDATE `viaje`
        SET 
          `kmllegada` = '$kmLlegada' where id=".$idviaje;
  
   $re = consulta_mysql($sql);
     
  /*actualizar estado viaje*/

  $sql="UPDATE `viaje`
        SET  `estado` = 'Rendicion', `totalGO` = '$litros'
        WHERE `id` = '$idviaje';"; 
  $registro = consulta_mysql($sql);
  header('Location: listado.php');
  exit;
}
else echo "error";
?>