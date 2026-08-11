<!-- Modal Ver Detalles de la Factura -->
<div class="modal fade" id="modalEditarFactura" tabindex="-1" aria-labelledby="modalEditarFacturaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" method="POST" id="formEditarFactura">
                @csrf
                @method('PUT')
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="modalEditarFacturaLabel">
                        <i class="bi bi-pencil-square"></i> Editar Factura
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Contenedor de alertas dentro del modal -->
                    <div id="alertaModalEditar" class="alert alert-dismissible fade" role="alert"
                        style="display: none;">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div id="alertaModalEditarContenido"></div>
                    </div>

                    <!-- Card 1: Información de la Factura (EDITABLE) -->
                    <div class="card mb-3"
                        style="background: rgba(245, 158, 11, 0.05); border: 1px solid rgba(245, 158, 11, 0.3);">
                        <div class="card-header"
                            style="background: rgba(245, 158, 11, 0.15) !important; border-bottom: 1px solid rgba(245, 158, 11, 0.3) !important;">
                            <h6 class="mb-0" style="color: #f59e0b !important; font-weight: 700;">
                                <i class="bi bi-file-earmark-text"></i> Información de la Factura
                            </h6>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="n_registro" id="edit_n_registro">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold" style="color: #f59e0b;">N° Factura:</label>
                                    <input type="text" class="form-control" id="edit_n_factura_display"
                                        style="color: #58a6ff; font-weight: 600; background: #1e293b; border-color: #f59e0b; cursor: not-allowed;"
                                        readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold" style="color: #f59e0b;">Fecha: <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="fecha" id="edit_fecha" required
                                        style="background: #1e293b; border-color: #f59e0b; color: #e2e8f0;">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold" style="color: #f59e0b;">Cliente: <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" name="id_informacion" id="edit_cliente" required
                                        style="background: #1e293b; border-color: #f59e0b; color: #e2e8f0;">
                                        <option value="">Seleccionar cliente</option>
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->id }}">
                                                {{ $cliente->nombre }} {{ $cliente->apellido_paterno }}
                                                {{ $cliente->apellido_materno }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold" style="color: #f59e0b;">CI/NIT:</label>
                                    <input type="text" class="form-control" name="ci_nit" id="edit_ci_nit"
                                        placeholder="Ingrese CI/NIT" pattern="[0-9]*" inputmode="numeric"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                        style="background: #1e293b; border-color: #f59e0b; color: #e2e8f0;">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold" style="color: #f59e0b;">Estado de Pago: <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" name="estado" id="edit_estado" required
                                        style="background: #1e293b; border-color: #f59e0b; color: #e2e8f0;">
                                        <option value="no_cancelado">No Cancelado</option>
                                        <option value="pago_efectivo">Pago Efectivo</option>
                                        <option value="pago_deposito">Pago Depósito</option>
                                        <option value="pago_horas">Pago Horas</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold" style="color: #f59e0b;">Monto: <span
                                            class="text-danger">*</span></label>
                                    <input type="number" step="0.01" class="form-control" name="monto"
                                        id="edit_monto" placeholder="0.00" required min="0" inputmode="decimal"
                                        pattern="[0-9]+(\.[0-9]{1,2})?"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        style="background: #1e293b; border-color: #f59e0b; color: #e2e8f0;">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold" style="color: #f59e0b;">Monto Literal:</label>
                                <input type="text" class="form-control" name="monto_literal"
                                    id="edit_monto_literal" placeholder="Ej: Cien bolivianos 00/100" readonly
                                    style="background: #1e293b; border-color: #f59e0b; color: #e2e8f0; cursor: not-allowed;">
                            </div>
                            <div class="mb-0">
                                <label class="form-label fw-bold" style="color: #f59e0b;">Concepto: <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control text-uppercase" name="concepto" id="edit_concepto" rows="3"
                                    placeholder="Ingrese el concepto de la factura" required
                                    style="background: #1e293b; border-color: #f59e0b; color: #e2e8f0;"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Estado de la Factura (ÚNICO CAMPO EDITABLE) -->
                    <div class="card"
                        style="background: rgba(239, 68, 68, 0.05); border: 1px solid rgba(239, 68, 68, 0.3);">
                        <div class="card-header"
                            style="background: rgba(239, 68, 68, 0.15) !important; border-bottom: 1px solid rgba(239, 68, 68, 0.3) !important;">
                            <h6 class="mb-0" style="color: #ef4444 !important; font-weight: 700;">
                                <i class="bi bi-exclamation-triangle"></i> Estado de la Factura
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="form-check form-switch d-flex align-items-center">
                                <input class="form-check-input me-3" type="checkbox" role="switch"
                                    id="edit_anulado" name="anulado" value="1"
                                    style="width: 50px; height: 25px; cursor: pointer; margin-top: 0;">
                                <label class="form-check-label fw-bold" for="edit_anulado"
                                    style="font-size: 1.1rem; margin-bottom: 0; margin-left:1rem;">
                                    <span id="edit_anulado_text">Factura Activa</span>
                                </label>
                            </div>
                            <small class="text-muted d-block mt-2">
                                <i class="bi bi-info-circle"></i> Activa el switch para marcar esta factura como
                                anulada
                            </small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Cerrar
                    </button>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-save"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Manejar el cambio de estado del switch de anulado
        const checkboxAnulado = document.getElementById('edit_anulado');
        const textoAnulado = document.getElementById('edit_anulado_text');

        function actualizarTextoAnulado() {
            if (checkboxAnulado.checked) {
                textoAnulado.textContent = 'Factura Anulada';
                textoAnulado.classList.add('text-danger', 'fw-bold');
                textoAnulado.classList.remove('text-success');
            } else {
                textoAnulado.textContent = 'Factura Activa';
                textoAnulado.classList.add('text-success', 'fw-bold');
                textoAnulado.classList.remove('text-danger');
            }
        }

        checkboxAnulado.addEventListener('change', actualizarTextoAnulado);

        // Conversión de número a letras
        function numeroALetras(num) {
            if (num === 0) return "Cero 00/100";

            const unidades = ['', 'UNO', 'DOS', 'TRES', 'CUATRO', 'CINCO', 'SEIS', 'SIETE', 'OCHO', 'NUEVE'];
            const decenas = ['', '', 'VEINTE', 'TREINTA', 'CUARENTA', 'CINCUENTA', 'SESENTA', 'SETENTA',
                'OCHENTA', 'NOVENTA'
            ];
            const especiales = ['DIEZ', 'ONCE', 'DOCE', 'TRECE', 'CATORCE', 'QUINCE', 'DIECISEIS', 'DIECISIETE',
                'DIECIOCHO', 'DIECINUEVE'
            ];
            const centenas = ['', 'CIENTO', 'DOSCIENTOS', 'TRESCIENTOS', 'CUATROCIENTOS', 'QUINIENTOS',
                'SEISCIENTOS', 'SETECIENTOS', 'OCHOCIENTOS', 'NOVECIENTOS'
            ];

            function convertirGrupo(n) {
                if (n === 0) return '';
                if (n === 100) return 'CIEN';

                let resultado = '';

                // Centenas
                if (n >= 100) {
                    resultado += centenas[Math.floor(n / 100)] + ' ';
                    n %= 100;
                }

                // Decenas y unidades
                if (n >= 10 && n < 20) {
                    resultado += especiales[n - 10];
                } else {
                    if (n >= 20) {
                        resultado += decenas[Math.floor(n / 10)];
                        if (n % 10 > 0) {
                            resultado += ' Y ' + unidades[n % 10];
                        }
                    } else if (n > 0) {
                        resultado += unidades[n];
                    }
                }

                return resultado.trim();
            }

            function convertirMiles(n) {
                if (n === 0) return '';
                if (n === 1) return 'MIL';
                if (n < 1000) return convertirGrupo(n) + ' MIL';

                let miles = Math.floor(n / 1000);
                let resultado = '';

                if (miles === 1) {
                    resultado = 'MIL';
                } else {
                    resultado = convertirGrupo(miles) + ' MIL';
                }

                return resultado;
            }

            // Separar parte entera y decimal
            let partes = num.toFixed(2).split('.');
            let entero = parseInt(partes[0]);
            let centavos = partes[1];

            if (entero === 0) {
                return 'CERO ' + centavos + '/100 BOLIVIANOS';
            }

            let literal = '';

            // Millones
            if (entero >= 1000000) {
                let millones = Math.floor(entero / 1000000);
                if (millones === 1) {
                    literal += 'UN MILLON ';
                } else {
                    literal += convertirGrupo(millones) + ' MILLONES ';
                }
                entero %= 1000000;
            }

            // Miles
            if (entero >= 1000) {
                literal += convertirMiles(Math.floor(entero / 1000)) + ' ';
                entero %= 1000;
            }

            // Centenas, decenas y unidades
            if (entero > 0) {
                literal += convertirGrupo(entero);
            }

            return literal.trim() + ' ' + centavos + '/100 BOLIVIANOS';
        }

        // Auto-calcular monto literal en modal editar
        document.getElementById('edit_monto').addEventListener('input', function() {
            const valor = parseFloat(this.value) || 0;
            document.getElementById('edit_monto_literal').value = numeroALetras(valor);
        });

        // Función para mostrar alerta dentro del modal editar
        function mostrarAlertaModalEditarRegistro(tipo, mensaje, errores = null) {
            const alertaDiv = document.getElementById('alertaModalEditar');
            const contenidoDiv = document.getElementById('alertaModalEditarContenido');

            alertaDiv.classList.remove('alert-success', 'alert-danger', 'alert-warning', 'show');

            if (tipo === 'success') {
                alertaDiv.classList.add('alert-success');
            } else if (tipo === 'error') {
                alertaDiv.classList.add('alert-danger');
            } else if (tipo === 'warning') {
                alertaDiv.classList.add('alert-warning');
            }

            let html = '<strong>' + (tipo === 'success' ? '¡Éxito!' : tipo === 'error' ? '¡Error!' :
                '¡Atención!') + '</strong> ' + mensaje;

            if (errores && errores.length > 0) {
                html += '<ul class="mb-0 mt-2">';
                errores.forEach(error => {
                    html += '<li>' + error + '</li>';
                });
                html += '</ul>';
            }

            contenidoDiv.innerHTML = html;
            alertaDiv.style.display = 'block';
            alertaDiv.classList.add('show');

            document.querySelector('#modalEditarFactura .modal-body').scrollTop = 0;
        }

        // Manejar el envío del formulario
        document.getElementById('formEditarFactura').addEventListener('submit', function(e) {
            e.preventDefault();

            document.getElementById('alertaModalEditar').style.display = 'none';

            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const btnText = submitBtn.innerHTML;

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="spinner-border spinner-border-sm"></i> Guardando...';

            fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = btnText;

                    if (data.success) {
                        // Cerrar modal
                        const modal = bootstrap.Modal.getInstance(document.getElementById(
                            'modalEditarFactura'));
                        modal.hide();

                        // Mostrar alerta del index
                        if (typeof mostrarAlerta === 'function') {
                            mostrarAlerta('success', '¡Éxito!', data.message);
                        }

                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    } else {
                        const errores = data.errors ? Object.values(data.errors).flat() : [];
                        mostrarAlertaModalEditarRegistro('error', data.message ||
                            'Error al actualizar', errores);
                    }
                })
                .catch(error => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = btnText;
                    mostrarAlertaModalEditarRegistro('error',
                        'No se pudo actualizar la factura. Por favor, intente nuevamente.');
                });
        });

        // Manejar la apertura del modal de Editar Factura
        var modalEditarFactura = document.getElementById('modalEditarFactura');
        modalEditarFactura.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;

            // Extraer datos
            var id = button.getAttribute('data-id');
            var numero = button.getAttribute('data-numero');
            var fecha = button.getAttribute('data-fecha');
            var clienteId = button.getAttribute('data-cliente-id');
            var clienteNombre = button.getAttribute('data-cliente-nombre');
            var ciNit = button.getAttribute('data-ci-nit');
            var concepto = button.getAttribute('data-concepto');
            var monto = button.getAttribute('data-monto');
            var montoLiteral = button.getAttribute('data-monto-literal');
            var estado = button.getAttribute('data-estado');
            var anulado = button.getAttribute('data-anulado');

            // Actualizar el action del formulario
            var form = document.getElementById('formEditarFactura');
            form.action = '{{ url('/facturacion/comprobantes') }}/' + id;

            // Cargar datos en los campos editables
            document.getElementById('edit_n_factura_display').value = numero || 'N/A';
            document.getElementById('edit_n_registro').value = numero || '';
            document.getElementById('edit_fecha').value = fecha || '';
            document.getElementById('edit_cliente').value = clienteId || '';
            document.getElementById('edit_ci_nit').value = ciNit || '';
            document.getElementById('edit_concepto').value = concepto || '';
            document.getElementById('edit_monto').value = monto || '0';
            document.getElementById('edit_monto_literal').value = montoLiteral || '';
            document.getElementById('edit_estado').value = estado || 'no_cancelado';

            // Configurar el switch de anulado
            checkboxAnulado.checked = (anulado === '1');
            actualizarTextoAnulado();
        });
    });
</script>
