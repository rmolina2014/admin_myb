<?php 
// Recibir la lista enviada por AJAX
$lista = $_POST['lista'];

// Convertir la lista en un array si es necesario
//$lista1 = json_decode($lista, true);

// recorrelista


// Procesar la lista (por ejemplo, guardarla en una base de datos o mostrarla)
foreach ($lista as $elemento) {
    echo "Elemento: " . $elemento . "<br>";
}

// También puedes devolver una respuesta al cliente
echo "Lista recibida y procesada correctamente.";
?>