<?php
session_start();
require_once 'db.php';

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['pagos']) && is_array($data['pagos'])) {
    $identificadorPago = $data['identificadorPago']; // Recuperar el identificador de pago

    foreach ($data['pagos'] as $pago) {
        $rutAlumno = $pago['rutAlumno'];
        $monto = $pago['monto'];
        $fechaCuota = $pago['fechaCuota'];
        $ano = date('Y', strtotime($fechaCuota));

        $queryFolio = "SELECT MAX(folio_pago) AS ultimo_folio, MAX(numero_documento) AS ultimo_numero FROM historial_de_pagos";
        $resultado = $conn->query($queryFolio);
        $fila = $resultado->fetch_assoc();
        $folio_pago = is_null($fila['ultimo_folio']) ? 1 : $fila['ultimo_folio'] + 1;
        $numero_documento = is_null($fila['ultimo_numero']) ? 1 : $fila['ultimo_numero'] + 1;

        $query = "INSERT INTO historial_de_pagos (identificador_pago, rut_alumno, ano, codigo_producto, folio_pago, valor, fecha_pago, medio_de_pago, estado, fecha_vencimiento, tipo_documento, numero_documento, fecha_emision, fecha_cobro)
                  VALUES ('$identificadorPago', '$rutAlumno', '$ano', 2, '$folio_pago', '$monto', CURDATE(), 4, 0, '$fechaCuota', 'transferencia', '$numero_documento', CURDATE(), CURDATE())";

        if (!$conn->query($query)) {
            echo "Error al insertar en la base de datos: " . $conn->error;
            exit;
        }
    }

    $_SESSION['identificador_pago'] = $identificadorPago;

    echo "Pagos procesados correctamente.";
} else {
    echo "Datos de pago no proporcionados.";
}
?>
