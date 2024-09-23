<?php
session_start();
include '../conexion/conexion_be.php';



$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$instrucciones = $_POST['instrucciones'];
$tiempo = $_POST['tiempo'];
$tipo = $_POST['tipo'];
$clasificacion = $_POST['clasificacion'];
$usuario = $_SESSION['usuario'];

// Manejo de la imagen
$imagen = $_FILES['imagen']['name'];
$target_dir = "../assets/Imagenes/";
$target_file = $target_dir . basename($imagen);

// Verificar y crear el directorio si no existe
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Mover el archivo a la carpeta
if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
    $query = "INSERT INTO recetas (nombre, descripcion, instrucciones, tiempo, tipo, clasificacion, imagen, usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("ssssssss", $nombre, $descripcion, $instrucciones, $tiempo, $tipo, $clasificacion, $imagen, $usuario);

    if ($stmt->execute()) {
        echo '<script>
                alert("Receta agregada exitosamente");
                window.location = "../index.php";
              </script>';
    } else {
        echo '<script>
                alert("Error al agregar la receta");
                window.location = "../add_receta.php";
              </script>';
    }

    $stmt->close();
    $conexion->close();
} else {
    echo '<script>
            alert("Error al subir la imagen");
            window.location = "../add_receta.php";
          </script>';
}
?>
