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
            <h2>OBSERVACIONES</h2>
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