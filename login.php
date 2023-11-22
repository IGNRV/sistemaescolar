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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <!-- Incluye Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-container {
            max-width: 400px; /* Ancho máximo para el formulario */
        }
        .btn-custom {
            width: 50%; /* Ancho personalizado para el botón */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="form-container">
                    <h2 class="text-center">Iniciar sesión</h2>
                    <form method="post" action="login.php" class="mt-4">
                        <div class="form-group">
                            <label for="usuario">Usuario:</label>
                            <input type="text" class="form-control" name="usuario" required>
                        </div>
                        <div class="form-group">
                            <label for="pass">Contraseña:</label>
                            <input type="password" class="form-control" name="pass" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-custom">Iniciar sesión</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Opcional: Incluye jQuery y Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
