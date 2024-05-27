<?php
session_start();
$nombre = $_SESSION['nombre'];
$apellido = $_SESSION['apellido'];
$dni = $_SESSION['dni'];
$origen = $_SESSION['origen'];
$destino = $_SESSION['destino'];
$fecha = $_SESSION['fecha'];
$cantidad_pasajes = $_SESSION['cantidad_pasajes'];
$importe = $_SESSION['importe'];
$total_a_pagar = $_SESSION['total_a_pagar'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago con Yape</title>
    <style>
        body {
            background-color: #800080;
            color: #fff;
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }
        .qr-code {
            margin: 20px auto;
        }
        .qr-code img {
            width: 200px;
            height: 200px;
        }
    </style>
</head>
<body>
    <h2>Pagar con Yape</h2>
    <p>Escanea el código QR con Yape para realizar el pago.</p>
    <div class="qr-code">
        <img src="image.png" alt="Código QR para Yape">
    </div>
    <form method="POST" action="boleta.php">
        <input type="hidden" name="modalidad_pago" value="yape">
        <button type="submit">Confirmar Pago</button>
    </form>
</body>
</html>
