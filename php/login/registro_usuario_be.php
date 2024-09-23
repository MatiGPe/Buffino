<?php
include '../conexion/conexion_be.php';



$usuario = $_POST['usuario'];
$nombre = $_POST['nombre'];
$mail = $_POST['mail'];
$clave = $_POST['clave'];

// Encriptamiento de contraseña
$clave = password_hash($clave, PASSWORD_DEFAULT);

$query = "INSERT INTO usuario (usuario, nombre, clave, mail) VALUES (?, ?, ?, ?)";
$stmt = $conexion->prepare($query);
$stmt->bind_param('ssss', $usuario, $nombre, $clave, $mail);

$verificar_correo = mysqli_query($conexion, "SELECT * FROM usuario WHERE mail='$mail'");
$verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuario WHERE usuario='$usuario'");

if(mysqli_num_rows($verificar_correo) > 0){
    echo '
        <script> 
            alert("Este correo ya está registrado. Intenta con otro diferente.");
            window.location = "login.php";
        </script>
    ';
    exit;
}

if(mysqli_num_rows($verificar_usuario) > 0){
    echo '
        <script> 
            alert("Este nombre de usuario ya está registrado. Intenta con otro diferente.");
            window.location = "login.php";
        </script>
    ';
    exit;
}

if ($stmt->execute()) {
    echo '
        <script>
            alert("Usuario registrado exitosamente.");
            window.location = "login.php";
        </script>
    ';
} else {
    echo '
        <script>
            alert("Error al registrar el usuario.");
            window.location = "login.php";
        </script>
    ';
}
?>
