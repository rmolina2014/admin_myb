$.ajax({
    url: 'liquidacionfletero/imprimir_resumen.php',
    method: 'POST',
    data: JSON.stringify({ ids: selectedLiquidaciones }),
    contentType: 'application/json',
    dataType: 'json',
    success: function(response) {
        if (response.success) {
            var newWindow = window.open('', '_blank');
            newWindow.document.write(response.html);
            newWindow.document.close();
        } else {
            alert("Error: " + response.message);
        }
    },
    error: function(xhr, status, error) {
        console.error("Error en la llamada AJAX:", error);
        alert("Hubo un error al generar el resumen. Por favor, inténtalo de nuevo.");
    }
});
