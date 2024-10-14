<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ids'])) {
    $ids = is_array($_POST['ids']) ? $_POST['ids'] : explode(',', $_POST['ids']);
    
    // Aquí va tu lógica para generar el resumen basado en $ids
    
    // Asegúrate de que no haya salida antes de este punto
    ob_start();
    // Tu código HTML y PHP para generar el resumen
    $contenido = ob_get_clean();
    
    echo $contenido;
} else {
    echo "Error: No se recibieron IDs válidos.";
}
