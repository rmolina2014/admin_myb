<?php
// Verificar si se recibieron datos por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lista'])) {
    $selectedLiquidaciones = $_POST['lista'];

    require_once 'liquidacionfletero.php';
    $objecto = new liquidacionfletero();

    // Generar el HTML basado en las liquidaciones seleccionadas
    $htmlContent = '<html><head><title>Resumen de Liquidaciones</title></head><body>';
    $htmlContent .= '<h1>Resumen de Liquidaciones</h1>';
    $htmlContent .= '<table><tr><th>HRI</th><th>Fecha</th><th>Chofer</th><th>Porcentaje</th><th>Importe HRI</th><th>Importe Fletero</th></tr>';

    foreach ($selectedLiquidaciones as $liquidacion) {
        $listado = $objecto->listaResumen($liquidacion);
        if (is_array($listado)) {
            $htmlContent .= '<tr>';
            $htmlContent .= '<td>' . htmlspecialchars($listado['id']) . '</td>';
            $htmlContent .= '<td>' . htmlspecialchars($listado['fecha']) . '</td>';
            $htmlContent .= '<td>' . htmlspecialchars($listado['chofer']) . '</td>';
            $htmlContent .= '<td>' . htmlspecialchars($listado['porcentaje']) . '</td>';
            $htmlContent .= '<td>' . htmlspecialchars($listado['hri_importe_fletero']) . '</td>';
            $htmlContent .= '<td>0</td>';
            $htmlContent .= '</tr>';
        } else {
            $htmlContent .= '<tr><td colspan="6">Error al obtener los detalles de la liquidación ' . htmlspecialchars($liquidacion) . '</td></tr>';
        }
    }

    $htmlContent .= '</table>';
    $htmlContent .= '</body></html>';

    // Devolver la respuesta en formato JSON
    echo json_encode([
        'success' => true,
        'html' => $htmlContent
    ]);
} else {
    // Si no se recibieron datos por POST, devolver un error
    echo json_encode([
        'success' => false,
        'message' => 'No se recibieron datos válidos.'
    ]);
}
?>
