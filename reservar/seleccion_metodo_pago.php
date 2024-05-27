<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selección de Método de Pago</title>
</head>
<body>
    <h2>Seleccione su método de pago</h2>
    <form action="procesar_metodo_pago.php" method="POST">
        <input type="hidden" name="nombre" value="<?php echo $_GET['nombre']; ?>">
        <input type="hidden" name="apellido" value="<?php echo $_GET['apellido']; ?>">
        <input type="hidden" name="correo" value="<?php echo $_GET['correo']; ?>">
        <input type="hidden" name="origen" value="<?php echo $_GET['origen']; ?>">
        <input type="hidden" name="destino" value="<?php echo $_GET['destino']; ?>">
        <input type="hidden" name="fecha" value="<?php echo $_GET['fecha']; ?>">
        <input type="hidden" name="cantidad_pasajes" value="<?php echo $_GET['cantidad_pasajes']; ?>">
        <input type="hidden" name="importe" value="<?php echo $_GET['importe']; ?>">
        <input type="hidden" name="total_a_pagar" value="<?php echo $_GET['total_a_pagar']; ?>">
        <label for="metodo_pago_yape"><input type="radio" id="metodo_pago_yape" name="metodo_pago" value="yape"> Yape</label><br>
        <label for="metodo_pago_tarjeta"><input type="radio" id="metodo_pago_tarjeta" name="metodo_pago" value="tarjeta"> Tarjeta de PVC de Código de Barras</label><br>
        <button type="submit">Siguiente</button>
    </form>
</body>
</html>
