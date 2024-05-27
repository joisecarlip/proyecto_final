<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escanear Tarjeta de PVC</title>
    <!-- Agrega la biblioteca QuaggaJS -->
    <script src="quagga.min.js"></script>
    <link rel="stylesheet" href="/reservar/styles/style_scaneo.css">
</head>
<body>
    <h1>Escanear Tarjeta de PVC</h1>
    <div id="scanner-container"></div>
    <div class="alert" id="barcode-alert"></div>

    <script>
        Quagga.init({
            inputStream: {
                name: "Live",
                type: "LiveStream",
                target: document.querySelector("#scanner-container"), // El contenedor donde se mostrará la cámara
                constraints: {
                    facingMode: "environment" // Utiliza la cámara trasera
                }
            },
            locator: {
                patchSize: "medium",
                halfSample: true
            },
            numOfWorkers: navigator.hardwareConcurrency || 4,
            decoder: {
                readers: [
                    "code_128_reader", // Puedes agregar más tipos de lectores si es necesario
                    "ean_reader",
                    "ean_8_reader",
                    "code_39_reader",
                    "code_39_vin_reader",
                    "codabar_reader",
                    "upc_reader",
                    "upc_e_reader",
                    "i2of5_reader",
                    "2of5_reader",
                    "code_93_reader"
                ]
            },
            locate: true
        }, function(err) {
            if (err) {
                console.error("Error al iniciar Quagga: ", err);
                return;
            }
            console.log("Quagga iniciado correctamente");
            Quagga.start();
        });

        Quagga.onProcessed(function(result) {
            var drawingCtx = Quagga.canvas.ctx.overlay,
                drawingCanvas = Quagga.canvas.dom.overlay;

            if (result) {
                if (result.boxes) {
                    drawingCtx.clearRect(0, 0, drawingCanvas.width, drawingCanvas.height);
                    result.boxes.filter(function (box) {
                        return box !== result.box;
                    }).forEach(function (box) {
                        Quagga.ImageDebug.drawPath(box, {x: 0, y: 1}, drawingCtx, {color: "green", lineWidth: 2});
                    });
                }

                if (result.box) {
                    Quagga.ImageDebug.drawPath(result.box, {x: 0, y: 1}, drawingCtx, {color: "#00F", lineWidth: 2});
                }

                if (result.codeResult && result.codeResult.code) {
                    Quagga.ImageDebug.drawPath(result.line, {x: 'x', y: 'y'}, drawingCtx, {color: 'red', lineWidth: 3});
                }
            }
        });

        Quagga.onDetected(function(result) {
            var code = result.codeResult.code;
            console.log("Código de barras detectado:", code);
            
            // Mostrar el código detectado en la alerta
            var alertBox = document.getElementById("barcode-alert");
            alertBox.innerText = "Código de barras detectado: " + code;
            alertBox.classList.add("show");

            // Redirigir o procesar el código de barras detectado después de un breve retraso
            setTimeout(function() {
                window.location.href = "verificar_pago_tarjeta_pvc.php?codigo=" + code;
            }, 2000);
        });
    </script>
</body>
</html>
