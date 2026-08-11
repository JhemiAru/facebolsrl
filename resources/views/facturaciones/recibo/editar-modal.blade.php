<!-- Modal Editar Recibo -->
<div class="modal fade" id="modalEditarRecibo" tabindex="-1" aria-labelledby="modalEditarReciboLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" method="POST" id="formEditarRecibo">
                @csrf
                @method('PUT')
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="modalEditarReciboLabel">
                        <i class="bi bi-pencil"></i> Ver Detalles del Recibo
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

                    <!-- DATOS DEL RECIBO (SOLO LECTURA) -->
                    <div class="card mb-3"
                        style="background: rgba(245, 158, 11, 0.05); border: 1px solid rgba(245, 158, 11, 0.3);">
                        <div class="card-header"
                            style="background: rgba(245, 158, 11, 0.15) !important; border-bottom: 1px solid rgba(245, 158, 11, 0.3) !important;">
                            <h6 class="mb-0" style="color: #f59e0b !important; font-weight: 700;">
                                <i class="bi bi-file-earmark-text"></i> Información del Recibo
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold" style="color: #f59e0b;">N° Recibo:</label>
                                    <p class="form-control-plaintext" id="edit_n_recibo_display"
                                        style="color: #58a6ff; font-weight: 600; font-size: 1.1rem;">-</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold" style="color: #f59e0b;">Fecha:</label>
                                    <p class="form-control-plaintext" id="edit_fecha_recibo_display"
                                        style="color: #e2e8f0;">-</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold" style="color: #f59e0b;">Cliente:</label>
                                    <p class="form-control-plaintext" id="edit_cliente_display" style="color: #e2e8f0;">
                                        -</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold" style="color: #f59e0b;">CI/NIT:</label>
                                    <p class="form-control-plaintext" id="edit_ci_nit_display" style="color: #e2e8f0;">-
                                    </p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold" style="color: #f59e0b;">Estado de Pago:</label>
                                    <p class="form-control-plaintext" id="edit_estado_display" style="color: #e2e8f0;">-
                                    </p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold" style="color: #f59e0b;">Monto Total:</label>
                                    <p class="form-control-plaintext text-success fw-bold" id="edit_monto_total_display"
                                        style="font-size: 1.2rem;">-</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CONCEPTOS (SOLO LECTURA) -->
                    <div class="card mb-3"
                        style="background: rgba(46, 160, 67, 0.05); border: 1px solid rgba(46, 160, 67, 0.3);">
                        <div class="card-header"
                            style="background: rgba(46, 160, 67, 0.15) !important; border-bottom: 1px solid rgba(46, 160, 67, 0.3) !important;">
                            <h6 class="mb-0" style="color: #10b981 !important; font-weight: 700;">
                                <i class="bi bi-list-ul"></i> Conceptos
                            </h6>
                        </div>
                        <div class="card-body">
                            <div id="conceptosContainerEditDisplay" style="max-height: 300px; overflow-y: auto;">
                                <!-- Los conceptos se cargarán dinámicamente -->
                            </div>
                        </div>
                    </div>

                    <!-- CAMPO EDITABLE: ANULADO -->
                    <div class="card"
                        style="background: rgba(239, 68, 68, 0.05); border: 1px solid rgba(239, 68, 68, 0.3);">
                        <div class="card-header"
                            style="background: rgba(239, 68, 68, 0.15) !important; border-bottom: 1px solid rgba(239, 68, 68, 0.3) !important;">
                            <h6 class="mb-0" style="color: #ef4444 !important; font-weight: 700;">
                                <i class="bi bi-exclamation-triangle"></i> Estado del Recibo
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="form-check form-switch d-flex align-items-center">
                                <input class="form-check-input" type="checkbox" role="switch" id="edit_anulado"
                                    name="anulado" value="1"
                                    style="width: 50px; height: 25px; cursor: pointer; margin-top: 0;">
                                <label class="form-check-label fw-bold" for="edit_anulado"
                                    style="font-size: 1.1rem; margin-bottom: 0; margin-left: 1rem;">
                                    <span id="edit_anulado_text">Recibo Activo</span>
                                </label>
                            </div>
                            <small class="text-muted d-block mt-2">
                                <i class="bi bi-info-circle"></i> Activa el switch para marcar este recibo como anulado
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
                textoAnulado.textContent = 'Recibo Anulado';
                textoAnulado.classList.add('text-danger', 'fw-bold');
                textoAnulado.classList.remove('text-success');
            } else {
                textoAnulado.textContent = 'Recibo Activo';
                textoAnulado.classList.add('text-success', 'fw-bold');
                textoAnulado.classList.remove('text-danger');
            }
        }

        checkboxAnulado.addEventListener('change', actualizarTextoAnulado);

        // Función para mostrar alerta dentro del modal editar
        function mostrarAlertaModalEditarRecibo(tipo, mensaje, errores = null) {
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

            document.querySelector('#modalEditarRecibo .modal-body').scrollTop = 0;
        }

        // Manejar el envío del formulario
        document.getElementById('formEditarRecibo').addEventListener('submit', function(e) {
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
                        mostrarAlertaModalEditarRecibo('success', data.message);
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    } else {
                        const errores = data.errors ? Object.values(data.errors).flat() : [];
                        mostrarAlertaModalEditarRecibo('error', data.message ||
                            'Error al actualizar', errores);
                    }
                })
                .catch(error => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = btnText;
                    mostrarAlertaModalEditarRecibo('error',
                        'No se pudo actualizar el recibo. Por favor, intente nuevamente.');
                });
        });

        // Manejar la apertura del modal de editar
        const modalEditarRecibo = document.getElementById('modalEditarRecibo');
        modalEditarRecibo.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;

            // Extraer datos del botón
            const id = button.getAttribute('data-id');
            const numero = button.getAttribute('data-numero');
            const fecha = button.getAttribute('data-fecha');
            const clienteNombre = button.getAttribute('data-cliente-nombre');
            const ciNit = button.getAttribute('data-ci-nit');
            const estado = button.getAttribute('data-estado');
            const montoTotal = button.getAttribute('data-monto-total');
            const conceptosJson = button.getAttribute('data-conceptos');
            const anulado = button.getAttribute('data-anulado') === '1';

            // Parsear conceptos
            let conceptos = [];
            try {
                conceptos = JSON.parse(conceptosJson || '[]');
            } catch (e) {
                console.error('Error al parsear conceptos:', e);
                conceptos = [];
            }

            // Actualizar el action del formulario
            const form = document.getElementById('formEditarRecibo');
            form.action = '{{ url('/facturacion/recibos') }}/' + id;

            // Mostrar datos en texto plano
            document.getElementById('edit_n_recibo_display').textContent = numero || 'N/A';
            document.getElementById('edit_fecha_recibo_display').textContent = fecha ? new Date(fecha)
                .toLocaleDateString('es-ES') : '-';
            document.getElementById('edit_cliente_display').textContent = clienteNombre || '-';
            document.getElementById('edit_ci_nit_display').textContent = ciNit || 'Sin CI/NIT';

            // Mostrar estado con badge
            let estadoBadge = '';
            if (estado === 'pago_efectivo') {
                estadoBadge = '<span class="badge bg-success">Pago Efectivo</span>';
            } else if (estado === 'pago_deposito') {
                estadoBadge = '<span class="badge bg-info">Pago Depósito</span>';
            } else {
                estadoBadge = '<span class="badge bg-secondary">Sin Estado</span>';
            }
            document.getElementById('edit_estado_display').innerHTML = estadoBadge;

            document.getElementById('edit_monto_total_display').textContent = 'Bs. ' + (parseFloat(
                montoTotal || 0).toFixed(2));

            // Cargar conceptos en texto plano
            const containerDisplay = document.getElementById('conceptosContainerEditDisplay');
            containerDisplay.innerHTML = '';

            if (conceptos.length > 0) {
                conceptos.forEach((concepto, index) => {
                    const conceptoDiv = document.createElement('div');
                    conceptoDiv.className = 'mb-2 p-2 border rounded';
                    conceptoDiv.style.background = 'rgba(255, 255, 255, 0.02)';
                    conceptoDiv.style.borderColor = 'rgba(255, 255, 255, 0.1)';
                    conceptoDiv.innerHTML = `
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <strong class="text-success">${index + 1}. ${concepto.concepto}</strong>
                                <div class="text-muted small mt-1">
                                    <i class="bi bi-calendar3"></i> ${new Date(concepto.fecha_concepto).toLocaleDateString('es-ES')}
                                </div>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-success" style="font-size: 0.9rem;">
                                    Bs. ${parseFloat(concepto.monto).toFixed(2)}
                                </span>
                            </div>
                        </div>
                    `;
                    containerDisplay.appendChild(conceptoDiv);
                });
            } else {
                containerDisplay.innerHTML = '<p class="text-muted text-center">No hay conceptos</p>';
            }

            // Configurar el switch de anulado
            checkboxAnulado.checked = (anulado === true || anulado === '1');
            actualizarTextoAnulado();
        });
    });
