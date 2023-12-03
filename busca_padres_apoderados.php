<?php
require_once 'db.php';

$respuesta = ['encontrado' => false, 'datos' => []];

if(isset($_POST['rutPadre'])) {
    $rutPadre = $_POST['rutPadre'];
    $anioActual = date("Y");
    $query = "SELECT 
                cp.id,
                cp.fecha_cuota_deuda,
                cp.monto,
                cp.estado_cuota,
                YEAR(cp.fecha_cuota_deuda) AS año,
                cp.id_alumno
              FROM
                cuotas_pago AS cp
                LEFT JOIN alumno AS a ON a.id = cp.id_alumno
                LEFT JOIN padres_apoderados AS pa ON pa.id = a.id_apoderado
              WHERE
                pa.rut = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $rutPadre);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $respuesta['encontrado'] = true;
        while($row = $resultado->fetch_assoc()) {
            // Agrupamos los datos por alumno y año
            $respuesta['datos'][$row['id_alumno']][$row['año']][] = $row;
        }
    }
    $stmt->close();
}

$conn->close();
echo json_encode($respuesta);
?>
