<!-- Modal Ver Registro -->
<div class="modal fade" id="modalVerFactura" tabindex="-1" aria-labelledby="modalVerFacturaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalVerFacturaLabel">
                    <i class="bi bi-file-text"></i> Detalle de Registro
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body"
                style="background: linear-gradient(135deg, rgba(30, 35, 45, 0.95) 0%, rgba(20, 25, 35, 0.98) 100%);">
                <!-- Contenedor moderno de factura -->
                <div
                    style="background: rgba(26, 54, 93, 0.4); border: 1px solid rgba(88, 166, 255, 0.3); border-radius: 16px; padding: 30px; backdrop-filter: blur(10px);">

                    <!-- Encabezado con información principal -->
                    <div
                        style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 2px solid rgba(88, 166, 255, 0.3);">
                        <div>
                            <h3 style="color: #58a6ff; font-size: 1.8rem; font-weight: 700; margin: 0 0 15px 0;">
                                <i class="bi bi-receipt-cutoff"></i> Comprobante de Pago
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
                                <p style="color: #000; font-weight: 700; font-size: 1.1rem; margin: 0 0 8px 0;">
                                    Registro N° <span id="ver_n_factura"></span>
                                </p>
                                <p style="color: #1a1a1a; font-size: 0.9rem; margin: 0;">
                                    <strong>Fecha:</strong> <span id="ver_fecha"></span>
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

                    <!-- Concepto -->
                    <div style="margin-bottom: 25px;">
                        <div
                            style="background: rgba(88, 166, 255, 0.1); border-left: 4px solid #10b981; padding: 15px 20px; border-radius: 8px;">
                            <p
                                style="color: #10b981; font-size: 0.85rem; font-weight: 600; margin: 0 0 8px 0; text-transform: uppercase; letter-spacing: 1px;">
                                Por concepto de
                            </p>
                            <p style="color: #e2e8f0; font-size: 1rem; margin: 0;" id="ver_concepto"></p>
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

                    <!-- Estados -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                        <div
                            style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); padding: 15px; border-radius: 10px;">
                            <p
                                style="color: #9ca3af; font-size: 0.85rem; margin: 0 0 8px 0; text-transform: uppercase; letter-spacing: 1px;">
                                <i class="bi bi-cash-stack"></i> Estado de Pago
                            </p>
                            <span id="ver_estado" class="badge" style="font-size: 0.95rem; padding: 8px 15px;"></span>
                        </div>
                        <div
                            style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); padding: 15px; border-radius: 10px;">
                            <p
                                style="color: #9ca3af; font-size: 0.85rem; margin: 0 0 8px 0; text-transform: uppercase; letter-spacing: 1px;">
                                <i class="bi bi-file-check"></i> Estado del Registro
                            </p>
                            <span id="ver_anulado" class="badge" style="font-size: 0.95rem; padding: 8px 15px;"></span>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Cerrar
                </button>
                <a href="#" id="btnDescargarPDF" target="_blank" class="btn btn-danger">
                    <i class="bi bi-file-pdf"></i> Descargar PDF
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Manejar el modal de Ver Registro
        var modalVerFactura = document.getElementById('modalVerFactura');
        modalVerFactura.addEventListener('show.bs.modal', function(event) {
            // Botón que activó el modal
            var button = event.relatedTarget;

            // Extraer datos de los atributos data-*
            var id = button.getAttribute('data-id');
            var numero = button.getAttribute('data-numero');
            var fecha = button.getAttribute('data-fecha');
            var cliente = button.getAttribute('data-cliente');
            var concepto = button.getAttribute('data-concepto');
            var monto = button.getAttribute('data-monto');
            var montoLiteral = button.getAttribute('data-monto-literal');
            var estado = button.getAttribute('data-estado');
            var anulado = button.getAttribute('data-anulado');

            // Actualizar el contenido del modal
            document.getElementById('ver_n_factura').textContent = numero;
            document.getElementById('ver_fecha').textContent = fecha;
            document.getElementById('ver_cliente').textContent = cliente;
            document.getElementById('ver_concepto').textContent = concepto;
            document.getElementById('ver_monto_total').textContent = monto;
            document.getElementById('ver_monto_literal').textContent = montoLiteral ||
                'No especificado';

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

            // Mostrar si está anulado
            var anuladoBadge = document.getElementById('ver_anulado');
            anuladoBadge.className = 'badge'; // Reset clases

            if (anulado === '1') {
                anuladoBadge.textContent = 'Registro Anulado';
                anuladoBadge.classList.add('bg-danger');
            } else {
                anuladoBadge.textContent = 'Registro Activo';
                anuladoBadge.classList.add('bg-success');
            }

            // Actualizar el enlace del botón PDF
            var btnPDF = document.getElementById('btnDescargarPDF');
            btnPDF.href = '{{ url('/facturacion/comprobantes') }}/' + id + '/pdf';
        });
    });
</script>
