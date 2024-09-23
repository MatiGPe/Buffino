<?php
include '../conexion/conexion_be.php';



if (isset($_POST['search'])) {
    $search = $conexion->real_escape_string($_POST['search']);

    $query = "SELECT * FROM recetas WHERE LOWER(nombre) LIKE '%$search%' OR LOWER(ingredientes) LIKE '%$search%' OR LOWER(instrucciones) LIKE '%$search%'";
    $resultado = $conexion->query($query);

    $recetas = [];
    while ($fila = $resultado->fetch_assoc()) {
        $recetas[] = $fila;
    }

    echo json_encode($recetas);
}
?>
