<?php
// Datos de autenticación de Yape
$api_key = 'tu_clave_de_api_de_yape';

// ID de transacción del pago que deseas verificar
$id_transaccion = 'id_de_transaccion_del_pago';

// URL de la API de Yape para verificar un pago
$url = 'https://api.yape.com/verificar_pago';

// Configuración de la solicitud HTTP
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $api_key,
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['id_transaccion' => $id_transaccion]));

// Realizar la solicitud a la API de Yape
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Procesar la respuesta de la API de Yape
if ($http_code == 200) {
    // La solicitud fue exitosa, procesar la respuesta JSON
    $respuesta = json_decode($response, true);

    // Verificar el estado del pago
    $estado_pago = $respuesta['estado']; // Suponiendo que la respuesta JSON contiene un campo 'estado'

    if ($estado_pago == 'completado') {
        // El pago se completó correctamente, realizar acciones adicionales
        // Por ejemplo, actualizar la base de datos, enviar un correo electrónico de confirmación, etc.
    } else {
        // El pago no se completó o está pendiente de confirmación, manejar según sea necesario
    }
} else {
    // La solicitud falló, manejar el error según sea necesario
    echo "Error al verificar el pago: HTTP $http_code";
}
?>
