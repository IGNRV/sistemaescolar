<?php
// buscar_alumno.php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rut = $conn->real_escape_string($_POST['rut']);

    // Iniciar transacción
    $conn->begin_transaction();

    try {
        // Actualizar el estado de las cuotas
        $queryUpdate = "UPDATE cuotas_pago AS cp
                        JOIN alumno AS a ON a.id = cp.id_alumno
                        SET cp.estado_cuota = 1
                        WHERE a.rut = '$rut' AND cp.fecha_cuota_deuda <= CURDATE() AND cp.estado_cuota = 0";
        $conn->query($queryUpdate);

        // Consulta para obtener los datos de las cuotas de pago del alumno
        $query = "SELECT cp.id, a.rut, cp.monto, cp.fecha_cuota_deuda, cp.estado_cuota, cp.id_alumno
                  FROM cuotas_pago AS cp
                  LEFT JOIN alumno AS a ON a.id = cp.id_alumno
                  WHERE a.rut = '$rut';";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $datos_cuotas_anterior = [];
            $datos_cuotas_actual = [];
            $ano_actual = date('Y');

            while ($cuota = $result->fetch_assoc()) {
                $ano_cuota = date('Y', strtotime($cuota['fecha_cuota_deuda']));
                if ($ano_cuota < $ano_actual) {
                    $datos_cuotas_anterior[] = $cuota;
                } else {
                    $datos_cuotas_actual[] = $cuota;
                }
            }

            // Luego, devolvemos estos arrays a la parte del frontend para procesarlos y mostrarlos
            echo json_encode(['anterior' => $datos_cuotas_anterior, 'actual' => $datos_cuotas_actual]);
        } else {
            echo "Alumno no encontrado.";
        }

        // Confirmar transacción
        $conn->commit();
    } catch (Exception $e) {
        // Si hay algún error, revertir la transacción
        $conn->rollback();
        echo "Error al procesar la solicitud: " . $e->getMessage();
    }
    exit;
}
?>
