<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Suad Team Gamer </title>
    <style>
        /* Estilo global */
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background: #3e0797;
            color: #ffffff;
            line-height: 1.6;
        }

        /* Contenedor principal */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 10px;
        }

        /* Cabecera */
        header {
            background: #6a1aeb;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            
        }

        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: #f7c24e;
            text-transform: uppercase;
        }

        nav a {
            color: #ffffff;
            text-decoration: none;
            margin: 0 15px;
            font-size: 1.1rem;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #ffd700;
        }

        /* Botón de acciones */
        .auth-buttons {
            display: flex;
            gap: 10px;
        }

        .auth-buttons button {
            padding: 10px 20px;
            border: none;
            background: #f7c24e;
            color: #1c1c1c;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .auth-buttons button:hover {
            background: #ffd700;
        }

        /* Publicaciones */
        .post {
            background: #2a2a2a;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .post img, .post video {
            max-width: 100%;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .post h3 {
            margin: 0 0 10px;
            color: #ffd700;
        }

        .post p {
            margin: 0;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 10px;
            margin-top: 20px;
            color: #ffffff;
            background: #6a1aeb;
        }

        /* Responsivo */
        @media (max-width: 768px) {
            header {
                flex-wrap: wrap;
                text-align: center;
            }

            nav {
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Cabecera -->
    <header>
        <div class="logo">      </div>
        <img src="mw3.png" alt="Icono Inicio" style="height: 40px;">
        <nav>
            <a href="#home.html">🏠Inicio</a>
            <a href="acerca de.html">Acerca de</a>
            <a href="services.html">Servicios</a>
            <a href="contact.html">Contacto</a>
        </nav>
        <div class="auth-buttons">
            <button onclick="location.href='login.html'">Iniciar Sesión</button>
            <button onclick="location.href='register.html'">Registrarse</button>
        </div>
    </header>

    <!-- Contenido Principal -->
    <div class="container">
        <h1>Bienvenido a Premium Gamer</h1>
        <p>La plataforma donde los gamers comparten sus mejores momentos. 🕹️</p>

        <!-- Publicaciones -->
        <div class="post">
            <h3>Mi Mejor Victoria en Fortnite</h3>
            <img src="fortnite-victory.jpg" alt="Victoria en Fortnite">
            <p>¡Logré una partida increíble! 🚀</p>
        </div>

        <div class="post">
            <h3>call of duty mw3</h3>
            <video controls>
                <source src="mw3.mp4" type="video/mp4">
                Tu navegador no soporta videos.
            </video>
            <form action="submit_comment.php" method="POST">
                <label for="comentario">Deja tu comentario:</label><br>
                <textarea id="comentario" name="comentario" rows="4" cols="50" required></textarea><br>
                <button type="submit">Enviar comentario</button>
            </form>
            
        </div>
        <!-- Aquí se incluirán los comentarios -->
        <?php include('php/display_comments.php'); ?>
    </div>

    <!-- Pie de página -->
    <footer>
        <p>&copy; 2024 Premium Gamer. Todos los derechos reservados.</p>
    </footer>
</body>
</html>