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
    <title>Pago con Tarjeta PVC</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }
    </style>
    <!-- Incluye la biblioteca de QuaggaJS -->
    <script src="https://serratus.github.io/quaggaJS/dist/quagga.min.js"></script>
</head>
<body>
    <h2>Pagar con Tarjeta PVC</h2>
    <p>Escanea el código de barras de tu tarjeta.</p>
    <div id="interactive" class="viewport"></div>
    <form method="POST" action="boleta.php" id="payment-form">
        <input type="hidden" name="modalidad_pago" value="tarjeta">
        <input type="hidden" id="codigo_barras" name="codigo_barras">
        <button type="submit">Confirmar Pago</button>
    </form>

    <script>
        Quagga.init({
            inputStream : {
                name : "Live",
                type : "LiveStream",
                target: document.querySelector('#interactive')    // Or '#yourElement' (optional)
            },
            decoder : {
                readers : ["code_128_reader"] // List of active readers
            }
        }, function(err) {
            if (err) {
                console.log(err);
                return;
            }
            console.log("Initialization finished. Ready to start");
            Quagga.start();
        });

        Quagga.onDetected(function(result) {
            var code = result.codeResult.code;
            document.getElementById('codigo_barras').value = code;
            alert("Código de barras detectado: " + code);
            // Puedes agregar más lógica aquí para verificar el código de barras
        });
    </script>
</body>
</html>
