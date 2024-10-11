<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

function consulta_mysql($sql){
//$conexion = mysqli_connect("localhost","mblogist_admin2020","+qazx2020","mblogist_admin2020");
$conexion = mysqli_connect("localhost","root","12345678","admin_myb");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit; 
  }
 $result = mysqli_query($conexion,$sql);
 /* esto duplica if (!mysqli_query($conexion,$sql))
  {
  echo("Errorcode: ".mysqli_errno($conexion));
  exit;
  }*/
 return $result;  
}
?>