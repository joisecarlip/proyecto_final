<?php
require('fpdf/fpdf.php');
require('/JsBarcode-master/dist/JsBarcode.all.min.js'); // Ajusta la ruta según donde tengas el archivo JsBarcode

// Recibir el ID_Usuario desde la URL
if (isset($_GET['id_usuario'])) {
    $id_usuario = $_GET['id_usuario'];

    // Consulta para obtener los datos de Usuario y Codigo_Barras
    $consulta = "SELECT u.ID_Usuario, u.Nombre, u.Apellido, u.Saldo, c.Codigo_Barras
                 FROM Usuario u
                 INNER JOIN Codigo_Barras c ON u.ID_Usuario = c.ID_Usuario
                 WHERE u.ID_Usuario = $id_usuario";

    $servidor = "localhost";
    $usuario = "root";
    $clave = "";
    $bd = "tarjeta";

    $conexion = mysqli_connect($servidor, $usuario, $clave, $bd);

    if (!$conexion) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);

        // Datos del usuario y código de barras
        $nombre = $fila['Nombre'];
        $apellido = $fila['Apellido'];
        $saldo = $fila['Saldo'];
        $codigo_barras = $fila['Codigo_Barras'];

        // Crear el objeto PDF
        class PDF extends FPDF
        {
            function Header()
            {
                // Cabecera del PDF
                $this->SetFont('Arial', 'B', 14);
                $this->Cell(0, 10, 'Código de Barras', 0, 1, 'C');
                $this->Ln(5);
            }

            function Footer()
            {
                // Pie de página
                $this->SetY(-15);
                $this->SetFont('Arial', 'I', 8);
                $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
            }
        }

        // Crear el objeto PDF
        $pdf = new PDF();
        $pdf->AddPage();

        // Mostrar datos del usuario
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, "Nombre: $nombre $apellido", 0, 1);
        $pdf->Cell(0, 10, "Saldo: S/. $saldo", 0, 1);

        // Generar el código de barras localmente
        ?>
        <script>
            // Generar el código de barras usando JsBarcode
            JsBarcode("#barcode", "<?php echo $codigo_barras; ?>");
        </script>
        <?php

        // Incluir el código de barras generado
        // Ajusta el tamaño y la posición según tus necesidades
        $pdf->Image('path/to/generated-barcode.png', 10, 30, 180, 15, 'PNG');

        // Salida del PDF
        $pdf->Output();

    } else {
        echo "No se encontraron datos para el usuario.";
    }

    mysqli_close($conexion);
} else {
    echo "ID de usuario no proporcionado.";
}
?>
