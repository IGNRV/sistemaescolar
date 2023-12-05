<?php
session_start();
require_once 'db.php';
ini_set('display_errors', 1);
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['pagos']) && is_array($data['pagos'])) {
    $identificadorPago = $data['identificadorPago'];

    $_SESSION['cuotas_seleccionadas'] = array_column($data['pagos'], 'idCuota');

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
                  VALUES (?, ?, ?, 4, ?, ?, CURDATE(), 4, 0, ?, 'khipu', ?, CURDATE(), CURDATE())";

        $stmt = $conn->prepare($query);
        if (!$stmt) {
            echo "Error al preparar la consulta: " . $conn->error;
            exit;
        }

        $stmt->bind_param("ssisss", $identificadorPago, $rutAlumno, $ano, $folio_pago, $monto, $fechaCuota, $numero_documento);
        if (!$stmt->execute()) {
            echo "Error al insertar en la base de datos: " . $stmt->error;
            exit;
        }
        $stmt->close();
    }

    $_SESSION['identificador_pago'] = $identificadorPago;

    echo "Pagos procesados correctamente.";
} else {
    echo "Datos de pago no proporcionados.";
}
?>
