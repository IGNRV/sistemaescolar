<?php
// Inicia sesión
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['correo_electronico'])) {
    header('Location: login.php');
    exit;
}

// Incluye la conexión a la base de datos
require_once 'db.php';

// Obtener el ID del usuario que ha iniciado sesión
$correo_electronico = $_SESSION['correo_electronico'];
$queryUsuario = "SELECT id FROM usuarios WHERE correo_electronico = '$correo_electronico'";
$resultadoUsuario = $conn->query($queryUsuario);
if ($resultadoUsuario->num_rows > 0) {
    $usuario = $resultadoUsuario->fetch_assoc();
    $id_usuario = $usuario['id'];

    // Consulta para obtener los datos del tutor económico
    $queryTutorEconomico = "SELECT * FROM pagador_tutor_economico WHERE id_usuario = $id_usuario";
    $resultadoTutorEconomico = $conn->query($queryTutorEconomico);
    if ($resultadoTutorEconomico->num_rows > 0) {
        $tutorEconomico = $resultadoTutorEconomico->fetch_assoc();
    } else {
        $tutorEconomico = null;
    }

    // Consulta para obtener los medios de pago
    $queryMediosPago = "SELECT * FROM medios_de_pago WHERE id_usuario = $id_usuario";
    $resultadoMediosPago = $conn->query($queryMediosPago);
} else {
    echo "Usuario no encontrado.";
    exit;
}

?>
<div class="tutor-economico">
    <h2>Datos tutor económico</h2>
    <form>
        <div class="form-group">
            <label for="rutTutor">RUT</label>
            <input type="text" class="form-control" name="rut" id="rutTutor" value="<?php echo $tutorEconomico['rut'] ?? ''; ?>">
        </div>
        <div class="form-group">
            <label for="nombresTutor">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombresTutor" value="<?php echo $tutorEconomico['nombre'] ?? ''; ?>">
        </div>
        <div class="form-group">
            <label for="apPaternoTutor">Apellido Paterno</label>
            <input type="text" class="form-control" name="apellido_paterno" id="apPaternoTutor" value="<?php echo $tutorEconomico['apellido_paterno'] ?? ''; ?>">
        </div>
        <div class="form-group">
            <label for="apMaternoTutor">Apellido Materno</label>
            <input type="text" class="form-control" name="apellido_materno" id="apMaternoTutor" value="<?php echo $tutorEconomico['apellido_materno'] ?? ''; ?>">
        </div>
        <div class="form-group">
            <label for="telefono_particular">Teléfono particular</label>
            <input type="text" class="form-control" name="telefono_particular" id="telefono_particular" value="<?php echo $tutorEconomico['telefono_particular'] ?? ''; ?>">
        </div>
        <div class="form-group">
            <label for="telefono_trabajo">Teléfono trabajo</label>
            <input type="text" class="form-control" name="telefono_trabajo" id="telefono_trabajo" value="<?php echo $tutorEconomico['telefono_trabajo'] ?? ''; ?>">
        </div>
        <div class="form-group">
            <label for="calleTutor">Calle</label>
            <input type="text" class="form-control" name="calle" id="calleTutor" value="<?php echo $tutorEconomico['calle'] ?? ''; ?>">
        </div>
        <div class="form-group">
            <label for="nCalleTutor">N° Calle</label>
            <input type="text" class="form-control" name="n_calle" id="nCalleTutor" value="<?php echo $tutorEconomico['n_calle'] ?? ''; ?>">
        </div>
        <div class="form-group">
            <label for="restoDireccionTutor">Resto Dirección</label>
            <input type="text" class="form-control" name="resto_direccion" id="restoDireccionTutor" value="<?php echo $tutorEconomico['resto_direccion'] ?? ''; ?>">
        </div>
        <div class="form-group">
            <label for="villaPoblacionTutor">Villa/Población</label>
            <input type="text" class="form-control" name="villa_poblacion" id="villaPoblacionTutor" value="<?php echo $tutorEconomico['villa_poblacion'] ?? ''; ?>">
        </div>
        <div class="form-group">
            <label for="comunaTutor">Comuna</label>
            <input type="text" class="form-control" name="comuna" id="comunaTutor" value="<?php echo $tutorEconomico['comuna'] ?? ''; ?>">
        </div>
        <div class="form-group">
            <label for="ciudadTutor">Ciudad</label>
            <input type="text" class="form-control" name="ciudad" id="ciudadTutor" value="<?php echo $tutorEconomico['ciudad'] ?? ''; ?>">
        </div>
        <div class="form-group">
            <label for="correoPersonalTutor">Correo Electrónico Personal</label>
            <input type="email" class="form-control" name="correo_electronico_particular" id="correoPersonalTutor" value="<?php echo $tutorEconomico['correo_electronico_particular'] ?? ''; ?>">
        </div>
        <div class="form-group">
            <label for="correoTrabajoTutor">Correo Electrónico Trabajo</label>
            <input type="email" class="form-control" name="correo_electronico_trabajo" id="correoTrabajoTutor" value="<?php echo $tutorEconomico['correo_electronico_trabajo'] ?? ''; ?>">
        </div>
        
        <button type="submit" class="btn btn-primary btn-block custom-button">ACTUALIZAR</button>
    </form>

    <h3>Medios de pago suscritos</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Tipo Medio de Pago</th>
                <th>Banco Emisor</th>
                <th>Fecha suscripción</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php while($fila = $resultadoMediosPago->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($fila['tipo_medio_de_pago']); ?></td>
                    <td><?php echo htmlspecialchars($fila['banco_emisor']); ?></td>
                    <td><?php echo htmlspecialchars($fila['fecha_suscripcion']); ?></td>
                    <td><?php echo htmlspecialchars($fila['estado']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <button type="button" class="btn btn-primary btn-block custom-button">VER DETALLE</button>
</div>
