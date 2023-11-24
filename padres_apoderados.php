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
                <th></th> <!-- Columna para 'Ver detalle' -->
            </tr>
        </thead>
        <tbody>
            <!-- Los datos de los padres/apoderados se insertarán aquí -->
        </tbody>
    </table>
    
    <h3>Información de padres/apoderados</h3>
    <form>
        <div class="form-group">
            <label for="rut">RUT</label>
            <input type="text" class="form-control" id="rut">
        </div>
        <div class="form-group">
            <label for="fechaNacimiento">Fecha Nacimiento</label>
            <input type="date" class="form-control" id="fechaNacimiento">
        </div>
        <div class="form-group">
            <label for="parentesco">Parentesco</label>
            <input type="text" class="form-control" id="parentesco">
        </div>
        <div class="form-group">
            <label for="nombres">Nombres</label>
            <input type="text" class="form-control" id="nombres">
        </div>
        <div class="form-group">
            <label for="apellidoPaterno">Apellido Paterno</label>
            <input type="text" class="form-control" id="apellidoPaterno">
        </div>
        <div class="form-group">
            <label for="apellidoMaterno">Apellido Materno</label>
            <input type="text" class="form-control" id="apellidoMaterno">
        </div>
        <div class="form-group">
            <label for="calle">Calle</label>
            <input type="text" class="form-control" id="calle">
        </div>
        <div class="form-group">
            <label for="numero">N°</label>
            <input type="text" class="form-control" id="numero">
        </div>
        <div class="form-group">
            <label for="restoDireccion">Resto Dirección</label>
            <input type="text" class="form-control" id="restoDireccion">
        </div>
        <div class="form-group">
            <label for="villaPoblacion">Villa/Población</label>
            <input type="text" class="form-control" id="villaPoblacion">
        </div>
        <div class="form-group">
            <label for="comuna">Comuna</label>
            <input type="text" class="form-control" id="comuna">
        </div>
        <div class="form-group">
            <label for="ciudad">Ciudad</label>
            <input type="text" class="form-control" id="ciudad">
        </div>
        <div class="form-group">
            <label for="telefonoParticular">Teléfono Particular</label>
            <input type="tel" class="form-control" id="telefonoParticular">
        </div>
        <div class="form-group">
            <label for="telefonoTrabajo">Teléfono Trabajo</label>
            <input type="tel" class="form-control" id="telefonoTrabajo">
        </div>
        <div class="form-group">
            <label for="correoElectronicoPersonal">Correo Electrónico Personal</label>
            <input type="email" class="form-control" id="correoElectronicoPersonal">
        </div>
        <div class="form-group">
            <label for="correoElectronicoTrabajo">Correo Electrónico Trabajo</label>
            <input type="email" class="form-control" id="correoElectronicoTrabajo">
        </div>
        
        <button type="submit" class="btn btn-primary btn-block custom-button">ACTUALIZAR DATOS</button>
    </form>
</div>
