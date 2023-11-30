<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transacción Exitosa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container { padding-top: 50px; }
        .alert { text-align: center; }
    </style>
</head>
<body>
<?php
session_start();
require_once '../db.php';

// Verificar el token de la sesión
if (!isset($_GET['token']) || $_GET['token'] !== $_SESSION['payment_token']) {
    header('Location: https://sistemaescolar.oralisisdataservice.cl/bienvenido.php');
    exit;
}

// Actualizar el estado en la base de datos
if (isset($_SESSION['identificador_pago'])) {
    $identificadorPago = $_SESSION['identificador_pago'];

    // Preparar la consulta para evitar problemas de inyección SQL
    $stmt = $conn->prepare("UPDATE historial_de_pagos SET estado = 1 WHERE identificador_pago = ?");
    $stmt->bind_param("s", $identificadorPago);

    if ($stmt->execute() === FALSE) {
        echo "Error al actualizar el estado: " . $conn->error;
    }

    // Cerrar la declaración preparada
    $stmt->close();

    // Eliminar el identificador de la sesión después de usarlo
    unset($_SESSION['identificador_pago']);
}
    ?>

    <div class="container">
        <div class="alert alert-success">
            <h4 class="alert-heading">¡Pago Realizado con Éxito!</h4>
            <p>El comprobante de pago se ha enviado a su correo electrónico. Será redireccionado al inicio en unos segundos.</p>
        </div>
    </div>

    <script>
        setTimeout(function() {
            window.location.href = 'https://sistemaescolar.oralisisdataservice.cl/bienvenido.php';
        }, 5000);
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
