<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Portal de Pago</title>
    <!-- Agrega los enlaces a los estilos de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Portal de Pago</h2>
                </div>
                <div class="card-body">
                    <!-- Formulario de pago -->
                    <form>
                        <!-- Campo RUT del alumno -->
                        <div class="form-group">
                            <label for="rutAlumno">Rut del alumno:</label>
                            <input type="text" class="form-control" id="rutAlumno" placeholder="Ingrese RUT del alumno">
                            <button type="button" class="btn btn-primary custom-button mt-3" id="btnBuscarAlumno">Buscar</button>
                        </div>
                        
                        <!-- Campo RUT del padre/poderado -->
                        <div class="form-group">
                            <label for="rutPadre">RUT del Padre/Poderado</label>
                            <input type="text" class="form-control" id="rutPadre" placeholder="Ingrese el RUT del Padre/Apoderado">
                        </div>

                        <!-- Botón de pago -->
                        <button type="submit" class="btn btn-primary btn-block">Realizar Pago</button>


<!-- Tabla de pagos -->
<div class="mt-4 table-responsive">
                            <h4>Saldo Periodo Anterior</h4>
                            <table class="table" id="tablaSaldoPeriodoAnterior">
                                <thead>
                                    <tr>
                                        <th>N° Cuota</th>
                                        <th>Fecha Vencimiento</th>
                                        <th>Monto</th>
                                        <th>Medio de Pago</th>
                                        <th>Fecha de Pago</th>
                                        <th>Estado</th>
                                        <th>Seleccione Valor a Pagar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Aquí irán las filas con la información de los pagos -->
                                </tbody>
                            </table>
                        </div>

<!-- Tabla de cuotas del periodo actual -->
<div class="mt-4 table-responsive">
                            <h4>Cuotas Periodo Actual</h4>
                            <table class="table" id="tablaCuotasPeriodoActual">
                                <thead>
                                    <tr>
                                        <th>N° Cuota</th>
                                        <th>Fecha Vencimiento</th>
                                        <th>Monto</th>
                                        <th>Medio de Pago</th>
                                        <th>Fecha de Pago</th>
                                        <th>Estado</th>
                                        <th>Seleccione Valor a Pagar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Aquí irán las filas con la información de las cuotas del periodo actual -->
                                </tbody>
                            </table>
                        </div>

                        <div>
                            <button type="button" class="btn btn-primary" id="btnSeleccionarValores">Seleccionar valores</button>
                        </div>

                        <!-- Sección "Total a Pagar $" -->
                        <div class="mt-4">
                            <h4 id="totalAPagar">Total a Pagar $</h4>
                            <h6>Seleccione Medio de Pago</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="efectivo">
                                <label class="form-check-label" for="efectivo">
                                    Efectivo
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="pagoPos">
                                <label class="form-check-label" for="pagoPos">
                                    Pago Tarjeta POS
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="cheque">
                                <label class="form-check-label" for="cheque">
                                    Cheque
                                </label>
                            </div>
                        </div>

                        <!-- Sección "PAGO CON EFECTIVO" -->
                        <div class="mt-4">
                            <h4>PAGO CON EFECTIVO</h4>
                            <div class="form-group">
                                <label for="tipoDocumento">Tipo Documento</label>
                                <input type="text" class="form-control" id="tipoDocumento" placeholder="Ingrese el tipo de documento">
                            </div>
                            <div class="form-group">
                                <label for="montoEfectivo">Monto</label>
                                <input type="text" class="form-control" id="montoEfectivo" placeholder="Ingrese el monto">
                            </div>
                            <div class="form-group">
                                <label for="fechaPagoEfectivo">Fecha Pago</label>
                                <input type="date" class="form-control" id="fechaPagoEfectivo">
                            </div>
                        </div>
                        <!-- Sección "PAGO CON CHEQUE" -->
                        <div class="mt-4">
                            <h4>PAGO CON CHEQUE</h4>
                            <div class="form-group">
                                <label for="tipoDocumentoCheque">Tipo Documento</label>
                                <input type="text" class="form-control" id="tipoDocumentoCheque" placeholder="Ingrese el tipo de documento">
                            </div>
                            <div class="form-group">
                                <label for="numeroDocumentoCheque">N°Documento</label>
                                <input type="text" class="form-control" id="numeroDocumentoCheque" placeholder="Ingrese el número de documento">
                            </div>
                            <div class="form-group">
                                <label for="fechaEmisionCheque">Fecha Emisión</label>
                                <input type="date" class="form-control" id="fechaEmisionCheque">
                            </div>
                            <div class="form-group">
                                <label for="bancoCheque">Banco</label>
                                <input type="text" class="form-control" id="bancoCheque" placeholder="Ingrese el banco">
                            </div>
                            <div class="form-group">
                                <label for="montoCheque">Monto</label>
                                <input type="text" class="form-control" id="montoCheque" placeholder="Ingrese el monto">
                            </div>
                            <div class="form-group">
                                <label for="fechaDepositoCheque">Fecha Depósito</label>
                                <input type="date" class="form-control" id="fechaDepositoCheque">
                            </div>
                        </div>
                        <!-- Sección "PAGO CON TARJETA POS" -->
                        <div class="mt-4">
                            <h4>PAGO CON TARJETA POS</h4>
                            <div class="form-group">
                                <label for="tipoDocumentoPos">Tipo Documento</label>
                                <input type="text" class="form-control" id="tipoDocumentoPos" placeholder="Ingrese el tipo de documento">
                            </div>
                            <div class="form-group">
                                <label for="montoPos">Monto</label>
                                <input type="text" class="form-control" id="montoPos" placeholder="Ingrese el monto">
                            </div>
                            <div class="form-group">
                                <label for="fechaPagoPos">Fecha Pago</label>
                                <input type="date" class="form-control" id="fechaPagoPos">
                            </div>
                            <div class="form-group">
                                <label for="comprobantePos">N°Comprobante o Voucher</label>
                                <input type="text" class="form-control" id="comprobantePos" placeholder="Ingrese el número de comprobante o voucher">
                            </div>
                            <div class="form-group">
                                <label for="tipoTarjetaPos">Tipo Tarjeta</label>
                                <input type="text" class="form-control" id="tipoTarjetaPos" placeholder="Ingrese el tipo de tarjeta">
                            </div>
                            <div class="form-group">
                                <label for="cuotasPos">Cantidad de Cuotas</label>
                                <input type="text" class="form-control" id="cuotasPos" placeholder="Ingrese la cantidad de cuotas">
                            </div>
                        </div>
                        <!-- Botón "REGISTRAR PAGO" en azul -->
                        <button type="button" class="btn btn-primary btn-block mt-4">REGISTRAR PAGO</button>

                    </form>
                </div>   
            </div>
        </div>
    </div>
