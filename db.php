<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tarjeta";

// Crear conexión
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if (isset($_POST['enviar'])) {
    $usuario = $_POST['username'];
    $contrasena = $_POST['contrasena'];
    $conf_contraseña = $_POST['conf_contrasena'];

    $contrasena_md5 = md5($contrasena);
    $conf_contraseña_md5 = md5($conf_contraseña);

    if ($contrasena === $conf_contraseña) {
        $stmt = $conn->prepare("INSERT INTO regitrar (Usuario, Contraseña, conf_contraseña) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $usuario, $contrasena_md5, $conf_contraseña_md5);

        if ($stmt->execute()) {
            header("Location: index.php?registro=exitoso");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Las contraseñas no coinciden.";
    }
    
    mysqli_close($conn);
}
?>
