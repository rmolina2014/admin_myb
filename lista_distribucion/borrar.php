<?php
$archivo= $_GET['id'];
unlink('archivo/'.$archivo);
 echo "<script language=Javascript> location.href=\"index.php\"; </script>";
?>