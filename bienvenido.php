<?php
// Incluye la conexión a la base de datos
require_once 'db.php';

// Inicia sesión
session_start();

// Verifica si el usuario está logueado
if (!isset($_SESSION['correo_electronico'])) {
    header('Location: login.php');
    exit;
}

// Incluir el archivo nav.php aquí
include 'nav.php';
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bienvenido</title>
    <!-- Agregamos Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Estilos personalizados -->
    <style>
        .custom-container {
            max-width: 600px; /* Ajusta el ancho según tus necesidades */
            margin: auto; /* Centra horizontalmente */
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Mantiene el centrado vertical */
        }

        .custom-button {
            width: auto; /* Ancho automático según el contenido del botón */
            margin: auto; /* Centra horizontalmente */
        }

        /* Ajustamos el tamaño de la letra del título */
        h1 {
            font-size: 1.2em; /* Puedes ajustar este valor según tu preferencia */
        }
    </style>
</head>

<body>
    <div class="container mt-5 custom-container">
        <!-- Selector de alumnos -->
        <div class="form-group">
            <form action="" method="post">
                <label for="rut">Ingrese un Rut:</label>
                <!-- Cambiamos el elemento select por un input de tipo text -->
                <input type="text" class="form-control" name="rut" id="rut" value="<?php echo isset($_POST['rut']) ? $_POST['rut'] : ''; ?>" required>
                <small id="rutHelp" class="form-text text-muted">Ingrese el Rut directamente.</small>
                <button type="submit" class="btn btn-primary mt-2" name="buscar">Buscar</button>
            </form>
        </div>

        <?php
        if (isset($alumno)) {
            ?>
            <!-- Formulario de datos del alumno -->
            <form action="" method="post">
                <input type="hidden" name="rut" value="<?php echo $rut; ?>">
                <div class="form-group">
                    <label>Nombre:</label>
                    <input type="text" class="form-control" name="nombre" value="<?php echo $alumno['nombre']; ?>">
                </div>
                <div class="form-group">
                    <label>Fecha de Nacimiento:</label>
                    <input type="text" class="form-control" value="<?php echo $alumno['fecha_de_nacimiento']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label>RDA:</label>
                    <input type="text" class="form-control" value="<?php echo $alumno['rda']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Apellido Paterno:</label>
                    <input type="text" class="form-control" value="<?php echo $alumno['appaterno']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Apellido Materno:</label>
                    <input type="text" class="form-control" value="<?php echo $alumno['apmaterno']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Nombres:</label>
                    <input type="text" class="form-control" value="<?php echo $alumno['nombres']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Calle:</label>
                    <input type="text" class="form-control" value="<?php echo $alumno['calle']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Número:</label>
                    <input type="text" class="form-control" value="<?php echo $alumno['numero']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Resto Dirección:</label>
                    <input type="text" class="form-control" value="<?php echo $alumno['resto_direccion']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Villa/Población:</label>
                    <input type="text" class="form-control" value="<?php echo $alumno['villa_poblacion']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Comuna:</label>
                    <input type="text" class="form-control" value="<?php echo $alumno['comuna']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Ciudad:</label>
                    <input type="text" class="form-control" value="<?php echo $alumno['ciudad']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" class="form-control" value="<?php echo $alumno['email']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Número de teléfono:</label>
                    <input type="text" class="form-control" name="numero_de_telefono" value="<?php echo $alumno['numero_de_telefono']; ?>">
                </div>
                <!-- Botón de actualizar con clase Bootstrap y personalizada -->
                <button type="submit" class="btn btn-primary btn-block custom-button" name="actualizar">Actualizar</button>
            </form>

            <!-- Historial de pagos -->
            <?php
            $idAlumno = $alumno['id'];
            $queryPagos = "SELECT monto, fecha_cuota_deuda, estado_cuota FROM cuotas_pago WHERE id_alumno = {$idAlumno}";
            $pagosResult = $conn->query($queryPagos);
            if ($pagosResult->num_rows > 0) {
                echo "<h2 class='mt-4 text-center'>Historial de Pagos</h2>";
                echo "<ul class='list-group'>";
                while($pago = $pagosResult->fetch_assoc()) {
                    $estadoPago = $pago['estado_cuota'] == '0' ? 'Sin pagar' : 'Cuota Pagada';
                    echo "<li class='list-group-item'>Monto: {$pago['monto']}, Fecha de Deuda: {$pago['fecha_cuota_deuda']}, Estado: {$estadoPago}</li>";
                }
                echo "</ul>";
            } else {
                echo "<p class='mt-3 text-center'>No hay registros de pagos para este alumno.</p>";
            }
        }
        ?>

        <div class="mt-3"></div> <!-- Espacio adicional después del botón de cerrar sesión -->
    </div>

    <!-- Opcional: Incluye jQuery y Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
