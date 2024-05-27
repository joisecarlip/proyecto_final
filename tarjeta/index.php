<?php include("conexion.php"); 
    if (isset($_GET['registro']) && $_GET['registro'] == 'exitoso') {
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        title: "Recarga exitosa",
                        text: "Su recarga de saldo ha sido exitosa.",
                        icon: "success"
                    })
                });
            </script>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="style.css">
    <script>
        function formatToTwoDecimals(event) {
            let input = event.target;
            let value = parseFloat(input.value);
            if (!isNaN(value)) {
                input.value = value.toFixed(2);
            }
        }

        function generarCodigoBarras(codigoBarras, idElemento) {
            JsBarcode("#barcode-" + idElemento, codigoBarras);
        }

        
    </script>
</head>
<body>
    <header class="header">
        <div class="container">
            <img src="" alt="Logo" class="logo">
            <nav class="nav">
                <ul>
                    <li><a href="/reservar/home.php">Inicio</a></li>
                    <li><a href="/reservar/index.php">Reservaciones</a></li>
                    <li><a href="/tarjeta/index.php">Procesos</a></li>
                    <li><a href="/reservar/contacto.php">Contacto</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="form-container">
        <div class="form" id="form">
            <h2>Registro de Usuario</h2>
            <form method="POST" action="">
                <div class="grupo-registro">
                    <label for="nombres">Nombre:</label>
                    <input type="text" id="nombres" name="nombres" placeholder="Ingrese su nombre" required>
                </div>
                <div class="grupo-registro">
                    <label for="apellidos">Apellido:</label>
                    <input type="text" id="apellidos" name="apellidos" placeholder="Ingrese su apellido" required>
                </div>
                <div class="grupo-registro">
                    <label for="saldo">Monto (S/.):</label>
                    <input type="number" id="saldo" name="saldo" placeholder="00.00" step="0.01" onblur="formatToTwoDecimals(event)" required>
                </div>
                <div class="boton">
                    <button type="submit" onclick="mostrar(event)">Registrar</button>
                </div>
            </form>
        </div>
        <div class="recarga">
            <h2>Recarga de Usuario</h2>
            <form method="POST" action="conexion.php">
                <div class="grupo-recarga">
                    <label for="id_usuario">ID de Usuario:</label>
                    <input type="number" id="id_usuario" name="id_usuario" placeholder="Ingrese el ID de Usuario" required>
                </div>
                <div class="grupo-recarga">
                    <label for="saldo">Monto (S/.):</label>
                    <input type="number" id="recarga_saldo" name="recarga_saldo" placeholder="00.00" step="0.01" onblur="formatToTwoDecimals(event)" required>
                </div>
                <div class="boton">
                    <button type="submit">Recargar</button>
                </div>
            </form>
        </div>
    </div>
    <div class="data">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Monto</th>
                    <th>Código de Barras</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = mysqli_fetch_assoc($resultado)) { ?>
                    <tr>
                        <td><?php echo $fila['ID_Usuario']; ?></td>
                        <td><?php echo $fila['Nombre']; ?></td>
                        <td><?php echo $fila['Apellido']; ?></td>
                        <td><?php echo $fila['Saldo']; ?></td>
                        <td>
                            <svg id="barcode-<?php echo $fila['ID_Usuario']; ?>"></svg>
                            <script>generarCodigoBarras('<?php echo $fila['Codigo_Barras']; ?>', '<?php echo $fila['ID_Usuario']; ?>');</script>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
