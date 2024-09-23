<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    echo '
        <script>
            alert("Por favor debes iniciar sesión");
            window.location = "../login.php";
        </script>
    ';
    session_destroy();
    die();
}

include 'conexion_be.php';

$id = $_GET['id'];
$sql = "SELECT * FROM recetas WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$resultado = $stmt->get_result();
$receta = $resultado->fetch_assoc();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $ingredientes = $_POST['ingredientes'];
    $instrucciones = $_POST['instrucciones'];
    $dificultad = $_POST['dificultad'];
    $tiempo = $_POST['tiempo'];
    $clasificacion = $_POST['clasificacion'];
    $imagen = $_FILES['imagen']['name'] ? $_FILES['imagen']['name'] : $receta['imagen'];
    $target = "../Imagenes/" . basename($imagen);
    if ($_FILES['imagen']['name']) {
        move_uploaded_file($_FILES['imagen']['tmp_name'], $target);
    }

    $sql = "UPDATE recetas SET nombre = ?, ingredientes = ?, instrucciones = ?, dificultad = ?, tiempo = ?, clasificacion = ?, imagen = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('sssssssi', $nombre, $ingredientes, $instrucciones, $dificultad, $tiempo, $clasificacion, $imagen, $id);

    if ($stmt->execute()) {
        echo '
            <script>
                alert("Receta actualizada exitosamente");
                window.location = "bienvenida.php";
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Error al actualizar la receta");
                window.location = "editar_receta.php?id=' . $id . '";
            </script>
        ';
    }

    $stmt->close();
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Receta</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Editar Receta</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($receta['nombre']); ?>" required>
            </div>
            <div class="form-group">
                <label for="ingredientes">Ingredientes</label>
                <textarea class="form-control" id="ingredientes" name="ingredientes" rows="3" required><?php echo htmlspecialchars($receta['ingredientes']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="instrucciones">Instrucciones</label>
                <textarea class="form-control" id="instrucciones" name="instrucciones" rows="3" required><?php echo htmlspecialchars($receta['instrucciones']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="dificultad">Dificultad</label>
                <select class="form-control" id="dificultad" name="dificultad" required>
                    <option value="Fácil" <?php echo $receta['dificultad'] == 'Fácil' ? 'selected' : ''; ?>>Fácil</option>
                    <option value="Medio" <?php echo $receta['dificultad'] == 'Medio' ? 'selected' : ''; ?>>Medio</option>
                    <option value="Difícil" <?php echo $receta['dificultad'] == 'Difícil' ? 'selected' : ''; ?>>Difícil</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tiempo">Tiempo</label>
                <input type="text" class="form-control" id="tiempo" name="tiempo" value="<?php echo htmlspecialchars($receta['tiempo']); ?>" required>
            </div>
            <div class="form-group">
                <label for="clasificacion">Clasificación</label>
                <input type="text" class="form-control" id="clasificacion" name="clasificacion" value="<?php echo htmlspecialchars($receta['clasificacion']); ?>" required>
            </div>
            <div class="form-group">
                <label for="imagen">Imagen</label>
                <input type="file" class="form-control-file" id="imagen" name="imagen">
                <img src="../Imagenes/<?php echo $receta['imagen']; ?>" alt="<?php echo htmlspecialchars($receta['nombre']); ?>" width="100" class="mt-2">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Receta</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
