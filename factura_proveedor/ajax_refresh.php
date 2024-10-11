<?php
//a
// PDO connect *********
function connect() {
   return new PDO('mysql:host=localhost;dbname=surexpre_2018', 'surexpre_nuevo','rawson2018$', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}
$pdo = connect();
$keyword = '%'.$_POST['keyword'].'%';
$sql = "SELECT id,nombre,cuit FROM proveedoressurexpre WHERE nombre LIKE (:keyword) or cuit LIKE (:keyword) ORDER BY nombre ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$list = $query->fetchAll();
foreach ($list as $rs) {
	// put in bold the written text
	$nombre = str_replace($_POST['keyword'], ''.$_POST['keyword'].'', $rs['nombre'].'--- '.$rs['cuit'] );
	// add new option
   	 echo '<li onclick="set_proveedor(\''.str_replace("'", "\'", $rs['id']).'\',\''.str_replace("'", "\'", $nombre).'\')">'.$nombre.'</li>';
   //	 echo '<li onclick="set_proveedor(\''.str_replace("'", "\'", $rs['id']).'\',\''.str_replace("'", "\'", $nombrereal).'\')">'.$nombrereal.'</li>';
}
?>