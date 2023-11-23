<div class="tutor-economico">
    <h2>DATOS TUTOR ECONÓMICO</h2>
    <form>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="rutTutor">RUT</label>
                <input type="text" class="form-control" id="rutTutor">
            </div>
            <div class="form-group col-md-4">
                <label for="fechaNacimientoTutor">Fecha Nacimiento</label>
                <input type="date" class="form-control" id="fechaNacimientoTutor">
            </div>
            <div class="form-group col-md-4">
                <label for="parentescoTutor">Parentesco</label>
                <input type="text" class="form-control" id="parentescoTutor">
            </div>
        </div>
        <!-- Continuar con los otros campos siguiendo el patrón anterior -->
        <!-- ... -->
        <button type="submit" class="btn btn-primary btn-block custom-button">ACTUALIZAR</button>
    </form>

    <h3>MEDIOS DE PAGO SUSCRITOS</h3>
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
            <!-- Las filas de la tabla de medios de pago se agregarán aquí -->
        </tbody>
    </table>
    <button type="button" class="btn btn-primary btn-block custom-button">VER DETALLE</button>
</div>
