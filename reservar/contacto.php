<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="stylesheet" href="/reservar/styles/style_contacto.css">
    <script src="https://kit.fontawesome.com/b408879b64.js" crossorigin="anonymous"></script>
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

    <div class="container">
        <div class="caja">
            <h1>Información de Contacto</h1>
            <div class="data">
                <p><strong>Telefono: </strong><i class=""></i>900212080</p>
                <p><strong>Email: </strong><i class=""></i>accopa@est.unap.edu.pe</p>
                <p><strong>Dirección: </strong><i class=""></i>Puno, Perú</p>
            </div>
            <div class="links">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
            <div class="referencias">
                <p><strong>Horario de Atención: </strong><i class=""></i>Lunes a Viernes, 9:00 AM - 6:00 PM</p>
                <p><strong>Ubicación: </strong><i class=""></i>mapa</p>
                <p><strong>Calificacion: </strong><i class=""></i></p>
            </div> 
        </div>
        <form>
            <div class="entrada">
                <input type="text" placeholder="Nombre y apellido" required>
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="entrada">
                <input type="email" required placeholder="Correo electrónico">
                <i class="fa-solid fa-envelope"></i>
            </div>
            <div class="entrada">
                <input type="text" placeholder="Asunto">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>
            <div class="entrada">
                <textarea placeholder="Escribe tu mensaje..."></textarea>
            </div>
            <button type="submit">Enviar mensaje</button>
        </form>
    </div>

    <!-- Otros elementos y scripts al final del cuerpo -->

    <script src="tu_script.js"></script>
</body>
</html>
