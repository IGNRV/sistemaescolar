<?php
require_once 'db.php';

$fecha = $_GET['fecha'] ?? '';
$medioPago = $_GET['medioPago'] ?? '';

// Preparar una consulta con marcadores de posición
$query = "SELECT * FROM historial_de_pagos WHERE fecha_pago = ? AND medio_de_pago = ?";
$stmt = $conn->prepare($query);

// Vincular los parámetros a la consulta preparada
$stmt->bind_param("ss", $fecha, $medioPago);

// Ejecutar la consulta
$stmt->execute();

// Obtener los resultados
$resultado = $stmt->get_result();

$datos = [];
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $datos[] = $fila;
    }
}

echo json_encode($datos);

$stmt->close();
?>
