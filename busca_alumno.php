<?php
include 'db.php'; // Asegúrate de que la ruta sea correcta

$rut = $_POST['rut'];
$anioActual = date("Y");

$sql = "SELECT cp.fecha_cuota_deuda, cp.monto, cp.estado_cuota, YEAR(cp.fecha_cuota_deuda) as año
        FROM cuotas_pago AS cp
        LEFT JOIN alumno AS a ON a.id = cp.id_alumno
        WHERE a.rut = '$rut'";

$result = $conn->query($sql);
$datosAnterior = [];
$datosActual = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if($row['año'] == $anioActual){
            array_push($datosActual, $row);
        } else {
            array_push($datosAnterior, $row);
        }
    }
    echo json_encode(['encontrado' => true, 'datosAnterior' => $datosAnterior, 'datosActual' => $datosActual]);
} else {
    echo json_encode(['encontrado' => false]);
}

$conn->close();
?>
