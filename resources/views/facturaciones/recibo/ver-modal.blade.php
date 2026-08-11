<!-- Modal Ver Recibo -->
<div class="modal fade" id="modalVerRecibo" tabindex="-1" aria-labelledby="modalVerReciboLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalVerReciboLabel">
                    <i class="bi bi-file-text"></i> Detalle de Recibo
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body"
                style="background: linear-gradient(135deg, rgba(30, 35, 45, 0.95) 0%, rgba(20, 25, 35, 0.98) 100%);">
                <!-- Contenedor moderno de recibo -->
                <div
                    style="background: rgba(26, 54, 93, 0.4); border: 1px solid rgba(88, 166, 255, 0.3); border-radius: 16px; padding: 30px; backdrop-filter: blur(10px);">

                    <!-- Encabezado con información principal -->
                    <div
                        style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 2px solid rgba(88, 166, 255, 0.3);">
                        <div>
                            <h3 style="color: #58a6ff; font-size: 1.8rem; font-weight: 700; margin: 0 0 15px 0;">
                                <i class="bi bi-receipt-cutoff"></i> Recibo de Pago
                            </h3>
                            <p style="color: #9ca3af; margin: 5px 0; font-size: 0.95rem;">
                                <strong style="color: #e2e8f0;">Empresa:</strong> FaceBol S.R.L Hazlo Diferente!
                            </p>
                            <p style="color: #9ca3af; margin: 5px 0; font-size: 0.95rem;">
                                <strong style="color: #e2e8f0;">SEPREC/NIT:</strong> 353354028
                            </p>
                        </div>
                        <div style="text-align: right;">
                            <div
                                style="background: linear-gradient(135deg, #58a6ff 0%, #3b82f6 100%); padding: 15px 25px; border-radius: 12px; box-shadow: 0 4px 12px rgba(88, 166, 255, 0.4);">
                                <p style="color: #000; font-weight: 700; font-size: 1.1rem; margin: 0;">
                                    Recibo N° <span id="ver_n_recibo"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Información del cliente -->
                    <div style="margin-bottom: 25px;">
                        <div
                            style="background: rgba(88, 166, 255, 0.1); border-left: 4px solid #58a6ff; padding: 15px 20px; border-radius: 8px;">
                            <p
                                style="color: #58a6ff; font-size: 0.85rem; font-weight: 600; margin: 0 0 8px 0; text-transform: uppercase; letter-spacing: 1px;">
                                Recibí del Señor(a)
                            </p>
                            <p style="color: #e2e8f0; font-size: 1.1rem; font-weight: 600; margin: 0;" id="ver_cliente">
                            </p>
                        </div>
                    </div>

                    <!-- Conceptos -->
                    <div style="margin-bottom: 25px;">
                        <div
                            style="background: rgba(88, 166, 255, 0.1); border-left: 4px solid #10b981; padding: 15px 20px; border-radius: 8px;">
                            <p
                                style="color: #10b981; font-size: 0.85rem; font-weight: 600; margin: 0 0 12px 0; text-transform: uppercase; letter-spacing: 1px;">
                                Por concepto de
                            </p>
                            <div id="ver_conceptos_container">
                                <!-- Los conceptos se cargarán dinámicamente aquí -->
                            </div>
                        </div>
                    </div>

                    <!-- Monto en letras -->
                    <div style="margin-bottom: 25px;">
                        <div
                            style="background: rgba(88, 166, 255, 0.1); border-left: 4px solid #f59e0b; padding: 15px 20px; border-radius: 8px;">
                            <p
                                style="color: #f59e0b; font-size: 0.85rem; font-weight: 600; margin: 0 0 8px 0; text-transform: uppercase; letter-spacing: 1px;">
                                La suma de
                            </p>
                            <p id="ver_monto_literal"
                                style="color: #ffffff; font-size: 1.1rem; margin: 0; font-style: italic; font-weight: 600; line-height: 1.5;">
                            </p>
                        </div>
                    </div>

                    <!-- Monto total destacado -->
                    <div style="margin-bottom: 25px;">
                        <div
                            style="background: linear-gradient(135deg, rgba(88, 166, 255, 0.2) 0%, rgba(59, 130, 246, 0.2) 100%); border: 2px solid #58a6ff; padding: 20px; border-radius: 12px; text-align: center;">
                            <p
                                style="color: #9ca3af; font-size: 0.9rem; margin: 0 0 5px 0; text-transform: uppercase; letter-spacing: 1px;">
                                Monto Total
                            </p>
                            <p style="color: #58a6ff; font-size: 2.2rem; font-weight: 700; margin: 0;">
                                Bs. <span id="ver_monto_total"></span>
                            </p>
                        </div>
                    </div>

                    <!-- Estado de pago -->
                    <div style="display: grid; grid-template-columns: 1fr; gap: 15px;">
                        <div
                            style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); padding: 15px; border-radius: 10px;">
                            <p
                                style="color: #9ca3af; font-size: 0.85rem; margin: 0 0 8px 0; text-transform: uppercase; letter-spacing: 1px;">
                                <i class="bi bi-cash-stack"></i> Estado de Pago
                            </p>
                            <span id="ver_estado" class="badge" style="font-size: 0.95rem; padding: 8px 15px;"></span>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Cerrar
                </button>
                <a href="#" id="btnDescargarPDFRecibo" target="_blank" class="btn btn-danger">
                    <i class="bi bi-file-pdf"></i> Descargar PDF
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Manejar el modal de Ver Recibo
        var modalVerRecibo = document.getElementById('modalVerRecibo');
        modalVerRecibo.addEventListener('show.bs.modal', function(event) {
            // Botón que activó el modal
            var button = event.relatedTarget;

            // Extraer datos de los atributos data-*
            var id = button.getAttribute('data-id');
            var numero = button.getAttribute('data-numero');
            var cliente = button.getAttribute('data-cliente');
            var montoTotal = button.getAttribute('data-monto');
            var montoLiteral = button.getAttribute('data-monto-literal');
            var estado = button.getAttribute('data-estado');
            var conceptosJson = button.getAttribute('data-conceptos');

            // Parsear conceptos
            let conceptos = [];
            try {
                conceptos = JSON.parse(conceptosJson || '[]');
            } catch (e) {
                console.error('Error al parsear conceptos:', e);
                conceptos = [];
            }

            // Actualizar el contenido del modal
            document.getElementById('ver_n_recibo').textContent = numero;
            document.getElementById('ver_cliente').textContent = cliente;
            document.getElementById('ver_monto_total').textContent = montoTotal;
            document.getElementById('ver_monto_literal').textContent = montoLiteral ||
                'No especificado';

            // Mostrar conceptos
            const conceptosContainer = document.getElementById('ver_conceptos_container');
            conceptosContainer.innerHTML = '';

            if (conceptos.length > 0) {
                conceptos.forEach((concepto, index) => {
                    const conceptoHtml = `
                        <div style="background: rgba(255, 255, 255, 0.05); padding: 12px; border-radius: 6px; margin-bottom: ${index < conceptos.length - 1 ? '10px' : '0'};">
                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 5px;">
                                <span style="color: #10b981; font-weight: 600; font-size: 0.85rem;">
                                    <i class="bi bi-check-circle-fill"></i> Concepto ${index + 1}
                                </span>
                                <span style="color: #58a6ff; font-weight: 600; font-size: 0.9rem;">
                                    Bs. ${parseFloat(concepto.monto).toFixed(2)}
                                </span>
                            </div>
                            <p style="color: #e2e8f0; font-size: 0.95rem; margin: 0 0 5px 0;">
                                ${concepto.concepto || 'Sin descripción'}
                            </p>
                            <p style="color: #9ca3af; font-size: 0.8rem; margin: 0;">
                                <i class="bi bi-calendar-event"></i> ${concepto.fecha_concepto || 'Sin fecha'}
                            </p>
                        </div>
                    `;
                    conceptosContainer.insertAdjacentHTML('beforeend', conceptoHtml);
                });
            } else {
                conceptosContainer.innerHTML =
                    '<p style="color: #9ca3af; margin: 0;">No hay conceptos registrados</p>';
            }

            // Mostrar estado con nombre legible y color
            var estadoBadge = document.getElementById('ver_estado');
            estadoBadge.className = 'badge'; // Reset clases

            switch (estado) {
                case 'no_cancelado':
                    estadoBadge.textContent = 'No Cancelado';
                    estadoBadge.classList.add('bg-warning', 'text-dark');
                    break;
                case 'pago_efectivo':
                    estadoBadge.textContent = 'Pago en Efectivo';
                    estadoBadge.classList.add('bg-success');
                    break;
                case 'pago_deposito':
                    estadoBadge.textContent = 'Pago por Depósito';
                    estadoBadge.classList.add('bg-info');
                    break;
                case 'pago_horas':
                    estadoBadge.textContent = 'Pago en Horas';
                    estadoBadge.classList.add('bg-secondary');
                    break;
                default:
                    estadoBadge.textContent = 'Sin Estado';
                    estadoBadge.classList.add('bg-secondary');
            }

            // Actualizar el enlace del botón PDF
            var btnPDF = document.getElementById('btnDescargarPDFRecibo');
            btnPDF.href = '{{ url('/facturacion/recibos') }}/' + id + '/pdf';
        });
    });
</script>
