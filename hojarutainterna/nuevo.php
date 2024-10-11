<?php
require_once 'hojarutainterna.php';
$objecto = new hojarutainterna();
$idhojaruta = $objecto->nuevo(date(y-m-d),'Abierto');
header('Location: dethrinterna.php?id='.$idhojaruta);
exit;
?>
