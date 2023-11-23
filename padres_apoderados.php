<div class="parents-apoderados">
    <h2>DATOS PADRES/APODERADOS</h2>
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
    
    <h3>INFORMACIÓN DE PADRES/APODERADOS</h3>
    <form>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="rut">RUT</label>
                <input type="text" class="form-control" id="rut">
            </div>
            <div class="form-group col-md-4">
                <label for="fechaNacimiento">Fecha Nacimiento</label>
                <input type="date" class="form-control" id="fechaNacimiento">
            </div>
            <div class="form-group col-md-4">
                <label for="parentesco">Parentesco</label>
                <input type="text" class="form-control" id="parentesco">
            </div>
        </div>
        <!-- Continuar con los otros campos siguiendo el patrón anterior -->
        <!-- ... -->
        <button type="submit" class="btn btn-primary btn-block custom-button">ACTUALIZAR DATOS</button>
    </form>
</div>
