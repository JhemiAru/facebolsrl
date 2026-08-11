@php
    use Illuminate\Support\Facades\Session;
@endphp
@extends('layouts.admin')

@section('content')
    <style>
        /* ===== RESET Y CONFIGURACIÓN BASE ===== */
        body {
            background: #0f2027;
            color: #f1f5f9;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        /* ===== CONTENEDOR PRINCIPAL ===== */
        .content {
            width: 100%;
            max-width: 100%;
            margin: 0;
            padding: 15px;
            box-sizing: border-box;
        }

        /* ===== TÍTULO PRINCIPAL ===== */
        h1.mb-2 {
            color: #58a6ff !important;
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 20px;
            padding: 15px 0;
            text-align: center;
            width: 100%;
        }

        /* ===== TARJETAS PRINCIPALES ===== */
        .card {
            background: rgba(20, 25, 35, 0.95) !important;
            border: 1px solid rgba(88, 166, 255, 0.2) !important;
            border-radius: 12px;
            margin-bottom: 15px;
            width: 100%;
            box-sizing: border-box;
        }

        /* ===== CABECERA DE TARJETA ===== */
        .card-header {
            background: #1a365d !important;
            border-bottom: 1px solid rgba(88, 166, 255, 0.3) !important;
            padding: 15px 20px;
            width: 100%;
            box-sizing: border-box;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .card-header h3 {
            font-size: 1.4rem;
            font-weight: 700;
            color: #58a6ff !important;
            margin: 0;
            flex: 0 0 auto;
        }

        .card-title {
            color: #58a6ff !important;
            font-weight: 700;
        }

        /* ===== BOTONES ===== */
        .btn-info {
            background: #0ea5e9 !important;
            border: none !important;
            color: #fff !important;
        }

        .btn-info:hover {
            background: #38bdf8 !important;
        }

        /* ===== TABLAS ===== */
        .table {
            background: transparent !important;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            width: 100% !important;
            color: #e2e8f0 !important;
        }

        .table thead th {
            background: #1a365d !important;
            color: #58a6ff !important;
            font-weight: 700;
            border: none !important;
            padding: 12px 8px;
            text-align: center;
            font-size: 0.9rem;
            vertical-align: middle;
        }

        .table tbody td {
            background: transparent !important;
            color: #e2e8f0 !important;
            border-color: rgba(255, 255, 255, 0.05) !important;
            padding: 10px 8px;
            vertical-align: middle;
        }

        .table tbody tr:hover td {
            background: rgba(88, 166, 255, 0.1) !important;
        }

        .table-bordered {
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
        }

        /* ===== BADGES ===== */
        .badge {
            font-weight: 600;
            padding: 6px 10px;
            border-radius: 4px;
            font-size: 0.85rem;
        }

        .bg-success {
            background: #10b981 !important;
        }

        .bg-warning {
            background: #f59e0b !important;
        }

        .bg-info {
            background: #06b6d4 !important;
        }

        .bg-secondary {
            background: #6b7280 !important;
        }

        /* ===== ALERTAS ===== */
        .alert {
            border-radius: 8px;
        }

        .alert-info {
            background: rgba(6, 182, 212, 0.1) !important;
            border: 1px solid #06b6d4 !important;
            color: #06b6d4 !important;
        }

        .alert-warning {
            background: rgba(245, 158, 11, 0.1) !important;
            border: 1px solid #f59e0b !important;
            color: #f59e0b !important;
        }

        /* ===== PAGINACIÓN ===== */
        .pagination {
            margin-top: 0 !important;
            margin-bottom: 0 !important;
            gap: 4px !important;
            display: flex !important;
            flex-wrap: wrap !important;
            justify-content: center !important;
            align-items: center !important;
        }

        .page-item {
            margin: 0 1px !important;
            list-style: none !important;
        }

        .page-link {
            background: rgba(255, 255, 255, 0.08) !important;
            border: 1px solid rgba(88, 166, 255, 0.3) !important;
            color: #e2e8f0 !important;
            border-radius: 6px !important;
            padding: 5px 10px !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
        }

        .page-link:hover {
            background: rgba(88, 166, 255, 0.25) !important;
            border-color: #58a6ff !important;
            color: #ffffff !important;
        }

        .page-item.active .page-link {
            background: linear-gradient(135deg, #58a6ff 0%, #3b82f6 100%) !important;
            border-color: #58a6ff !important;
            color: #000000 !important;
        }

        /* ===== MODALES ===== */
        .modal-content {
            background: rgba(20, 25, 35, 0.98) !important;
            border: 1px solid rgba(88, 166, 255, 0.3) !important;
            border-radius: 12px;
            color: #f1f5f9 !important;
        }

        .modal-header {
            background: #1a365d !important;
            border-bottom: 1px solid rgba(88, 166, 255, 0.3) !important;
            color: #58a6ff !important;
        }

        .modal-title {
            color: #58a6ff !important;
        }

        .modal-body {
            background: rgba(20, 25, 35, 0.95) !important;
            color: #e2e8f0 !important;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .content {
                padding: 10px;
            }

            h1.mb-2 {
                font-size: 1.8rem;
            }

            .btn {
                width: 100%;
                margin-bottom: 5px;
            }

            .table thead th,
            .table tbody td {
                padding: 6px 4px;
                font-size: 0.75rem;
            }
        }

        /* ===== UTILIDADES ===== */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }
    </style>

    <div class="content" style="margin-left: 10px;">
        <div class="container-fluid">
            <h1 class="mb-2">Mis Recibos de Facturación</h1>

            @if (isset($mensaje))
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle"></i> {{ $mensaje }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="bi bi-receipt"></i> Lista de Mis Recibos
                    </h3>
                </div>

                <div class="card-body">
                    @if ($facturas->total() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="tabla-recibos">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 60px;">N°</th>
                                        <th class="text-center" style="width: 120px;">N° Recibo</th>
                                        <th class="text-center" style="width: 250px;">Cliente</th>
                                        <th class="text-center" style="width: 100px;">Fecha</th>
                                        <th class="text-center" style="width: 120px;">Monto Total</th>
                                        <th class="text-center" style="width: 120px;">Estado</th>
                                        <th class="text-center" style="width: 80px;">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($facturas as $index => $factura)
                                        <tr>
                                            <td class="text-center">
                                                {{ ($facturas->currentPage() - 1) * $facturas->perPage() + $index + 1 }}
                                            </td>
                                            <td class="text-center">
                                                <strong>{{ $factura->recibo->n_recibo ?? 'N/A' }}</strong>
                                            </td>
                                            <td>
                                                {{ trim(
                                                    ($factura->informacion->nombre ?? '') .
                                                        ' ' .
                                                        ($factura->informacion->apellido_paterno ?? '') .
                                                        ' ' .
                                                        ($factura->informacion->apellido_materno ?? ''),
                                                ) ?:
                                                    'Sin nombre' }}
                                            </td>
                                            <td class="text-center">
                                                {{ $factura->recibo && $factura->recibo->fecha_recibo
                                                    ? \Carbon\Carbon::parse($factura->recibo->fecha_recibo)->format('d/m/Y')
                                                    : 'N/A' }}
                                            </td>
                                            <td class="text-end">
                                                <strong>Bs.
                                                    {{ $factura->recibo ? number_format($factura->recibo->monto_total, 2) : '0.00' }}</strong>
                                            </td>
                                            <td class="text-center">
                                                @if ($factura->estado === 'no_cancelado')
                                                    <span class="badge bg-warning text-dark">No Cancelado</span>
                                                @elseif($factura->estado === 'pago_efectivo')
                                                    <span class="badge bg-success">Pago Efectivo</span>
                                                @elseif($factura->estado === 'pago_deposito')
                                                    <span class="badge bg-info">Pago Depósito</span>
                                                @elseif($factura->estado === 'pago_horas')
                                                    <span class="badge bg-secondary">Pago Horas</span>
                                                @else
                                                    <span class="badge bg-secondary">Sin Estado</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-info btn-ver-recibo"
                                                    data-id="{{ $factura->id }}" title="Ver detalles">
                                                    <i class="bi bi-eye"></i> Ver
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Información de paginación -->
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="text-muted">
                                Mostrando <strong>{{ $facturas->firstItem() }}</strong> a
                                <strong>{{ $facturas->lastItem() }}</strong> de
                                <strong>{{ $facturas->total() }}</strong> recibos
                            </div>
                            <div>
                                {{ $facturas->links() }}
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info text-center">
                            <i class="bi bi-info-circle" style="font-size: 2rem;"></i>
                            <h5 class="mt-2">No tienes recibos registrados</h5>
                            <p class="mb-0">Aún no se han generado recibos asociados a tu cuenta.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Paginación -->
    @if ($facturas->hasPages())
        <div class="d-flex justify-content-center mt-3">
            {{ $facturas->links() }}
        </div>
    @endif

    <!-- Modal Ver Recibo (solo lectura) -->
    @include('facturaciones.recibo.ver-modal')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Manejar el botón Ver Recibo - Cargar datos desde el servidor
            document.querySelectorAll('.btn-ver-recibo').forEach(function(button) {
                button.addEventListener('click', function() {
                    const facturaId = this.getAttribute('data-id');

                    // Mostrar el modal inmediatamente
                    const modal = new bootstrap.Modal(document.getElementById('modalVerRecibo'));
                    modal.show();

                    // Mostrar spinner de carga
                    const modalBody = document.querySelector('#modalVerRecibo .modal-body');
                    const originalContent = modalBody.innerHTML;
                    modalBody.innerHTML = `
                        <div class="text-center p-4">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Cargando...</span>
                            </div>
                            <p class="mt-2">Cargando detalles del recibo...</p>
                        </div>
                    `;

                    // Cargar datos del recibo desde el servidor
                    fetch(`/facturacion/recibos/${facturaId}/show`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success && data.factura) {
                                const factura = data.factura;
                                const recibo = factura.recibo;
                                const informacion = factura.informacion;

                                // Restaurar contenido original
                                modalBody.innerHTML = originalContent;

                                // Rellenar datos del modal
                                document.getElementById('ver_n_recibo').textContent = recibo
                                    .n_recibo || 'N/A';

                                // Formatear fecha (no hay campo de fecha en el modal ver-modal)

                                // Cliente
                                const nombreCompleto =
                                    `${informacion.nombre || ''} ${informacion.apellido_paterno || ''} ${informacion.apellido_materno || ''}`
                                    .trim();
                                document.getElementById('ver_cliente').textContent =
                                    nombreCompleto || 'Sin nombre';

                                // Montos
                                const montoFormateado = parseFloat(recibo.monto_total || 0)
                                    .toFixed(2);
                                document.getElementById('ver_monto_total').textContent =
                                    montoFormateado;
                                document.getElementById('ver_monto_literal').textContent =
                                    recibo.monto_literal || 'N/A';

                                // Estado con badge
                                const estadoBadge = document.getElementById('ver_estado');
                                estadoBadge.className = 'badge';

                                switch (factura.estado) {
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

                                // Cargar conceptos si existen
                                const conceptosContainer = document.getElementById(
                                    'ver_conceptos_container');
                                if (conceptosContainer && recibo.conceptos && recibo.conceptos
                                    .length > 0) {
                                    conceptosContainer.innerHTML = '';
                                    recibo.conceptos.forEach((concepto, index) => {
                                        const conceptoDiv = document.createElement(
                                            'div');
                                        conceptoDiv.className =
                                            'concepto-item border-bottom pb-2 mb-2';
                                        conceptoDiv.innerHTML = `
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <span class="badge bg-primary concepto-numero-badge">${index + 1}</span>
                                                    <strong style="color: #e2e8f0;">${concepto.concepto}</strong>
                                                </div>
                                                <div class="text-end">
                                                    <strong style="color: #58a6ff;">Bs. ${parseFloat(concepto.monto).toFixed(2)}</strong>
                                                </div>
                                            </div>
                                            <div class="text-muted small mt-1">
                                                <i class="bi bi-calendar"></i> ${new Date(concepto.fecha_concepto).toLocaleDateString('es-BO')}
                                            </div>
                                        `;
                                        conceptosContainer.appendChild(conceptoDiv);
                                    });
                                }

                                // Actualizar enlace de descarga PDF
                                const btnPDF = document.getElementById('btnDescargarPDFRecibo');
                                if (btnPDF) {
                                    btnPDF.href = `/facturacion/recibos/${facturaId}/pdf`;
                                }
                            } else {
                                modalBody.innerHTML = `
                                    <div class="alert alert-danger">
                                        <i class="bi bi-exclamation-triangle"></i> 
                                        Error al cargar los datos del recibo
                                    </div>
                                `;
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            modalBody.innerHTML = `
                                <div class="alert alert-danger">
                                    <i class="bi bi-exclamation-triangle"></i> 
                                    Error de conexión: ${error.message}
                                </div>
                            `;
                        });
                });
            });
        });
    </script>
@endsection
