<?php
// Incluye la conexión a la base de datos
require_once 'db.php';

if(isset($_POST['id'])) {
    $id = $_POST['id'];

    // Consulta para obtener los detalles
    $sql = "SELECT * FROM padres_apoderados WHERE id = $id";
    $resultado = $conn->query($sql);

    if($fila = $resultado->fetch_assoc()) {
        // Aquí generas el HTML con los detalles
        echo "<p>RUT: " . htmlspecialchars($fila['rut']) . "</p>";
        echo "<p>Nombre: " . htmlspecialchars($fila['nombre']) . " " . htmlspecialchars($fila['apellido_paterno']) . " " . htmlspecialchars($fila['apellido_materno']) . "</p>";
        // Agrega más campos según sea necesario
    }
}
?>
