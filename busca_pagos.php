<?php
require_once 'db.php';

$fecha = $_GET['fecha'] ?? '';
$medioPago = $_GET['medioPago'] ?? '';

$query = "SELECT * FROM historial_de_pagos WHERE fecha_pago = '$fecha' AND medio_de_pago = '$medioPago'";
$resultado = $conn->query($query);

if ($resultado->num_rows > 0) {
    // Procesar los resultados y devolverlos
    // Por ejemplo: devolver filas de tabla en formato HTML
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>
                <td>{$fila['fecha_pago']}</td>
                <td>{$fila['monto']}</td>
                <td>{$fila['medio_de_pago']}</td>
                <td>{$fila['tipo_documento']}</td>
                <td>{$fila['estado']}</td>
                <td>{$fila['rut_alumno']}</td>
              </tr>";
    }
} else {
    echo '';
}
?>
