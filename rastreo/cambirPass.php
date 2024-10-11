<?php
require_once '../conexion.php';
mysql_query("SET NAMES 'utf8'");
$sql="SELECT * FROM usuario";
$listado = consulta_mysql($sql);
while( $item = mysqli_fetch_array($listado))
{
  //$pass=md5($item['password']);
  
  $id=$item['id'];
  $act="UPDATE usuario
        SET `estado` = 'Activo' WHERE `id` = '$id'";
  consulta_mysql($act);
  echo $id.'--'.$pass;
  echo "<br/>";
}
  
  ?>
