<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $_SESSION['mensaje'] = "Imagen enviada correctamente.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago con Yape</title>
    <link rel="stylesheet" href="/reservar/styles/style_pago_yape.css">
</head>
<body>
    <div class="pago">
        <div class="form">
            <h2>Pago con Yape</h2>
            <p>Escanee el siguiente código QR para realizar su pago:</p>
            <!-- Código QR para el pago con Yape -->
            <img src="image.png" alt="Código QR Yape" class="qr-code">
            <p>Una vez completado el pago, suba una imagen de confirmación y haga clic en el siguiente botón para verificar:</p>
            <form action="pago_yape.php" method="POST" enctype="multipart/form-data">
                <!-- Campos ocultos con los datos de la reserva -->
                <input type="hidden" name="nombre" value="<?php echo $_GET['nombre'] ?? ''; ?>">
                <input type="hidden" name="apellido" value="<?php echo $_GET['apellido'] ?? ''; ?>">
                <input type="hidden" name="correo" value="<?php echo $_GET['correo'] ?? ''; ?>">
                <input type="hidden" name="origen" value="<?php echo $_GET['origen'] ?? ''; ?>">
                <input type="hidden" name="destino" value="<?php echo $_GET['destino'] ?? ''; ?>">
                <input type="hidden" name="fecha" value="<?php echo $_GET['fecha'] ?? ''; ?>">
                <input type="hidden" name="cantidad_pasajes" value="<?php echo $_GET['cantidad_pasajes'] ?? ''; ?>">
                <input type="hidden" name="importe" value="<?php echo $_GET['importe'] ?? ''; ?>">
                <input type="hidden" name="total_a_pagar" value="<?php echo $_GET['total_a_pagar'] ?? ''; ?>">
                <!-- Campo de carga de archivo -->
                <div class="file-input">
                    <input type="file" name="comprobante_pago" accept="image/*" id="file" required>
                    <label for="file" id="file-label">Seleccionar archivo</label>
                </div>
                <div class="boton">
                    <button type="submit">Enviar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script de SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const fileInput = document.getElementById('file');
        const fileLabel = document.getElementById('file-label');

        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                fileLabel.textContent = this.files[0].name;
            }
        });

        // Mostrar SweetAlert2 si hay un mensaje de sesión
        <?php
        if (isset($_SESSION['mensaje'])) {
            echo 'mostrarSweetAlert();';
            unset($_SESSION['mensaje']); // Limpiar la sesión después de mostrar la alerta
        }
        ?>

        function mostrarSweetAlert() {
            Swal.fire({
                icon: 'success',
                title: '¡Pago enviado!',
                text: 'Su comprobante de pago ha sido enviado correctamente.',
                showConfirmButton: false,

            });
        }
    </script>
</body>
</html>
