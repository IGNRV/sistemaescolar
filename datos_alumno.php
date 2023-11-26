<?php
// Incluye la conexión a la base de datos
require_once 'db.php';

// Inicia sesión
session_start();

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
        echo "Usuario no encontrado.";
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
        echo "Datos actualizados correctamente.";
    } else {
        echo "Error al actualizar los datos: " . $conn->error;
    }
}

// Busca los datos del alumno que coincidan con el id_usuario
$queryAlumno = "SELECT * FROM alumno WHERE id_usuario = $id_usuario";
$resultadoAlumno = $conn->query($queryAlumno);

if ($resultadoAlumno->num_rows > 0) {
    $alumno = $resultadoAlumno->fetch_assoc();
} else {
    echo "Datos del alumno no encontrados.";
    exit;
}

// A continuación va el código HTML...
?>

<h1 class="text-center">Datos del alumno</h1>
            <!-- Formulario de datos del alumno -->
            <form action="" method="post">
                <input type="hidden" name="rut" value="<?php echo $rut; ?>">
                <div class="form-group">
                    <label>Nombre:</label>
                    <input type="text" class="form-control" name="nombre" value="<?php echo $alumno['nombre']; ?>">
                </div>
                <div class="form-group">
                    <label>Fecha de Nacimiento:</label>
                    <input type="text" class="form-control" name="fecha_de_nacimiento" value="<?php echo $alumno['fecha_de_nacimiento']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label>RDA:</label>
                    <input type="text" class="form-control" name="rda" value="<?php echo $alumno['rda']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Apellido Paterno:</label>
                    <input type="text" class="form-control" name="apellido_paterno" value="<?php echo $alumno['apellido_paterno']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Apellido Materno:</label>
                    <input type="text" class="form-control" name="apellido_materno" value="<?php echo $alumno['apellido_materno']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Calle:</label>
                    <input type="text" class="form-control" name="calle" value="<?php echo $alumno['calle']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Número:</label>
                    <input type="text" class="form-control" name="n_calle" value="<?php echo $alumno['n_calle']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Resto Dirección:</label>
                    <input type="text" class="form-control" name="resto_direccion" value="<?php echo $alumno['resto_direccion']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Villa/Población:</label>
                    <input type="text" class="form-control" name="villa_poblacion" value="<?php echo $alumno['villa_poblacion']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Comuna:</label>
                    <input type="text" class="form-control" name="comuna" value="<?php echo $alumno['comuna']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Ciudad:</label>
                    <input type="text" class="form-control" name="ciudad" value="<?php echo $alumno['ciudad']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" class="form-control" name="correo_electronico" value="<?php echo $alumno['correo_electronico']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Número de teléfono:</label>
                    <input type="text" class="form-control" name="telefono" value="<?php echo $alumno['telefono']; ?>">
                </div>
                <!-- Botón de actualizar con clase Bootstrap y personalizada -->
                <button type="submit" class="btn btn-primary btn-block custom-button" name="actualizar">Actualizar</button>
            </form>
            <h2>Observaciones</h2>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Categoría</th>
            <th scope="col">Descripción</th>
            <th scope="col">Fecha</th>
        </tr>
    </thead>
    <tbody>
        <!-- Las filas de la tabla se agregarán aquí -->
    </tbody>
</table>

<!-- Botón para agregar observaciones -->
<button type="button" class="btn btn-primary btn-block custom-button">AGREGAR OBSERVACIÓN</button>