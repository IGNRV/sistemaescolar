<?php
include 'db.php'; // Incluye el script de conexión a la base de datos
ini_set('display_errors', 1);
// Asegurarse de que el método de solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos enviados desde el frontend
    $contenido = file_get_contents("php://input");
    $datos = json_decode($contenido, true);

    // Extraer los datos necesarios
    $tipoDocumento = $datos['tipoDocumento'];
    $montoEfectivo = $datos['montoEfectivo'];
    $fechaPagoEfectivo = $datos['fechaPagoEfectivo'];
    $rutAlumno = $datos['rutAlumno'];

    // Extraer el año de la fecha de pago
    $ano = date('Y', strtotime($fechaPagoEfectivo));

    // Consulta SQL para obtener el último folio_pago y numero_documento
    $consultaFolio = "SELECT MAX(folio_pago) as ultimo_folio, MAX(numero_documento) as ultimo_numero FROM historial_de_pagos";
    $resultado = $conn->query($consultaFolio);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $folioPago = $fila['ultimo_folio'] + 1;
        $numeroDocumento = $fila['ultimo_numero'] + 1;
    } else {
        // Si no hay registros previos, iniciar desde 1
        $folioPago = 1;
        $numeroDocumento = 1;
    }

    // Preparar la consulta SQL para insertar en la base de datos
    $stmt = $conn->prepare("INSERT INTO historial_de_pagos (tipo_documento, valor, fecha_pago, ano, rut_alumno, codigo_producto, folio_pago, medio_de_pago, estado, numero_documento, fecha_emision, fecha_cobro) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $codigoProducto = 1; // Código del producto
    $medioDePago = 1; // Número que representa el medio de pago
    $estado = 1; // Estado del pago

    // Vincular los parámetros
    $stmt->bind_param("sdssiiiiisss", $tipoDocumento, $montoEfectivo, $fechaPagoEfectivo, $ano, $rutAlumno, $codigoProducto, $folioPago, $medioDePago, $estado, $numeroDocumento, $fechaPagoEfectivo, $fechaPagoEfectivo);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Pago registrado con éxito";

        // Actualizar el estado de las cuotas seleccionadas
        $idsCuotasSeleccionadas = $datos['idsCuotasSeleccionadas'];
        foreach ($idsCuotasSeleccionadas as $idCuota) {
            $stmtCuota = $conn->prepare("UPDATE cuotas_pago SET estado_cuota = 2 WHERE id = ?");
            $stmtCuota->bind_param("i", $idCuota);
            $stmtCuota->execute();
            $stmtCuota->close();
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Método de solicitud no válido";
}
?>