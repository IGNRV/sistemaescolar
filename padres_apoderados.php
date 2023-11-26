<?php
session_start();

// Asegúrate de que un usuario haya iniciado sesión
if (!isset($_SESSION['correo_electronico'])) {
    header('Location: login.php');
    exit;
}

// Conexión a la base de datos
require_once 'db.php';

// Obtener el id_usuario del usuario que ha iniciado sesión
$correo_electronico = $_SESSION['correo_electronico'];
$queryUsuario = "SELECT id FROM usuarios WHERE correo_electronico = '$correo_electronico'";
$resultadoUsuario = $conn->query($queryUsuario);

if ($resultadoUsuario->num_rows > 0) {
    $usuario = $resultadoUsuario->fetch_assoc();
    $id_usuario = $usuario['id'];
} else {
    echo "Usuario no encontrado.";
    exit;
}

if (isset($_POST['actualizar_datos'])) {
    // Recuperar los valores del formulario
    $rut = $conn->real_escape_string($_POST['rut']);
    $parentesco = $conn->real_escape_string($_POST['parentesco']);
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $apellidoPaterno = $conn->real_escape_string($_POST['apellidoPaterno']);
    $apellidoMaterno = $conn->real_escape_string($_POST['apellidoMaterno']);
    $telefonoParticular = $conn->real_escape_string($_POST['telefonoParticular']);
    $telefonoTrabajo = $conn->real_escape_string($_POST['telefonoTrabajo']);
    $correoElectronicoPersonal = $conn->real_escape_string($_POST['correoElectronicoPersonal']);
    $correoElectronicoTrabajo = $conn->real_escape_string($_POST['correoElectronicoTrabajo']);
    $calle = $conn->real_escape_string($_POST['calle']);
    $n_calle = $conn->real_escape_string($_POST['n_calle']);
    $restoDireccion = $conn->real_escape_string($_POST['restoDireccion']);
    $villaPoblacion = $conn->real_escape_string($_POST['villaPoblacion']);
    $comuna = $conn->real_escape_string($_POST['comuna']);
    $ciudad = $conn->real_escape_string($_POST['ciudad']);
    $tutorAcademico = isset($_POST['tutorAcademico']) ? 1 : 0;

    // Insertar los datos en la tabla padres_apoderados
    $sql = "INSERT INTO padres_apoderados (rut, parentesco, nombre, apellido_paterno, apellido_materno, telefono_particular, telefono_trabajo, correo_electronico_particular, correo_electronico_trabajo, calle, n_calle, resto_direccion, villa_poblacion, comuna, ciudad, tutor_academico, id_usuario) VALUES ('$rut', '$parentesco', '$nombre', '$apellidoPaterno', '$apellidoMaterno', '$telefonoParticular', '$telefonoTrabajo', '$correoElectronicoPersonal', '$correoElectronicoTrabajo', '$calle', '$n_calle', '$restoDireccion', '$villaPoblacion', '$comuna', '$ciudad', '$tutorAcademico', '$id_usuario')";

    if ($conn->query($sql)) {
        $_SESSION['mensaje'] = "Datos actualizados correctamente.";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar datos: " . $conn->error;
    }

    // Recargar la página para mostrar los datos actualizados
    header("Location: bienvenido.php?page=padres_apoderados");
    exit;
}

// Consulta para obtener los datos de padres/apoderados
$queryPadres = "SELECT * FROM padres_apoderados WHERE id_usuario = $id_usuario";
$resultadoPadres = $conn->query($queryPadres);

// Resto del código para mostrar la interfaz de usuario
?>


