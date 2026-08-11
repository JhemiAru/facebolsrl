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

            /* Botones PDF Vista Previa y Agregar - segunda fila (50/50) */
            .card-header #btnPdfEnviar,
            .card-header button[data-bs-target="#modalAgregarRecibo"] {
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
            .card-header #btnPdfEnviar::after {
                content: "Preview";
                font-size: 0.85rem;
                font-weight: 600;
            }

            .card-header button[data-bs-target="#modalAgregarRecibo"]::after {
                content: "Nuevo";
                font-size: 0.85rem;
                font-weight: 600;
            }

            .btn {
                width: 100%;
                margin-bottom: 5px;
                font-size: 0.8rem;
            }

            .btn {
                width: 100%;
                margin-bottom: 5px;
                font-size: 0.8rem;
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

            .card-body {
                padding: 8px;
            }

            /* Tabla responsive */
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .table {
                font-size: 0.7rem;
                min-width: 900px;
            }

            .table thead th {
                padding: 8px 4px;
                font-size: 0.7rem;
                white-space: nowrap;
            }

            .table tbody td {
                padding: 8px 4px;
                font-size: 0.7rem;
            }

            .table tbody td:nth-child(1) {
                width: 50px;
            }

            .toggle-actions {
                width: 18px !important;
                height: 18px !important;
                font-size: 0.65rem !important;
            }

            .badge {
                font-size: 0.7rem;
                padding: 4px 6px;
            }

            /* Paginación responsive */
            .pagination-wrapper {
                padding: 8px;
            }

            .pagination-info {
                font-size: 0.7rem !important;
                margin-bottom: 8px !important;
            }

            .pagination {
                gap: 2px !important;
                flex-wrap: wrap !important;
            }

            .page-link {
                padding: 4px 6px !important;
                font-size: 0.7rem !important;
                min-width: 28px !important;
                height: 28px !important;
            }

            .page-item:first-child .page-link,
            .page-item:last-child .page-link {
                padding: 4px 8px !important;
            }

            /* Modales responsive */
            .modal-dialog {
                margin: 0.5rem;
                max-width: calc(100% - 1rem);
            }

            .modal-dialog-centered {
                min-height: calc(100% - 1rem);
            }

            .modal-content {
                border-radius: 8px;
            }

            .modal-header {
                padding: 12px;
            }

            .modal-title {
                font-size: 1rem;
            }

            .modal-body {
                padding: 12px;
                max-height: calc(100vh - 200px);
                overflow-y: auto;
            }

            .modal-footer {
                padding: 10px;
                flex-direction: column;
                gap: 8px;
            }

            .modal-footer .btn {
                width: 100%;
                margin: 0;
            }

            /* Formularios en modales */
            .form-label {
                font-size: 0.85rem;
                margin-bottom: 4px;
            }

            .form-control,
            .form-select {
                font-size: 0.85rem;
                padding: 8px 10px;
            }

            /* Conceptos en modales */
            .concepto-item {
                padding: 8px;
                margin-bottom: 8px;
            }

            .concepto-numero-badge {
                font-size: 0.7rem;
                padding: 0.2rem 0.4rem;
            }

            /* Botones en conceptos */
            #agregar_conceptos .btn,
            #editar_conceptos .btn {
                width: 100%;
                margin-top: 5px;
            }

            .concepto-item .btn-danger {
                width: 100%;
                margin-top: 5px;
            }

            /* Input groups */
            .input-group {
                flex-wrap: nowrap;
            }

            .input-group-text {
                font-size: 0.75rem;
                padding: 6px 8px;
            }

            /* Select2 en móvil */
            .select2-container .select2-selection--single {
                height: 38px !important;
            }

            .select2-container--default .select2-selection--single .select2-selection__rendered {
                font-size: 0.85rem;
                line-height: 36px !important;
            }

            /* Alertas */
            .alert {
                font-size: 0.8rem;
                padding: 10px;
            }

            /* Modal de alerta */
            #modalAlerta .modal-body {
                padding: 20px 15px;
            }

            #modalAlerta i {
                font-size: 3rem !important;
            }

            #modalAlerta h4 {
                font-size: 1.1rem;
            }

            #modalAlerta p {
                font-size: 0.9rem;
            }
        }

        /* Responsive para tablets */
        @media (min-width: 769px) and (max-width: 1024px) {
            .content {
                padding: 10px;
            }

            h1.mb-4 {
                font-size: 2rem;
            }

            .table {
                font-size: 0.85rem;
            }

            .card-header .btn-sm {
                padding: 6px 12px;
            }

            .modal-dialog {
                max-width: 90%;
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

        /* ===== ANIMACIONES PARA CONCEPTOS ===== */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideOut {
            from {
                opacity: 1;
                transform: translateX(0);
            }

            to {
                opacity: 0;
                transform: translateX(20px);
            }
        }

        /* ===== ESTILOS PARA CONCEPTOS ===== */
        .concepto-item {
            transition: all 0.2s ease;
        }

        .concepto-item:hover {
            background: rgba(255, 255, 255, 0.04) !important;
            border-color: rgba(88, 166, 255, 0.3) !important;
        }

        .concepto-numero-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }

        .conceptos-list::-webkit-scrollbar {
            width: 6px;
        }

        .conceptos-list::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 3px;
        }

        .conceptos-list::-webkit-scrollbar-thumb {
            background: rgba(88, 166, 255, 0.3);
            border-radius: 3px;
        }

        .conceptos-list::-webkit-scrollbar-thumb:hover {
            background: rgba(88, 166, 255, 0.5);
        }

        .input-group-text {
            background: rgba(88, 166, 255, 0.2) !important;
            border-color: rgba(255, 255, 255, 0.2) !important;
            color: #58a6ff !important;
            font-weight: 600;
        }
    </style>

    <div class="content" style="margin-left: 10px;">
        <div class="container-fluid">
            <h1 class="mb-2">Gestión de Recibos</h1>
            <!-- Tabla de facturas -->
            <div class="card">
                <div class="card-header">
                    <div class="d-flex gap-2 align-items-center">
                        <!-- Buscador de Cliente/Fecha -->
                        <div style="min-width: 250px;">
                            <input type="text" id="buscar_cliente" class="form-control"
                                placeholder="Buscar cliente o fecha (dd/mm/aaaa)..."
                                style="background: rgba(255, 255, 255, 0.1) !important; 
                                          border: 1px solid rgba(255, 255, 255, 0.2) !important; 
                                          color: #ffffff !important;">
                        </div>

                        <!-- Filtro por Mes -->
                        <div style="min-width: 150px;">
                            <select id="filtro_mes" class="form-select"
                                style="background: rgba(255, 255, 255, 0.1) !important; 
                                          border: 1px solid rgba(255, 255, 255, 0.2) !important; 
                                          color: #ffffff !important; height: 36px;">
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
                        </div>

                        <!-- Botón Vista Previa PDF (solo icono) -->
                        <button type="button" id="btnPdfEnviar" class="btn btn-info btn-sm" disabled
                            title="Vista previa PDF del cliente filtrado"
                            style="width: 36px; height: 36px; padding: 0; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-file-pdf-fill" style="font-size: 1.1rem;"></i>
                        </button>

                        <!-- Separador (spacer) -->
                        <div style="flex: 1;"></div>

                        <!-- Botón Descargar Todos (solo icono) -->
                        <a href="{{ route('facturacion.recibo.pdf.todas') }}" class="btn btn-danger btn-sm"
                            title="Descargar TODOS los recibos en PDF" target="_blank"
                            style="width: 36px; height: 36px; padding: 0; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-file-earmark-pdf-fill" style="font-size: 1.1rem;"></i>
                        </a>

                        <!-- Botón Nuevo Recibo (solo icono) -->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#modalAgregarRecibo" title="Crear nuevo recibo"
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
                                    <th>N° Recibo</th>
                                    <th>Fecha</th>
                                    <th>Cliente</th>
                                    <th>CI/NIT</th>
                                    <th>Monto Total</th>
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
                                                    data-target="actions-{{ $factura->id }}"
                                                    data-id-informacion="{{ $factura->id_informacion }}"
                                                    title="Mostrar acciones">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>
                                                <strong>{{ $facturas->firstItem() + $index }}</strong>
                                            </div>
                                        </td>
                                        <td><strong>{{ $factura->recibo->n_recibo ?? 'N/A' }}</strong></td>
                                        <td>{{ \Carbon\Carbon::parse($factura->recibo->fecha_recibo ?? now())->format('d/m/Y') }}
                                        </td>
                                        <td>
                                            @if ($factura->informacion)
                                                {{ $factura->informacion->nombre }}
                                                {{ $factura->informacion->apellido_paterno ?? '' }}
                                                {{ $factura->informacion->apellido_materno ?? '' }}
                                            @else
                                                <span class="text-muted">Sin cliente</span>
                                            @endif
                                        </td>
                                        <td>{{ $factura->ci_nit }}</td>
                                        <td class="text-end">
                                            <strong>{{ number_format($factura->recibo->monto_total ?? $factura->monto, 2) }}
                                                Bs</strong>
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
                                                        data-bs-toggle="modal" data-bs-target="#modalVerRecibo"
                                                        data-id="{{ $factura->id }}"
                                                        data-numero="{{ $factura->recibo->n_recibo ?? 'N/A' }}"
                                                        data-fecha="{{ $factura->recibo->fecha_recibo ? \Carbon\Carbon::parse($factura->recibo->fecha_recibo)->format('d/m/Y') : 'N/A' }}"
                                                        data-cliente="{{ $factura->informacion ? $factura->informacion->nombre . ' ' . ($factura->informacion->apellido_paterno ?? '') . ' ' . ($factura->informacion->apellido_materno ?? '') : 'Sin cliente' }}"
                                                        data-monto="{{ number_format($factura->recibo->monto_total ?? 0, 2) }}"
                                                        data-monto-literal="{{ $factura->recibo->monto_literal ?? 'N/A' }}"
                                                        data-estado="{{ $factura->estado }}"
                                                        data-conceptos='@json($factura->recibo->conceptos ?? [])'
                                                        title="Ver detalles">
                                                        <i class="bi bi-eye"></i> Ver
                                                    </button>

                                                    <!-- Botón Editar -->
                                                    <button type="button" class="btn btn-warning btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#modalEditarRecibo"
                                                        data-id="{{ $factura->id }}"
                                                        data-recibo-id="{{ $factura->recibo->id ?? '' }}"
                                                        data-numero="{{ $factura->recibo->n_recibo ?? 'N/A' }}"
                                                        data-fecha="{{ $factura->recibo->fecha_recibo ?? $factura->fecha }}"
                                                        data-cliente-nombre="{{ $factura->informacion ? $factura->informacion->nombre . ' ' . $factura->informacion->apellido_paterno . ' ' . $factura->informacion->apellido_materno : 'N/A' }}"
                                                        data-ci-nit="{{ $factura->ci_nit }}"
                                                        data-estado="{{ $factura->estado }}"
                                                        data-monto-total="{{ $factura->recibo->monto_total ?? 0 }}"
                                                        data-anulado="{{ $factura->anulado ?? 0 }}"
                                                        data-conceptos='@json($factura->recibo->conceptos ?? [])'
                                                        title="Ver Detalles">
                                                        <i class="bi bi-pencil"></i> Editar
                                                    </button>

                                                    <!-- Botón PDF -->
                                                    <a href="{{ route('facturacion.recibo.pdf', $factura->id) }}"
                                                        target="_blank" class="btn btn-danger btn-sm"
                                                        title="Generar PDF">
                                                        <i class="bi bi-file-pdf"></i> PDF
                                                    </a>

                                                    <!-- Botón Enviar -->
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#modalEnviarFactura"
                                                        data-id="{{ $factura->id }}"
                                                        data-numero="{{ $factura->recibo->n_recibo ?? 'N/A' }}"
                                                        data-cliente="{{ $factura->informacion ? $factura->informacion->nombre . ' ' . $factura->informacion->apellido_paterno . ' ' . $factura->informacion->apellido_materno : 'N/A' }}"
                                                        data-monto="{{ number_format($factura->monto, 2, ',', '.') }}"
                                                        data-fecha="{{ \Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') }}"
                                                        title="Enviar recibo por correo">
                                                        <i class="bi bi-send"></i> Enviar
                                                    </button>

                                                    <!-- Botón Eliminar -->
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#modalEliminarRecibo"
                                                        data-id="{{ $factura->id }}"
                                                        data-numero="{{ $factura->recibo->n_recibo ?? 'N/A' }}"
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
                                                <i class="bi bi-info-circle"></i> No hay recibos registrados
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
    @include('facturaciones.recibo.agregar-modal')

    <!-- Modal Editar Factura -->
    @include('facturaciones.recibo.editar-modal')

    <!-- Modal Ver Recibo -->
    @include('facturaciones.recibo.ver-modal')

    <!-- Modal Eliminar Factura -->
    <div class="modal fade" id="modalEliminarRecibo" tabindex="-1" aria-labelledby="modalEliminarReciboLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalEliminarReciboLabel">
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

    <!-- Modal Enviar Factura por Correo -->
    <div class="modal fade" id="modalEnviarFactura" tabindex="-1" aria-labelledby="modalEnviarFacturaLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="modalEnviarFacturaLabel">
                        <i class="bi bi-envelope"></i> Enviar Comprobante por Correo
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Campo para el correo electrónico -->
                    <div class="mb-3">
                        <label for="email_destinatario" class="form-label">
                            Correo Electrónico del Destinatario <span class="text-danger">*</span>
                        </label>
                        <input type="email" class="form-control" id="email_destinatario"
                            placeholder="ejemplo@correo.com" required>
                        <small class="text-muted">
                            <i class="bi bi-info-circle"></i> El recibo se enviará como archivo PDF adjunto.
                        </small>
                    </div>

                    <!-- Mensaje personalizado -->
                    <div class="mb-3">
                        <label for="mensaje_extra" class="form-label">
                            Mensaje Adicional (Opcional)
                        </label>
                        <textarea class="form-control" id="mensaje_extra" rows="4"
                            placeholder="Agregue un mensaje personalizado que se incluirá en el correo..."></textarea>
                        <small class="text-muted">
                            <i class="bi bi-info-circle"></i> Este mensaje aparecerá en el contenido del correo
                            electrónico.
                        </small>
                    </div>

                    <!-- Indicador de carga -->
                    <div id="loading_envio" class="text-center" style="display: none;">
                        <div class="spinner-border text-success" role="status">
                            <span class="visually-hidden">Enviando...</span>
                        </div>
                        <p class="mt-2 text-muted">Enviando correo electrónico...</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </button>
                    <button type="button" class="btn btn-success" id="btnConfirmarEnvio">
                        <i class="bi bi-send-fill"></i> Enviar Correo
                    </button>
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
                const btnPdfEnviar = document.getElementById('btnPdfEnviar');

                todasLasFilas.forEach(fila => {
                    const esFilaAcciones = fila.classList.contains('actions-row');

                    if (esFilaAcciones) {
                        fila.style.display = 'none';
                    } else {
                        const clienteCell = fila.querySelector('td:nth-child(4)');
                        const fechaCell = fila.querySelector('td:nth-child(3)');
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
                            estadoTexto.includes(textoBusqueda);

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

                const filasVisibles = todasLasFilas.filter(fila =>
                    !fila.classList.contains('actions-row') && fila.style.display !== 'none'
                );

                const mensajePrevio = tablaBody.querySelector('.no-results-message');
                if (mensajePrevio) {
                    mensajePrevio.remove();
                }

                let clientesUnicos = new Set();
                let clienteNombre = '';
                filasVisibles.forEach(fila => {
                    const clienteCell = fila.querySelector('td:nth-child(4)');
                    if (clienteCell) {
                        const cliente = clienteCell.textContent.trim();
                        clientesUnicos.add(cliente);
                        clienteNombre = cliente;
                    }
                });

                const unSoloCliente = textoBusqueda !== '' && clientesUnicos.size === 1 && filasVisibles.length > 0;

                if (unSoloCliente) {
                    btnPdfEnviar.disabled = false;
                    btnPdfEnviar.title =
                        `Vista previa PDF de ${clienteNombre} (${filasVisibles.length} factura${filasVisibles.length > 1 ? 's' : ''})`;
                    btnPdfEnviar.classList.remove('btn-secondary');
                    btnPdfEnviar.classList.add('btn-info');
                } else {
                    btnPdfEnviar.disabled = true;
                    if (textoBusqueda === '') {
                        btnPdfEnviar.title = 'Busca un cliente para previsualizar';
                    } else if (clientesUnicos.size > 1) {
                        btnPdfEnviar.title = 'Refina tu búsqueda (varios clientes encontrados)';
                    } else if (filasVisibles.length === 0) {
                        btnPdfEnviar.title = 'No hay resultados para mostrar';
                    }
                    btnPdfEnviar.classList.remove('btn-info');
                    btnPdfEnviar.classList.add('btn-secondary');
                }

                if (filasVisibles.length === 0 && (textoBusqueda !== '' || mesSeleccionado !== '')) {
                    const noResultsRow = document.createElement('tr');
                    noResultsRow.className = 'no-results-message';
                    noResultsRow.innerHTML = `
                        <td colspan="9" class="text-center text-muted py-4">
                            <i class="bi bi-search" style="font-size: 2rem;"></i>
                            <p class="mb-0 mt-2">No se encontraron resultados</p>
                        </td>
                    `;
                    tablaBody.appendChild(noResultsRow);
                }
            }

            // Inicializar filas y agregar event listeners
            guardarFilas();
            buscarCliente.addEventListener('input', aplicarFiltros);
            filtroMes.addEventListener('change', aplicarFiltros);

            // Manejar el botón de PDF para previsualización
            document.getElementById('btnPdfEnviar').addEventListener('click', function() {
                const textoBusqueda = buscarCliente.value.toLowerCase().trim();

                // Obtener las facturas visibles (filtradas)
                const filasVisibles = todasLasFilas.filter(fila => {
                    return !fila.classList.contains('actions-row') &&
                        fila.style.display !== 'none' &&
                        fila.querySelector(
                            '.toggle-actions'); // Asegurar que es una fila de factura
                });

                if (filasVisibles.length === 0) {
                    mostrarAlerta('warning', 'Atención', 'No hay facturas visibles para generar el PDF.');
                    return;
                }

                // Verificar que todas las facturas son del mismo cliente
                let clientesUnicos = new Set();
                let clienteId = null;

                filasVisibles.forEach(fila => {
                    const clienteCell = fila.querySelector(
                        'td:nth-child(4)'); // Columna 4 es el cliente
                    if (clienteCell) {
                        const nombreCliente = clienteCell.textContent.trim();
                        clientesUnicos.add(nombreCliente);
                    }

                    // Obtener el ID del cliente desde el atributo data-id-informacion
                    if (!clienteId) {
                        const toggleBtn = fila.querySelector('.toggle-actions');
                        if (toggleBtn) {
                            const idInfo = toggleBtn.getAttribute('data-id-informacion');
                            if (idInfo) {
                                clienteId = idInfo;
                            }
                        }
                    }
                });

                if (clientesUnicos.size > 1) {
                    mostrarAlerta('warning', 'Atención',
                        'Por favor, filtra para mostrar facturas de un solo cliente.');
                    return;
                }

                if (!clienteId) {
                    mostrarAlerta('error', 'Error', 'No se pudo obtener el ID del cliente.');
                    return;
                }

                // Generar URL con el ID del cliente
                const url = '{{ route('facturacion.recibo.pdf.cliente', ':clienteId') }}'.replace(
                    ':clienteId', clienteId);

                // Abrir en nueva pestaña
                window.open(url, '_blank');
            });

            // Manejar el cambio de color del select de estado según la opción seleccionada
            const selectEstado = document.getElementById('estado');

            function actualizarEstiloEstado() {
                const valor = selectEstado.value;

                // Remover todas las clases de color previas
                selectEstado.classList.remove('bg-warning', 'bg-success', 'bg-info', 'bg-secondary', 'text-dark',
                    'text-white');

                // Aplicar estilo según el valor seleccionado
                switch (valor) {
                    case 'no_cancelado':
                        selectEstado.classList.add('bg-warning', 'text-dark');
                        break;
                    case 'pago_efectivo':
                        selectEstado.classList.add('bg-success', 'text-white');
                        break;
                    case 'pago_deposito':
                        selectEstado.classList.add('bg-info', 'text-white');
                        break;
                    case 'pago_horas':
                        selectEstado.classList.add('bg-secondary', 'text-white');
                        break;
                    default:
                        // Estado por defecto (sin selección)
                        break;
                }
            }

            // Ejecutar al cambiar el valor
            selectEstado.addEventListener('change', actualizarEstiloEstado);

            // Ejecutar al cargar la página si hay un valor preseleccionado
            if (selectEstado.value) {
                actualizarEstiloEstado();
            }

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

            // Guardar el número de factura inicial
            const numeroFacturaInicial = '{{ $siguienteNumero }}';

            // Si hay errores, reabrir el modal
            @if ($errors->any() && old('n_factura'))
                var modalAgregar = new bootstrap.Modal(document.getElementById('modalAgregarRecibo'));
                modalAgregar.show();
            @endif

            // Resetear formulario al cerrar el modal
            var modalElement = document.getElementById('modalAgregarRecibo');
            modalElement.addEventListener('hidden.bs.modal', function() {
                // Solo resetear si no hay errores
                @if (!$errors->any())
                    document.getElementById('formAgregarFactura').reset();
                    // Resetear Select2
                    $('#id_informacion').val(null).trigger('change');
                    // Resetear estilos del select de estado
                    selectEstado.classList.remove('bg-warning', 'bg-success', 'bg-info', 'bg-secondary',
                        'text-dark', 'text-white');
                    // Restaurar el número de factura generado automáticamente
                    document.getElementById('n_factura').value = numeroFacturaInicial;
                    // Restaurar la fecha actual
                    document.getElementById('fecha').value = '{{ date('Y-m-d') }}';
                @endif
            });

            // Al abrir el modal, asegurar que tenga el número correcto
            modalElement.addEventListener('show.bs.modal', function() {
                // Solo si no hay errores de validación
                @if (!$errors->any())
                    if (!document.getElementById('n_factura').value) {
                        document.getElementById('n_factura').value = numeroFacturaInicial;
                    }
                @endif
            });

            // Manejar el modal de Ver Recibo
            var modalVerRecibo = document.getElementById('modalVerRecibo');
            modalVerRecibo.addEventListener('show.bs.modal', function(event) {
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

                // Actualizar el contenido del modal
                document.getElementById('ver_n_factura').textContent = numero;
                document.getElementById('ver_fecha').textContent = fecha;
                document.getElementById('ver_cliente').textContent = cliente;
                document.getElementById('ver_concepto').textContent = concepto;
                document.getElementById('ver_monto').textContent = monto;
                document.getElementById('ver_monto_total').textContent = monto;
                document.getElementById('ver_monto_literal').textContent = montoLiteral;

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
                var btnPDF = document.getElementById('btnDescargarPDF');
                btnPDF.href = '{{ url('/facturacion/recibos') }}/' + id + '/pdf';
            });

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
            var modalEliminarRecibo = document.getElementById('modalEliminarRecibo');
            modalEliminarRecibo.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;

                // Extraer datos
                var id = button.getAttribute('data-id');
                var numero = button.getAttribute('data-numero');

                // Actualizar el action del formulario de eliminación
                var form = document.getElementById('formEliminarFactura');
                form.action = '{{ url('/facturacion/recibos') }}/' + id;

                // Mostrar el número de factura en el modal
                document.getElementById('delete_n_factura').textContent = numero;
            });

            // Manejar el modal de Enviar Factura
            var modalEnviarFactura = document.getElementById('modalEnviarFactura');
            var facturaIdParaEnviar = null;

            modalEnviarFactura.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                facturaIdParaEnviar = button.getAttribute('data-id');

                // Limpiar los campos del formulario
                document.getElementById('email_destinatario').value = '';
                document.getElementById('mensaje_extra').value = '';

                // Ocultar indicador de carga
                document.getElementById('loading_envio').style.display = 'none';

                // Habilitar botón de envío
                document.getElementById('btnConfirmarEnvio').disabled = false;
            });

            // Manejar el envío del correo
            document.getElementById('btnConfirmarEnvio').addEventListener('click', function() {
                const emailDestinatario = document.getElementById('email_destinatario').value.trim();
                const mensajeExtra = document.getElementById('mensaje_extra').value.trim();

                // Validar que se haya ingresado un correo
                if (!emailDestinatario) {
                    mostrarAlerta('warning', 'Atención', 'Por favor, ingresa un correo electrónico.');
                    return;
                }

                // Validar formato de correo
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailDestinatario)) {
                    mostrarAlerta('error', 'Error', 'Por favor, ingresa un correo electrónico válido.');
                    return;
                }

                // Validar que haya una factura para enviar
                if (!facturaIdParaEnviar) {
                    mostrarAlerta('error', 'Error', 'No hay factura seleccionada para enviar.');
                    return;
                }

                // Mostrar indicador de carga
                document.getElementById('loading_envio').style.display = 'block';
                document.getElementById('btnConfirmarEnvio').disabled = true;

                // Envío individual
                const url = '{{ url('/facturacion/recibos') }}/' + facturaIdParaEnviar + '/enviar-correo';
                const bodyData = {
                    email: emailDestinatario,
                    mensaje: mensajeExtra
                };

                // Realizar la petición AJAX para enviar el correo
                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(bodyData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Ocultar indicador de carga
                        document.getElementById('loading_envio').style.display = 'none';
                        document.getElementById('btnConfirmarEnvio').disabled = false;

                        // Limpiar campos del formulario
                        document.getElementById('email_destinatario').value = '';
                        document.getElementById('mensaje_extra').value = '';
                        facturaIdParaEnviar = null;

                        // Esperar 2 segundos antes de cerrar modal y mostrar alerta
                        setTimeout(() => {
                            // Cerrar el modal
                            var modal = bootstrap.Modal.getInstance(modalEnviarFactura);
                            modal.hide();

                            // Esperar a que se cierre el modal antes de mostrar la alerta
                            setTimeout(() => {
                                if (data.success) {
                                    mostrarAlerta('success', '¡Éxito!',
                                        '✅ El correo se envió correctamente a: ' +
                                        emailDestinatario);
                                } else {
                                    mostrarAlerta('error', '¡Error!', '❌ ' + (data
                                        .message ||
                                        'No se pudo enviar el correo. Por favor, intenta nuevamente.'
                                    ));
                                }
                            }, 300);
                        }, 2000);
                    })
                    .catch(error => {
                        // Ocultar indicador de carga
                        document.getElementById('loading_envio').style.display = 'none';
                        document.getElementById('btnConfirmarEnvio').disabled = false;

                        // Cerrar el modal PRIMERO
                        var modal = bootstrap.Modal.getInstance(modalEnviarFactura);
                        modal.hide();

                        // Limpiar variable
                        facturaIdParaEnviar = null;

                        // DESPUÉS mostrar mensaje de error (esperar un poco para que el modal se cierre)
                        setTimeout(() => {
                            mostrarAlerta('error', '¡Error!',
                                '❌ No se pudo enviar el correo. Por favor, verifica tu conexión e intenta nuevamente.'
                            );
                        }, 300);
                        console.error('Error:', error);
                    });
            });
        });
    </script>
@endsection
