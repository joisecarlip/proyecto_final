<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selección de Método de Pago</title>
    <link rel="stylesheet" href="styles/style_pago.css">
</head>
<body>
    <div class="pago">
        <div class="form">
            <h2>Seleccione su método de pago</h2>
            <form action="procesar_metodo_pago.php" method="POST">
                <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($_GET['nombre']); ?>">
                <input type="hidden" name="apellido" value="<?php echo htmlspecialchars($_GET['apellido']); ?>">
                <input type="hidden" name="correo" value="<?php echo htmlspecialchars($_GET['correo']); ?>">
                <input type="hidden" name="origen" value="<?php echo htmlspecialchars($_GET['origen']); ?>">
                <input type="hidden" name="destino" value="<?php echo htmlspecialchars($_GET['destino']); ?>">
                <input type="hidden" name="fecha" value="<?php echo htmlspecialchars($_GET['fecha']); ?>">
                <input type="hidden" name="cantidad_pasajes" value="<?php echo htmlspecialchars($_GET['cantidad_pasajes']); ?>">
                <input type="hidden" name="importe" value="<?php echo htmlspecialchars($_GET['importe']); ?>">
                <input type="hidden" name="total_a_pagar" value="<?php echo htmlspecialchars($_GET['total_a_pagar']); ?>">

                <div class="form-group">
                    <label for="metodo_pago_yape">
                        <input type="radio" id="metodo_pago_yape" name="metodo_pago" value="yape" required> Yape
                    </label>
                </div>
                <div class="form-group">
                    <label for="metodo_pago_tarjeta">
                        <input type="radio" id="metodo_pago_tarjeta" name="metodo_pago" value="tarjeta" required> Tarjeta de PVC de Código de Barras
                    </label>
                </div>
                <div class="boton">
                    <button type="submit">Siguiente</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