<div class="parents-apoderados">
    <h2>Datos padres/apoderados</h2>
    <table class="table">
        <thead>
            <tr>
                <th>RUT</th>
                <th>Nombre completo</th>
                <th>Parentesco</th>
                <th>Mail</th>
                <th>Teléfono</th>
                <th>Otros</th>
            </tr>
        </thead>
        <tbody>
            <?php while($fila = $resultadoPadres->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($fila['rut']); ?></td>
                    <td><?php echo htmlspecialchars($fila['nombre']) . " " . htmlspecialchars($fila['apellido_paterno']) . " " . htmlspecialchars($fila['apellido_materno']); ?></td>
                    <td><?php echo htmlspecialchars($fila['parentesco']); ?></td>
                    <td><?php echo htmlspecialchars($fila['correo_electronico_particular']) . "<br>" . htmlspecialchars($fila['correo_electronico_trabajo']); ?></td>
                    <td><?php echo htmlspecialchars($fila['telefono_particular']) . "<br>" . htmlspecialchars($fila['telefono_trabajo']); ?></td>
                    <td>
                        <!-- Aquí puede ir el botón para abrir el pop-up con más detalles -->
                        <button type="button" class="btn btn-info btn-sm" onclick="openDetails(<?php echo $fila['id']; ?>)">Ver Detalle</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    
    <h3>Información de padres/apoderados</h3>
    <form method="POST" action="padres_apoderados.php">

        <div class="form-group">
            <label for="rut">RUT</label>
            <input type="text" class="form-control" name="rut">
        </div>
      <!--   <div class="form-group">
            <label for="fechaNacimiento">Fecha Nacimiento</label>
            <input type="date" class="form-control" name="fechaNacimiento">
        </div> -->
        <div class="form-group">
            <label for="parentesco">Parentesco</label>
            <input type="text" class="form-control" name="parentesco">
        </div>
        <div class="form-group">
            <label for="nombres">Nombre</label>
            <input type="text" class="form-control" name="nombre">
        </div>
        <div class="form-group">
            <label for="apellidoPaterno">Apellido Paterno</label>
            <input type="text" class="form-control" name="apellidoPaterno">
        </div>
        <div class="form-group">
            <label for="apellidoMaterno">Apellido Materno</label>
            <input type="text" class="form-control" name="apellidoMaterno">
        </div>
        <div class="form-group">
            <label for="calle">Calle</label>
            <input type="text" class="form-control" name="calle">
        </div>
        <div class="form-group">
            <label for="n_calle">N°</label>
            <input type="text" class="form-control" name="n_calle">
        </div>
        <div class="form-group">
            <label for="restoDireccion">Resto Dirección</label>
            <input type="text" class="form-control" name="restoDireccion">
        </div>
        <div class="form-group">
            <label for="villaPoblacion">Villa/Población</label>
            <input type="text" class="form-control" name="villaPoblacion">
        </div>
        <div class="form-group">
            <label for="comuna">Comuna</label>
            <input type="text" class="form-control" name="comuna">
        </div>
        <div class="form-group">
            <label for="ciudad">Ciudad</label>
            <input type="text" class="form-control" name="ciudad">
        </div>
        <div class="form-group">
            <label for="telefonoParticular">Teléfono Particular</label>
            <input type="tel" class="form-control" name="telefonoParticular">
        </div>
        <div class="form-group">
            <label for="telefonoTrabajo">Teléfono Trabajo</label>
            <input type="tel" class="form-control" name="telefonoTrabajo">
        </div>
        <div class="form-group">
            <label for="correoElectronicoPersonal">Correo Electrónico Personal</label>
            <input type="email" class="form-control" name="correoElectronicoPersonal">
        </div>
        <div class="form-group">
            <label for="correoElectronicoTrabajo">Correo Electrónico Trabajo</label>
            <input type="email" class="form-control" name="correoElectronicoTrabajo">
        </div>
        <div class="form-group">
            <label for="tutorAcademico">Tutor académico</label>
            <input type="checkbox" id="tutorAcademico" name="tutorAcademico" value="1">
        </div>
        <button type="submit" class="btn btn-primary btn-block custom-button" name="actualizar_datos">ACTUALIZAR DATOS</button>
</form>
</div>
 