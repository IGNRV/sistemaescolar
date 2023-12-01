<?php
include 'db.php';
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contenido = file_get_contents("php://input");
    $datos = json_decode($contenido, true);

    $rutAlumno = $datos['rutAlumno'] ?? '';
    $idsCuotasSeleccionadas = $datos['idsCuotasSeleccionadas'] ?? [];

    $montoEfectivo = $datos['montoEfectivo'] ?? 0;
    if ($montoEfectivo > 0) {
        insertarPago($conn, $datos, 1); // 1 para efectivo
    }

    $montoCheque = $datos['montoCheque'] ?? 0;
    if ($montoCheque > 0) {
        insertarPago($conn, $datos, 3); // 3 para cheque
    }

    $montoPos = $datos['montoPos'] ?? 0;

    if ($montoPos > 0) {
        insertarPago($conn, $datos, 2); // 2 para pago con tarjeta POS
    }

    foreach ($idsCuotasSeleccionadas as $idCuota) {
        $stmtCuota = $conn->prepare("UPDATE cuotas_pago SET estado_cuota = 2 WHERE id = ?");
        $stmtCuota->bind_param("i", $idCuota);
        $stmtCuota->execute();
        $stmtCuota->close();
    }

    echo "Pago registrado con éxito";
    $conn->close();
} else {
    echo "Método de solicitud no válido";
}

function insertarPago($conn, $datos, $tipoPago) {
    $ano = date('Y');
    $consultaFolio = "SELECT MAX(folio_pago) as ultimo_folio FROM historial_de_pagos";
    $resultado = $conn->query($consultaFolio);
    $folioPago = ($resultado->num_rows > 0) ? $resultado->fetch_assoc()['ultimo_folio'] + 1 : 1;

    $codigoProducto = 1; // Código del producto
    $estado = 1; // Estado del pago

    $stmt = $conn->prepare("INSERT INTO historial_de_pagos (tipo_documento, valor, fecha_pago, ano, rut_alumno, codigo_producto, folio_pago, medio_de_pago, estado, numero_documento, fecha_emision, fecha_cobro) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if ($tipoPago == 1) { // Pago en efectivo
        $stmt->bind_param("sdssiiiiisss", $datos['tipoDocumento'], $datos['montoEfectivo'], $datos['fechaPagoEfectivo'], $ano, $datos['rutAlumno'], $codigoProducto, $folioPago, $tipoPago, $estado, $folioPago, $datos['fechaPagoEfectivo'], $datos['fechaPagoEfectivo']);
    } else if ($tipoPago == 3) { // Pago con cheque
        $stmt = $conn->prepare("INSERT INTO historial_de_pagos (tipo_documento, valor, fecha_pago, ano, rut_alumno, codigo_producto, folio_pago, medio_de_pago, estado, numero_documento, fecha_emision, fecha_cobro, banco) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sdssiiiiissss", $datos['tipoDocumentoCheque'], $datos['montoCheque'], $datos['fechaDepositoCheque'], $ano, $datos['rutAlumno'], $codigoProducto, $folioPago, $tipoPago, $estado, $datos['numeroDocumentoCheque'], $datos['fechaEmisionCheque'], $datos['fechaDepositoCheque'], $datos['bancoCheque']);
    } else if ($tipoPago == 2) { // Pago con tarjeta POS
        $tipoDocumentoPos = $datos['tipoDocumentoPos'] ?? '';
        $montoPos = $datos['montoPos'] ?? 0;
        $fechaPagoPos = $datos['fechaPagoPos'] ?? '';
        $comprobantePos = $datos['comprobantePos'] ?? '';
        $tipoTarjetaPos = 2;
        $cuotasPos = $datos['cuotasPos'] ?? '';
        $fechaActual = date('Y-m-d');

        $stmt = $conn->prepare("INSERT INTO historial_de_pagos (tipo_documento, valor, fecha_pago, ano, rut_alumno, codigo_producto, folio_pago, medio_de_pago, estado, numero_documento, fecha_emision, fecha_cobro, n_cuotas) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sdssiiiiisssi", $tipoDocumentoPos, $montoPos, $fechaPagoPos, $ano, $datos['rutAlumno'], $codigoProducto, $folioPago, $tipoTarjetaPos, $estado, $comprobantePos, $fechaActual, $fechaActual, $datos['cuotasPos']);

    }


    if (!$stmt->execute()) {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>
