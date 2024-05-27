<?php
session_start();

// Verificar si los datos de la sesión existen
if (!isset($_SESSION['nombre']) || !isset($_SESSION['apellido']) || !isset($_SESSION['dni']) || !isset($_SESSION['origen']) || !isset($_SESSION['destino']) || !isset($_SESSION['fecha']) || !isset($_SESSION['cantidad_pasajes']) || !isset($_SESSION['importe']) || !isset($_SESSION['total_a_pagar'])) {
    // Si falta alguno de los datos, redirigir al usuario a la página de inicio o mostrar un mensaje de error
    header("Location: index.php"); // Cambia "index.php" por la página a la que quieras redirigir
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boleta Electrónica</title>
    <!-- Agrega tus estilos CSS aquí -->
    <style>
        /* Agrega tus estilos CSS aquí */
        .boleta {
            /* Estilos para el contenedor de la boleta */
        }
        /* Agrega más estilos según sea necesario */
    </style>
</head>
<body>
    <div class="boleta">
        <h2>Boleta Electrónica</h2>
        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($_SESSION['nombre']); ?></p>
        <p><strong>Apellido:</strong> <?php echo htmlspecialchars($_SESSION['apellido']); ?></p>
        <p><strong>DNI:</strong> <?php echo htmlspecialchars($_SESSION['dni']); ?></p>
        <p><strong>Origen:</strong> <?php echo htmlspecialchars($_SESSION['origen']); ?></p>
        <p><strong>Destino:</strong> <?php echo htmlspecialchars($_SESSION['destino']); ?></p>
        <p><strong>Fecha:</strong> <?php echo htmlspecialchars($_SESSION['fecha']); ?></p>
        <p><strong>Cantidad de Pasajes:</strong> <?php echo htmlspecialchars($_SESSION['cantidad_pasajes']); ?></p>
        <p><strong>Importe:</strong> <?php echo htmlspecialchars($_SESSION['importe']); ?></p>
        <p><strong>Total a Pagar:</strong> <?php echo htmlspecialchars($_SESSION['total_a_pagar']); ?></p>
        <!-- Agrega más detalles de la boleta si es necesario -->
    </div>
    
    <!-- Agrega un botón o enlace para imprimir la boleta -->
    <div class="print-button">
        <button onclick="window.print()">Imprimir Boleta Electrónica</button>
    </div>
</body>
</html>
