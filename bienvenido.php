<?php
// Incluye la conexión a la base de datos
require_once 'db.php';

// Inicia sesión
session_start();

// Verifica si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    // Si no está logueado, redirecciona al login
    header('Location: login.php');
    exit;
}

// Manejar la actualización de los datos del alumno si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['actualizar'])) {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $numero_de_telefono = $conn->real_escape_string($_POST['numero_de_telefono']);
    $rut = $conn->real_escape_string($_POST['rut']);

    // Actualiza los datos del alumno seleccionado
    $updateQuery = "UPDATE alumnos SET nombre = ?, numero_de_telefono = ? WHERE rut = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param('sss', $nombre, $numero_de_telefono, $rut);
    $stmt->execute();
    $stmt->close();
}

// Obtener todos los ruts de alumnos
$query = "SELECT rut, id FROM alumnos";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['nombre']; ?>!</h1>

    <!-- Selector de alumnos -->
    <form action="" method="post">
        <label for="alumnos">Seleccione un alumno:</label>
        <select name="rut" id="alumnos" onchange="this.form.submit()">
            <option value="">Seleccione un Rut...</option>
            <?php while($row = $result->fetch_assoc()): ?>
                <option value="<?php echo $row['rut']; ?>" <?php echo (isset($_POST['rut']) && $_POST['rut'] == $row['rut']) ? 'selected' : ''; ?>>
                    <?php echo $row['rut']; ?>
                </option>
            <?php endwhile; ?>
        </select>
    </form>

    <?php
    // Mostrar y editar los datos del alumno seleccionado
    if (isset($_POST['rut'])) {
        $rut = $conn->real_escape_string($_POST['rut']);
        $queryAlumno = "SELECT id, nombre, direccion, email, numero_de_telefono FROM alumnos WHERE rut = '{$rut}'";
        $alumnoResult = $conn->query($queryAlumno);
        $alumno = $alumnoResult->fetch_assoc();
        if ($alumno) {
            ?>
            <form action="" method="post">
                <input type="hidden" name="rut" value="<?php echo $rut; ?>">
                Nombre: <input type="text" name="nombre" value="<?php echo $alumno['nombre']; ?>"><br>
                Dirección: <input type="text" value="<?php echo $alumno['direccion']; ?>" disabled><br>
                Email: <input type="email" value="<?php echo $alumno['email']; ?>" disabled><br>
                Número de teléfono: <input type="text" name="numero_de_telefono" value="<?php echo $alumno['numero_de_telefono']; ?>"><br>
                <input type="submit" name="actualizar" value="Actualizar">
            </form>
            <?php
            // Mostrar historial de pagos del alumno
            $idAlumno = $alumno['id'];
            $queryPagos = "SELECT monto, fecha_cuota_deuda, estado_cuota FROM cuotas_pago WHERE id_alumno = {$idAlumno}";
            $pagosResult = $conn->query($queryPagos);
            if ($pagosResult->num_rows > 0) {
                echo "<h2>Historial de Pagos</h2>";
                echo "<ul>";
                while($pago = $pagosResult->fetch_assoc()) {
                    $estadoPago = $pago['estado_cuota'] == '0' ? 'Sin pagar' : 'Cuota Pagada';
                    echo "<li>Monto: {$pago['monto']}, Fecha de Deuda: {$pago['fecha_cuota_deuda']}, Estado: {$estadoPago}</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No hay registros de pagos para este alumno.</p>";
            }
        }
    }
    ?>

    <a href="logout.php">Cerrar sesión</a>
</body>
</html>
