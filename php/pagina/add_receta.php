<?php
session_start();

// Verifica si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: ../php/login/login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Receta</title>
    <link rel="shortcut icon" href="Buffino/assets/Imagenes/icono.png" />
    <link rel="stylesheet" href="../assets/CSS/add_receta.css">
    

</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="http://localhost/buffino/index.php">Inicio</a></li>
                <li><a href="#">Agregar Receta</a></li>
                <li><a href="recetas.php">Mis Recetas</a></li>
                <li><a href="cerrar_sesion.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Agregar Nueva Receta</h1>
        <form action="add_receta_be.php" method="POST" enctype="multipart/form-data">
            <div>
                <label for="nombre">Nombre de la Receta:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div>
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" rows="4" required></textarea>
            </div>
            <div>
                <label for="instrucciones">Instrucciones:</label>
                <textarea id="instrucciones" name="instrucciones" rows="4" required></textarea>
            </div>
            <div>
                <label for="tiempo">Tiempo de Preparación:</label>
                <input type="text" id="tiempo" name="tiempo" required>
            </div>
            <div>
                <label for="tipo">Tipo de Receta:</label>
                <input type="text" id="tipo" name="tipo" required>
            </div>
            <div>
                <label for="clasificacion">Clasificación:</label>
                <input type="text" id="clasificacion" name="clasificacion" required>
            </div>
            <div>
                <label for="imagen">Imagen (opcional):</label>
                <input type="file" id="imagen" name="imagen">
            </div>
            <button type="submit">Agregar Receta</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Buffino</p>
    </footer>
</body>
</html>
