<?php
// Incluye la conexión a la base de datos
require_once 'db.php';

// Inicia sesión
session_start();

// Verifica si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $conn->real_escape_string($_POST['usuario']);
    $pass = $conn->real_escape_string($_POST['pass']);

    // Busca el usuario en la base de datos
    $sql = "SELECT id, usuario, nombre FROM usuarios WHERE usuario = '{$usuario}' AND pass = '{$pass}'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Usuario encontrado
        $userData = $result->fetch_assoc();
        $_SESSION['usuario'] = $userData['usuario'];
        $_SESSION['nombre'] = $userData['nombre'];
        // Redirecciona a la página protegida
        header('Location: bienvenido.php');
        exit;
    } else {
        // Usuario no encontrado o contraseña incorrecta
        echo "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <form method="post" action="login.php">
        Usuario: <input type="text" name="usuario" required><br>
        Contraseña: <input type="password" name="pass" required><br>
        <input type="submit" value="Iniciar sesión">
    </form>
</body>
</html>