</script>
</button>
</div>
</form>
</div>
</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ===== MANEJO DINÁMICO DE CONCEPTOS EN EDITAR =====
        let conceptoIndexEdit = 1;

        // Función para convertir número a letras (igual que en agregar)
        function numeroALetrasEdit(num) {
            if (num === 0) return "CERO 00/100 BOLIVIANOS";

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

                if (n >= 100) {
                    resultado += centenas[Math.floor(n / 100)] + ' ';
                    n %= 100;
                }

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

            let partes = num.toFixed(2).split('.');
            let entero = parseInt(partes[0]);
            let centavos = partes[1];

            if (entero === 0) {
                return 'CERO ' + centavos + '/100 BOLIVIANOS';
            }

            let literal = '';

            if (entero >= 1000000) {
                let millones = Math.floor(entero / 1000000);
                if (millones === 1) {
                    literal += 'UN MILLON ';
                } else {
                    literal += convertirGrupo(millones) + ' MILLONES ';
                }
                entero %= 1000000;
            }

            if (entero >= 1000) {
                literal += convertirMiles(Math.floor(entero / 1000)) + ' ';
                entero %= 1000;
            }

            if (entero > 0) {
                literal += convertirGrupo(entero);
            }

            return literal.trim() + ' ' + centavos + '/100 BOLIVIANOS';
        }

        // Función para calcular el total en editar
        function calcularTotalReciboEdit() {
            let total = 0;
            document.querySelectorAll('.concepto-monto-edit').forEach(input => {
                const monto = parseFloat(input.value) || 0;
                total += monto;
            });
            document.getElementById('totalReciboEdit').textContent = total.toFixed(2);
            const totalLiteral = numeroALetrasEdit(total);
            document.getElementById('totalReciboLiteralEdit').textContent = totalLiteral;

            const campoOculto = document.getElementById('edit_monto_literal');
            if (campoOculto) {
                campoOculto.value = totalLiteral;
            }
        }

        // Agregar nuevo concepto en editar
        const btnAgregarEdit = document.getElementById('btnAgregarConceptoEdit');
        if (btnAgregarEdit) {
            btnAgregarEdit.addEventListener('click', function() {
                const container = document.getElementById('conceptosContainerEdit');
                const fechaHoy = '{{ date('Y-m-d') }}';
                const newConcepto = `
                <div class="concepto-item-edit mb-2 p-2 border rounded" data-index="${conceptoIndexEdit}"
                    style="background: rgba(255, 255, 255, 0.02); border-color: rgba(255, 255, 255, 0.1) !important; animation: slideIn 0.3s ease;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge bg-success concepto-numero-badge-edit">
                            <i class="bi bi-hash"></i><span class="concepto-numero-edit">${conceptoIndexEdit + 1}</span>
                        </span>
                        <button type="button" class="btn btn-danger btn-sm d-inline-flex align-items-center justify-content-center btn-eliminar-concepto-edit" style="width: 32px; height: 32px; padding: 0;">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </div>
                    <div class="mb-2">
                        <input type="text" class="form-control form-control-sm" 
                            name="conceptos[${conceptoIndexEdit}][concepto]"
                            placeholder="Descripción del concepto *" required>
                    </div>
                    <div class="row g-2">
                        <div class="col-6">
                            <input type="date" class="form-control form-control-sm"
                                name="conceptos[${conceptoIndexEdit}][fecha_concepto]"
                                value="${fechaHoy}" required>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">Bs</span>
                                <input type="number" class="form-control form-control-sm concepto-monto-edit"
                                    name="conceptos[${conceptoIndexEdit}][monto]" step="0.01"
                                    placeholder="0.00" required>
                            </div>
                        </div>
                    </div>
                </div>
            `;
                container.insertAdjacentHTML('beforeend', newConcepto);
                conceptoIndexEdit++;
                actualizarNumerosConceptosEdit();
                actualizarBotonesEliminarEdit();

                setTimeout(() => {
                    const items = container.querySelectorAll('.concepto-item-edit');
                    items[items.length - 1].scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest'
                    });
                }, 100);
            });
        }

        // Eliminar concepto en editar
        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn-eliminar-concepto-edit')) {
                const row = e.target.closest('.concepto-item-edit');
                if (document.querySelectorAll('.concepto-item-edit').length > 1) {
                    row.style.animation = 'slideOut 0.3s ease';
                    setTimeout(() => {
                        row.remove();
                        actualizarNumerosConceptosEdit();
                        actualizarBotonesEliminarEdit();
                        calcularTotalReciboEdit();
                    }, 300);
                }
            }
        });

        // Actualizar numeración y atributos name de inputs
        function actualizarNumerosConceptosEdit() {
            document.querySelectorAll('.concepto-item-edit').forEach((row, index) => {
                row.querySelector('.concepto-numero-edit').textContent = index + 1;

                // Actualizar name de todos los inputs manteniendo el orden correcto
                const inputId = row.querySelector('input[name*="[id]"]');
                if (inputId) inputId.name = `conceptos[${index}][id]`;

                row.querySelector('input[name*="[concepto]"]').name = `conceptos[${index}][concepto]`;
                row.querySelector('input[name*="[fecha_concepto]"]').name =
                    `conceptos[${index}][fecha_concepto]`;
                row.querySelector('input[name*="[monto]"]').name = `conceptos[${index}][monto]`;
            });
        }

        // Actualizar estado de botones eliminar en editar
        function actualizarBotonesEliminarEdit() {
            const rows = document.querySelectorAll('.concepto-item-edit');
            rows.forEach((row) => {
                const btnEliminar = row.querySelector('.btn-eliminar-concepto-edit');
                if (rows.length === 1) {
                    btnEliminar.disabled = true;
                } else {
                    btnEliminar.disabled = false;
                }
            });
        }

        // Función para mostrar alerta dentro del modal editar
        function mostrarAlertaModalEditarRecibo(tipo, mensaje, errores = null) {
            const alertaDiv = document.getElementById('alertaModalEditar');
            const contenidoDiv = document.getElementById('alertaModalEditarContenido');

            // Remover clases previas
            alertaDiv.classList.remove('alert-success', 'alert-danger', 'alert-warning', 'show');

            // Agregar clase según el tipo
            if (tipo === 'success') {
                alertaDiv.classList.add('alert-success');
            } else if (tipo === 'error') {
                alertaDiv.classList.add('alert-danger');
            } else if (tipo === 'warning') {
                alertaDiv.classList.add('alert-warning');
            }

            // Construir contenido
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

            // Scroll al inicio del modal para ver la alerta
            document.querySelector('#modalEditarRecibo .modal-body').scrollTop = 0;
        }

        // Calcular total cuando cambia un monto en editar
        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('concepto-monto-edit')) {
                calcularTotalReciboEdit();
            }
        });

        // Inicializar Select2 para el campo de cliente en editar
        $('#edit_id_informacion').select2({
            placeholder: 'Buscar cliente...',
            allowClear: true,
            width: '100%',
            dropdownParent: $('#modalEditarRecibo'),
            language: {
                noResults: function() {
                    return "No se encontraron resultados";
                },
                searching: function() {
                    return "Buscando...";
                }
            }
        });

        // Manejar el envío del formulario con validación
        document.getElementById('formEditarRecibo').addEventListener('submit', function(e) {
            e.preventDefault();

            // Ocultar alertas previas
            document.getElementById('alertaModalEditar').style.display = 'none';

            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const btnText = submitBtn.innerHTML;

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="spinner-border spinner-border-sm"></i> Actualizando...';

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
                        // Cerrar modal y mostrar éxito
                        const modal = bootstrap.Modal.getInstance(document.getElementById(
                            'modalEditarRecibo'));
                        modal.hide();

                        // Mostrar alerta de éxito
                        if (typeof mostrarAlerta === 'function') {
                            mostrarAlerta('success', '¡Éxito!', data.message ||
                                'Recibo actualizado correctamente');
                        }

                        setTimeout(() => {
                            window.location.href = window.location.pathname + '?page=1';
                        }, 1000);
                    } else {
                        // Mostrar errores dentro del modal
                        const errores = data.errors ? Object.values(data.errors).flat() : [data
                            .message || 'Error al actualizar el recibo'
                        ];
                        mostrarAlertaModalEditarRecibo('error',
                            'Por favor corrija los siguientes errores:', errores);
                    }
                })
                .catch(error => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = btnText;
                    mostrarAlertaModalEditarRecibo('error',
                        'No se pudo actualizar el recibo. Por favor, intente nuevamente.');
                });
        });

        // Manejar la apertura del modal de editar
        const modalEditarRecibo = document.getElementById('modalEditarRecibo');
        modalEditarRecibo.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;

            // Extraer datos del botón
            const id = button.getAttribute('data-id');
            const reciboId = button.getAttribute('data-recibo-id');
            const numero = button.getAttribute('data-numero');
            const fecha = button.getAttribute('data-fecha');
            const clienteId = button.getAttribute('data-cliente');
            const ciNit = button.getAttribute('data-ci-nit');
            const estado = button.getAttribute('data-estado');
            const conceptosJson = button.getAttribute('data-conceptos');

            // Parsear conceptos
            let conceptos = [];
            try {
                conceptos = JSON.parse(conceptosJson || '[]');
            } catch (e) {
                console.error('Error al parsear conceptos:', e);
                conceptos = [];
            }

            // Actualizar el action del formulario
            const form = document.getElementById('formEditarRecibo');
            form.action = '{{ url('/facturacion/recibos') }}/' + id;

            // Llenar los campos básicos
            document.getElementById('edit_n_recibo').value = numero || 'N/A';
            document.getElementById('edit_fecha_recibo').value = fecha || '';

            // Actualizar Select2 con el cliente
            if (clienteId) {
                $('#edit_id_informacion').val(clienteId).trigger('change');
            } else {
                $('#edit_id_informacion').val(null).trigger('change');
            }

            document.getElementById('edit_ci_nit').value = ciNit || '';
            document.getElementById('edit_estado').value = estado || 'no_cancelado';

            // Cargar conceptos existentes
            const container = document.getElementById('conceptosContainerEdit');
            container.innerHTML = '';
            conceptoIndexEdit = 0;

            if (conceptos.length > 0) {
                // Cargar conceptos existentes
                conceptos.forEach((concepto, index) => {
                    const conceptoHtml = `
                        <div class="concepto-item-edit mb-2 p-2 border rounded" data-index="${index}"
                            style="background: rgba(255, 255, 255, 0.02); border-color: rgba(255, 255, 255, 0.1) !important;">
                            <input type="hidden" name="conceptos[${index}][id]" value="${concepto.id || ''}">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-success concepto-numero-badge-edit">
                                    <i class="bi bi-hash"></i><span class="concepto-numero-edit">${index + 1}</span>
                                </span>
                                <button type="button" class="btn btn-danger btn-sm d-inline-flex align-items-center justify-content-center btn-eliminar-concepto-edit" style="width: 32px; height: 32px; padding: 0;" ${conceptos.length === 1 ? 'disabled' : ''}>
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </div>
                            <div class="mb-2">
                                <input type="text" class="form-control form-control-sm" 
                                    name="conceptos[${index}][concepto]"
                                    value="${concepto.concepto || ''}"
                                    placeholder="Descripción del concepto *" required>
                            </div>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="date" class="form-control form-control-sm"
                                        name="conceptos[${index}][fecha_concepto]"
                                        value="${concepto.fecha_concepto || '{{ date('Y-m-d') }}'}"
                                        required>
                                </div>
                                <div class="col-6">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Bs</span>
                                        <input type="number" class="form-control form-control-sm concepto-monto-edit"
                                            name="conceptos[${index}][monto]" step="0.01"
                                            value="${concepto.monto || 0}"
                                            placeholder="0.00" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    container.insertAdjacentHTML('beforeend', conceptoHtml);
                    conceptoIndexEdit++;
                });
            } else {
                // Si no hay conceptos, agregar uno vacío
                const primerConcepto = `
                    <div class="concepto-item-edit mb-2 p-2 border rounded" data-index="0"
                        style="background: rgba(255, 255, 255, 0.02); border-color: rgba(255, 255, 255, 0.1) !important;">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-success concepto-numero-badge-edit">
                                <i class="bi bi-hash"></i><span class="concepto-numero-edit">1</span>
                            </span>
                            <button type="button" class="btn btn-danger btn-sm d-inline-flex align-items-center justify-content-center btn-eliminar-concepto-edit" disabled style="width: 32px; height: 32px; padding: 0;">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </div>
                        <div class="mb-2">
                            <input type="text" class="form-control form-control-sm" 
                                name="conceptos[0][concepto]"
                                placeholder="Descripción del concepto *" required>
                        </div>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="date" class="form-control form-control-sm"
                                    name="conceptos[0][fecha_concepto]"
                                    value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">Bs</span>
                                    <input type="number" class="form-control form-control-sm concepto-monto-edit"
                                        name="conceptos[0][monto]" step="0.01"
                                        placeholder="0.00" required>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                container.innerHTML = primerConcepto;
                conceptoIndexEdit = 1;
            }

            // Recalcular total después de cargar conceptos
            setTimeout(() => {
                calcularTotalReciboEdit();
            }, 100);
        });
    });
</script>
