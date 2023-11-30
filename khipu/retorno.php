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
    

    if (!isset($_GET['token']) || $_GET['token'] !== $_SESSION['payment_token']) {
        header('Location: https://sistemaescolar.oralisisdataservice.cl/bienvenido.php');
        exit;
    }

    if (isset($_SESSION['identificador_pago'])) {
        $identificadorPago = $_SESSION['identificador_pago'];

        $query = "UPDATE historial_de_pagos SET estado = 1 WHERE identificador_pago = '$identificadorPago'";
        $conn->query($query);
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
