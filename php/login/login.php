<?php
session_start();

// Redirige a la página de inicio si el usuario ya está autenticado
if (isset($_SESSION['usuario'])) {
    header("Location: index.php"); // Ajusta la ruta si es necesario
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Registro</title>
    <link rel="stylesheet" href="/buffino/assets/CSS/login.css">
</head>
<body>
    <div class="container">
        <div class="container-form">
            <form action="login_usuario_be.php" method="POST" class="sign-in">
                <h2>Iniciar Sesión</h2>
                <div class="social-networks">
                    <ion-icon name="logo-instagram"></ion-icon>
                    <ion-icon name="logo-facebook"></ion-icon>
                    <ion-icon name="logo-twitter"></ion-icon>
                </div>
                <span>Usa tu correo y contraseña</span>
                <div class="container-input">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="email" placeholder="Email" name="mail" required>
                </div>
                <div class="container-input">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" placeholder="Contraseña" name="clave" required>
                </div>
                <a href="#">¿Olvidaste tu contraseña?</a>
                <button class="button" type="submit">Iniciar Sesión</button>
            </form>
        </div>
        <div class="container-form">
            <form action="registro_usuario_be.php" method="POST" class="sign-up">
                <h2>Registro</h2>
                <div class="social-networks">
                    <ion-icon name="logo-instagram"></ion-icon>
                    <ion-icon name="logo-facebook"></ion-icon>
                    <ion-icon name="logo-twitter"></ion-icon>
                </div>
                <span>Usa tu correo electrónico para registrarte</span>
                <div class="container-input">
                    <ion-icon name="person-outline"></ion-icon>
                    <input type="text" placeholder="Usuario" name="usuario" required>
                </div>
                <div class="container-input">
                    <ion-icon name="person-outline"></ion-icon>
                    <input type="text" placeholder="Nombre" name="nombre" required>
                </div>
                <div class="container-input">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" placeholder="Contraseña" name="clave" required>
                </div>
                <div class="container-input">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="email" placeholder="Email" name="mail" required>
                </div>
                <button class="button" type="submit">Registrarse</button>
            </form>
        </div>
        <div class="container-welcome">
            <div class="welcome-sign-up welcome">
                <h3>¡Bienvenido!</h3>
                <p>Ingresa tus datos personales para usar todas las funciones del sitio</p>
                <button class="button" id="btn-sign-up">Registrarse</button>
            </div>
            <div class="welcome-sign-in welcome">
                <h3>¡Hola!</h3>
                <p>Regístrate con tus datos personales para usar todas las funciones del sitio</p>
                <button class="button" id="btn-sign-in">Iniciar Sesión</button>
            </div>
        </div>
    </div>
    <script src="/buffino/assets/Scripts/JS/login.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
