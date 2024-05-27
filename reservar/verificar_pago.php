<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$codigo_barras = $data['codigo_barras'];

$servidor = "localhost";
$usuario = "root";
$clave = "";
$bd = "transporte";

$conexion = mysqli_connect($servidor, $usuario, $clave, $bd);

if (!$conexion) {
    echo json_encode(['success' => false, 'message' => 'Error en la conexión a la base de datos']);
    exit();
}

$consulta = "SELECT * FROM pagos WHERE codigo_barras = '$codigo_barras' AND estado = 'pagado'";
$resultado = mysqli_query($conexion, $consulta);

if (mysqli_num_rows($resultado) > 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Pago no encontrado o no verificado']);
}

mysqli_close($conexion);
?>
