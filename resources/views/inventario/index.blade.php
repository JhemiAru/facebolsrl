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
            .card-header button[data-bs-target="#modalAgregarInventario"] {
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

            .card-header button[data-bs-target="#modalAgregarInventario"]::after {
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
        #tipo {
            font-weight: 500;
            transition: all 0.3s ease;
        }

        #tipo:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        #tipo option[value="compra"] {
            background-color: #fff3cd;
            color: #856404;
        }

        #tipo option[value="venta"] {
            background-color: #d4edda;
            color: #155724;
        }

        #tipo option[value="bono"] {
            background-color: #d1ecf1;
            color: #0c5460;
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
            <h1 class="mb-2">Gestión de Inventarios</h1>
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
                        <a href="{{ route('inventarios.pdf.todas') }}" class="btn btn-danger btn-sm"
                            title="Descargar TODOS los inventarios en PDF" target="_blank"
                            style="width: 36px; height: 36px; padding: 0; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-file-earmark-pdf-fill" style="font-size: 1.1rem;"></i>
                        </a>

                        <!-- Botón Nuevo Inventario (solo icono) -->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#modalAgregarInventario" title="Crear nuevo inventario"
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
                                    <th>N° Inventario</th>
                                    <th>Fecha</th>
                                    <th>cliente</th>
                                    <th>Cantidad</th>                             
                                    <th>Total</th>
                                    <th>Tipo</th>
                                    <th>Anulado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($inventarios as $index => $inventario)
                                    <tr>
                                        <td class="text-center">
                                            <div class="d-flex align-items-center justify-content-center gap-2">
                                                <button type="button" class="btn btn-sm btn-primary toggle-actions"
                                                    data-target="actions-{{ $inventario->id }}"
                                                    data-id-informacion="{{ $inventario->facturacion->id_informacion }}"
                                                    title="Mostrar acciones">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>

                                                <strong>{{ $inventarios->firstItem() + $index }}</strong>
                                            </div>
                                        </td>
                                        <td>
                                            <strong>{{ $inventario->n_inventario ?? 'N/A' }}</strong>
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($inventario->fecha_inve ?? now())->format('d/m/Y') }}
                                        </td>
                                         <td>
                                            @if ($inventario->facturacion->informacion)
                                                {{ $inventario->facturacion->informacion->nombre }}
                                                {{ $inventario->facturacion->informacion->apellido_paterno ?? '' }}
                                                {{ $inventario->facturacion->informacion->apellido_materno ?? '' }}
                                            @else
                                                <span class="text-muted">Sin cliente</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{ $inventario->cantidad }}
                                        </td>

                                        {{--<td>
                                            <ul class="mb-0">
                                                @foreach($inventario->concepto as $c)
                                                    <li>
                                                        <strong>{{ $c['concepto'] }}</strong>
                                                        ({{ $c['cantidad'] }} × {{ $c['precio_uni'] }})
                                                        = {{ $c['sub_total'] }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>

                                        <td class="text-end">
                                            Bs. {{ number_format($inventario->precio_uni, 2, ',', '.') }}
                                        </td>
                                        <td class="text-end">
                                            Bs. {{ number_format($inventario->sub_total, 2, ',', '.') }}
                                        </td>--}}
                                        <td class="text-end">
                                            <strong>Bs. {{ number_format($inventario->total, 2, ',', '.') }}</strong>
                                        </td>
                                        <td class="text-center">
                                            @if ($inventario->tipo === 'compra')
                                                <span class="badge bg-primary">
                                                    Compra
                                                </span>
                                            @elseif ($inventario->tipo === 'venta')
                                                <span class="badge bg-success">
                                                    Venta
                                                </span>
                                            @elseif ($inventario->tipo === 'bono')
                                                <span class="badge bg-info">
                                                    Bono
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">
                                                    Sin Estado
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($inventario->anulado)
                                                <span class="badge bg-danger">
                                                    Anulado
                                                </span>
                                            @else
                                                <span class="badge bg-success">
                                                    Activo
                                                </span>
                                            @endif
                                        </td>
                                     </tr>

                                     <tr id="actions-{{ $inventario->id }}" class="actions-row" style="display: none;">
                                        <td colspan="10" class="p-3" style="background: rgba(88, 166, 255, 0.05);">
                                          <div class="d-flex justify-content-center gap-2">
                                            <div class="btn-group" role="group">
                                               @php
                                                        // Si el campo concepto contiene JSON (varios conceptos), decodificarlo
                                                        $conceptos_json = [];
                                                        try {
                                                            $decoded = json_decode($inventario->concepto, true);
                                                            if (is_array($decoded)) {
                                                                foreach ($decoded as $c) {
                                                                    $conceptos_json[] = [
                                                                        'concepto' => $c['concepto'] ?? ($inventario->concepto ?? ''),
                                                                        'fecha_concepto' => $c['fecha_concepto'] ?? ($inventario->fecha_inve ?? ''),
                                                                        'monto' => $c['sub_total'] ?? ($inventario->sub_total ?? 0)
                                                                    ];
                                                                }
                                                            } else {
                                                                // Fallback: buscar filas antiguas con el mismo n_inventario
                                                                $rows = \App\Models\Inventario::where('n_inventario', $inventario->n_inventario)->orderBy('id')->get();
                                                                foreach ($rows as $c) {
                                                                    $conceptos_json[] = [
                                                                        'concepto' => $c->concepto,
                                                                        'fecha_concepto' => $c->fecha_inve,
                                                                        'monto' => $c->sub_total
                                                                    ];
                                                                }
                                                            }
                                                        } catch (\Exception $e) {
                                                            $conceptos_json = [];
                                                        }
                                                @endphp

                                                <!-- Ver -->
                                                <button type="button" class="btn btn-info btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#modalVerInventario"
                                                    data-id="{{ $inventario->id }}"
                                                    data-numero="{{ $inventario->n_inventario ?? 'N/A' }}"
                                                    data-fecha_inve="{{ $inventario->fecha_inve ? \Carbon\Carbon::parse($inventario->fecha_inve)->format('d/m/Y') : 'N/A' }}"
                                                    data-id_facturacion="{{ $inventario->id_facturacion }}"
                                                    data-cantidad="{{ $inventario->cantidad }}"
                                                    data-concepto="{{ $inventario->concepto }}"
                                                    data-conceptos='@json($conceptos_json)'
                                                    data-precio_uni="{{ $inventario->precio_uni }}"
                                                    data-sub_total="{{ $inventario->sub_total }}"
                                                    data-total="{{ $inventario->total }}"
                                                    data-tipo="{{ $inventario->tipo }}"
                                                    data-cliente-nombre="{{ $inventario->facturacion && $inventario->facturacion->informacion ? $inventario->facturacion->informacion->nombre . ' ' . ($inventario->facturacion->informacion->apellido_paterno ?? '') . ' ' . ($inventario->facturacion->informacion->apellido_materno ?? '') : 'Sin cliente' }}"
                                                    data-ci-nit="{{ $inventario->facturacion->ci_nit ?? '' }}"
                                                    title="Ver detalles">
                                                    <i class="bi bi-eye"></i> Ver
                                                </button>

                                                <!-- Editar -->
                                                <button type="button" class="btn btn-warning btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#modalEditarInventario"
                                                    data-id="{{ $inventario->id }}"
                                                    data-numero="{{ $inventario->n_inventario }}"
                                                    data-fecha_inve="{{ $inventario->fecha_inve }}"
                                                    data-id_facturacion="{{ $inventario->id_facturacion }}"
                                                    data-cantidad="{{ $inventario->cantidad }}"
                                                    data-concepto="{{ $inventario->concepto }}"
                                                    data-conceptos='@json($conceptos_json)'
                                                    data-precio_uni="{{ $inventario->precio_uni }}"
                                                    data-sub_total="{{ $inventario->sub_total }}"
                                                    data-total="{{ $inventario->total }}"
                                                    data-tipo="{{ $inventario->tipo }}"
                                                    data-anulado="{{ $inventario->anulado ?? 0 }}"
                                                    data-cliente-nombre="{{ $inventario->facturacion && $inventario->facturacion->informacion ? $inventario->facturacion->informacion->nombre . ' ' . ($inventario->facturacion->informacion->apellido_paterno ?? '') . ' ' . ($inventario->facturacion->informacion->apellido_materno ?? '') : 'Sin cliente' }}"
                                                    data-ci-nit="{{ $inventario->facturacion->ci_nit ?? '' }}"
                                                    title="Editar">
                                                    <i class="bi bi-pencil"></i> Editar
                                                </button>
                                                <!-- Botón PDF -->
                                                    <a href="{{ route('inventarios.pdf', $inventario->id) }}"
                                                        target="_blank" class="btn btn-danger btn-sm"
                                                        title="Generar PDF">
                                                        <i class="bi bi-file-pdf"></i> PDF
                                                    </a>

                                                <!-- Eliminar -->
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#modalEliminarInventario"
                                                    data-url="{{ route('inventarios.destroy', $inventario->id) }}"
                                                    data-numero="{{ $inventario->n_inventario }}"
                                                    title="Eliminar inventario">
                                                    <i class="bi bi-trash"></i> Eliminar
                                                </button>
                                              </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            <div class="alert alert-info mb-0">
                                                <i class="bi bi-info-circle"></i> <br>No hay inventarios registrados
                                            </div>    
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación Mejorada -->
                    <div class="pagination-wrapper">
                        @if ($inventarios->total() > 0)
                            <div class="pagination-info">
                                <i class="bi bi-info-circle me-2"></i>
                                Mostrando
                                <strong>{{ $inventarios->firstItem() }}</strong>
                                a
                                <strong>{{ $inventarios->lastItem() }}</strong>
                                de
                                <strong>{{ $inventarios->total() }}</strong>
                                inventarios
                            </div>
                        @endif

                        <div class="d-flex justify-content-center align-items-center">
                            {{ $inventarios->links('vendor.pagination.custom') }}
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

    <!-- Modal Agregar Inventario -->
    @include('inventario.agregar-modal')

    <!-- Modal Editar Inventario -->
    @include('inventario.editar-modal')

    <!-- Modal Ver Inventario -->
    @include('inventario.ver-modal')

    <!-- Modal Eliminar Inventario -->
    <div class="modal fade" id="modalEliminarInventario" tabindex="-1" aria-labelledby="modalEliminarInventarioLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalEliminarInventarioLabel">
                        <i class="bi bi-exclamation-triangle"></i> Confirmar Eliminación
                    </h5>
                    <button type="button" class="btn-close btn-close-white"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <i class="bi bi-exclamation-circle text-danger" style="font-size: 4rem;"></i>
                    </div>
                    <h5 class="text-center mb-3"> ¿Está seguro de eliminar este inventario?</h5>
                    <p class="text-center">
                        <strong>Inventario N°:<span id="delete_n_inventario"></span></strong>
                    </p>
                    <div class="alert alert-warning" role="alert">
                        <i class="bi bi-info-circle"></i> Esta acción no se puede deshacer.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </button>
                    <form action="" method="POST" id="formEliminarInventario" style="display: inline;">
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

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* =========================================================
       FILTROS (BUSCAR + MES)
    ========================================================= */

    const buscarCliente = document.getElementById('buscar_cliente');
    const filtroMes = document.getElementById('filtro_mes');
    const tablaBody = document.querySelector('.table tbody');
    const btnPdfEnviar = document.getElementById('btnPdfEnviar');

    let todasLasFilas = [];

    if (tablaBody) {
        todasLasFilas = Array.from(tablaBody.querySelectorAll('tr'));
    }

    function aplicarFiltros() {
        if (!tablaBody) return;

        const textoBusqueda = buscarCliente ? buscarCliente.value.toLowerCase().trim() : '';
        const mesSeleccionado = filtroMes ? filtroMes.value : '';

        let filasVisibles = [];

        todasLasFilas.forEach(fila => {

            if (fila.classList.contains('actions-row')) {
                fila.style.display = 'none';
                return;
            }

            const clienteCell = fila.querySelector('td:nth-child(4)');
            const fechaCell = fila.querySelector('td:nth-child(3)');
            const numeroCell = fila.querySelector('td:nth-child(2)');
            const tipoCell = fila.querySelector('td:nth-child(7)');

            const clienteTexto = clienteCell ? clienteCell.textContent.toLowerCase() : '';
            const fechaTexto = fechaCell ? fechaCell.textContent.trim() : '';
            const numeroTexto = numeroCell ? numeroCell.textContent.toLowerCase() : '';
            const tipoTexto = tipoCell ? tipoCell.textContent.toLowerCase() : '';

            const coincideTexto = textoBusqueda === '' ||
                clienteTexto.includes(textoBusqueda) ||
                numeroTexto.includes(textoBusqueda) ||
                tipoTexto.includes(textoBusqueda);

            let coincideMes = true;
            if (mesSeleccionado !== '') {
                const fechaParts = fechaTexto.split('/');
                coincideMes = fechaParts.length === 3 && fechaParts[1] === mesSeleccionado;
            }

            const visible = coincideTexto && coincideMes;
            fila.style.display = visible ? '' : 'none';

            if (visible) filasVisibles.push(fila);
        });

        /* =========================================================
            VALIDAR CLIENTE ÚNICO PARA PDF
        ========================================================= */

        if (!btnPdfEnviar) return;

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

        const unSoloCliente =
            textoBusqueda !== '' &&
            clientesUnicos.size === 1 &&
            filasVisibles.length > 0;

        btnPdfEnviar.disabled = !unSoloCliente;

        btnPdfEnviar.title = unSoloCliente
            ? `Generar PDF de ${clienteNombre} (${filasVisibles.length} registros)`
            : 'Filtra por un solo cliente para generar PDF';
    }

    if (buscarCliente) buscarCliente.addEventListener('input', aplicarFiltros);
    if (filtroMes) filtroMes.addEventListener('change', aplicarFiltros);


    /* =========================================================
      Manejar el cambio de color del select de estado según la opción seleccionad
    ========================================================= */
        const selectTipo = document.getElementById('tipo');

        function actualizarEstiloTipo() {
            const valor = selectTipo.value;

            // Quitar clases previas
            selectTipo.classList.remove(
                'bg-primary',
                'bg-success',
                'bg-info',
                'bg-secondary',
                'text-white'
            );

            switch (valor) {
                case 'compra':
                    selectTipo.classList.add('bg-primary', 'text-white');
                    break;
                case 'venta':
                    selectTipo.classList.add('bg-success', 'text-white');
                    break;
                case 'bono':
                    selectTipo.classList.add('bg-info', 'text-white');
                    break;
                default:
                    selectTipo.classList.add('bg-secondary', 'text-white');
                    break;
            }
        }

        if (selectTipo) {
            selectTipo.addEventListener('change', actualizarEstiloTipo);

            if (selectTipo.value) {
                actualizarEstiloTipo();
            }
        }

    /* =========================================================
       TOGGLE DE FILAS (VERSIÓN SEGURA)
    ========================================================= */

    document.addEventListener('click', function (e) {

        const button = e.target.closest('.toggle-actions');
        if (!button) return;

        const targetId = button.getAttribute('data-target');
        const targetRow = document.getElementById(targetId);
        if (!targetRow) return;

        const icon = button.querySelector('i');
        const isHidden = window.getComputedStyle(targetRow).display === 'none';

        if (isHidden) {
            targetRow.style.display = 'table-row';
            if (icon) icon.classList.replace('bi-plus-lg', 'bi-dash-lg');
            button.classList.replace('btn-primary', 'btn-danger');
            button.title = 'Ocultar acciones';
        } else {
            targetRow.style.display = 'none';
            if (icon) icon.classList.replace('bi-dash-lg', 'bi-plus-lg');
            button.classList.replace('btn-danger', 'btn-primary');
            button.title = 'Mostrar acciones';
        }

    });

    /* =========================================================
       MODAL VER INVENTARIO
    ========================================================= */

    const modalVer = document.getElementById('modalVerInventario');

    if (modalVer) {
        modalVer.addEventListener('show.bs.modal', function (event) {

            const button = event.relatedTarget;
            if (!button) return;

            document.getElementById('ver_n_inventario').textContent = button.getAttribute('data-numero') || '';
            document.getElementById('ver_fecha_inve').textContent = button.getAttribute('data-fecha_inve') || '';
            document.getElementById('ver_concepto').textContent = button.getAttribute('data-concepto') || '';
            document.getElementById('ver_cantidad').textContent = button.getAttribute('data-cantidad') || '';
            document.getElementById('ver_precio_uni').textContent = button.getAttribute('data-precio_uni') || '';
            document.getElementById('ver_sub_total').textContent = button.getAttribute('data-sub_total') || '';
            document.getElementById('ver_total').textContent = button.getAttribute('data-total') || '';
            document.getElementById('ver_tipo').textContent = button.getAttribute('data-tipo') || '';

            const tipo = button.getAttribute('data-tipo') || '';
                var tipoBadge = document.getElementById('ver_tipo');
                tipoBadge.className = 'badge'; // Resetear clases

                switch (tipo) {
                    case 'compra':
                        tipoBadge.textContent = 'Compra';
                        tipoBadge.classList.add('bg-primary');
                        break;

                    case 'venta':
                        tipoBadge.textContent = 'Venta';
                        tipoBadge.classList.add('bg-success');
                        break;

                    case 'bono':
                        tipoBadge.textContent = 'Bono';
                        tipoBadge.classList.add('bg-warning', 'text-dark');
                        break;

                    default:
                        tipoBadge.textContent = 'Sin Tipo';
                        tipoBadge.classList.add('bg-secondary');
                }


            const id = button.getAttribute('data-id');
            const btnPDF = document.getElementById('btnDescargarPDF');
            if (btnPDF && id) {
                btnPDF.href = `/inventario/${id}/pdf`;
            }
        });
    }

    /* =========================================================
       MODAL ELIMINAR
    ========================================================= */

   const modalEliminar = document.getElementById('modalEliminarInventario');

    if (modalEliminar) {
        modalEliminar.addEventListener('show.bs.modal', function (event) {

            const button = event.relatedTarget;
            if (!button) return;

            const url = button.getAttribute('data-url');
            const numero = button.getAttribute('data-numero');

            const form = document.getElementById('formEliminarInventario');
            if (form && url) {
                form.action = url;
            }

            const spanNumero = document.getElementById('delete_n_inventario');
            if (spanNumero) spanNumero.textContent = numero || '';
        });
    }
    /* =========================================================
       MODAL ENVIAR CORREO
    ========================================================= */

    const modalEnviar = document.getElementById('modalEnviarInventario');
    const btnConfirmarEnvio = document.getElementById('btnConfirmarEnvio');
    let facturaId = null;

    if (modalEnviar) {
        modalEnviar.addEventListener('show.bs.modal', function (event) {

            const button = event.relatedTarget;
            if (!button) return;

            facturaId = button.getAttribute('data-id');
            document.getElementById('email_destinatario').value = '';
            document.getElementById('mensaje_extra').value = '';
        });
    }

    if (btnConfirmarEnvio) {
        btnConfirmarEnvio.addEventListener('click', function () {

            const email = document.getElementById('email_destinatario').value.trim();
            const mensaje = document.getElementById('mensaje_extra').value.trim();

            if (!email) {
                alert('Ingresa un correo.');
                return;
            }

            if (!facturaId) {
                alert('No hay inventario seleccionado.');
                return;
            }

            fetch(`/inventario/${facturaId}/enviar-correo`, {
                method: 'POST',
                headers: {  
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email, mensaje })
            })
            .then(res => res.json())
            .then(data => {
                alert(data.success ? 'Correo enviado correctamente.' : 'No se pudo enviar.');
                const modalInstance = bootstrap.Modal.getInstance(modalEnviar);
                if (modalInstance) modalInstance.hide();
            })
            .catch(() => alert('Error al enviar.'));
        });
    }
        /* =========================================================
       PDF AGRUPADO POR CLIENTE
    ========================================================= */

    if (btnPdfEnviar) {
        btnPdfEnviar.addEventListener('click', function () {

            let filasVisibles = todasLasFilas.filter(f =>
                !f.classList.contains('actions-row') &&
                f.style.display !== 'none'
            );

            let clienteId = null;
            let clientesUnicos = new Set();

            filasVisibles.forEach(fila => {
                const clienteCell = fila.querySelector('td:nth-child(4)');
                if (clienteCell) {
                    clientesUnicos.add(clienteCell.textContent.trim());
                }

                if (!clienteId) {
                    const btnToggle = fila.querySelector('.toggle-actions');
                    if (btnToggle) {
                        clienteId = btnToggle.getAttribute('data-id-informacion');
                    }
                }
            });

            if (clientesUnicos.size !== 1 || !clienteId) {
                alert('Selecciona un solo cliente válido.');
                return;
            }

            window.open(`/inventario/pdf/cliente/${clienteId}`, '_blank');
        });
    }

});
</script>
@endsection
