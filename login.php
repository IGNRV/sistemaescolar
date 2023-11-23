<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Incluye la conexión a la base de datos
require_once 'db.php';

// Inicia sesión
session_start();

// Variable para almacenar el mensaje de error
$errorMsg = '';

// Verifica si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $conn->real_escape_string($_POST['usuario']);
    $password = $conn->real_escape_string($_POST['password']);

    // Busca el usuario en la base de datos
    $sql = "SELECT id, usuario, nombre, password FROM usuarios WHERE usuario = '{$usuario}'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Usuario encontrado
        $userData = $result->fetch_assoc();

        // Verificar si la contraseña proporcionada coincide con el hash almacenado
        if (password_verify($password, $userData['password'])) {
            $_SESSION['usuario'] = $userData['usuario'];
            $_SESSION['nombre'] = $userData['nombre'];
            // Redirecciona a la página protegida
            header('Location: bienvenido.php');
            exit;
        } else {
            // Contraseña incorrecta
            $errorMsg = "Usuario o contraseña incorrectos.";
        }
    } else {
        // Usuario no encontrado
        $errorMsg = "Usuario o contraseña incorrectos.";
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
        .modal-dialog {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
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
                            <label for="password">Contraseña:</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-custom">Iniciar sesión</button>
                        </div>
                    </form>

                    <!-- Enlace para registrarse -->
                    <div class="text-center mt-3">
                        <a href="registro.php">¿No tienes una cuenta? Regístrate aquí</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para mostrar el mensaje de error -->
    <?php if (!empty($errorMsg)): ?>
        <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="errorModalLabel">Error</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo $errorMsg; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Incluye jQuery y Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script>
            // Muestra automáticamente el modal al cargar la página
            $(document).ready(function() {
                $('#errorModal').modal('show');
            });
        </script>
    <?php endif; ?>
</body>

</html>
