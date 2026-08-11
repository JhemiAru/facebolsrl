<!-- Modal Agregar Inventario -->
<style>
    .swal-custom-inventario {
    border: 1px solid #1e3a8a;
    box-shadow: 0 0 25px rgba(59,130,246,0.5);
    border-radius: 12px;
}
</style>
<div class="modal fade" id="modalAgregarInventario" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('inventarios.store') }}" method="POST" id="formAgregarInventario">
                @csrf

                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-box-seam"></i> Nuevo Registro de Inventario
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <!-- ALERTA -->
                    <div id="alertaInventario" class="alert d-none"></div>

                    <div class="row">
                        <!-- COLUMNA IZQUIERDA -->
                        <div class="col-md-6">
                            <div class="card h-100" style="background: rgba(88, 166, 255, 0.05); border: 1px solid rgba(88, 166, 255, 0.2);">     
                                <div class="card-header" style="background: rgba(88, 166, 255, 0.1);">
                                    <h6 class="mb-0"><i class="bi bi-file-earmark-text"></i> Datos del Inventario</h6>
                                </div>

                            <div class="card-body">
                                <div class="mb-3">
                                        <label for="n_recibo_preview" class="form-label">N° Inventario
                                            <small class="text-muted">(Automático)</small>
                                        </label>
                                        <input type="text" class="form-control" id="n_recibo_preview"
                                            value="{{ $siguienteNumero }}" readonly
                                            style="background-color: rgba(88, 166, 255, 0.1) !important; cursor: not-allowed;">
                                    </div>
                                <div class="mb-3">
                                        <label for="fecha_inve" class="form-label">Fecha Inventario<span
                                                class="text-danger">*</span></label>
                                        <input type="date"
                                            class="form-control @error('fecha_inve') is-invalid @enderror"
                                            name="fecha_inve" id="fecha_inve"
                                            value="{{ old('fecha_inve', date('Y-m-d')) }}" required>
                                        @error('fecha_inve')
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
                                        <label for="tipo" class="form-label">
                                            Tipo de Inventario <span class="text-danger">*</span>
                                        </label>
                                        <select name="tipo" id="tipo"
                                            class="form-control @error('tipo') is-invalid @enderror" required>
                                            <option value="" disabled {{ old('tipo') ? '' : 'selected' }}>
                                                Seleccione tipo
                                            </option>
                                            <option value="compra"
                                                {{ old('tipo') == 'compra' ? 'selected' : '' }}>
                                                COMPRA
                                            </option>
                                            <option value="venta"
                                                {{ old('tipo') == 'venta' ? 'selected' : '' }}>
                                                VENTA
                                            </option>
                                            <option value="bono"
                                                {{ old('tipo') == 'bono' ? 'selected' : '' }}>
                                                BONO
                                            </option>
                                        </select>

                                        @error('tipo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                             </div>
                        </div>        
                    </div>
                        <!-- COLUMNA DERECHA -->
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
                                                {{-- <div class="col-6">
                                                    <input type="date" class="form-control form-control-sm"
                                                        name="conceptos[0][fecha_concepto]"
                                                        value="{{ date('Y-m-d') }}" required
                                                        title="Fecha del concepto">
                                                </div> --}}
                                                 <div class="col-6">
                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-plus-slash-minus"></i>
                                                        </span>
                                                        <input type="number"
                                                                step="0.0001"
                                                                inputmode="decimal"
                                                                class="form-control form-control-sm cantidad text-center"
                                                                name="conceptos[0][cantidad]"
                                                                placeholder="CANT"
                                                                required>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-text">Bs</span>
                                                        <input type="number"
                                                            step="0.0001"
                                                            inputmode="decimal"
                                                            min="0"
                                                            class="form-control form-control-sm precio-unitario text-center"
                                                            name="conceptos[0][precio_uni]"
                                                            step="0.01"
                                                            placeholder="P. / U."
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="input-group input-group-sm rounded overflow-hidden shadow-sm ">
                                                        <span class="input-group-text">Bs</span>
                                                        <input type="text"
                                                            class="form-control form-control-sm sub-total-display text-center"
                                                            placeholder="SUBTOT"
                                                            readonly>
                                                        <input type="hidden"
                                                            name="conceptos[0][sub_total]"
                                                            class="sub-total-hidden" >
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
                  <input type="hidden" id="monto_literal" name="monto_literal" value="">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Guardar Inventario
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formAgregarInventario');
    const alerta = document.getElementById('alertaInventario');

    let conceptoIndex = 1;

    // ===============================
    // FUNCIÓN PARA MOSTRAR ALERTA EN EL MODAL
    // ===============================
    function mostrarAlertaModalInventario(tipo, mensaje, errores = null) {
        const alertaDiv = document.getElementById('alertaInventario');
        // Remover clases previas
        alertaDiv.classList.remove('alert-success', 'alert-danger', 'alert-warning','d-none');
        // Agregar clase según el tipo
        if (tipo === 'success') {
            alertaDiv.classList.add('alert-success');
        } else if (tipo === 'error') {
            alertaDiv.classList.add('alert-danger');
        } else if (tipo === 'warning') {
            alertaDiv.classList.add('alert-warning');
        }
        // Construir contenido
        let html = '<strong>' + (tipo === 'success' ? '¡Éxito!' : tipo === 'error' ? '¡Error!' : '¡Atención!') + '</strong> ' + mensaje;
        if (errores && errores.length > 0) {
            html += '<ul class="mb-0 mt-2">';
            errores.forEach(error => {
                html += '<li>' + error + '</li>';
            });
            html += '</ul>';
        }
        alertaDiv.innerHTML = html;
    alertaDiv.classList.remove('d-none');
    }
    

    // ===============================
    // CONVERTIR NÚMERO A LETRAS
    // ===============================
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

    // ===============================
    //  CALCULAR SUBTOTAL POR FILA
    // ===============================
    function calcularFila(row) {

        const cantidad = parseFloat(row.querySelector('.cantidad').value) || 0;
        const precio = parseFloat(row.querySelector('.precio-unitario').value) || 0;

        const subtotal = cantidad * precio;

        row.querySelector('.sub-total-display').value = subtotal.toFixed(2);
        row.querySelector('.sub-total-hidden').value = subtotal.toFixed(2);

        calcularTotalGeneral();
    }

    // ===============================
    //  CALCULAR TOTAL GENERAL
    // ===============================
    function calcularTotalGeneral() {

        let total = 0;

        document.querySelectorAll('.sub-total-hidden').forEach(input => {
            total += parseFloat(input.value) || 0;
        });

        document.getElementById('totalRecibo').textContent = total.toFixed(2);

        const literal = numeroALetras(total);
        document.getElementById('totalReciboLiteral').textContent = literal;

        const campoOculto = document.getElementById('monto_literal');
        if (campoOculto) campoOculto.value = literal;
    }

    // ===============================
    // EVENTO INPUT PRECIO
    // ===============================
    document.addEventListener('input', function(e) {

    if (e.target.classList.contains('precio-unitario') ||
        e.target.classList.contains('cantidad')) {

        const row = e.target.closest('.concepto-item');
        calcularFila(row);
    }
    });

    // ===============================
    //  AGREGAR CONCEPTO
    // ===============================
    document.getElementById('btnAgregarConcepto').addEventListener('click', function() {

        const container = document.getElementById('conceptosContainer');
        const fechaHoy = '{{ date('Y-m-d') }}';

        const newConcepto = `
        <div class="concepto-item mb-2 p-2 border rounded" data-index="${conceptoIndex}">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="badge bg-success">
                    <i class="bi bi-hash"></i> ${conceptoIndex + 1}
                </span>
                <button type="button" class="btn btn-danger btn-sm btn-eliminar-concepto">
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
                        value="${fechaHoy}" required>
                </div>

                <div class="col-6">
                    <div class="input-group input-group-sm">
                         <span class="input-group-text">
                         <i class="bi bi-plus-slash-minus"></i>
                         </span>
                        <input type="number"
                        step="0.0001"
                        inputmode="decimal"
                        class="form-control form-control-sm cantidad text-center"
                        name="conceptos[${conceptoIndex}][cantidad]"
                        placeholder="CANT" 
                       required >
                    </div>
                </div>

                <div class="col-6">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">Bs</span>
                        <input type="number" 
                            step="0.0001"
                            inputmode="decimal"
                            min="0"
                            class="form-control form-control-sm precio-unitario text-center"
                            name="conceptos[${conceptoIndex}][precio_uni]"
                            placeholder="P. / U."
                            required>
                    </div>
                </div>

                <div class="col-6">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">Bs</span>
                        <input type="text" class="form-control form-control-sm sub-total-display" placeholder="SUBTOT" readonly>
                        <input type="hidden"
                            name="conceptos[${conceptoIndex}][sub_total]"
                            class="sub-total-hidden">
                    </div>
                </div>
            </div>
        </div>
        `;

        container.insertAdjacentHTML('beforeend', newConcepto);
        conceptoIndex++;
    });

    // ===============================
    //  ELIMINAR CONCEPTO
    // ===============================
    document.addEventListener('click', function(e) {
        if (e.target.closest('.btn-eliminar-concepto')) {
            const row = e.target.closest('.concepto-item');
            if (document.querySelectorAll('.concepto-item').length > 1) {
                 row.style.animation = 'slideOut 0.3s ease';
                    setTimeout(() => {
                        row.remove();
                        calcularTotalGeneral();
                    }, 300);
            }
        }
    });

     // ===============================
    // ENVÍO AJAX DEL FORMULARIO
    // ===============================
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Ocultar alerta previa
            alerta.classList.add('d-none');

        const formData = new FormData(this);
        const submitBtn = this.querySelector('button[type="submit"]');
        const btnText = submitBtn.innerHTML;

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="spinner-border spinner-border-sm"></i> Guardando...';

        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.json())
        .then(data => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = btnText;

            /*if (data.success) {
                // Cerrar modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('modalAgregarInventario'));
                modal.hide();

                conceptoIndex = 1;
                document.getElementById('totalRecibo').textContent = '0.00';
                document.getElementById('totalReciboLiteral').textContent = 'Cero 00/100 Bolivianos';

                    // Mostrar mensaje de éxito dentro del modal
                    mostrarAlertaModalInventario('success', data.message || 'Inventario guardado correctamente');

                    // Opcional: recargar después de mostrar el mensaje
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
            }*/
           if (data.success) {
            Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            html: `
                <div style="font-size:16px">
                    <strong>Inventario creado correctamente:</strong><br>
                </div>
            `,
            background: '#0f172a',
            color: '#ffffff',
            showConfirmButton: false,
            showCancelButton: false,
            timer: 2000,
            timerProgressBar: true,
            customClass: {
                popup: 'swal-custom-inventario'
            }
        }).then(() => {
            const modal = bootstrap.Modal.getInstance(
                document.getElementById('modalAgregarInventario')
            );
            modal.hide();
            location.reload();
        });

        } else {
                        // Mostrar errores en el modal
                const errores = data.errors ? Object.values(data.errors).flat() : [data.message || 'Error al guardar'];
                    mostrarAlertaModalInventario('error', 'Por favor corrija los siguientes errores:', errores);
            }
        })
        .catch(err => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = btnText;
                mostrarAlertaModalInventario('error', 'No se pudo guardar el inventario. Por favor, intente nuevamente.');
                console.error(err);
        });
    });

    // ===============================
    // Inicializar Select2 para cliente
    // ===============================
    $('#id_informacion').select2({
        placeholder: 'Buscar cliente...',
        allowClear: true,
        width: '100%',
        dropdownParent: $('#modalAgregarInventario'),
        language: {
            noResults: function() { return "No se encontraron resultados"; },
            searching: function() { return "Buscando..."; }
        }
    });
    // ===============================
    // CAMBIO DE COLOR SEGÚN TIPO
    // ===============================
    const selectTipo = document.getElementById('tipo');

    function actualizarEstiloTipo() {

        const valor = selectTipo.value;

        // Limpiar clases anteriores
        selectTipo.classList.remove(
            'bg-success',
            'bg-primary',
            'bg-warning',
            'text-white',
            'text-dark'
        );

        switch (valor) {
            case 'COMPRA':
                selectTipo.classList.add('bg-success', 'text-white');
                break;

            case 'VENTA':
                selectTipo.classList.add('bg-primary', 'text-white');
                break;

            case 'BONO':
                selectTipo.classList.add('bg-warning', 'text-dark');
                break;
        }
    }

    // Ejecutar cuando cambie
    selectTipo.addEventListener('change', actualizarEstiloTipo);

    // Ejecutar si ya tiene valor seleccionado
    if (selectTipo.value) {
        actualizarEstiloTipo();
    }


});
</script>