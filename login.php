<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tarjeta";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['username'];
    $contrasena = md5($_POST['contrasena']); 

    $stmt = $conn->prepare("SELECT * FROM regitrar WHERE Usuario = ? AND Contraseña = ?");
    $stmt->bind_param("ss", $usuario, $contrasena);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: reservar/home.php");
        exit();
    } else {
        header("Location: index.php?error=not_found");
        exit();
    }

    $stmt->close();
}

mysqli_close($conn);
?>
