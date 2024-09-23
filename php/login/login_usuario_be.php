<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

include '../conexion/conexion_be.php';

session_start();

if (isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail = $_POST['mail'];
    $clave = $_POST['clave'];

    if (empty($mail) || empty($clave)) {
        echo '
            <script>
                alert("Por favor complete todos los campos.");
                window.location = "../login.php";
            </script>
        ';
        exit();
    }

    $query = "SELECT * FROM usuario WHERE mail = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('s', $mail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($clave, $row['clave'])) {
            $_SESSION['usuario'] = $row['usuario'];
            header('Location: http://localhost/buffino/');  
            exit();
        } else {
            echo '
                <script>
                    alert("Email o contraseña incorrectos.");
                    window.location = "../login.php";
                </script>
            ';
        }
    } else {
        echo '
            <script>
                alert("Email o contraseña incorrectos.");
                window.location = "../login.php";
            </script>
        ';
    }
}
?>
