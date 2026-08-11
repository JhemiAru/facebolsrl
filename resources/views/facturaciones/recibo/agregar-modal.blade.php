<!-- Modal Agregar Factura -->
<div class="modal fade" id="modalAgregarRecibo" tabindex="-1" aria-labelledby="modalAgregarReciboLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{ route('facturacion.recibo.store') }}" method="POST" id="formAgregarFactura">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalAgregarReciboLabel">
                        <i class="bi bi-plus-circle"></i> Nuevo Recibo
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Contenedor de alertas dentro del modal -->
                    <div id="alertaModalAgregarRecibo" class="alert alert-dismissible fade" role="alert"
                        style="display: none;">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div id="alertaModalAgregarReciboContenido"></div>
                    </div>

                    <div class="row">
                        <!-- COLUMNA IZQUIERDA: DATOS PRINCIPALES -->
                        <div class="col-md-6">
                            <div class="card h-100"
                                style="background: rgba(88, 166, 255, 0.05); border: 1px solid rgba(88, 166, 255, 0.2);">
                                <div class="card-header" style="background: rgba(88, 166, 255, 0.1);">
                                    <h6 class="mb-0"><i class="bi bi-file-earmark-text"></i> Datos del Recibo</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="n_recibo_preview" class="form-label">N° Recibo
                                            <small class="text-muted">(Automático)</small>
                                        </label>
                                        <input type="text" class="form-control" id="n_recibo_preview"
                                            value="{{ $siguienteNumero }}" readonly
                                            style="background-color: rgba(88, 166, 255, 0.1) !important; cursor: not-allowed;">
                                    </div>
                                    <div class="mb-3">
                                        <label for="fecha_recibo" class="form-label">Fecha Recibo <span
                                                class="text-danger">*</span></label>
                                        <input type="date"
                                            class="form-control @error('fecha_recibo') is-invalid @enderror"
                                            name="fecha_recibo" id="fecha_recibo"
                                            value="{{ old('fecha_recibo', date('Y-m-d')) }}" required>
                                        @error('fecha_recibo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="id_informacion" class="form-label">Cliente <span
                                                class="text-danger">*</span></label>
                                        <select
                                            class="form-control select2-cliente @error('id_informacion') is-invalid @enderror"
                                            name="id_informacion" id="id_informacion" required>
                                            <option value="">Seleccione un cliente</option>
                                            @foreach ($clientes as $cliente)
                                                <option value="{{ $cliente->id }}"
                                                    {{ old('id_informacion') == $cliente->id ? 'selected' : '' }}>
                                                    {{ $cliente->nombre }} {{ $cliente->apellido_paterno }}
                                                    {{ $cliente->apellido_materno }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_informacion')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="ci_nit" class="form-label">CI/NIT</label>
                                        <input type="text" class="form-control @error('ci_nit') is-invalid @enderror"
                                            name="ci_nit" id="ci_nit" placeholder="Ej: 12345678"
                                            value="{{ old('ci_nit') }}" pattern="[0-9]*" inputmode="numeric"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                        @error('ci_nit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="estado" class="form-label">Estado de Pago <span
                                                class="text-danger">*</span></label>
                                        <select name="estado" id="estado"
                                            class="form-control @error('estado') is-invalid @enderror" required>
                                            <option value="" disabled {{ old('estado') ? '' : 'selected' }}>
                                                Seleccione estado de pago</option>
                                            <option value="pago_efectivo"
                                                {{ old('estado') == 'pago_efectivo' ? 'selected' : '' }}>
                                                Pago Efectivo
                                            </option>
                                            <option value="pago_deposito"
                                                {{ old('estado') == 'pago_deposito' ? 'selected' : '' }}>
                                                Pago Depósito
                                            </option>
                                        </select>
                                        @error('estado')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNA DERECHA: CONCEPTOS -->
                        <div class="col-md-6">
                            <div class="card h-100"
                                style="background: rgba(46, 160, 67, 0.05); border: 1px solid rgba(46, 160, 67, 0.2);">
                                <div class="card-header d-flex justify-content-between align-items-center py-2"
                                    style="background: rgba(46, 160, 67, 0.1);">
                                    <h6 class="mb-0"><i class="bi bi-list-ul"></i> Conceptos</h6>
                                    <button type="button"
                                        class="btn btn-success btn-sm d-inline-flex align-items-center"
                                        id="btnAgregarConcepto" title="Agregar nuevo concepto"
                                        style="width: auto; white-space: nowrap;">
                                        <i class="bi bi-plus-circle me-1"></i> Agregar
                                    </button>
                                </div>
                                <div class="card-body p-2"
                                    style="max-height: 450px; overflow-y: auto; overflow-x: hidden;">
                                    <div id="conceptosContainer" class="conceptos-list">
                                        <!-- Primer concepto (obligatorio) -->
                                        <div class="concepto-item mb-2 p-2 border rounded" data-index="0"
                                            style="background: rgba(255, 255, 255, 0.02); border-color: rgba(255, 255, 255, 0.1) !important;">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span class="badge bg-success concepto-numero-badge">
                                                    <i class="bi bi-hash"></i><span class="concepto-numero">1</span>
                                                </span>
                                                <button type="button"
                                                    class="btn btn-danger btn-sm d-inline-flex align-items-center justify-content-center btn-eliminar-concepto"
                                                    disabled style="width: 32px; height: 32px; padding: 0;">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </div>
                                            <div class="mb-2">
                                                <input type="text" class="form-control form-control-sm"
                                                    name="conceptos[0][concepto]"
                                                    placeholder="Descripción del concepto *" required
                                                    style="text-transform: uppercase;">
                                            </div>
                                            <div class="row g-2">
                                                <div class="col-6">
                                                    <input type="date" class="form-control form-control-sm"
                                                        name="conceptos[0][fecha_concepto]"
                                                        value="{{ date('Y-m-d') }}" required
                                                        title="Fecha del concepto">
                                                </div>
                                                <div class="col-6">
                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-text">Bs</span>
                                                        <input type="number"
                                                            class="form-control form-control-sm concepto-monto"
                                                            name="conceptos[0][monto]" step="0.01"
                                                            placeholder="0.00" required title="Monto en bolivianos"
                                                            pattern="[0-9]+(\.[0-9]{1,2})?" inputmode="decimal"
                                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Total fijo -->
                                    <div class="mt-2 pt-2 px-2 border-top"
                                        style="background: rgba(46, 160, 67, 0.08); margin: 0 -0.5rem -0.5rem; border-radius: 0 0 0.375rem 0.375rem;">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <h6 class="mb-0 text-success"><i class="bi bi-calculator"></i> Total:</h6>
                                            <h5 class="mb-0 text-success fw-bold">Bs. <span
                                                    id="totalRecibo">0.00</span></h5>
                                        </div>
                                        <div class="text-muted small" style="font-size: 0.7rem;">
                                            <i class="bi bi-chat-left-text me-1"></i>
                                            <span id="totalReciboLiteral">Cero 00/100 Bolivianos</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- Campo oculto para el monto literal total -->
                    <input type="hidden" id="monto_literal" name="monto_literal" value="">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Guardar Recibo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ===== MANEJO DINÁMICO DE CONCEPTOS =====
        let conceptoIndex = 1;

        // Función para mostrar alerta dentro del modal
        function mostrarAlertaModalRecibo(tipo, mensaje, errores = null) {
            const alertaDiv = document.getElementById('alertaModalAgregarRecibo');
            const contenidoDiv = document.getElementById('alertaModalAgregarReciboContenido');

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
            document.querySelector('#modalAgregarRecibo .modal-body').scrollTop = 0;
        }

        // Función para convertir número a letras
        function numeroALetras(num) {
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

        // Función para calcular el total
        function calcularTotalRecibo() {
            let total = 0;
            document.querySelectorAll('.concepto-monto').forEach(input => {
                const monto = parseFloat(input.value) || 0;
                total += monto;
            });
            document.getElementById('totalRecibo').textContent = total.toFixed(2);
            const totalLiteral = numeroALetras(total);
            document.getElementById('totalReciboLiteral').textContent = totalLiteral;

            // Actualizar el campo oculto para guardar en la base de datos
            const campoOculto = document.getElementById('monto_literal');
            if (campoOculto) {
                campoOculto.value = totalLiteral;
            }
        }

        const btnAgregar = document.getElementById('btnAgregarConcepto');
        if (btnAgregar) {
            btnAgregar.addEventListener('click', function() {
                console.log('🎯 Click en btnAgregarConcepto detectado!');
                const container = document.getElementById('conceptosContainer');
                console.log('📦 Container encontrado:', container);
                const fechaHoy = '{{ date('Y-m-d') }}';
                const newConcepto = `
                <div class="concepto-item mb-2 p-2 border rounded" data-index="${conceptoIndex}"
                    style="background: rgba(255, 255, 255, 0.02); border-color: rgba(255, 255, 255, 0.1) !important; animation: slideIn 0.3s ease;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge bg-success concepto-numero-badge">
                            <i class="bi bi-hash"></i><span class="concepto-numero">${conceptoIndex + 1}</span>
                        </span>
                        <button type="button" class="btn btn-danger btn-sm d-inline-flex align-items-center justify-content-center btn-eliminar-concepto" style="width: 32px; height: 32px; padding: 0;">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </div>
                    <div class="mb-2">
                        <input type="text" class="form-control form-control-sm" 
                            name="conceptos[${conceptoIndex}][concepto]"
                            placeholder="Descripción del concepto *" required
                            style="text-transform: uppercase;">
                    </div>
                    <div class="row g-2">
                        <div class="col-6">
                            <input type="date" class="form-control form-control-sm"
                                name="conceptos[${conceptoIndex}][fecha_concepto]"
                                value="${fechaHoy}" required
                                title="Fecha del concepto">
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">Bs</span>
                                <input type="number" class="form-control form-control-sm concepto-monto"
                                    name="conceptos[${conceptoIndex}][monto]" step="0.01"
                                    placeholder="0.00" required title="Monto en bolivianos"
                                    pattern="[0-9]+(\\.[0-9]{1,2})?" inputmode="decimal"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\\..*)\\./g, '$1');">
                            </div>
                        </div>
                    </div>
                </div>
            `;
                console.log('🏗️ Creando nuevo concepto con index:', conceptoIndex);
                container.insertAdjacentHTML('beforeend', newConcepto);
                console.log('✨ Concepto agregado exitosamente');
                conceptoIndex++;
                actualizarNumerosConceptos();
                actualizarBotonesEliminar();

                // Scroll suave al nuevo concepto
                setTimeout(() => {
                    const items = container.querySelectorAll('.concepto-item');
                    console.log('📋 Total de conceptos ahora:', items.length);
                    items[items.length - 1].scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest'
                    });
                }, 100);
            });
        } else {
            console.error('❌ ERROR: No se encontró el botón btnAgregarConcepto');
        }

        // Eliminar concepto
        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn-eliminar-concepto')) {
                const row = e.target.closest('.concepto-item');
                if (document.querySelectorAll('.concepto-item').length > 1) {
                    // Animación de salida
                    row.style.animation = 'slideOut 0.3s ease';
                    setTimeout(() => {
                        row.remove();
                        actualizarNumerosConceptos();
                        actualizarBotonesEliminar();
                        calcularTotalRecibo();
                    }, 300);
                }
            }
        });

        // Actualizar numeración de conceptos
        function actualizarNumerosConceptos() {
            document.querySelectorAll('.concepto-item').forEach((row, index) => {
                row.querySelector('.concepto-numero').textContent = index + 1;
            });
        }

        // Actualizar estado de botones eliminar
        function actualizarBotonesEliminar() {
            const rows = document.querySelectorAll('.concepto-item');
            rows.forEach((row, index) => {
                const btnEliminar = row.querySelector('.btn-eliminar-concepto');
                if (rows.length === 1) {
                    btnEliminar.disabled = true;
                } else {
                    btnEliminar.disabled = false;
                }
            });
        }

        // Calcular total cuando cambia un monto
        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('concepto-monto')) {
                calcularTotalRecibo();
            }
        });

        // Reset del formulario cuando se cierra el modal
        document.getElementById('modalAgregarRecibo').addEventListener('hidden.bs.modal', function() {
            const container = document.getElementById('conceptosContainer');
            // Limpiar todos los conceptos excepto el primero
            const conceptos = container.querySelectorAll('.concepto-item');
            conceptos.forEach((row, index) => {
                if (index > 0) row.remove();
            });
            // Limpiar el primer concepto
            container.querySelector('input[name="conceptos[0][concepto]"]').value = '';
            container.querySelector('input[name="conceptos[0][fecha_concepto]"]').value =
                '{{ date('Y-m-d') }}';
            container.querySelector('input[name="conceptos[0][monto]"]').value = '';
            conceptoIndex = 1;
            calcularTotalRecibo();
            actualizarBotonesEliminar();
        });

        // Calcular total inicial
        calcularTotalRecibo();

        // Manejar el envío del formulario con validación
        document.getElementById('formAgregarFactura').addEventListener('submit', function(e) {
            e.preventDefault();

            // Ocultar alertas previas
            document.getElementById('alertaModalAgregarRecibo').style.display = 'none';

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
                        // Cerrar modal y mostrar éxito
                        const modal = bootstrap.Modal.getInstance(document.getElementById(
                            'modalAgregarRecibo'));
                        modal.hide();

                        // Mostrar alerta de éxito
                        if (typeof mostrarAlerta === 'function') {
                            mostrarAlerta('success', '¡Éxito!', data.message ||
                                'Recibo registrado correctamente');
                        }

                        setTimeout(() => {
                            window.location.href = window.location.pathname + '?page=1';
                        }, 1000);
                    } else {
                        // Mostrar errores dentro del modal
                        const errores = data.errors ? Object.values(data.errors).flat() : [data
                            .message || 'Error al guardar el recibo'
                        ];
                        mostrarAlertaModalRecibo('error',
                            'Por favor corrija los siguientes errores:', errores);
                    }
                })
                .catch(error => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = btnText;
                    mostrarAlertaModalRecibo('error',
                        'No se pudo guardar el recibo. Por favor, intente nuevamente.');
                });
        });

        // Inicializar Select2 para el campo de cliente
        $('#id_informacion').select2({
            placeholder: 'Buscar cliente...',
            allowClear: true,
            width: '100%',
            dropdownParent: $('#modalAgregarRecibo'),
            language: {
                noResults: function() {
                    return "No se encontraron resultados";
                },
                searching: function() {
                    return "Buscando...";
                }
            }
        });
    });
</script>
