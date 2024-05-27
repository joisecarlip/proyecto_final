<?php
// Iniciar sesión para almacenar los datos temporalmente
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitización y validación de entrada
    $_SESSION['nombre'] = trim($_POST['nombre']);
    $_SESSION['apellido'] = trim($_POST['apellido']);
    $_SESSION['dni'] = trim($_POST['dni']);
    $_SESSION['origen'] = trim($_POST['origen']);
    $_SESSION['destino'] = trim($_POST['destino']);
    $_SESSION['fecha'] = trim($_POST['fecha']);
    $_SESSION['cantidad_pasajes'] = intval($_POST['cantidad_pasajes']);
    $_SESSION['importe'] = floatval($_POST['importe']);
    $_SESSION['total_a_pagar'] = floatval($_POST['total_a_pagar']);
    $modalidad_pago = trim($_POST['modalidad_pago']);

    // Redirigir a la página de la boleta electrónica
    header("Location: boleta.php");
    exit();
}
?>
