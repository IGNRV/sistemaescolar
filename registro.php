<?php
require_once 'db.php';

// Variable para almacenar el mensaje de error
$errorMsg = '';

// Verifica si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rut = $conn->real_escape_string($_POST['rut']);
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $correo_electronico = $conn->real_escape_string($_POST['correo_electronico']);
    $usuario = $conn->real_escape_string($_POST['usuario']);
    $password = $conn->real_escape_string($_POST['password']);
    $passwordEncriptada = password_hash($password, PASSWORD_DEFAULT); // Encriptación de la contraseña

    // Verifica si el usuario ya existe en la base de datos (basado en el campo 'usuario', 'correo_electronico' o 'rut', según lo que desees)
    $checkUser = "SELECT id FROM usuarios WHERE usuario = '{$usuario}' OR correo_electronico = '{$correo_electronico}' OR rut = '{$rut}'";
    $result = $conn->query($checkUser);

    if ($result->num_rows > 0) {
        $errorMsg = "El usuario ya existe.";
    } else {
        // Agrega el nuevo usuario a la base de datos
        $insertUser = "INSERT INTO usuarios (rut, nombre, correo_electronico, password, usuario) VALUES ('{$rut}', '{$nombre}', '{$correo_electronico}', '{$passwordEncriptada}', '{$usuario}')";
        if ($conn->query($insertUser) === TRUE) {
            header('Location: login.php');
            exit;
        } else {
            $errorMsg = "Error al registrar el usuario: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro</title>
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
                    <h2 class="text-center">Registro de Usuario</h2>
                    <form method="post" action="registro.php" class="mt-4">
                        <div class="form-group">
                            <label for="rut">RUT:</label>
                            <input type="text" class="form-control" name="rut" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo Electrónico:</label>
                            <input type="email" class="form-control" name="correo_electronico" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Usuario:</label>
                            <input type="text" class="form-control" name="usuario" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-custom">Registrarse</button>
                        </div>
                    </form>
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