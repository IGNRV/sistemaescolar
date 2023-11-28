<?php
// buscar_alumno.php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rut = $conn->real_escape_string($_POST['rut']);

    // Modificamos la consulta para obtener los datos de las cuotas de pago del alumno
    $query = "SELECT cp.id, a.rut, cp.monto, cp.fecha_cuota_deuda, cp.estado_cuota, cp.id_alumno
              FROM cuotas_pago AS cp
              LEFT JOIN alumno as a on a.id = cp.id_alumno
              WHERE a.rut = '$rut';";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Inicializamos las variables para almacenar los datos
        $datos_cuotas_anterior = [];
        $datos_cuotas_actual = [];
        $ano_actual = date('Y');
        
        while ($cuota = $result->fetch_assoc()) {
            // Verificamos si la cuota pertenece al año actual o al anterior
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
    exit;
}
?>
