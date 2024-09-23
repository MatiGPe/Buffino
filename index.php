<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: php/login/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buffino</title>
    <link rel="shortcut icon" href="assets/Imagenes/icono.png" />
    <link rel="stylesheet" href="assets/CSS/bienvenida.css">
    

</head>
<body>
    <nav>
        <div class="logo">
            <a href="index.php">Buffino</a>
        </div>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="php/pagina/add_receta.php">Agregar Receta</a></li>
            <li><a href="php/pagina/recetas.php">Mis Recetas</a></li>
            <li><a href="php/pagina/cerrar_sesion.php">Cerrar Sesión</a></li>
        </ul>
    </nav>

    <header>
        <h1>Bienvenido, <?php echo $_SESSION['usuario']; ?>!</h1>
    </header>

    <main>
        <section>
            <h2>Tus Recetas</h2>
            <!-- Aquí puedes agregar el código para mostrar las recetas del usuario -->
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Buffino. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
