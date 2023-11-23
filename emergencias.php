<div class="emergency-contact">
    <h2>CONTACTO DE EMERGENCIA</h2>
    <form>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputRUT">RUT</label>
                <input type="text" class="form-control" id="inputRUT">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputNombres">Nombres</label>
                <input type="text" class="form-control" id="inputNombres">
            </div>
            <div class="form-group col-md-4">
                <label for="inputApellidoPaterno">Ap. Paterno</label>
                <input type="text" class="form-control" id="inputApellidoPaterno">
            </div>
            <div class="form-group col-md-4">
                <label for="inputApellidoMaterno">Ap. Materno</label>
                <input type="text" class="form-control" id="inputApellidoMaterno">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputTelefono">Teléfono</label>
                <input type="text" class="form-control" id="inputTelefono">
            </div>
            <div class="form-group col-md-6">
                <label for="inputEmail">Correo Electrónico</label>
                <input type="email" class="form-control" id="inputEmail">
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">ACTUALIZAR CONTACTO DE EMERGENCIA</button>
    </form>
</div>

<div class="medical-record">
    <h2>ANTECEDENTES MÉDICOS (ENFERMEDADES / ALERGIAS)</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Categoría</th>
                <th>Descripción</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <!-- Las filas de la tabla se agregarán aquí -->
        </tbody>
    </table>
    <button type="submit" class="btn btn-primary btn-block">ACTUALIZAR ANTECEDENTES MÉDICOS</button>
</div>
