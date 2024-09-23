<?php 
session_start();
include '../conexion/conexion_be.php';



// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Obtener el nombre del usuario desde la sesión
$usuario = $_SESSION['usuario'];

// Consulta para obtener las recetas del usuario
$query = "SELECT * FROM recetas WHERE usuario = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Recetas</title>
    <link rel="shortcut icon" href="../assets/Imagenes/icono.png" />
    <link rel="stylesheet" href="Buffino\assets\CSS\recetas.css">
</head>
<body>
    <header>
        <nav>
            <a href="index.php" class="logo">Buffino</a>
            <ul>
            <li><a href="http://localhost/buffino/index.php">Inicio</a></li>
            <li><a href="add_receta.php">Agregar Receta</a></li>
            <li><a href="#">Mis Recetas</a></li>
            <li><a href="cerrar_sesion.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Mis Recetas</h1>
        <div class="recetas-container">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="receta-card">
                        <img src="assets/Imagenes/<?php echo htmlspecialchars($row['imagen']); ?>" alt="<?php echo htmlspecialchars($row['nombre']); ?>">
                        <div class="receta-info">
                            <h3><?php echo htmlspecialchars($row['nombre']); ?></h3>
                            <p><?php echo htmlspecialchars($row['descripcion']); ?></p>
                            <a href="ver_receta.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="button">Ver Receta</a>
                            <a href="php/eliminar_receta_be.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="button eliminar" onclick="return confirm('¿Estás seguro de que quieres eliminar esta receta?');">Eliminar</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No tienes recetas guardadas.</p>
            <?php endif; ?>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Buffino. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
