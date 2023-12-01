<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cuadratura de Caja Diaria</title>
    <!-- Agrega los enlaces a los estilos de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        /* Estilo personalizado para el tamaño de letra del título */
        .custom-title {
            font-size: 1.5em;
        }

        /* Estilo personalizado para hacer la tabla responsiva */
        .table-responsive {
            overflow-x: auto;
        }

        /* Estilo personalizado para ajustar el ancho del contenedor */
        .custom-container {
            max-width: 600px; /* Ajusta el ancho según tus preferencias */
            margin: auto;
            margin-top: 20px; /* Ajusta el margen superior según tus preferencias */
        }
    </style>
</head>
<body>

<div class="container mt-5 custom-container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <!-- Título personalizado -->
                    <h2 class="text-center custom-title">CUADRATURA DE CAJA DIARIA</h2>
                </div>
                <div class="card-body">
                    <!-- Formulario de cuadratura de caja -->
                    <form>
                        <!-- Campos de selección de fecha y medio de pago -->
                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <input type="date" class="form-control" id="fecha">
                        </div>
                        
                        <div class="form-group">
                            <label for="medioPago">Medio de Pago</label>
                            <select class="form-control" id="medioPago">
                                <option value="1">Efectivo</option>
                                <option value="3">Cheque</option>
                                <option value="2">Tarjeta POS</option>
                                <option value="4">Khipu</option>
                                <!-- Agrega más opciones según sea necesario -->
                            </select>
                        </div>

                        <!-- Botón para realizar la cuadratura -->
                        <button type="button" class="btn btn-primary btn-block" id="btnBuscar">Buscar</button>
                    </form>

                    <!-- Tabla de Pago con Efectivo -->
                    <div class="table-responsive mt-4">
                    <!-- Título personalizado con un ID para mostrar el total recaudado -->
                        <h2 class="text-center custom-title" id="totalRecaudado">TOTAL RECAUDADO $</h2>
                        <h4 class="section-title">PAGO CON EFECTIVO</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Fecha Pago</th>
                                    <th>Monto</th>
                                    <th>Medio de Pago</th>
                                    <th>Tipo Documento</th>
                                    <th>Estado</th>
                                    <th>RUT Alumno</th>
                                </tr>
                            </thead>
                            <tbody id="tablaEfectivo">
                                <!-- Agrega filas de datos según tus necesidades -->
                                <tr>
                                    <td>Fecha de Pago</td>
                                    <td>Monto</td>
                                    <td>Medio de Pago</td>
                                    <td>Tipo de Documento</td>
                                    <td>Estado</td>
                                    <td>RUT del Alumno</td>
                                </tr>
                                <!-- Puedes agregar más filas según sea necesario -->
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Selecciona Valores</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Nuevo contenedor para PAGO CON CHEQUE -->
    <div class="col-md-12 mt-4">
        <div class="card">
            <div class="card-header">
                <!-- Título y subtítulo personalizados -->
                <h2 class="text-center custom-title">TOTAL RECAUDADO $</h2>
                <h5 class="text-center">PAGO CON CHEQUE</h5>
            </div>
            <div class="card-body">
                <!-- Tabla de Pago con Cheque -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Fecha Pago</th>
                                <th>Monto</th>
                                <th>Medio de Pago</th>
                                <th>Tipo Documento</th>
                                <th>Estado</th>
                                <th>RUT Alumno</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Agrega filas de datos según tus necesidades -->
                            <tr>
                                <td>Fecha de Pago</td>
                                <td>Monto</td>
                                <td>Medio de Pago</td>
                                <td>Tipo de Documento</td>
                                <td>Estado</td>
                                <td>RUT del Alumno</td>
                            </tr>
                            <!-- Puedes agregar más filas según sea necesario -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Nuevo contenedor para PAGO CON CHEQUE -->
    <div class="col-md-12 mt-4">
        <div class="card">
            <div class="card-header">
                <!-- Título y subtítulo personalizados -->
                <h3 class="text-center custom-title">TOTAL RECAUDADO $</h3>
                <h5 class="text-center">PAGO CON TARJETA POS</h5>
            </div>
            <div class="card-body">
                <!-- Tabla de Pago con Cheque -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Fecha Pago</th>
                                <th>Monto</th>
                                <th>Medio de Pago</th>
                                <th>Tipo Documento</th>
                                <th>Estado</th>
                                <th>RUT Alumno</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Agrega filas de datos según tus necesidades -->
                            <tr>
                                <td>Fecha de Pago</td>
                                <td>Monto</td>
                                <td>Medio de Pago</td>
                                <td>Tipo de Documento</td>
                                <td>Estado</td>
                                <td>RUT del Alumno</td>
                            </tr>
                            <!-- Puedes agregar más filas según sea necesario -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-4">
        <div class="card">
            <div class="card-header">
                <!-- Título y subtítulo personalizados -->
                <h3 class="text-center custom-title">TOTAL RECAUDADO $</h3>
                <h5 class="text-center">PAGO CON KHIPU</h5>
            </div>
            <div class="card-body">
                <!-- Tabla de Pago con Cheque -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Fecha Pago</th>
                                <th>Monto</th>
                                <th>Medio de Pago</th>
                                <th>Tipo Documento</th>
                                <th>Estado</th>
                                <th>RUT Alumno</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Agrega filas de datos según tus necesidades -->
                            <tr>
                                <td>Fecha de Pago</td>
                                <td>Monto</td>
                                <td>Medio de Pago</td>
                                <td>Tipo de Documento</td>
                                <td>Estado</td>
                                <td>RUT del Alumno</td>
                            </tr>
                            <!-- Puedes agregar más filas según sea necesario -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <h5 class="text-center">TOTAL RECAUDADO $</h5>
    <button type="submit" class="btn btn-primary btn-block">Generar Reporte</button>
</div>

<!-- Agrega el script de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    document.getElementById('btnBuscar').addEventListener('click', function() {
    var fecha = document.getElementById('fecha').value;
    var medioPago = document.getElementById('medioPago').value;

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'busca_pagos.php?fecha=' + fecha + '&medioPago=' + medioPago, true);
    xhr.onload = function() {
        if (this.status == 200 && this.responseText != '') {
            document.getElementById('tablaEfectivo').innerHTML = this.responseText;
            // Actualizar el total recaudado
            var totalRecaudadoElement = document.querySelector('.totalRecaudado');
            if (totalRecaudadoElement) {
                var totalRecaudado = totalRecaudadoElement.getAttribute('data-total');
                document.getElementById('totalRecaudado').textContent = 'TOTAL RECAUDADO $' + totalRecaudado;
            }
        } else {
            document.getElementById('tablaEfectivo').innerHTML = '<tr><td colspan="6">No se han encontrado datos</td></tr>';
            document.getElementById('totalRecaudado').textContent = 'TOTAL RECAUDADO $0';
        }
    };
    xhr.send();
});


</script>


</body>
</html>
