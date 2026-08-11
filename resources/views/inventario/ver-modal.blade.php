<!-- Modal Ver Inventario -->
<div class="modal fade" id="modalVerInventario" tabindex="-1" aria-labelledby="modalVerInventarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalVerInventarioLabel">
                    <i class="bi bi-box-seam"></i> Detalle de Inventario
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body"
                style="background: linear-gradient(135deg, rgba(30,35,45,.95), rgba(20,25,35,.98));">

                <div
                    style="background: rgba(26,54,93,.4); border: 1px solid rgba(88,166,255,.3);
                    border-radius: 16px; padding: 30px; backdrop-filter: blur(10px);">

                    <!-- ENCABEZADO -->
                    <div style="display:flex; justify-content:space-between; align-items:start; margin-bottom:25px; border-bottom:2px solid rgba(88,166,255,.3); padding-bottom:20px;">
                        <div>
                            <h3 style="color:#58a6ff; font-weight:700;">
                                <i class="bi bi-archive"></i> Registro de Inventario
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
                               Recibo N° <span id="ver_n_inventario"></span>
                            </p>
                         </div>
                       </div>
                     </div>

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
                                <i class="bi bi-cash-stack"></i> Estado
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
                <a href="#" id="btnDescargarPDFInventario" target="_blank" class="btn btn-danger">
                    <i class="bi bi-file-pdf"></i> Descargar PDF
                </a>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Manejar el modal de Ver Inventario
        var modalVerInventario = document.getElementById('modalVerInventario');
        modalVerInventario.addEventListener('show.bs.modal', function(event) {
            // Botón que activó el modal
            var button = event.relatedTarget;

            // Extraer datos de los atributos data-* (acepta variantes)
            var id = button.getAttribute('data-id');
            var numero = button.getAttribute('data-numero') || '';
            var cliente = button.getAttribute('data-cliente-nombre') || button.getAttribute('data-cliente') || '';
            var montoTotalAttr = button.getAttribute('data-total') || button.getAttribute('data-monto') || button.getAttribute('data-sub_total') || null;
            var montoLiteral = button.getAttribute('data-monto-literal') || null;
            var estado = button.getAttribute('data-tipo') || button.getAttribute('data-estado') || '';
            var conceptosJson = button.getAttribute('data-conceptos');

            // Parsear conceptos
            let conceptos = [];
            try {
                conceptos = JSON.parse(conceptosJson || '[]');
            } catch (e) {
                console.error('Error al parsear conceptos:', e);
                conceptos = [];
            }

            // Calcular total a partir de conceptos si están presentes
            let totalFromConcepts = 0;
            if (Array.isArray(conceptos) && conceptos.length > 0) {
                totalFromConcepts = conceptos.reduce((acc, c) => {
                    const v = parseFloat(c.monto || c.subtotal || c.sub_total || 0) || 0;
                    return acc + v;
                }, 0);
            }

            // Determinar monto final: preferencias -> conceptos sumados -> atributo
            let montoFinal = totalFromConcepts > 0 ? totalFromConcepts : (montoTotalAttr !== null ? parseFloat(montoTotalAttr) : 0);

            // Formatear número (separador miles y coma decimal)
            function formatBs(n) {
                return new Intl.NumberFormat('es-ES', {minimumFractionDigits: 2, maximumFractionDigits: 2}).format(n);
            }

            // Actualizar el contenido del modal
            document.getElementById('ver_n_inventario').textContent = numero;
            document.getElementById('ver_cliente').textContent = cliente || '-';
            document.getElementById('ver_monto_total').textContent = formatBs(montoFinal);

            // Mostrar literal: usar el proporcionado o generar un simple literal (enteros + centavos)
            if (montoLiteral) {
                document.getElementById('ver_monto_literal').textContent = montoLiteral;
            } else {
                const entero = Math.floor(montoFinal);
                const centavos = Math.round((montoFinal - entero) * 100).toString().padStart(2, '0');
                document.getElementById('ver_monto_literal').textContent = entero === 0 ? ('CERO ' + centavos + '/100 BOLIVIANOS') : (entero + ' ' + centavos + '/100 BOLIVIANOS');
            }

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
                                    Bs. ${formatBs(parseFloat(concepto.monto || concepto.subtotal || concepto.sub_total || 0) || 0)}
                                </span>
                            </div>
                            <p style="color: #e2e8f0; font-size: 0.95rem; margin: 0 0 5px 0;">
                                ${concepto.concepto || 'Sin descripción'}
                            </p>
                            <p style="color: #9ca3af; font-size: 0.8rem; margin: 0;">
                                <i class="bi bi-calendar-event"></i> ${concepto.fecha_concepto || concepto.fecha_inve || 'Sin fecha'}
                            </p>
                        </div>
                    `;
                    conceptosContainer.insertAdjacentHTML('beforeend', conceptoHtml);
                });
            } else {
                conceptosContainer.innerHTML =
                    '<p style="color: #9ca3af; margin: 0;">No hay conceptos registrados</p>';
            }

            // Mostrar estado con nombre legible y color (acepta mayúsc/minúsc)
            var estadoBadge = document.getElementById('ver_estado');
            estadoBadge.className = 'badge'; // Reset clases
            var tipoNormalized = (estado || '').toString().toLowerCase();
            if (tipoNormalized === 'compra') {
                estadoBadge.textContent = 'COMPRA';
                estadoBadge.classList.add('bg-warning', 'text-dark');
            } else if (tipoNormalized === 'venta') {
                estadoBadge.textContent = 'VENTA';
                estadoBadge.classList.add('bg-success');
            } else if (tipoNormalized === 'bono') {
                estadoBadge.textContent = 'BONO';
                estadoBadge.classList.add('bg-info');
            } else {
                estadoBadge.textContent = (estado || 'Sin tipo').toString().toUpperCase();
                estadoBadge.classList.add('bg-secondary');
            }

            // Actualizar el enlace del botón PDF
            var btnPDF = document.getElementById('btnDescargarPDFInventario');
            btnPDF.href = "{{ url('inventarios') }}/" + id + "/pdf";
        });
    });
</script>


