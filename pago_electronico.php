<div class="pago-electronico">
    <h2>Pago electrónico de cuotas</h2>
    <div class="form-group">
        <label for="rutAlumno">Rut del alumno:</label>
        <input type="text" class="form-control" id="rutAlumno" placeholder="Ingrese RUT del alumno">
        <button class="btn btn-primary custom-button mt-3">Buscar</button>
    </div>
    <button id="btnPagoAutomatico" class="btn btn-warning custom-button mt-3">Pago automático cuentas</button>

    <h3>Valores pendientes de año anterior</h3>
    <!-- Tabla de valores pendientes del año anterior -->
    <!-- La tabla deberá ser llenada con datos dinámicamente -->
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>N° Cuota</th>
                    <th>Tipo Pago</th>
                    <th>Fecha Vencimiento</th>
                    <th>Medio de Pago</th>
                    <th>Fecha de Pago</th>
                    <th>Estado</th>
                    <th>Seleccione Valor a Pagar</th>
                </tr>
            </thead>
            <tbody>
                <!-- Los datos de las cuotas se insertarán aquí -->
            </tbody>
        </table>
    </div>

    <h3>Plan de pago año en curso</h3>
    <!-- Tabla de plan de pago del año en curso -->
    <!-- La tabla deberá ser llenada con datos dinámicamente -->
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>N° Cuota</th>
                    <th>Tipo Pago</th>
                    <th>Fecha Vencimiento</th>
                    <th>Medio de Pago</th>
                    <th>Fecha de Pago</th>
                    <th>Estado</th>
                    <th>Seleccione Valor a Pagar</th>
                </tr>
            </thead>
            <tbody>
                <!-- Los datos de las cuotas se insertarán aquí -->
            </tbody>
        </table>
    </div>

    <button class="btn btn-primary custom-button mt-3">Seleccionar valores</button>

    <h3>Resumen de valores a pagar</h3>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>N° Cupón</th>
                    <th>Fecha</th>
                    <th>RUT alumno</th>
                    <th>Monto</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <!-- Los datos del resumen de pagos se insertarán aquí -->
            </tbody>
        </table>
    </div>

    <div class="total-pagar mt-3">
        <strong>Total a pagar $</strong>
        <!-- Aquí se mostrará el total a pagar calculado -->
    </div>

    <div class="metodos-pago mt-3">
        <button class="btn btn-success custom-button">Pagar con tarjeta CR/DB</button>
        <button class="btn btn-info custom-button">Pagar con transferencia</button>
        <button class="btn btn-secondary custom-button">Agregar otro alumno</button>
    </div>
</div>
<script type="text/javascript">
    document.getElementById('btnPagoAutomatico').addEventListener('click', function() {
        window.location.href = 'bienvenido.php?page=vista_pago_automatico';
    });
</script>