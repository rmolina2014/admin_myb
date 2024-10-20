<?php
// Verificar si se recibieron datos por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lista'])) {
    $selectedLiquidaciones = $_POST['lista'];

    require_once 'liquidacionfletero.php';
    $objecto = new liquidacionfletero();

    //funcion para calcular el importe del flerero segun el valor de la hoja de ruta interna
    function calcularImporteFletero($hri_importe_fletero, $porcentaje)
    {
        $neto = 0;
        $a = 0;
        $hri_importe_flelero = $hri_importe_fletero;
        $a = round($hri_importe_flelero / 1.21, 2);
        $neto = $neto + $a;
        $total = round((($neto * $porcentaje) / 100), 2);
        return $total;
    }

    // Generar el HTML basado en las liquidaciones seleccionadas
    $htmlContent = '<html><head><title>Resumen de Liquidaciones</title><style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }
        th, td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        th {
            background-color: #000;
            color: #fff;
        }
        caption {
            caption-side: top;
            font-size: 1.5em;
            margin: 10px 0;
        }</style></head><body>';
    $htmlContent .= '<h1>Resumen de Liquidaciones</h1>';
    $htmlContent .= '<table><thead><tr><th>HRI</th><th>Fecha</th><th>Chofer</th><th>Porcentaje</th><th>Importe Fletero</th></tr></thead><tbody>';
    $sumatoria = 0;
    foreach ($selectedLiquidaciones as $liquidacion) {
        $listado = $objecto->listaResumen($liquidacion);
        if (is_array($listado)) {
            //$calculo_importe = calcularImporteFletero($listado['hri_importe_fletero'], $listado['porcentaje']);
            $sumatoria += $listado['hri_importe_fletero'];
            $htmlContent .= "<tr>";
            $htmlContent .= "<td>" . htmlspecialchars($listado['id']) . "</td>";
            $htmlContent .= "<td>" . htmlspecialchars(date('d-m-Y', strtotime($listado['fecha']))) . "</td>";
            $htmlContent .= "<td>" . htmlspecialchars($listado['chofer']) . "</td>";
            $htmlContent .= "<td>" . htmlspecialchars($listado['porcentaje']) . "%</td>";
            $htmlContent .= "<td>$ " . number_format($listado['hri_importe_fletero'], 2, ',', '.') . "</td>";
           // $htmlContent .= "<td>$ " . number_format($calculo_importe, 2, ',', '.') . "</td>";
            $htmlContent .= "</tr>";
        } else {
            $htmlContent .= "<tr><td colspan='6'>Error al obtener los detalles de la liquidaci n " . htmlspecialchars($liquidacion) . "</td></tr>";
        }
    }
    $htmlContent .= "<tr><td></td><td></td><td></td><td>Sumatoria</td><td >$ ". number_format($sumatoria, 2, ',', '.') . "</td></tr>";
    $htmlContent .= '</tbody></table>';
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
