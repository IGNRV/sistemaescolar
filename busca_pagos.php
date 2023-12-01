<?php
require_once 'db.php';

$fecha = $_GET['fecha'] ?? '';
$medioPago = $_GET['medioPago'] ?? '';

$query = "SELECT * FROM historial_de_pagos WHERE fecha_pago = '$fecha' AND medio_de_pago = '$medioPago'";
$resultado = $conn->query($query);

$totalRecaudado = 0; // Inicializa el total recaudado

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        if ($fila['medio_de_pago'] == '1') { // Asegúrate de que solo se devuelvan datos para pagos en efectivo
            $totalRecaudado += $fila['valor']; // Suma al total recaudado
            echo "<tr>
                    <td>{$fila['fecha_pago']}</td>
                    <td>{$fila['valor']}</td>
                    <td>{$fila['medio_de_pago']}</td>
                    <td>{$fila['tipo_documento']}</td>
                    <td>{$fila['estado']}</td>
                    <td>{$fila['rut_alumno']}</td>
                  </tr>";
        }
    }
    // Imprime el total recaudado al final
    if ($totalRecaudado > 0) {
        echo "<tr><td colspan='6' class='totalRecaudado' data-total='$totalRecaudado'></td></tr>";
    }
} else {
    echo '';
}
?>
