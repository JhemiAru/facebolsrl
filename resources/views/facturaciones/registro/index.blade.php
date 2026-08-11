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

        .card-header .d-flex {
            flex: 1;
            justify-content: flex-end;
        }

        .card-header .btn-primary {
            margin-left: auto;
        }

        .card-title {
            color: #58a6ff !important;
            font-weight: 700;
        }

        /* ===== BOTONES PRINCIPALES ===== */
        .btn-primary {
            background: #238636 !important;
            border: none !important;
            border-radius: 6px;
            padding: 8px 16px;
            font-weight: 600;
            transition: all 0.2s ease;
            margin: 2px;
            color: #fff !important;
        }

        .btn-primary:hover {
            background: #2ea043 !important;
            transform: translateY(-1px);
        }

        .btn-warning {
            background: #f59e0b !important;
            border: none !important;
            color: #000 !important;
        }

        .btn-info {
            background: #0ea5e9 !important;
            border: none !important;
        }

        .btn-success {
            background: #10b981 !important;
            border: none !important;
        }

        .btn-danger {
            background: #ef4444 !important;
            border: none !important;
        }

        .btn-secondary {
            background: #6b7280 !important;
            border: none !important;
        }

        .btn-warning:hover {
            background: #fbbf24 !important;
        }

        .btn-info:hover {
            background: #38bdf8 !important;
        }

        .btn-success:hover {
            background: #34d399 !important;
        }

        .btn-danger:hover {
            background: #dc2626 !important;
        }

        /* Estilos para botones deshabilitados */
        .btn:disabled,
        .btn.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* Botones pequeños del header con icono */
        .card-header .btn-sm {
            transition: all 0.3s ease !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2) !important;
        }

        .card-header .btn-sm:hover:not(:disabled) {
            transform: translateY(-2px) scale(1.05) !important;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3) !important;
        }

        .card-header .btn-sm:active:not(:disabled) {
            transform: translateY(0) scale(0.98) !important;
        }

        .card-header .btn-sm i {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ===== TABLAS PRINCIPALES ===== */
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

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(255, 255, 255, 0.02) !important;
        }

        /* ===== BADGES/ETIQUETAS ===== */
        .badge {
            font-weight: 600;
            padding: 6px 10px;
            border-radius: 4px;
            font-size: 0.85rem;
        }

        .bg-primary {
            background: #3b82f6 !important;
        }

        .bg-success {
            background: #10b981 !important;
        }

        .bg-warning {
            background: #f59e0b !important;
        }

        .bg-danger {
            background: #ef4444 !important;
        }

        .bg-secondary {
            background: #6b7280 !important;
        }

        .bg-info {
            background: #06b6d4 !important;
        }

        /* ===== GRUPOS DE BOTONES ===== */
        .btn-group .btn {
            border-radius: 4px;
            margin: 1px;
            border: none;
            font-weight: 600;
            padding: 6px 10px;
            font-size: 0.8rem;
        }

        .btn-sm {
            padding: 4px 8px;
            font-size: 0.8rem;
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

        .modal-footer {
            background: rgba(20, 25, 35, 0.95) !important;
            border-top: 1px solid rgba(88, 166, 255, 0.3) !important;
        }

        /* ===== FORMULARIOS ===== */
        .form-label {
            color: #e2e8f0 !important;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            background: rgba(255, 255, 255, 0.1) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            color: #ffffff !important;
            border-radius: 6px;
            padding: 8px 12px;
        }

        .form-control:focus,
        .form-select:focus {
            background: rgba(255, 255, 255, 0.15) !important;
            border-color: #58a6ff !important;
            color: #ffffff !important;
            box-shadow: 0 0 0 0.2rem rgba(88, 166, 255, 0.25) !important;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5) !important;
        }

        textarea.form-control {
            resize: vertical;
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
            min-width: 34px !important;
            height: 34px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            text-align: center !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
            font-size: 0.8rem !important;
            line-height: 1 !important;
            text-decoration: none !important;
        }

        .page-link:hover {
            background: rgba(88, 166, 255, 0.25) !important;
            border-color: #58a6ff !important;
            color: #ffffff !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 8px rgba(88, 166, 255, 0.3) !important;
        }

        .page-item.active .page-link {
            background: linear-gradient(135deg, #58a6ff 0%, #3b82f6 100%) !important;
            border-color: #58a6ff !important;
            color: #000000 !important;
            font-weight: 700 !important;
            box-shadow: 0 4px 12px rgba(88, 166, 255, 0.5) !important;
            transform: scale(1.05) !important;
        }

        .page-item.disabled .page-link {
            background: rgba(255, 255, 255, 0.05) !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
            color: #6b7280 !important;
            opacity: 0.5 !important;
            cursor: not-allowed !important;
            pointer-events: none !important;
        }

        .page-link:focus {
            box-shadow: 0 0 0 0.2rem rgba(88, 166, 255, 0.4) !important;
            z-index: 3 !important;
            outline: none !important;
        }

        /* Estilos para los botones de Previous/Next */
        .page-item:first-child .page-link,
        .page-item:last-child .page-link {
            font-weight: 700 !important;
            padding: 5px 12px !important;
        }

        /* Contenedor de paginación */
        .pagination-wrapper {
            background: rgba(26, 54, 93, 0.3);
            border-radius: 12px;
            padding: 15px;
            border: 1px solid rgba(88, 166, 255, 0.2);
            backdrop-filter: blur(10px);
            margin-top: 15px;
        }

        .pagination-info {
            color: #9ca3af;
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 12px;
            text-align: center;
        }

        .pagination-info strong {
            color: #58a6ff !important;
            font-weight: 700;
        }

        /* Forzar estilos en spans dentro de page-link */
        .page-link span {
            font-size: 0.8rem !important;
            line-height: 1 !important;
        }

        /* ===== ALERTAS ===== */
        .alert {
            border-radius: 8px;
            border: none;
        }

        .alert-info {
            background: rgba(6, 182, 212, 0.2) !important;
            color: #06b6d4 !important;
            border: 1px solid rgba(6, 182, 212, 0.4) !important;
        }

        .alert-warning {
            background: rgba(245, 158, 11, 0.2) !important;
            color: #f59e0b !important;
            border: 1px solid rgba(245, 158, 11, 0.4) !important;
        }

        .alert-secondary {
            background: rgba(107, 114, 128, 0.2) !important;
            color: #9ca3af !important;
            border: 1px solid rgba(107, 114, 128, 0.4) !important;
        }

        /* ===== TEXTO ===== */
        .text-muted {
            color: #9ca3af !important;
        }

        .text-danger {
            color: #ef4444 !important;
        }

        .text-end,
        .text-center {
            color: #e2e8f0 !important;
        }

        strong {
            color: #f1f5f9 !important;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .content {
                padding: 10px;
            }

            h1.mb-4 {
                font-size: 1.8rem;
            }

            .card-header h3 {
                font-size: 1.2rem;
            }

            /* Header responsive - Layout optimizado */
            .card-header .d-flex {
                flex-wrap: wrap !important;
                gap: 8px !important;
            }

            /* Input container - primera fila (casi todo el ancho) */
            .card-header .d-flex>div:first-child {
                order: 1;
                flex: 1 1 calc(100% - 50px);
                min-width: calc(100% - 50px);
            }

            /* Input de búsqueda - más pequeño */
            #buscar_cliente {
                font-size: 0.85rem !important;
                padding: 8px 10px !important;
                height: 36px !important;
            }

            /* Botón Descargar Todos - primera fila junto al input */
            .card-header a[href*="pdf.todas"] {
                order: 2;
                width: 42px !important;
                min-width: 42px !important;
                height: 36px !important;
                padding: 0 !important;
            }

            /* Ocultar separador en móvil */
            .card-header .d-flex>div[style*="flex: 1"] {
                display: none !important;
            }

            /* Botones PDF Filtrado y Agregar - segunda fila (50/50) */
            .card-header #btnPdfFiltrado,
            .card-header button[data-bs-target="#modalAgregarFactura"] {
                order: 3;
                flex: 1 1 calc(50% - 4px);
                width: calc(50% - 4px) !important;
                height: 40px !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                gap: 4px !important;
            }

            /* Agregar texto a los botones de segunda fila en móvil */
            .card-header #btnPdfFiltrado::after {
                content: "Preview";
                font-size: 0.85rem;
                font-weight: 600;
            }

            .card-header button[data-bs-target="#modalAgregarFactura"]::after {
                content: "Nuevo";
                font-size: 0.85rem;
                font-weight: 600;
            }

            .btn {
                width: 100%;
                margin-bottom: 5px;
                font-size: 0.8rem;
            }

            .btn-group {
                display: flex;
                flex-direction: column;
            }

            .btn-group .btn {
                margin: 1px 0;
                width: 100%;
            }

            .table thead th,
            .table tbody td {
                padding: 6px 4px;
                font-size: 0.75rem;
            }

            /* Botones de acciones en móvil - horizontal solo iconos */
            .btn-group {
                flex-direction: row !important;
                flex-wrap: wrap !important;
                gap: 4px !important;
                justify-content: flex-start !important;
            }

            .btn-group .btn {
                width: auto !important;
                min-width: 36px !important;
                height: 36px !important;
                padding: 0 !important;
                margin: 0 !important;
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                flex: 0 0 auto !important;
            }

            /* Contenedor de botones alineado a la izquierda */
            .actions-row .d-flex {
                justify-content: flex-start !important;
            }

            /* Ocultar texto en botones de acciones, solo mostrar iconos */
            .btn-group .btn-sm {
                font-size: 0 !important;
            }

            .btn-group .btn-sm i {
                font-size: 1rem !important;
                margin: 0 !important;
            }

            /* Paginación responsive */
            .page-link {
                padding: 4px 8px !important;
                font-size: 0.75rem !important;
                min-width: 30px !important;
                height: 30px !important;
            }

            .page-item:first-child .page-link,
            .page-item:last-child .page-link {
                padding: 4px 10px !important;
            }

            .pagination-wrapper {
                padding: 10px 8px !important;
            }

            .pagination-info {
                font-size: 0.75rem !important;
                margin-bottom: 10px !important;
            }

            .pagination {
                gap: 2px !important;
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

        .btn-close-white {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        /* Estilos personalizados para Select2 en modales */
        .select2-container {
            width: 100% !important;
        }

        .select2-container .select2-selection--single {
            height: 38px;
            background: rgba(255, 255, 255, 0.1) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            border-radius: 6px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px !important;
            padding-left: 12px !important;
            padding-top: 0 !important;
            color: #ffffff !important;
            display: flex !important;
            align-items: center !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: #ffffff transparent transparent transparent !important;
        }

        .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
            border-color: transparent transparent #ffffff transparent !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
            right: 6px;
        }

        .select2-dropdown {
            background: rgba(20, 25, 35, 0.98) !important;
            border: 1px solid rgba(88, 166, 255, 0.3) !important;
            border-radius: 6px !important;
        }

        .select2-search--dropdown .select2-search__field {
            background: rgba(255, 255, 255, 0.1) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            border-radius: 6px !important;
            color: #ffffff !important;
            padding: 8px 12px;
        }

        .select2-search--dropdown .select2-search__field:focus {
            background: rgba(255, 255, 255, 0.15) !important;
            border-color: #58a6ff !important;
            outline: none;
        }

        .select2-results {
            background: transparent !important;
        }

        .select2-results__option {
            padding: 8px 12px;
            color: #e2e8f0 !important;
            background: transparent !important;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background: rgba(88, 166, 255, 0.3) !important;
            color: #ffffff !important;
        }

        .select2-container--default .select2-results__option[aria-selected=true] {
            background: rgba(88, 166, 255, 0.5) !important;
            color: #ffffff !important;
        }

        .select2-container--default .select2-selection--single:focus,
        .select2-container--default.select2-container--open .select2-selection--single {
            background: rgba(255, 255, 255, 0.15) !important;
            border-color: #58a6ff !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: rgba(255, 255, 255, 0.5) !important;
        }

        .select2-results__message {
            color: #9ca3af !important;
        }

        /* Ajuste para el z-index en modales */
        .select2-container--open {
            z-index: 9999;
        }

        .select2-dropdown {
            z-index: 9999;
        }

        /* Estilos para el select de estado */
        #estado {
            font-weight: 500;
            transition: all 0.3s ease;
        }

        #estado:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        #estado option[value="no_cancelado"] {
            background-color: #fff3cd;
            color: #856404;
        }

        #estado option[value="pago_efectivo"] {
            background-color: #d4edda;
            color: #155724;
        }

        #estado option[value="pago_deposito"] {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        #estado option[value="pago_horas"] {
            background-color: #e2e3e5;
            color: #383d41;
        }

        /* Estilos para el switch de anulado */
        #edit_anulado:checked {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        #edit_anulado:not(:checked) {
            background-color: #28a745;
            border-color: #28a745;
        }

        #edit_anulado:focus {
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        .form-check-label {
            cursor: pointer;
            user-select: none;
        }

        /* Estilos para el botón de despliegue circular */
        .toggle-actions {
            width: 20px !important;
            height: 20px !important;
            border-radius: 50% !important;
            padding: 0 !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-size: 0.75rem !important;
            transition: all 0.2s ease !important;
        }

        .toggle-actions i {
            margin: 0 !important;
        }

        .toggle-actions:hover {
            transform: scale(1.1) !important;
        }
    </style>

    <div class="content" style="margin-left: 10px;">
        <div class="container-fluid">
            <h1 class="mb-2">Gestión de Comprobantes</h1>
            <!-- Tabla de facturas -->
            <div class="card">
                <div class="card-header">
                    <div class="d-flex gap-2 align-items-center">
                        <!-- Buscador de Cliente/Fecha -->
                        <div style="min-width: 150px;">
                            <input type="text" id="buscar_cliente" class="form-control"
                                placeholder="Buscar cliente o fecha (dd/mm/aaaa)..."
                                style="background: rgba(255, 255, 255, 0.1) !important; 
                                          border: 1px solid rgba(255, 255, 255, 0.2) !important; 
                                          color: #ffffff !important;">
                        </div>

                        <!-- Selector de mes -->
                        <select id="filtro_mes" class="form-select form-select-sm"
                            style="width: 150px; 
                                       background: rgba(255, 255, 255, 0.1) !important; 
                                       border: 1px solid rgba(255, 255, 255, 0.2) !important; 
                                       color: #ffffff !important;">
                            <option value="">Todos los meses</option>
                            <option value="01">Enero</option>
                            <option value="02">Febrero</option>
                            <option value="03">Marzo</option>
                            <option value="04">Abril</option>
                            <option value="05">Mayo</option>
                            <option value="06">Junio</option>
                            <option value="07">Julio</option>
                            <option value="08">Agosto</option>
                            <option value="09">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                        </select>

                        <!-- Botón PDF Filtrado por Cliente (solo icono) -->
                        <button type="button" id="btnPdfFiltrado" class="btn btn-info btn-sm" disabled
                            title="Generar PDF del cliente filtrado"
                            style="width: 36px; height: 36px; padding: 0; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-file-pdf-fill" style="font-size: 1.1rem;"></i>
                        </button>

                        <!-- Separador (spacer) -->
                        <div style="flex: 1;"></div>

                        <!-- Botón Descargar Todos (solo icono) -->
                        <a href="{{ route('facturacion.comprobante.pdf.todas') }}" class="btn btn-danger btn-sm"
                            title="Descargar TODOS los comprobantes en PDF" target="_blank"
                            style="width: 36px; height: 36px; padding: 0; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-file-earmark-pdf-fill" style="font-size: 1.1rem;"></i>
                        </a>

                        <!-- Botón Nueva Factura (solo icono) -->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#modalAgregarFactura" title="Crear nueva factura"
                            style="width: 36px; height: 36px; padding: 0; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-plus-circle-fill" style="font-size: 1.1rem;"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width: 60px;">N°</th>
                                    <th>N° Factura</th>
                                    <th>Fecha</th>
                                    <th>Cliente</th>
                                    <th>Concepto</th>
                                    <th>Monto</th>
                                    <th>Estado</th>
                                    <th>Anulado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($facturas as $index => $factura)
                                    <!-- Fila principal -->
                                    <tr>
                                        <td class="text-center">
                                            <div class="d-flex align-items-center justify-content-center gap-2">
                                                <button type="button" class="btn btn-sm btn-primary toggle-actions"
                                                    data-target="actions-{{ $factura->id }}" title="Mostrar acciones">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>
                                                <strong>{{ $facturas->firstItem() + $index }}</strong>
                                            </div>
                                        </td>
                                        <td><strong>{{ $factura->registro->n_registro }}</strong></td>
                                        <td>{{ \Carbon\Carbon::parse($factura->registro->fecha)->format('d/m/Y') }}</td>
                                        <td>
                                            @if ($factura->informacion)
                                                {{ $factura->informacion->nombre }}
                                                {{ $factura->informacion->apellido_paterno ?? '' }}
                                                {{ $factura->informacion->apellido_materno ?? '' }}
                                            @else
                                                <span class="text-muted">Sin cliente</span>
                                            @endif
                                        </td>
                                        <td>{{ $factura->registro->concepto }}</td>
                                        <td class="text-end">
                                            <strong>{{ number_format($factura->registro->monto, 2) }} Bs</strong>
                                        </td>
                                        <td class="text-center">
                                            @if ($factura->estado === 'no_cancelado')
                                                <span class="badge bg-warning text-dark">
                                                    No Cancelado
                                                </span>
                                            @elseif ($factura->estado === 'pago_efectivo')
                                                <span class="badge bg-success">
                                                    Pago Efectivo
                                                </span>
                                            @elseif ($factura->estado === 'pago_deposito')
                                                <span class="badge bg-info">
                                                    Pago Depósito
                                                </span>
                                            @elseif ($factura->estado === 'pago_horas')
                                                <span class="badge bg-secondary">
                                                    Pago Horas
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">Sin Estado</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($factura->anulado)
                                                <span class="badge bg-danger">
                                                    Anulada
                                                </span>
                                            @else
                                                <span class="badge bg-success">
                                                    Activa
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    <!-- Fila de acciones desplegable -->
                                    <tr id="actions-{{ $factura->id }}" class="actions-row" style="display: none;">
                                        <td colspan="8" class="p-3" style="background: rgba(88, 166, 255, 0.05);">
                                            <div class="d-flex justify-content-center gap-2">
                                                <div class="btn-group" role="group">
                                                    <!-- Botón Ver -->
                                                    <button type="button" class="btn btn-info btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#modalVerFactura"
                                                        data-id="{{ $factura->id }}"
                                                        data-numero="{{ $factura->registro->n_registro ?? 'N/A' }}"
                                                        data-fecha="{{ \Carbon\Carbon::parse($factura->registro->fecha)->format('d/m/Y') }}"
                                                        data-cliente="{{ $factura->informacion ? $factura->informacion->nombre . ' ' . ($factura->informacion->apellido_paterno ?? '') . ' ' . ($factura->informacion->apellido_materno ?? '') : 'Sin cliente' }}"
                                                        data-concepto="{{ $factura->registro->concepto }}"
                                                        data-monto="{{ number_format($factura->registro->monto, 2) }}"
                                                        data-monto-literal="{{ $factura->registro->monto_literal ?? 'N/A' }}"
                                                        data-estado="{{ $factura->estado }}"
                                                        data-anulado="{{ $factura->anulado ?? '0' }}"
                                                        title="Ver detalles">
                                                        <i class="bi bi-eye"></i> Ver
                                                    </button>

                                                    <!-- Botón Editar -->
                                                    <button type="button" class="btn btn-warning btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#modalEditarFactura"
                                                        data-id="{{ $factura->id }}"
                                                        data-numero="{{ $factura->registro->n_registro ?? 'N/A' }}"
                                                        data-fecha="{{ $factura->registro->fecha }}"
                                                        data-cliente-id="{{ $factura->id_informacion }}"
                                                        data-cliente-nombre="{{ $factura->informacion ? $factura->informacion->nombre . ' ' . $factura->informacion->apellido_paterno . ' ' . $factura->informacion->apellido_materno : 'N/A' }}"
                                                        data-ci-nit="{{ $factura->ci_nit }}"
                                                        data-concepto="{{ $factura->registro->concepto }}"
                                                        data-monto="{{ $factura->registro->monto }}"
                                                        data-monto-literal="{{ $factura->registro->monto_literal ?? '' }}"
                                                        data-estado="{{ $factura->estado }}"
                                                        data-anulado="{{ $factura->anulado ?? '0' }}"
                                                        title="Editar Factura">
                                                        <i class="bi bi-pencil"></i> Editar
                                                    </button>

                                                    <!-- Botón PDF -->
                                                    <a href="{{ route('facturacion.comprobante.pdf', $factura->id) }}"
                                                        target="_blank" class="btn btn-danger btn-sm"
                                                        title="Generar PDF">
                                                        <i class="bi bi-file-pdf"></i> PDF
                                                    </a>

                                                    <!-- Botón Eliminar -->
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#modalEliminarFactura"
                                                        data-id="{{ $factura->id }}"
                                                        data-numero="{{ $factura->registro->n_registro ?? 'N/A' }}"
                                                        title="Eliminar">
                                                        <i class="bi bi-trash"></i> Eliminar
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            <div class="alert alert-info mb-0">
                                                <i class="bi bi-info-circle"></i> No hay facturas registradas
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación Mejorada -->
                    <div class="pagination-wrapper">
                        @if ($facturas->total() > 0)
                            <div class="pagination-info">
                                <i class="bi bi-info-circle me-2"></i>
                                Mostrando
                                <strong>{{ $facturas->firstItem() }}</strong>
                                a
                                <strong>{{ $facturas->lastItem() }}</strong>
                                de
                                <strong>{{ $facturas->total() }}</strong>
                                facturas
                            </div>
                        @endif

                        <div class="d-flex justify-content-center align-items-center">
                            {{ $facturas->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Alerta Universal -->
    <div class="modal fade" id="modalAlerta" tabindex="-1" aria-labelledby="modalAlertaLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-body text-center p-4">
                    <div class="mb-3">
                        <i id="alertaIcono" class="bi" style="font-size: 4rem;"></i>
                    </div>
                    <h4 id="alertaTitulo" class="mb-3"></h4>
                    <p id="alertaMensaje" class="mb-0"></p>
                    <div id="alertaListaErrores" class="text-start mt-3" style="display: none;">
                        <ul id="listaErrores" class="mb-0"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Agregar Factura -->
    @include('facturaciones.registro.agregar-modal')

    <!-- Modal Editar Factura -->
    @include('facturaciones.registro.editar-modal')

    <!-- Modal Ver Registro -->
    @include('facturaciones.registro.ver-modal')

    <!-- Modal Eliminar Factura -->
    <div class="modal fade" id="modalEliminarFactura" tabindex="-1" aria-labelledby="modalEliminarFacturaLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalEliminarFacturaLabel">
                        <i class="bi bi-exclamation-triangle"></i> Confirmar Eliminación
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <i class="bi bi-exclamation-circle text-danger" style="font-size: 4rem;"></i>
                    </div>
                    <h5 class="text-center mb-3">¿Está seguro de eliminar esta factura?</h5>
                    <p class="text-center">
                        <strong>Factura N°: <span id="delete_n_factura"></span></strong>
                    </p>
                    <div class="alert alert-warning" role="alert">
                        <i class="bi bi-info-circle"></i> Esta acción no se puede deshacer.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </button>
                    <form action="" method="POST" id="formEliminarFactura" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i> Sí, Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para manejar el modal -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Buscador de cliente y filtro de mes
            const buscarCliente = document.getElementById('buscar_cliente');
            const filtroMes = document.getElementById('filtro_mes');
            const tablaBody = document.querySelector('.table tbody');
            let todasLasFilas = [];

            // Guardar todas las filas al cargar
            function guardarFilas() {
                todasLasFilas = Array.from(tablaBody.querySelectorAll('tr'));
            }

            // Función de filtrado combinado
            function aplicarFiltros() {
                const textoBusqueda = buscarCliente.value.toLowerCase().trim();
                const mesSeleccionado = filtroMes.value;
                const btnPdfFiltrado = document.getElementById('btnPdfFiltrado');

                todasLasFilas.forEach(fila => {
                    const esFilaAcciones = fila.classList.contains('actions-row');

                    if (esFilaAcciones) {
                        fila.style.display = 'none';
                    } else {
                        const clienteCell = fila.querySelector('td:nth-child(4)'); // Columna de cliente
                        const fechaCell = fila.querySelector('td:nth-child(3)'); // Columna de fecha
                        const numeroCell = fila.querySelector('td:nth-child(2)');
                        const estadoCell = fila.querySelector('td:nth-child(7)');

                        const clienteTexto = clienteCell ? clienteCell.textContent.toLowerCase() : '';
                        const fechaTexto = fechaCell ? fechaCell.textContent.trim() : '';
                        const numeroTexto = numeroCell ? numeroCell.textContent.toLowerCase() : '';
                        const estadoTexto = estadoCell ? estadoCell.textContent.toLowerCase() : '';

                        // Filtro de texto
                        const coincideTexto = textoBusqueda === '' ||
                            clienteTexto.includes(textoBusqueda) ||
                            numeroTexto.includes(textoBusqueda) ||
                            estadoTexto.includes(textoBusqueda) ||
                            fechaTexto.toLowerCase().includes(textoBusqueda);

                        // Filtro de mes
                        let coincideMes = true;
                        if (mesSeleccionado !== '') {
                            const fechaParts = fechaTexto.split('/');
                            if (fechaParts.length === 3) {
                                const mesFecha = fechaParts[1];
                                coincideMes = mesFecha === mesSeleccionado;
                            } else {
                                coincideMes = false;
                            }
                        }

                        if (coincideTexto && coincideMes) {
                            fila.style.display = '';
                        } else {
                            fila.style.display = 'none';
                        }
                    }
                });

                // Mostrar mensaje si no hay resultados
                const filasVisibles = todasLasFilas.filter(fila =>
                    !fila.classList.contains('actions-row') && fila.style.display !== 'none'
                );

                // Remover mensaje previo si existe
                const mensajePrevio = tablaBody.querySelector('.no-results-message');
                if (mensajePrevio) {
                    mensajePrevio.remove();
                }

                // Verificar si todas las facturas visibles pertenecen a UN SOLO cliente
                let clientesUnicos = new Set();
                let clienteNombre = '';
                filasVisibles.forEach(fila => {
                    const clienteCell = fila.querySelector('td:nth-child(4)');
                    if (clienteCell) {
                        const nombre = clienteCell.textContent.trim();
                        clientesUnicos.add(nombre);
                        clienteNombre = nombre;
                    }
                });

                // Variable para verificar si hay un solo cliente
                const unSoloCliente = textoBusqueda !== '' && clientesUnicos.size === 1 && filasVisibles
                    .length > 0;

                // Habilitar/deshabilitar botón PDF según si hay un solo cliente
                if (unSoloCliente) {
                    btnPdfFiltrado.disabled = false;
                    btnPdfFiltrado.title =
                        `Generar PDF de ${clienteNombre} (${filasVisibles.length} factura${filasVisibles.length > 1 ? 's' : ''})`;
                    btnPdfFiltrado.classList.remove('btn-secondary');
                    btnPdfFiltrado.classList.add('btn-info');
                } else {
                    btnPdfFiltrado.disabled = true;
                    if (textoBusqueda === '') {
                        btnPdfFiltrado.title = 'Busca un cliente para generar PDF filtrado';
                    } else if (clientesUnicos.size > 1) {
                        btnPdfFiltrado.title = 'Refina tu búsqueda (varios clientes encontrados)';
                    } else if (filasVisibles.length === 0) {
                        btnPdfFiltrado.title = 'No hay facturas';
                    }
                    btnPdfFiltrado.classList.remove('btn-info');
                    btnPdfFiltrado.classList.add('btn-secondary');
                }

                if (filasVisibles.length === 0 && (textoBusqueda !== '' || mesSeleccionado !== '')) {
                    const noResultsRow = document.createElement('tr');
                    noResultsRow.className = 'no-results-message';
                    noResultsRow.innerHTML = `
                        <td colspan="8" class="text-center py-4">
                            <i class="bi bi-search" style="font-size: 2rem; color: #9ca3af;"></i>
                            <p class="mt-2 mb-0" style="color: #9ca3af;">
                                No se encontraron resultados
                            </p>
                        </td>
                    `;
                    tablaBody.appendChild(noResultsRow);
                }
            }

            // Inicializar filas y agregar event listeners
            guardarFilas();
            buscarCliente.addEventListener('input', aplicarFiltros);
            filtroMes.addEventListener('change', aplicarFiltros);

            // Manejar el botón de PDF filtrado por cliente
            document.getElementById('btnPdfFiltrado').addEventListener('click', function() {
                const textoBusqueda = buscarCliente.value.toLowerCase().trim();

                // Obtener las facturas visibles (filtradas)
                const filasVisibles = todasLasFilas.filter(fila => {
                    return !fila.classList.contains('actions-row') &&
                        fila.style.display !== 'none' &&
                        fila.querySelector('.toggle-actions');
                });

                if (filasVisibles.length === 0) {
                    alert('No hay facturas visibles para generar el PDF.');
                    return;
                }

                // Verificar que todas las facturas son del mismo cliente
                let clientesUnicos = new Set();
                let clienteId = null;
                filasVisibles.forEach(fila => {
                    const clienteCell = fila.querySelector('td:nth-child(4)');
                    if (clienteCell) {
                        clientesUnicos.add(clienteCell.textContent.trim());
                    }
                    // Obtener el ID del cliente desde el botón Ver
                    const btnVer = fila.querySelector('button[data-bs-target="#modalVerFactura"]');
                    if (btnVer && !clienteId) {
                        // Extraer el ID de informacion del dataset
                        const facturaId = btnVer.getAttribute('data-id');
                        // Guardar temporalmente para obtener el cliente
                        clienteId = facturaId;
                    }
                });

                if (clientesUnicos.size > 1) {
                    alert('Por favor, filtra para mostrar facturas de un solo cliente.');
                    return;
                }

                // Obtener el nombre del cliente buscado
                const nombreCliente = encodeURIComponent(textoBusqueda);

                // Generar URL con el filtro de cliente
                const url = '{{ route('facturacion.comprobante.pdf.todas') }}?cliente=' + nombreCliente;

                // Abrir en nueva pestaña
                window.open(url, '_blank');
            });

            // Función para mostrar alertas con modal
            window.mostrarAlerta = function(tipo, titulo, mensaje, listaErrores = null) {
                const modal = new bootstrap.Modal(document.getElementById('modalAlerta'));
                const icono = document.getElementById('alertaIcono');
                const tituloElement = document.getElementById('alertaTitulo');
                const mensajeElement = document.getElementById('alertaMensaje');
                const listaErroresDiv = document.getElementById('alertaListaErrores');
                const listaErroresUl = document.getElementById('listaErrores');

                // Resetear clases
                icono.className = 'bi';
                tituloElement.className = 'mb-3';

                // Configurar según el tipo
                if (tipo === 'success') {
                    icono.classList.add('bi-check-circle-fill', 'text-success');
                    tituloElement.classList.add('text-success');
                } else if (tipo === 'error') {
                    icono.classList.add('bi-x-circle-fill', 'text-danger');
                    tituloElement.classList.add('text-danger');
                } else if (tipo === 'warning') {
                    icono.classList.add('bi-exclamation-triangle-fill', 'text-warning');
                    tituloElement.classList.add('text-warning');
                }

                // Establecer contenido
                tituloElement.textContent = titulo;
                mensajeElement.textContent = mensaje;

                // Manejar lista de errores
                if (listaErrores && listaErrores.length > 0) {
                    listaErroresUl.innerHTML = '';
                    listaErrores.forEach(error => {
                        const li = document.createElement('li');
                        li.textContent = error;
                        listaErroresUl.appendChild(li);
                    });
                    listaErroresDiv.style.display = 'block';
                } else {
                    listaErroresDiv.style.display = 'none';
                }

                // Mostrar modal
                modal.show();

                // Auto-cerrar después de 2 segundos
                setTimeout(function() {
                    modal.hide();
                }, 2000);
            }

            // Verificar mensajes de sesión y mostrar alertas
            @if ($message = Session::get('mensaje'))
                mostrarAlerta('success', '¡Éxito!', '{{ $message }}');
            @endif

            @if ($error = Session::get('error'))
                mostrarAlerta('error', '¡Error!', '{{ $error }}');
            @endif

            @if ($errors->any())
                const errores = [
                    @foreach ($errors->all() as $error)
                        '{{ $error }}',
                    @endforeach
                ];
                mostrarAlerta('error', '¡Error!', 'Por favor corrija los siguientes errores:', errores);
            @endif

            // Manejar el toggle de las filas de acciones
            document.querySelectorAll('.toggle-actions').forEach(function(button) {
                button.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const targetRow = document.getElementById(targetId);
                    const icon = this.querySelector('i');

                    if (targetRow.style.display === 'none' || targetRow.style.display === '') {
                        // Mostrar las acciones
                        targetRow.style.display = 'table-row';
                        icon.classList.remove('bi-plus-lg');
                        icon.classList.add('bi-dash-lg');
                        this.classList.remove('btn-primary');
                        this.classList.add('btn-danger');
                        this.setAttribute('title', 'Ocultar acciones');
                    } else {
                        // Ocultar las acciones
                        targetRow.style.display = 'none';
                        icon.classList.remove('bi-dash-lg');
                        icon.classList.add('bi-plus-lg');
                        this.classList.remove('btn-danger');
                        this.classList.add('btn-primary');
                        this.setAttribute('title', 'Mostrar acciones');
                    }
                });
            });

            // Manejar el modal de Eliminar Factura
            var modalEliminarFactura = document.getElementById('modalEliminarFactura');
            modalEliminarFactura.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;

                // Extraer datos
                var id = button.getAttribute('data-id');
                var numero = button.getAttribute('data-numero');

                // Actualizar el action del formulario de eliminación
                var form = document.getElementById('formEliminarFactura');
                form.action = '{{ url('/facturacion/comprobantes') }}/' + id;

                // Mostrar el número de factura en el modal
                document.getElementById('delete_n_factura').textContent = numero;
            });
        });
    </script>
@endsection
