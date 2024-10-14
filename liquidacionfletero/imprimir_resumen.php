<?php

// Leer los datos JSON de la entrada
$json_input = file_get_contents('php://input');

// Decodificar los datos JSON
$data = json_decode($json_input, true);

// Mostrar los datos en formato JSON
header('Content-Type: application/json');
echo $data;