</div>

<!-- Agrega el script de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
document.getElementById('btnBuscarAlumno').addEventListener('click', function() {
    var rutAlumno = document.getElementById('rutAlumno').value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'busca_alumno.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.status == 200) {
            var response = JSON.parse(this.responseText);
            if(response.encontrado){
                alert('Rut encontrado');
                actualizarTabla(response.datosAnterior, 'tablaSaldoPeriodoAnterior');
                actualizarTabla(response.datosActual, 'tablaCuotasPeriodoActual');
            } else {
                alert('Rut no encontrado');
            }
        }
    };
    xhr.send('rut=' + rutAlumno);
});

function actualizarTabla(datos, idTabla) {
    var tbody = document.getElementById(idTabla).getElementsByTagName('tbody')[0];
    tbody.innerHTML = ''; // Limpiar la tabla actual

    var contador = 1;
    datos.forEach(function(cuota) {
        var row = tbody.insertRow();
        row.insertCell(0).innerHTML = contador++; // N° Cuota
        row.insertCell(1).innerHTML = cuota.fecha_cuota_deuda; // Fecha Vencimiento
        row.insertCell(2).innerHTML = cuota.monto; // Monto
        // Asegúrate de que esta celda está vacía o contiene el dato correcto para 'Medio de Pago'
        row.insertCell(3).innerHTML = ''; // Medio de Pago
        // Asegúrate de que esta celda está vacía o contiene el dato correcto para 'Fecha de Pago'
        row.insertCell(4).innerHTML = ''; // Fecha de Pago

        // Asignar texto según el estado de la cuota
        var estadoTexto = '';
        switch(cuota.estado_cuota) {
            case '0':
                estadoTexto = 'VIGENTE';
                break;
            case '1':
                estadoTexto = 'VENCIDA';
                break;
            case '2':
                estadoTexto = 'PAGADA';
                break;
        }
        row.insertCell(5).innerHTML = estadoTexto; // Estado

        // Asegúrate de que esta celda está vacía o contiene el dato correcto para 'Seleccione Valor a Pagar'
        row.insertCell(6).innerHTML = ''; // Seleccione Valor a Pagar

        var cell = row.insertCell(6); // Celda para el checkbox
        var checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.classList.add('cuota-checkbox'); // Clase para identificar el checkbox
        checkbox.value = cuota.monto; // Asignar el monto como valor del checkbox
        cell.appendChild(checkbox); // Agregar el checkbox a la celda
    });
}
document.getElementById('btnSeleccionarValores').addEventListener('click', function() {
    var checkboxes = document.querySelectorAll('.cuota-checkbox:checked'); // Seleccionar solo los checkboxes marcados
    var total = 0;
    checkboxes.forEach(function(checkbox) {
        total += parseFloat(checkbox.value);
    });
    document.getElementById('totalAPagar').textContent = 'Total a Pagar $ ' + total.toFixed(2);
});


</script>





</body>
</html>
