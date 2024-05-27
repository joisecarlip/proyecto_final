<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$bd = "tarjeta";

$conexion = mysqli_connect($servidor, $usuario, $clave, $bd);

if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Inicializar $resultado como variable vacía para evitar errores si no se ha hecho una consulta aún
$resultado = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nombres']) && isset($_POST['apellidos']) && isset($_POST['saldo'])) {
        // Registro de usuario
        $nombres = mysqli_real_escape_string($conexion, $_POST['nombres']);
        $apellidos = mysqli_real_escape_string($conexion, $_POST['apellidos']);
        $saldo = mysqli_real_escape_string($conexion, $_POST['saldo']);

        $consultaUser = "INSERT INTO Usuario (Nombre, Apellido, Saldo) VALUES ('$nombres', '$apellidos', '$saldo')";
        if (mysqli_query($conexion, $consultaUser)) {
            // Obtener el ID_Usuario generado
            $id_usuario = mysqli_insert_id($conexion);

            // Generar un código de barras
            $codigo_barras = "CB-" . uniqid();

            // Consulta para insertar el código de barras asociado al usuario
            $consultaCodigo = "INSERT INTO Codigo_Barras (ID_Usuario, Codigo_Barras) VALUES ($id_usuario, '$codigo_barras')";
            if (mysqli_query($conexion, $consultaCodigo)) {
                echo"";
            } else {
                echo "Error al insertar el código de barras: " . mysqli_error($conexion);
            }
        } else {
            echo "Error al insertar el usuario: " . mysqli_error($conexion);
        }
    } elseif (isset($_POST['id_usuario']) && isset($_POST['recarga_saldo'])) {
        // Recarga de saldo
        $id_usuario = mysqli_real_escape_string($conexion, $_POST['id_usuario']);
        $recarga_saldo = mysqli_real_escape_string($conexion, $_POST['recarga_saldo']);

        // Actualizar el saldo del usuario
        $consultaSaldo = "UPDATE Usuario SET Saldo = Saldo + $recarga_saldo WHERE ID_Usuario = $id_usuario";
        if (mysqli_query($conexion, $consultaSaldo)) {
            header("Location: index.php?registro=exitoso");
            exit();
        } else {
            echo "Error al recargar el saldo: " . mysqli_error($conexion);
        }
    }
}

// Consulta para obtener los datos de Usuario y Codigo_Barras
$consulta = "SELECT u.ID_Usuario, u.Nombre, u.Apellido, u.Saldo, c.Codigo_Barras
            FROM Usuario u
            INNER JOIN Codigo_Barras c ON u.ID_Usuario = c.ID_Usuario";

$resultado = mysqli_query($conexion, $consulta);

if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

mysqli_close($conexion);
?>
