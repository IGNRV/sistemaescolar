<?php
// Incluye la conexión a la base de datos
require_once 'db.php';

// Inicia sesión
session_start();

// Verifica si el usuario está logueado
if (!isset($_SESSION['correo_electronico'])) {
    header('Location: login.php');
    exit;
}

// Incluir el archivo nav.php aquí
include 'nav.php';
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bienvenido</title>
    <!-- Agregamos Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Estilos personalizados -->
    <style>
        .custom-container {
            max-width: 600px; /* Ajusta el ancho según tus necesidades */
            margin: auto; /* Centra horizontalmente */
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Mantiene el centrado vertical */
        }

        .custom-button {
            width: auto; /* Ancho automático según el contenido del botón */
            margin: auto; /* Centra horizontalmente */
        }

        /* Ajustamos el tamaño de la letra del título */
        h1 {
            font-size: 1.2em; /* Puedes ajustar este valor según tu preferencia */
        }
        h2 {
            font-size: 1.2em; /* Puedes ajustar este valor según tu preferencia */
        }
        h3 {
            font-size: 1.2em; /* Puedes ajustar este valor según tu preferencia */
        }
    </style>
</head>

<body>
<div class="container mt-5 custom-container">
    <?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        switch ($page) {
            case 'datos_alumno':
                include 'datos_alumno.php';
                break;
            case 'emergencias':
                include 'emergencias.php';
                break;
            case 'padres_apoderados':
                include 'padres_apoderados.php';
                break;
            case 'tutor_economico':
                include 'tutor_economico.php';
                break;
            case 'inicio':
            default:
                include 'inicio.php';
                break;
        }
    } else {
        // Si no hay parámetro 'page', muestra la pantalla de inicio por defecto
        include 'inicio.php';
    }
    ?>
    <div class="mt-3"></div> <!-- Espacio adicional -->
</div>


    <!-- Opcional: Incluye jQuery y Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
