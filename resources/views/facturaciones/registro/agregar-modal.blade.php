<!-- Modal Agregar Factura -->
<div class="modal fade" id="modalAgregarFactura" tabindex="-1" aria-labelledby="modalAgregarFacturaLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('facturacion.comprobante.store') }}" method="POST" id="formAgregarFactura">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalAgregarFacturaLabel">
                        <i class="bi bi-plus-circle"></i> Nueva Factura
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Contenedor de alertas dentro del modal -->
                    <div id="alertaModalAgregarRegistro" class="alert alert-dismissible fade" role="alert"
                        style="display: none;">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div id="alertaModalAgregarRegistroContenido"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="n_registro_preview" class="form-label">N° Registro
                                <small class="text-muted">(Automático)</small>
                            </label>
                            <input type="text" class="form-control" id="n_registro_preview"
                                value="{{ $siguienteNumero }}" readonly
                                style="background-color: rgba(88, 166, 255, 0.1) !important; cursor: not-allowed;">
                            <small class="text-muted">Este número se generará automáticamente al guardar</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fecha" class="form-label">Fecha <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('fecha') is-invalid @enderror"
                                name="fecha" id="fecha" value="{{ old('fecha', date('Y-m-d')) }}" required>
                            @error('fecha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="id_informacion" class="form-label">Cliente <span
                                    class="text-danger">*</span></label>
                            <select class="form-control select2-cliente @error('id_informacion') is-invalid @enderror"
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
                        <div class="col-md-6 mb-3">
                            <label for="ci_nit" class="form-label">CI/NIT</label>
                            <input type="text" class="form-control @error('ci_nit') is-invalid @enderror"
                                name="ci_nit" id="ci_nit" placeholder="Ej: 12345678" value="{{ old('ci_nit') }}"
                                pattern="[0-9]*" inputmode="numeric"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            @error('ci_nit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="estado" class="form-label">Estado de Pago <span
                                    class="text-danger">*</span></label>
                            <select name="estado" id="estado"
                                class="form-control @error('estado') is-invalid @enderror" required>
                                <option value="" disabled {{ old('estado') ? '' : 'selected' }}>Seleccione
                                    estado de pago</option>
                                <option value="no_cancelado" {{ old('estado') == 'no_cancelado' ? 'selected' : '' }}>
                                    <i class="bi bi-x-circle"></i> No Cancelado
                                </option>
                                <option value="pago_efectivo" {{ old('estado') == 'pago_efectivo' ? 'selected' : '' }}>
                                    <i class="bi bi-cash"></i> Pago en Efectivo
                                </option>
                                <option value="pago_deposito" {{ old('estado') == 'pago_deposito' ? 'selected' : '' }}>
                                    <i class="bi bi-bank"></i> Pago por Depósito
                                </option>
                                <option value="pago_horas" {{ old('estado') == 'pago_horas' ? 'selected' : '' }}>
                                    <i class="bi bi-clock"></i> Pago en Horas
                                </option>
                            </select>
                            @error('estado')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="concepto" class="form-label">Concepto <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('concepto') is-invalid @enderror" name="concepto" id="concepto" rows="3"
                            placeholder="Descripción del servicio/producto" required style="text-transform: uppercase;">{{ old('concepto') }}</textarea>
                        @error('concepto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="monto" class="form-label">Monto (Bs) <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('monto') is-invalid @enderror"
                                name="monto" id="monto" step="0.01" placeholder="0.00"
                                value="{{ old('monto') }}" required
                                pattern="[0-9]+(\.[0-9]{1,2})?" inputmode="decimal"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            @error('monto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="monto_literal" class="form-label">Monto Literal</label>
                            <input type="text" class="form-control @error('monto_literal') is-invalid @enderror"
                                name="monto_literal" id="monto_literal" placeholder="Ej: Mil bolivianos 00/100"
                                value="{{ old('monto_literal') }}">
                            @error('monto_literal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Guardar Factura
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar Select2 para el campo de cliente en modal agregar
        $('#id_informacion').select2({
            placeholder: 'Buscar cliente...',
            allowClear: true,
            width: '100%',
            dropdownParent: $('#modalAgregarFactura'),
            language: {
                noResults: function() {
                    return "No se encontraron resultados";
                },
                searching: function() {
                    return "Buscando...";
                }
            }
        });

        // Función para mostrar alerta dentro del modal
        function mostrarAlertaModalRegistro(tipo, mensaje, errores = null) {
            const alertaDiv = document.getElementById('alertaModalAgregarRegistro');
            const contenidoDiv = document.getElementById('alertaModalAgregarRegistroContenido');

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
            document.querySelector('#modalAgregarFactura .modal-body').scrollTop = 0;
        }

        // Manejar el envío del formulario
        document.getElementById('formAgregarFactura').addEventListener('submit', function(e) {
            e.preventDefault();

            // Ocultar alertas previas
            document.getElementById('alertaModalAgregarRegistro').style.display = 'none';

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
                        const modal = bootstrap.Modal.getInstance(document.getElementById(
                            'modalAgregarFactura'));
                        modal.hide();

                        // Mostrar alerta de éxito
                        if (typeof mostrarAlerta === 'function') {
                            mostrarAlerta('success', '¡Éxito!', data.message ||
                                'Factura registrada correctamente');
                        }

                        setTimeout(() => {
                            window.location.href = window.location.pathname + '?page=1';
                        }, 1000);
                    } else {
                        // Mostrar errores dentro del modal
                        const errores = data.errors ? Object.values(data.errors).flat() : [data
                            .message || 'Error al guardar la factura'
                        ];
                        mostrarAlertaModalRegistro('error',
                            'Por favor corrija los siguientes errores:', errores);
                    }
                })
                .catch(error => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = btnText;
                    mostrarAlertaModalRegistro('error',
                        'No se pudo guardar la factura. Por favor, intente nuevamente.');
                });
        });

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

        // Auto-calcular monto literal
        document.getElementById('monto').addEventListener('input', function() {
            const valor = parseFloat(this.value) || 0;
            document.getElementById('monto_literal').value = numeroALetras(valor);
        });

        // Guardar el número de factura inicial
        const numeroFacturaInicial = '{{ $siguienteNumero }}';

        // Si hay errores, reabrir el modal
        @if ($errors->any() && old('n_factura'))
            var modalAgregar = new bootstrap.Modal(document.getElementById('modalAgregarFactura'));
            modalAgregar.show();
        @endif

        // Resetear formulario al cerrar el modal
        var modalElement = document.getElementById('modalAgregarFactura');
        modalElement.addEventListener('hidden.bs.modal', function() {
            @if (!$errors->any())
                document.getElementById('formAgregarFactura').reset();
                $('#id_informacion').val(null).trigger('change');
                document.getElementById('fecha').value = '{{ date('Y-m-d') }}';
                document.getElementById('n_registro_preview').value = numeroFacturaInicial;
            @endif
        });

        // Al abrir el modal, asegurar valores correctos
        modalElement.addEventListener('show.bs.modal', function() {
            @if (!$errors->any())
                document.getElementById('n_registro_preview').value = numeroFacturaInicial;
            @endif
        });
    });
</script>
