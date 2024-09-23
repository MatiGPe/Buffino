<?php
session_start();
include '../conexion/conexion_be.php';



// Verifica si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    echo '
        <script>
            alert("Por favor debes iniciar sesión");
            window.location = "login.php";
        </script>
    ';
    session_destroy();
    exit();
}

$id = $_GET['id'];
$query = "SELECT * FROM recetas WHERE id = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();
$resultado = $stmt->get_result();
$receta = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($receta['nombre']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> 
    <link rel="shortcut icon" href="../assets/Imagenes/icono.png" />
     <link rel="stylesheet" href="../assets/CSS/receta.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <h5><a href="index.php">Inicio</a></h5>
                <h5><a href="add_receta.php">Agregar Receta</a></h5>
                <h5><a href="recetas.php">Recetas</a></h5>
                <h5><a href="#">Contactos</a></h5>
                <h5><a href="php/logout.php">Cerrar Sesión</a></h5>
            </ul>
        </nav>
    </header>
    <main>
        <section class="receta-detalle">
            <div class="container">
                <h2><?php echo htmlspecialchars($receta['nombre']); ?></h2>
                <?php if (!empty($receta['imagen'])) { ?>
                    <img src="assets/Imagenes/<?php echo htmlspecialchars($receta['imagen']); ?>" alt="<?php echo htmlspecialchars($receta['nombre']); ?>" class="img-fluid">
                <?php } else { ?>
                    <img src="assets/Imagenes/default.jpg" alt="Imagen por defecto" class="img-fluid">
                <?php } ?>
                <p><strong>Descripción:</strong> <?php echo htmlspecialchars($receta['descripcion'] ?? 'Descripción no disponible'); ?></p>
                <p><strong>Instrucciones:</strong> <?php echo htmlspecialchars($receta['instrucciones'] ?? 'Instrucciones no disponibles'); ?></p>
                <p><strong>Tiempo de Preparación:</strong> <?php echo htmlspecialchars($receta['tiempo'] ?? 'Tiempo no disponible'); ?></p>
                <p><strong>Clasificación:</strong> <?php echo htmlspecialchars($receta['clasificacion'] ?? 'Clasificación no disponible'); ?></p>
                <?php if ($_SESSION['usuario'] === 'admin' || $_SESSION['usuario'] === $receta['usuario']) { ?>
                    <a href="php/eliminar_receta.php?id=<?php echo $receta['id']; ?>" class="btn btn-danger">Eliminar Receta</a>
                <?php } ?>
            </div>
        </section>
    </main>
    <footer>
        <p>Contactos</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-mQ93dO+G1W5rfYQ4sFY1q9D8+H1kpAnq8I09QQRfJwLZtTfQ23D7bZmcb5k7jUGy" crossorigin="anonymous"></script>
</body>
</html>
