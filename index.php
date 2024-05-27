<?php
    include("db.php");

    if (isset($_GET['registro']) && $_GET['registro'] == 'exitoso') {
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        title: "Registro exitoso",
                        text: "El usuario ha sido registrado correctamente.",
                        icon: "success"
                    }).then(() => {
                        window.location.href = "reservar/home.php";
                    });
                });
            </script>';
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="/style/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="#inicio">Iniciar sesión</a></li>
                <li><a href="#registro">Registrar</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <div class="form-container active" id="inicio">
            <div class="image-container">
                <img src="/image/logo.png" alt="Descripción de la imagen">
            </div>
            <form action="login.php" method="post">
                <h1>Iniciar Sesión</h1>
                <div class="inp">
                    <label for="username">Usuario:</label>
                    <input type="text" name="username" placeholder="nombre" required>
                </div>
                <div class="inp">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" name="contrasena" placeholder="Contraseña" required>
                </div>
                <div class="inp">
                    <button type="submit">Iniciar sesión</button>
                </div>
                <div class="inp">
                    <p>¿No tienes una cuenta? <a href="#registro">Regístrate aquí</a></p>
                </div> 
            </form>
        </div>
        <div class="form-container" id="registro">
            <div class="image-container">
                <img src="/image/tarjeta" alt="Descripción de la imagen">
            </div>
            <form action="db.php" method="post">
                <h1>Regístrate</h1>
                <div class="inp">
                    <label for="username">Usuario:</label>
                    <input type="text" name="username" placeholder="nombre" required>
                </div>
                <div class="inp">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" name="contrasena" placeholder="Contraseña" required>
                </div>
                <div class="inp">
                    <label for="conf_contrasena">Confirmar contraseña:</label>
                    <input type="password" name="conf_contrasena" placeholder="Confirmar contraseña" required>
                </div>
                <div class="inp">
                    <button type="submit" name="enviar">Registrar</button>
                </div>
                <div class="inp">
                    <p>¿Tienes una cuenta? <a href="#inicio">Entrar</a></p>
                </div> 
            </form>
        </div>
    </div>

    <script>
        document.querySelectorAll('nav ul li a').forEach(item => {
            item.addEventListener('click', function(event) {
                event.preventDefault();
                let target = this.getAttribute('href').substring(1);
                document.querySelectorAll('.form-container').forEach(form => {
                    form.classList.remove('active');
                    if (form.id === target) {
                        form.classList.add('active');
                    }
                });
            });
        });

        // Mostrar el formulario de inicio de sesión por defecto
        document.querySelector('#inicio').classList.add('active');
    </script>

    <?php if (isset($_GET['error']) && $_GET['error'] == 'not_found'): ?>
        <script>
            Swal.fire({
                title: 'Cuenta no existe',
                text: 'La cuenta no se encuentra registrada.',
                icon: 'error'
            });
        </script>
    <?php endif; ?>
</body>
</html>
