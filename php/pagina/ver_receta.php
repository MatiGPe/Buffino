<?php 
session_start();
include '../conexion/conexion_be.php';



// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// Consulta para obtener la receta por ID
$query = "SELECT * FROM recetas WHERE id = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: index.php");
    exit();
}

$receta = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($receta['nombre']); ?></title>
    <link rel="shortcut icon" href="../assets/Imagenes/icono.png" />
    <link rel="stylesheet" href="../assets/CSS/ver_receta.css">
</head>
<body>
    <header>
        <nav>
            <a href="index.php" class="logo">Buffino</a>
            <ul>
            <li><a href="http://localhost/buffino/index.php">Inicio</a></li>
            <li><a href="add_receta.php">Agregar Receta</a></li>
            <li><a href="recetas.php">Mis Recetas</a></li>
            <li><a href="cerrar_sesion.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="receta-detalle">
            <img src="assets/Imagenes/<?php echo htmlspecialchars($receta['imagen']); ?>" alt="<?php echo htmlspecialchars($receta['nombre']); ?>">
            <h1><?php echo htmlspecialchars($receta['nombre']); ?></h1>
            <p><strong>Descripción:</strong> <?php echo htmlspecialchars($receta['descripcion']); ?></p>
            <p><strong>Instrucciones:</strong> <?php echo htmlspecialchars($receta['instrucciones']); ?></p>
            <p><strong>Tiempo de Preparación:</strong> <?php echo htmlspecialchars($receta['tiempo']); ?></p>
            <p><strong>Tipo:</strong> <?php echo htmlspecialchars($receta['tipo']); ?></p>
            <p><strong>Clasificación:</strong> <?php echo htmlspecialchars($receta['clasificacion']); ?></p>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Buffino. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
