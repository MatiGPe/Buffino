<?php
session_start();
include '../conexion/conexion_be.php';



// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: ../index.php");
    exit();
}

$id = $_GET['id'];

// Verifica si la receta pertenece al usuario actual
$query = "SELECT imagen FROM recetas WHERE id = ? AND usuario = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("is", $id, $_SESSION['usuario']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: ../index.php");
    exit();
}

$receta = $result->fetch_assoc();

// Elimina la imagen asociada a la receta
$imagen_path = "../assets/Imagenes/" . $receta['imagen'];
if (file_exists($imagen_path)) {
    unlink($imagen_path);
}

// Elimina la receta de la base de datos
$query = "DELETE FROM recetas WHERE id = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: ../recetas.php");
?>
