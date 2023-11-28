<?php
// Incluye la conexión a la base de datos
require_once 'db.php';

// Inicia sesión
session_start();

// Define una variable para el mensaje
$mensaje = '';

// Verifica si el usuario está logueado y obtiene su id
if (!isset($_SESSION['correo_electronico'])) {
    header('Location: login.php');
    exit;
} else {
    $correo_electronico = $_SESSION['correo_electronico'];
    // Busca el id del usuario en la tabla 'usuarios'
    $queryUsuario = "SELECT id FROM usuarios WHERE correo_electronico = '$correo_electronico'";
    $resultadoUsuario = $conn->query($queryUsuario);
    if ($resultadoUsuario->num_rows > 0) {
        $usuario = $resultadoUsuario->fetch_assoc();
        $id_usuario = $usuario['id'];
    } else {
        // Manejar el error si el usuario no se encuentra
        $mensaje = "Usuario no encontrado.";
        exit;
    }
}

// Verifica si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['actualizar'])) {
    // Recoge los datos del formulario
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $telefono = $conn->real_escape_string($_POST['telefono']);

    // Actualiza los datos en la base de datos
    $updateQuery = "UPDATE alumno SET nombre = '$nombre', telefono = '$telefono' WHERE id_usuario = $id_usuario";
    if ($conn->query($updateQuery) === TRUE) {
        $mensaje = "Datos actualizados correctamente.";
    } else {
        $mensaje = "Error al actualizar los datos: " . $conn->error;
    }
}

// Busca los datos del alumno que coincidan con el id_usuario
$queryAlumno = "SELECT * FROM alumno WHERE id_usuario = $id_usuario";
$resultadoAlumno = $conn->query($queryAlumno);

if ($resultadoAlumno->num_rows > 0) {
    $alumno = $resultadoAlumno->fetch_assoc();
} else {
    $mensaje = "Datos del alumno no encontrados.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agregar_observacion'])) {
    $categoria = $conn->real_escape_string($_POST['categoria']);
    $descripcion = $conn->real_escape_string($_POST['descripcion']);
    $fecha = $conn->real_escape_string($_POST['fecha']);

    // Inserta la nueva observación en la base de datos
    $insertQuery = "INSERT INTO observaciones (categoria, descripcion, fecha, id_usuario) VALUES ('$categoria', '$descripcion', '$fecha', $id_usuario)";
    if ($conn->query($insertQuery) === TRUE) {
        $mensaje = "Observación agregada correctamente.";
    } else {
        $mensaje = "Error al agregar la observación: " . $conn->error;
    }
}

// Recuperar observaciones del usuario
$queryObservaciones = "SELECT categoria, descripcion, fecha FROM observaciones WHERE id_usuario = $id_usuario";
$resultadoObservaciones = $conn->query($queryObservaciones);

// Manejar la eliminación de una observación
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar_observacion'])) {
    $idObservacion = $conn->real_escape_string($_POST['id_observacion']);
    $deleteQuery = "DELETE FROM observaciones WHERE id = $idObservacion AND id_usuario = $id_usuario";
    if ($conn->query($deleteQuery) === TRUE) {
        $mensaje = "Observación eliminada correctamente.";
    } else {
        $mensaje = "Error al eliminar la observación: " . $conn->error;
    }
}
// Resto del código existente...
?>
<?php if (!empty($mensaje)): ?>
    <div class="alert alert-success" role="alert">
        <?php echo $mensaje; ?>
    </div>
