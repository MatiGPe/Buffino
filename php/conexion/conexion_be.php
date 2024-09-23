<?php
// Ruta absoluta para la base de datos en Glitch
$databasePath = __DIR__ . '/../../buffino.db';

try {
    // Crear la conexión
    $conexion = new PDO("sqlite:$databasePath");
    
    // Configurar excepciones en errores
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Mostrar el error si ocurre
    echo "Error de conexión: " . $e->getMessage();
    exit();
}
?>
