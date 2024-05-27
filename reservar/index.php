<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$bd = "tarjeta";

$conexion = mysqli_connect($servidor, $usuario, $clave, $bd);

if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['form_type']) && $_POST['form_type'] == 'reservation') {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $apellido = mysqli_real_escape_string($conexion, $_POST['apellido']);
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']); 
    $fecha = mysqli_real_escape_string($conexion, $_POST['fecha']);
    $origen = mysqli_real_escape_string($conexion, $_POST['origen']);
    $destino = mysqli_real_escape_string($conexion, $_POST['destino']);
    $cantidad_pasajes = (int)$_POST['cantidad_pasajes'];
    $importe = (float)$_POST['importe'];
    $total_a_pagar = (float)$_POST['total_a_pagar'];
    $modalidad_pago = mysqli_real_escape_string($conexion, $_POST['modalidad_pago']);

    $fechaMySQL = date("Y-m-d", strtotime($fecha));

    $consultaUsuario = "INSERT INTO usuarioresev (nombre, apellido, correo) VALUES ('$nombre', '$apellido', '$correo')";
    mysqli_query($conexion, $consultaUsuario);

    $consultaFecha = "INSERT INTO fecha (fecha) VALUES ('$fechaMySQL')";
    mysqli_query($conexion, $consultaFecha);

    header("Location: pago.php?nombre=$nombre&apellido=$apellido&correo=$correo&origen=$origen&destino=$destino&fecha=$fecha&cantidad_pasajes=$cantidad_pasajes&importe=$importe&total_a_pagar=$total_a_pagar&modalidad_pago=$modalidad_pago");
    exit();
}

$consultaOrigen = "SELECT origen, importe FROM origen";
$resultadoOrigen = mysqli_query($conexion, $consultaOrigen);

$origenes = [];
if (mysqli_num_rows($resultadoOrigen) > 0) {
    while ($row = mysqli_fetch_assoc($resultadoOrigen)) {
        $origenes[] = $row;
    }
}

$consultaDestino = "SELECT origen, importe FROM destinos";
$resultadoDestino = mysqli_query($conexion, $consultaDestino);

$destinos = [];
if (mysqli_num_rows($resultadoDestino) > 0) {
    while ($row = mysqli_fetch_assoc($resultadoDestino)) {
        $destinos[] = $row;
    }
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Reservaciones</title>
    <link rel="stylesheet" href="styles/style.css">
    <script>
        const destinos = <?php echo json_encode($destinos); ?>;

        function actualizarDestinos() {
            const origenSelect = document.getElementById('origen');
            const destinoSelect = document.getElementById('destino');
            const origenSeleccionado = origenSelect.value;
            destinoSelect.innerHTML = '<option value="">Seleccione su destino</option>';
            destinos.forEach(destino => {
                if (destino.origen !== origenSeleccionado) {
                    const option = document.createElement('option');
                    option.value = destino.origen;
                    option.textContent = destino.origen;
                    destinoSelect.appendChild(option);
                }
            });
        }

        function actualizarImporte() {
            const destinoSelect = document.getElementById('destino');
            const importeInput = document.getElementById('importe');
            const destinoSeleccionado = destinoSelect.value;
            const destino = destinos.find(d => d.origen === destinoSeleccionado);
            if (destino) {
                importeInput.value = destino.importe;
            }
        }

        function calcularTotal() {
            const importe = parseFloat(document.getElementById('importe').value);
            const cantidadPasajes = parseInt(document.getElementById('cantidad_pasajes').value);
            const total = importe * cantidadPasajes;
            document.getElementById('total_a_pagar').value = total.toFixed(2);
        }

        function validarYMostrarPago(event) {
            event.preventDefault();
            document.getElementById('form').submit();
        }
    </script>
</head>
<body>
    <header class="header">
        <div class="container">
            <nav class="nav">
                <ul>
                    <li><a href="home.php">Inicio</a></li>
                    <li><a href="index.php">Reservaciones</a></li>
                    <li><a href="/tarjeta/index.php">Procesos</a></li>
                    <li><a href="contacto.php">Contacto</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="reservaciones">
        <div class="form">
            <h2>Ventas</h2>
            <form id="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" name="form_type" value="reservation">
                <div class="form-group">
                    <label for="asientos_disponibles">ASIENTOS DISPONIBLES:</label>
                    <input type="text" id="asientos_disponibles" name="asientos_disponibles" value="15" readonly>
                </div>
                <div class="form-group">
                    <label for="nombre">NOMBRES:</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Ingrese su nombre" required>
                </div>
                <div class="form-group">
                    <label for="apellido">APELLIDOS:</label>
                    <input type="text" id="apellido" name="apellido" placeholder="Ingrese su apellido" required>
                </div>
                <div class="form-group">
                    <label for="origen">ORIGEN:</label>
                    <select name="origen" id="origen" onchange="actualizarDestinos()" required>
                        <option value="">Seleccione</option>
                        <?php foreach ($origenes as $origen) { ?>
                            <option value="<?php echo $origen['origen']; ?>"><?php echo $origen['origen']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="destino">DESTINO:</label>
                    <select name="destino" id="destino" onchange="actualizarImporte()" required>
                        <option value="">Seleccione</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="importe">IMPORTE:</label>
                    <input type="number" id="importe" name="importe" placeholder="Ingrese el importe" required readonly>
                </div>
                <div class="form-group">
                    <label for="cantidad_pasajes">N° DE ASIENTOS:</label>
                    <input type="number" id="cantidad_pasajes" name="cantidad_pasajes" placeholder="Ingrese la cantidad de pasajes" required onchange="calcularTotal()">
                </div>
                <div class="form-group">
                    <label for="fecha">FECHA:</label>
                    <input type="date" id="fecha" name="fecha" placeholder="Ingrese la fecha" required>
                </div>
                <div class="form-group">
                    <label for="correo">Correo electrónico (Google):</label>
                    <input type="email" id="correo" name="correo" placeholder="Ingrese su correo electrónico" required>
                </div>
                <div class="boton">
                    <button type="submit" onclick="validarYMostrarPago(event)">Siguiente</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