<?php endif; ?>

    <div class="titulo-container" style="background-color: blue; padding: 10px; display: flex; justify-content: center; align-items: center; height: 100%;">
        <h1 class="text-center" style="color: white; margin-bottom: 0px;">Datos del alumno</h1>
    </div>
            <!-- Formulario de datos del alumno -->
            <form action="" method="post">
    <input type="hidden" name="rut" value="<?php echo $rut; ?>">

    <div class="row">
        <!-- Primera columna -->
        <div class="col-md-6">
            <div class="form-group">
                <label>Nombre:</label>
                <input type="text" class="form-control" name="nombre" value="<?php echo $alumno['nombre']; ?>">
            </div>

            <div class="form-group">
                <label>Apellido Materno:</label>
                <input type="text" class="form-control" name="apellido_materno" value="<?php echo $alumno['apellido_materno']; ?>" disabled>
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email" class="form-control" name="correo_electronico" value="<?php echo $alumno['correo_electronico']; ?>" disabled>
            </div>

            <div class="form-group">
                <label>Calle:</label>
                <input type="text" class="form-control" name="calle" value="<?php echo $alumno['calle']; ?>" disabled>
            </div>

            <div class="form-group">
                <label>Resto Dirección:</label>
                <input type="text" class="form-control" name="resto_direccion" value="<?php echo $alumno['resto_direccion']; ?>" disabled>
            </div>

            <div class="form-group">
                <label>Ciudad:</label>
                <input type="text" class="form-control" name="ciudad" value="<?php echo $alumno['ciudad']; ?>" disabled>
            </div>

            <!-- Otros campos de la primera columna -->

        </div>

        <!-- Segunda columna -->
        <div class="col-md-6">
            <div class="form-group">
                <label>Apellido Paterno:</label>
                <input type="text" class="form-control" name="apellido_paterno" value="<?php echo $alumno['apellido_paterno']; ?>" disabled>
            </div>

            <div class="form-group">
                <label>RDA:</label>
                <input type="text" class="form-control" name="rda" value="<?php echo $alumno['rda']; ?>" disabled>
            </div>

            <div class="form-group">
                <label>Número de teléfono:</label>
                <input type="text" class="form-control" name="telefono" value="<?php echo $alumno['telefono']; ?>">
            </div>

            <div class="form-group">
                <label>Número:</label>
                <input type="text" class="form-control" name="n_calle" value="<?php echo $alumno['n_calle']; ?>" disabled>
            </div>

            <div class="form-group">
                <label>Villa/Población:</label>
                <input type="text" class="form-control" name="villa_poblacion" value="<?php echo $alumno['villa_poblacion']; ?>" disabled>
            </div>

            <div class="form-group">
                <label>Comuna:</label>
                <input type="text" class="form-control" name="comuna" value="<?php echo $alumno['comuna']; ?>" disabled>
            </div>

            <!-- Otros campos de la segunda columna -->

        </div>
    </div>

    <!-- Resto del formulario y botón de actualizar -->


                <button type="submit" class="btn btn-primary btn-block custom-button" name="actualizar">Actualizar</button>
</form>
            <h2>Observaciones</h2>
<table class="table">
    <thead>
        <style>
        .titulo-container {
            background-color: blue;
            padding: 10px;
            margin-bottom: 20px; /* Puedes ajustar esto según sea necesario */
        }

        .titulo-container h1 {
            color: white;
        /* Puedes ajustar el color del texto según sea necesario */
        }
        </style>
        <tr>
            <th scope="col">Categoría</th>
            <th scope="col">Descripción</th>
            <th scope="col">Fecha</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $queryObservaciones = "SELECT id, categoria, descripcion, fecha FROM observaciones WHERE id_usuario = $id_usuario";
        $resultadoObservaciones = $conn->query($queryObservaciones);
        while($fila = $resultadoObservaciones->fetch_assoc()):
        ?>
        <tr>
            <td><?php echo htmlspecialchars($fila['categoria']); ?></td>
            <td><?php echo htmlspecialchars($fila['descripcion']); ?></td>
            <td><?php echo htmlspecialchars($fila['fecha']); ?></td>
            <td>
                <form action="" method="post" onsubmit="return confirmDelete();">
                    <input type="hidden" name="id_observacion" value="<?php echo $fila['id']; ?>">
                    <button type="submit" name="eliminar_observacion" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>


<form action="" method="post">
    <div class="form-group">
        <label>Categoría:</label>
        <input type="text" class="form-control" name="categoria" required>
    </div>
    <div class="form-group">
        <label>Descripción:</label>
        <textarea class="form-control" name="descripcion" required></textarea>
    </div>
    <div class="form-group">
        <label>Fecha:</label>
        <input type="date" class="form-control" name="fecha" required>
    </div>
    <button type="submit" class="btn btn-primary btn-block custom-button" name="agregar_observacion">Agregar Observación</button>
</form>


<script>
function confirmDelete() {
    return confirm("¿Estás seguro de que quieres eliminar esta observación?");
}
</script>