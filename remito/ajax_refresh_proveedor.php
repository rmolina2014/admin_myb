<?php
// PDO connect *********
function connect() {
    return new PDO('mysql:host=localhost;dbname=mblogist_admin2020', 'mblogist_admin2020','+qazx2020', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

$pdo = connect();
$keyword = '%'.$_POST['keyword'].'%';
$sql = "SELECT id,nombrereal,nombrefantasia,cuit FROM cliente WHERE nombrereal LIKE (:keyword)  or nombrefantasia LIKE (:keyword) or cuit LIKE (:keyword) ORDER BY nombrereal ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$list = $query->fetchAll();
foreach ($list as $rs) {
	// put in bold the written text
	$nombrereal = str_replace($_POST['keyword'], ''.$_POST['keyword'].'', $rs['nombrereal'].' --- '.$rs['nombrefantasia'].' --- '.$rs['cuit'] );
	// add new option
   	 echo '<li onclick="set_proveedor(\''.str_replace("'", "\'", $rs['id']).'\',\''.str_replace("'", "\'", $nombrereal).'\')">'.$nombrereal.'</li>';
   //	 echo '<li onclick="set_proveedor(\''.str_replace("'", "\'", $rs['id']).'\',\''.str_replace("'", "\'", $nombrereal).'\')">'.$nombrereal.'</li>';
}
?>