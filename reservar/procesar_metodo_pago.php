<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['metodo_pago'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $origen = $_POST['origen'];
    $destino = $_POST['destino'];
    $fecha = $_POST['fecha'];
    $cantidad_pasajes = $_POST['cantidad_pasajes'];
    $importe = $_POST['importe'];
    $total_a_pagar = $_POST['total_a_pagar'];
    $metodo_pago = $_POST['metodo_pago'];

    // Lógica para procesar el método de pago seleccionado
    if ($metodo_pago === "yape") {
        // Redirigir al usuario a la página de pago con Yape
        header("Location: pago_yape.php?nombre=$nombre&apellido=$apellido&correo=$correo&origen=$origen&destino=$destino&fecha=$fecha&cantidad_pasajes=$cantidad_pasajes&importe=$importe&total_a_pagar=$total_a_pagar");
        exit();
    } elseif ($metodo_pago === "tarjeta") {
        // Redirigir al usuario a la página de pago con Tarjeta de Código de Barras
        header("Location: escanear_tarjeta_pvc.php?nombre=$nombre&apellido=$apellido&correo=$correo&origen=$origen&destino=$destino&fecha=$fecha&cantidad_pasajes=$cantidad_pasajes&importe=$importe&total_a_pagar=$total_a_pagar");
        exit();
    } else {
        // Manejar un método de pago desconocido
        echo "Método de pago desconocido";
    }
} else {
    // Manejar solicitud incorrecta o falta de datos
    echo "Error: Solicitud incorrecta o datos faltantes";
}
?>
