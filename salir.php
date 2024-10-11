<?php
session_start();
unset($_SESSION['sesion_usuario']);
unset($_SESSION['sesion_ID']);
header('Location: index.php');
?>
