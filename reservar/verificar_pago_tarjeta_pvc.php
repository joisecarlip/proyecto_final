<?php
// Recibe el código de barras escaneado
if (isset($_GET['codigo'])) {
    $codigo_barras = $_GET['codigo'];

    // Aquí puedes realizar la verificación del pago utilizando el código de barras escaneado
    // Por ejemplo, puedes verificar si el código de barras está asociado a una tarjeta válida y si el pago es suficiente

    // Simulación de verificación
    $esPagoValido = true; // Cambia esto según la lógica de verificación real

    if ($esPagoValido) {
        echo "Pago realizado con éxito. Código de barras: " . htmlspecialchars($codigo_barras);
    } else {
        echo "Pago fallido. Código de barras no válido: " . htmlspecialchars($codigo_barras);
    }
} else {
    echo "No se recibió ningún código de barras.";
}
?>
