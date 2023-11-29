<?php
// procesar_pago.php
require_once 'db.php'; // Asegúrate de que tienes un archivo db.php con la conexión a la base de datos

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['pagos']) && is_array($data['pagos'])) {
    foreach ($data['pagos'] as $pago) {
        $rutAlumno = $pago['rutAlumno'];
        $monto = $pago['monto'];
        $fechaCuota = $pago['fechaCuota'];
        $ano = date('Y', strtotime($fechaCuota));

        // Obtener el último folio_pago y numero_documento
        $queryFolio = "SELECT MAX(folio_pago) AS ultimo_folio, MAX(numero_documento) AS ultimo_numero FROM historial_de_pagos";
        $resultado = $conn->query($queryFolio);
        $fila = $resultado->fetch_assoc();
        $folio_pago = $fila['ultimo_folio'] + 1;
        $numero_documento = $fila['ultimo_numero'] + 1;

        // Insertar en la base de datos
        $query = "INSERT INTO historial_de_pagos (rut_alumno, ano, codigo_producto, folio_pago, valor, fecha_pago, medio_de_pago, estado, fecha_vencimiento, tipo_documento, numero_documento, fecha_emision, fecha_cobro)
                  VALUES ('$rutAlumno', '$ano', 2, '$folio_pago', '$monto', CURDATE(), 4, 0, '$fechaCuota', 'transferencia', '$numero_documento', CURDATE(), CURDATE())";

        // Ejecutar la consulta
        if (!$conn->query($query)) {
            // Manejar el error aquí
            echo "Error al insertar en la base de datos: " . $conn->error;
            exit;
        }
    }

    echo "Pagos procesados correctamente.";
} else {
    echo "Datos de pago no proporcionados.";
}
?>
