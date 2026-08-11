@php
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\Auth;
@endphp
@extends('layouts.admin')

@section('content')
    <style>
        /* ===== RESET Y CONFIGURACIÓN BASE ===== */
        /* Estilos base para toda la página */
        body {
            background: #0f2027;
            /* Fondo oscuro sólido para mejor rendimiento */
            color: #f1f5f9;
            /* Texto principal en blanco suave */
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            margin: 0;
            /* Eliminar márgenes por defecto */
            padding: 0;
            /* Eliminar padding por defecto */
        }

        /* ===== CONTENEDOR PRINCIPAL ===== */
        /* Ocupa todo el ancho disponible */
        .content {
            width: 100%;
            /* Ocupar 100% del ancho */
            max-width: 100%;
            /* Evitar límites de ancho */
            margin: 0;
            /* Sin márgenes */
            padding: 15px;
            /* Padding reducido pero suficiente */
            box-sizing: border-box;
            /* Incluir padding en el ancho total */
        }

        /* ===== TÍTULO PRINCIPAL ===== */
        .text-center h1 {
            color: #58a6ff;
            /* Azul brillante para el título */
            font-size: 2.2rem;
            /* Tamaño responsive */
            font-weight: 800;
            margin-bottom: 20px;
            padding: 15px 0;
            text-align: center;
            width: 100%;
            /* Ocupar todo el ancho */
        }

        /* ===== TARJETAS PRINCIPALES ===== */
        .card {
            background: rgba(20, 25, 35, 0.95);
            /* Fondo semi-transparente oscuro */
            border: 1px solid rgba(88, 166, 255, 0.2);
            /* Borde azul sutil */
            border-radius: 12px;
            /* Esquinas redondeadas */
            margin-bottom: 15px;
            width: 100%;
            /* Ocupar todo el ancho disponible */
            box-sizing: border-box;
            /* Incluir bordes en el ancho */
        }

        /* ===== CABECERA DE TARJETA ===== */
        .card-header {
            background: #1a365d !important;
            /* Azul oscuro para la cabecera */
            border-bottom: 1px solid rgba(88, 166, 255, 0.3);
            /* Línea separadora */
            padding: 15px 20px;
            /* Padding interno */
            width: 100%;
            /* Ancho completo */
            box-sizing: border-box;
        }

        .card-header h3 {
            font-size: 1.4rem;
            /* Tamaño responsive */
            font-weight: 700;
            color: #58a6ff;
            /* Azul brillante */
            margin: 0;
        }

        /* ===== BOTONES PRINCIPALES ===== */
        .btn-primary {
            background: #238636;
            /* Verde principal */
            border: none;
            border-radius: 6px;
            /* Esquinas menos redondeadas */
            padding: 8px 16px;
            /* Padding compacto */
            font-weight: 600;
            transition: all 0.2s ease;
            /* Transición suave */
            margin: 2px;
            /* Espaciado entre botones */
        }

        .btn-primary:hover {
            background: #2ea043;
            /* Verde más claro al hover */
            transform: translateY(-1px);
            /* Efecto de elevación */
        }

        /* Botones secundarios con colores diferentes */
        .btn-warning {
            background: #f59e0b;
        }

        /* Amarillo/naranja */
        .btn-info {
            background: #0ea5e9;
        }

        /* Azul claro */
        .btn-success {
            background: #10b981;
        }

        /* Verde éxito */

        .btn-warning:hover {
            background: #fbbf24;
        }

        .btn-info:hover {
            background: #38bdf8;
        }

        .btn-success:hover {
            background: #34d399;
        }

        /* ===== TABLAS PRINCIPALES ===== */
        .table {
            background: transparent !important;
            /* Fondo transparente */
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            width: 100% !important;
            /* Forzar ancho completo */
        }

        /* Cabecera de tabla */
        .table thead th {
            background: #1a365d !important;
            /* Mismo azul que las cabeceras de card */
            color: #58a6ff !important;
            /* Texto azul */
            font-weight: 700;
            border: none;
            padding: 10px 8px;
            /* Padding compacto */
            text-align: center;
            font-size: 0.85rem;
            /* Texto más pequeño */
        }

        /* Celdas de tabla - TRANSPARENTES */
        .table tbody td {
            background: transparent !important;
            /* Fondo completamente transparente */
            color: #e2e8f0 !important;
            /* Texto blanco grisáceo */
            border-color: rgba(255, 255, 255, 0.05) !important;
            /* Bordes muy sutiles */
            padding: 8px 6px;
            /* Padding reducido */
            vertical-align: middle;
        }

        /* Efecto hover en filas */
        .table tbody tr:hover td {
            background: rgba(88, 166, 255, 0.1) !important;
            /* Azul muy tenue al hover */
        }

        /* ===== BADGES/ETIQUETAS ===== */
        .badge {
            font-weight: 600;
            padding: 4px 8px;
            /* Compacto */
            border-radius: 4px;
            /* Esquinas suaves */
            font-size: 0.8rem;
            /* Texto pequeño */
        }

        /* Colores para diferentes estados */
        .bg-primary {
            background: #3b82f6 !important;
        }

        /* Azul */
        .bg-success {
            background: #10b981 !important;
        }

        /* Verde */
        .bg-warning {
            background: #f59e0b !important;
        }

        /* Amarillo */
        .bg-danger {
            background: #ef4444 !important;
        }

        /* Rojo */
        .bg-secondary {
            background: #6b7280 !important;
        }

        /* Gris */
        .bg-info {
            background: #06b6d4 !important;
        }

        /* Azul claro */

        /* ===== GRUPOS DE BOTONES ===== */
        .btn-group .btn {
            border-radius: 4px;
            margin: 1px;
            /* Espaciado mínimo */
            border: none;
            font-weight: 600;
            padding: 6px 10px;
            /* Botones pequeños */
            font-size: 0.8rem;
            /* Iconos más pequeños */
        }

        /* ===== CONTENEDORES DE HORAS ===== */
        .hora-laboral,
        .hora-academica {
            padding: 10px;
            border-radius: 6px;
            text-align: center;
            margin: 5px 0;
            border: 1px solid transparent;
        }

        .hora-laboral {
            background: rgba(0, 123, 255, 0.1);
            /* Azul muy tenue */
            color: #007bff;
            border-color: #007bff;
        }

        .hora-academica {
            background: rgba(40, 167, 69, 0.1);
            /* Verde muy tenue */
            color: #28a745;
            border-color: #28a745;
        }

        /* ===== DATATABLES PERSONALIZACIÓN ===== */
        /* Textos en blanco para mejor contraste */
        .dataTables_length,
        .dataTables_filter,
        .dataTables_info,
        .dataTables_paginate {
            color: #ffffff !important;
        }

        .dataTables_length label,
        .dataTables_filter label {
            color: #ffffff !important;
            font-size: 0.9rem;
        }

        /* Campos de entrada de DataTables */
        .dataTables_length select,
        .dataTables_filter input {
            background: rgba(255, 255, 255, 0.1) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            border-radius: 4px;
            color: #ffffff !important;
            padding: 4px 8px;
            font-size: 0.85rem;
        }

        .dataTables_filter input:focus,
        .dataTables_length select:focus {
            border-color: #58a6ff !important;
            outline: none;
        }

        /* Botones de paginación */
        .paginate_button {
            background: rgba(255, 255, 255, 0.1) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            color: #ffffff !important;
            border-radius: 4px;
            margin: 1px;
            padding: 4px 8px;
            font-size: 0.8rem;
        }

        .paginate_button:hover {
            background: rgba(88, 166, 255, 0.3) !important;
            border-color: #58a6ff !important;
        }

        .paginate_button.current {
            background: #58a6ff !important;
            border-color: #58a6ff !important;
            color: #000000 !important;
            font-weight: 600;
        }

        /* ===== BOTÓN GLOWING (ESPECIAL) ===== */
        .glowing-button {
            display: inline-block;
            padding: 8px 16px;
            font-size: 0.9rem;
            font-weight: bold;
            text-decoration: none;
            text-align: center;
            border-radius: 6px;
            color: #fff;
            background: #3a6896;
            border: none;
            transition: all 0.2s ease;
        }

        .glowing-button:hover {
            background: #1f4b77;
            transform: translateY(-1px);
        }

        /* ===== MODALES ===== */
        .modal-content {
            background: rgba(20, 25, 35, 0.98);
            border: 1px solid rgba(88, 166, 255, 0.3);
            border-radius: 12px;
            width: 100%;
            /* Modales responsivos */
        }

        .modal-header {
            background: #1a365d !important;
            border-bottom: 1px solid rgba(88, 166, 255, 0.3);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .content {
                padding: 10px;
                /* Menos padding en móviles */
            }

            .text-center h1 {
                font-size: 1.8rem;
                /* Título más pequeño */
            }

            .card-header h3 {
                font-size: 1.2rem;
                /* Cabecera más pequeña */
            }

            .btn {
                width: 100%;
                /* Botones de ancho completo en móviles */
                margin-bottom: 5px;
                font-size: 0.8rem;
                /* Texto más pequeño */
            }

            .btn-group {
                display: flex;
                flex-direction: column;
                /* Botones en columna */
            }

            .btn-group .btn {
                margin: 1px 0;
                /* Espaciado vertical */
            }

            .table thead th,
            .table tbody td {
                padding: 6px 4px;
                /* Menos padding en móviles */
                font-size: 0.75rem;
                /* Texto más pequeño */
            }
        }

        /* ===== UTILIDADES ===== */
        /* Asegurar que todos los elementos usen box-sizing border-box */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        /* Contenedor responsive para tablas */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            /* Scroll horizontal si es necesario */
        }
        /* ===== ESTILOS DEL CALENDARIO ===== */
.calendario-container {
    background: rgba(20, 25, 35, 0.95);
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 20px;
    border: 1px solid rgba(88, 166, 255, 0.2);
}

.calendario-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding: 10px;
    background: #1a365d;
    border-radius: 8px;
}

.calendario-header button {
    background: #238636;
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    color: white;
    cursor: pointer;
    transition: all 0.2s ease;
}

.calendario-header button:hover {
    background: #2ea043;
    transform: translateY(-1px);
}

.calendario-mes-titulo {
    font-size: 1.5rem;
    font-weight: bold;
    color: #58a6ff;
}

.calendario-dias-semana {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 5px;
    margin-bottom: 10px;
}

.calendario-dia-nombre {
    text-align: center;
    padding: 10px;
    font-weight: bold;
    background: #1a365d;
    border-radius: 6px;
    color: #58a6ff;
}

.calendario-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 5px;
}

.calendario-dia {
    aspect-ratio: 1;
    padding: 10px;
    background: rgba(30, 35, 45, 0.8);
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s ease;
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 80px;
}

.calendario-dia:hover {
    transform: scale(1.02);
    background: rgba(88, 166, 255, 0.2);
}

.calendario-dia-numero {
    font-size: 1.2rem;
    font-weight: bold;
    margin-bottom: 5px;
}

.calendario-dia-otro-mes {
    opacity: 0.4;
}

/* Estados de asistencia */
.calendario-dia-presente {
    background: rgba(16, 185, 129, 0.2);
    border: 1px solid #10b981;
}

.calendario-dia-presente .calendario-dia-numero {
    color: #10b981;
}

.calendario-dia-falta {
    background: rgba(239, 68, 68, 0.2);
    border: 1px solid #ef4444;
}

.calendario-dia-falta .calendario-dia-numero {
    color: #ef4444;
}

.calendario-dia-permiso {
    background: rgba(245, 158, 11, 0.2);
    border: 1px solid #f59e0b;
}

.calendario-dia-permiso .calendario-dia-numero {
    color: #f59e0b;
}

.calendario-dia-retraso {
    background: rgba(59, 130, 246, 0.2);
    border: 1px solid #3b82f6;
}

.calendario-dia-retraso .calendario-dia-numero {
    color: #3b82f6;
}

/* Indicadores */
.calendario-indicador {
    font-size: 0.7rem;
    margin-top: 4px;
    padding: 2px 4px;
    border-radius: 4px;
    background: rgba(0, 0, 0, 0.5);
}

.calendario-leyenda {
    display: flex;
    gap: 20px;
    margin-top: 20px;
    padding: 10px;
    justify-content: center;
    flex-wrap: wrap;
}

.leyenda-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.85rem;
}

.leyenda-color {
    width: 20px;
    height: 20px;
    border-radius: 4px;
}

/* Tooltip para dias */
.calendario-dia-tooltip {
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    background: #1a365d;
    color: white;
    padding: 5px 10px;
    border-radius: 6px;
    font-size: 0.75rem;
    white-space: nowrap;
    z-index: 10;
    pointer-events: none;
    display: none;
}

    .calendario-dia:hover .calendario-dia-tooltip {
        display: block;
    }

    @media (max-width: 768px) {
        .calendario-dia {
            min-height: 60px;
            font-size: 0.75rem;
        }
    
        .calendario-dia-numero {
            font-size: 0.9rem;
        }
    
        .calendario-indicador {
         font-size: 0.6rem;
        }
    }
    </style>

    <!-- ===== CONTENIDO PRINCIPAL ===== -->
    <div class="content">
        <h1 class="text-center" style="color: black;"><b>Bienvenido a la Planilla de Asistencias</b></h1>

        <!-- ===== ALERTA SWEETALERT ===== -->
        @if ($message = Session::get('mensaje'))
            <script>
                Swal.fire({
                    title: "Buen trabajo!",
                    text: "{{ $message }}",
                    icon: "success",
                    background: '#1a365d',
                    color: '#ffffff',
                    confirmButtonColor: '#58a6ff'
                });
            </script>
        @endif

        <!-- ===== SECCIÓN PRINCIPAL ===== -->
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="table-responsive">
                        <div class="card-header">
                            <!-- ===== TABLA INFORMACIÓN PERSONAL ===== -->
                            <table class="table table-bordered table-striped table-m text-center">
                                <thead class="thead-custom">
                                    <tr>
                                        <th scope="row">Nombre del Pasante</th>
                                        <th scope="row">Codigo de Credencial</th>
                                        <th scope="row">Codigo de Serie</th>
                                        <th scope="row">Total Horas Laborales</th>
                                        {{-- <th scope="row">Total Horas Académicas</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <!-- Información del pasante -->
                                        <td scope="row">
                                            {{ $inscripcions->informacion->nombre }}
                                            {{ $inscripcions->informacion->apellido_paterno }}
                                            {{ $inscripcions->informacion->apellido_materno }}
                                        </td>

                                        <td scope="row">{{ $inscripcions->codigo_credencial }}</td>

                                        <!-- Lista de series de tarjetas -->
                                        <td scope="row">
                                            @foreach ($inscripcions->tarjetas as $tarjeta)
                                                {{ $tarjeta->serie }}<br>
                                            @endforeach
                                        </td>

                                        <!-- Total Horas Laborales -->
                                        <td scope="row">
                                            <div class="hora-laboral">
                                                <h4 id="globalTotalHorasLaborales"
                                                    data-base="{{ $horaacumulada->total_horas ?? '00:00:00' }}">
                                                    {{ isset($totalHora) && $totalHora->total_horas ? $totalHora->total_horas : $horaacumulada->total_horas ?? '00:00:00' }}
                                                </h4>
                                                <small id="globalDetalleHorasLaborales">
                                                    {{ $horaacumulada->detalle_horas_laborales ?? '' }}
                                                    @if (isset($totalHora) && ($totalHora->asistencias_extras > 0 || $totalHora->horas_descuento > 0))
                                                        | Extras: {{ $totalHora->asistencias_extras ?? 0 }} | Descuento:
                                                        {{ $totalHora->horas_descuento ?? 0 }}h
                                                    @endif
                                                </small>
                                            </div>
                                        </td>

                                        <!-- Total Horas Académicas -->
                                        {{-- <td scope="row">
                                        <div class="hora-academica">
                                            <h4 id="globalTotalHorasAcademicas"
                                                data-base="{{ $horaResultado->horas_academicas ?? '00:00:00' }}">
                                                {{ isset($totalHora) && $totalHora->horas_academicas ? $totalHora->horas_academicas : ($horaResultado->horas_academicas ?? '00:00:00') }}
                                            </h4>
                                            <small id="globalDetalleHorasAcademicas">
                                                {{ $horaResultado->detalle_horas_academicas ?? '' }}
                                                @if (isset($totalHora) && ($totalHora->asistencias_extras > 0 || $totalHora->horas_descuento > 0))
                                                    | Extras: {{ $totalHora->asistencias_extras ?? 0 }} | Descuento: {{ $totalHora->horas_descuento ?? 0 }}h
                                                @endif
                                            </small>
                                        </div>
                                    </td> --}}
                                    </tr>
                                </tbody>
                            </table>

                            <!-- ===== BOTONES DE ACCIÓN ===== -->
                            <div class="card-tools">
                                {{-- <a href="{{ url('/asistencias/pdf') }}" class="btn btn-warning" target="_blank">
                                <i class="bi bi-printer-fill"></i> Imprimir Reporte
                            </a> --}}

                                <a href="{{ route('asistencias.pdf', $inscripcions->id) }}" class="btn btn-warning"
                                    target="_blank">
                                    <i class="bi bi-printer-fill"></i> Imprimir Reporte Asistencia
                                </a>



                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                    data-bs-target="#detalleAsistenciasModal">
                                    <i class="bi bi-emoji-smile-upside-down-fill"></i> Detalle de Asistencias
                                </button>

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#dataModal">
                                    <i class="bi bi-check-circle"></i> Registre su Informe de Semanal
                                </button>

                                <!-- Botones condicionales por permisos -->
                                @can('asistencia')
                                    <a href="{{ route('asistencias.crearFields', $inscripcions->id) }}" type="button"
                                        class="btn btn-success"><i class="bi bi-check-circle"></i> Registrar Asistencia</a>
                                @endcan

                                @can('asistencia')
                                    <a href="{{ url('/asistencias') }}" class="btn btn-info btn-custom glowing-button">
                                        <i class="bi bi-file-plus"></i> Volver
                                    </a>
                                @endcan
                            </div>
                        </div>

                        <!-- ===== TABLA PRINCIPAL DE ASISTENCIAS ===== -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-m">
                                <thead>
                                    <tr>
                                        <th>Nro</th>
                                        <th>Dia</th>
                                        <th>Fecha</th>
                                        <th>Hora de Llegada</th>
                                        <th>Hora de Salida</th>
                                        <th>Horas</th>
                                        <th>Turno</th>
                                        <th>Tipo de Asistencia</th>
                                        <th>Atrasos</th>
                                        <th>Actividades</th>
                                        <th>Estado D/C</th>
                                        @can('asistencia')
                                            <th>Accion</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $contador = 0; ?>
                                    @foreach ($asistencias as $asistencia)
                                        <tr>
                                            <td><?php echo $contador = $contador + 1; ?></td>
                                            <td>{{ $asistencia->fecha->translatedFormat('l') }}</td>
                                            <td data-order="{{ $asistencia->fecha->format('Y-m-d') }}">
                                                {{ $asistencia->fecha->translatedFormat('d-m-Y') }}
                                            </td>
                                            <td>{{ $asistencia->h_llegada }}</td>
                                            <td>{{ $asistencia->h_salida }}</td>
                                            <td>{{ $asistencia->horas }}</td>

                                            <!-- Turno con badges -->
                                            <td>
                                                @if ($asistencia->multa->turno == 1)
                                                    <span class="badge bg-primary">MAÑANA</span>
                                                @else
                                                    <span class="badge bg-warning">TARDE</span>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                <span class="badge bg-warning">{{ $asistencia->asistencia }}</span>
                                            </td>

                                            <td>
                                                <span
                                                    class="badge bg-secondary">{{ $asistencia->multa->nombre_multa }}</span>
                                            </td>

                                            <td>
                                                <span
                                                    class="badge bg-success">{{ $asistencia->actividad->nombre_actividad }}</span>
                                            </td>

                                            <!-- Estado con colores diferentes -->
                                            <td>
                                                @if ($asistencia->estado == 1)
                                                    <span class="badge bg-success">Cancelado</span>
                                                @elseif ($asistencia->estado == 0)
                                                    <span class="badge bg-danger">Deuda</span>
                                                @elseif ($asistencia->estado == 2)
                                                    <span class="badge bg-secondary">Ninguno</span>
                                                @else
                                                    <span class="badge bg-secondary">Desconocido</span>
                                                @endif
                                            </td>

                                            <!-- Botones de acción (solo para usuarios con permiso) -->
                                            @can('asistencia')
                                                <td style="text-align: center">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        @can('asistencia')
                                                            <a href="{{ route('asistencias.edit', $asistencia->id) }}"
                                                                type="button" class="btn btn-success"><i
                                                                    class="bi bi-pencil"></i></a>
                                                        @endcan
                                                        <form action="{{ url('asistencias', $asistencia->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            {{ method_field('DELETE') }}
                                                            <button type="submit"
                                                                onclick=" return confirm('Estas seguro de eliminar este registro?')"
                                                                class="btn btn-danger" value="">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- ===== SCRIPT DATATABLES ===== -->
                            <script>
                                $(function() {
                                    $("#example1").DataTable({
                                        "pageLength": 10,
                                        "order": [
                                            [2, "asc"]
                                        ], // Ordenar por fecha
                                        "language": {
                                            "emptyTable": "No hay información",
                                            "info": "Mostrando _START_ a _END_ de _TOTAL_ Asistencias",
                                            "infoEmpty": "Mostrando 0 a 0 de 0 Asistencias",
                                            "infoFiltered": "(Filtrado de _MAX_ total Asistencias)",
                                            "infoPostFix": "",
                                            "thousands": ",",
                                            "lengthMenu": "Mostrar _MENU_ Asistencias",
                                            "loadingRecords": "Cargando...",
                                            "processing": "Procesando...",
                                            "search": "Buscador:",
                                            "zeroRecords": "Sin resultados encontrados",
                                            "paginate": {
                                                "first": "Primero",
                                                "last": "Ultimo",
                                                "next": "Siguiente",
                                                "previous": "Anterior"
                                            }
                                        },
                                        "responsive": true,
                                        "lengthChange": true,
                                        "autoWidth": false,
                                        buttons: [{
                                                extend: 'collection',
                                                text: 'Reportes',
                                                orientation: 'landscape',
                                                buttons: [{
                                                    text: 'Copiar',
                                                    extend: 'copy',
                                                }, {
                                                    extend: 'pdf'
                                                }, {
                                                    extend: 'csv'
                                                }, {
                                                    extend: 'excel'
                                                }, {
                                                    text: 'Imprimir',
                                                    extend: 'print'
                                                }]
                                            },
                                            {
                                                extend: 'colvis',
                                                text: 'Visor de columnas',
                                                collectionLayout: 'fixed three-column'
                                            }
                                        ],
                                    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                                });
                            </script>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <style>
            .hora-laboral h4,
            .hora-academica h4 {
                margin: 0;
            }

            .hora-laboral,
            .hora-academica {
                padding: 5px;
                border-radius: 5px;
                text-align: center;
            }

            .hora-laboral {
                background-color: #e9f7fd;
                color: #007bff;
                /* color: #28a745; */
            }

            .hora-academica {
                background-color: #eafaf1;
                /* color: #28a745; */
            }

            .table-m th,
            .table-m td {
                vertical-align: middle;
                padding: 5px;
                font-size: 0.9em;
            }

            .thead-dark th {
                background-color: #343a40;
                color: #fff;
            }

            .thead-light th {
                background-color: #f8f9fa;
            }

            /* .table-m tbody tr:hover {
                                                                                background-color: #f1f1f1;
                                                                            } */

            .btn-sm {
                padding: 0.25rem 0.5rem;
                font-size: 0.875rem;
                line-height: 1.5;
                border-radius: 0.2rem;
            }

            .thead-custom {
                background-color: #008080;
                /* Celeste oscuro */
                color: white;
                /* Color del texto */
            }


            .glowing-button {
                display: inline-block;
                padding: 8px 16px;
                font-size: 14px;
                font-weight: bold;
                text-decoration: none;
                text-align: center;
                border-radius: 4px;
                color: #fff;
                background-color: #3a6896;
                /* Celeste oscuro */
                border: none;
                box-shadow: 0 0 20px #3a6896;
                /* Sombra del efecto glowing */

                /* Animación de brillo */
                animation: glowing 1.5s infinite;

                /* Transiciones */
                transition: background-color 0.3s, box-shadow 0.3s;
            }

            .glowing-button:hover {
                background-color: #1f4b77;
                /* Cambia el color al pasar el mouse */
                box-shadow: 0 0 20px #1f4b77;
                /* Cambia la sombra al pasar el mouse */
            }

            /* Animación de brillo */
            @keyframes glowing {
                0% {
                    background-color: #3a6896;
                    box-shadow: 0 0 20px #3a6896;
                }

                50% {
                    background-color: #1f4b77;
                    box-shadow: 0 0 20px #1f4b77;
                }

                100% {
                    background-color: #3a6896;
                    box-shadow: 0 0 20px #3a6896;
                }
            }
        </style>

        <!-- Modal Detalle de Asistencias -->
        <div class="modal fade" id="detalleAsistenciasModal" tabindex="-1" aria-labelledby="detalleAsistenciasLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header bg-secondary text-white">
                        <h2 class="modal-title w-100 text-center d-flex align-items-center justify-content-center gap-2"
                            id="detalleAsistenciasLabel">
                            <i class="bi bi-emoji-smile-upside-down-fill"></i> Detalle de Asistencias
                        </h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>

                    <div class="modal-body">
                        <center><span class="badge bg-secondary fs-4"><b>Total de asistencias registradas:</b> </span>
                            <span class="badge bg-secondary fs-4">
                                {{ $asistencias->count() }}
                            </span>
                        </center>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="btn btn-info btn-block btn-flat fs-6"><b>Actividades de la Empresas:</b></p>
                                <ul>
                                    @php
                                        $actividadesPermitidas = [
                                            2 => 'CAMPAÑA',
                                            3 => 'REPRE. COMERCIAL',
                                            4 => 'VOLUNTARIADO',
                                            5 => 'CONVENIO',
                                        ];
                                    @endphp
                                    @foreach ($actividadesPermitidas as $id => $nombre)
                                        @php
                                            $items = $asistencias->where('id_actividad', $id);
                                        @endphp
                                        <li>{{ $nombre }}: {{ $items->count() }}</li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="col-md-6">
                                <p class="btn btn-info btn-block btn-flat fs-6"><b>Tipo de asistencia:</b></p>
                                @php
                                    $asistenciasTipo = [
                                        'ASISTENCIA' => $asistencias->where('asistencia', 'A')->count(),
                                        'FALTA' => $asistencias->where('asistencia', 'F')->count(),
                                        'PERMISO' => $asistencias->where('asistencia', 'P')->count(),
                                    ];
                                @endphp

                                <ul>
                                    @foreach ($asistenciasTipo as $tipo => $cantidad)
                                        <li>{{ $tipo }}: {{ $cantidad }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <hr>
                            <div class="col-md-6">
                                <p class="btn btn-info btn-block btn-flat fs-6"><b>Atrasos registrados:</b></p>
                                @php
                                    // Definimos los costos de cada atraso
                                    $costos = [
                                        'ATRASO1' => 1,
                                        'ATRASO2' => 2,
                                        'ATRASO3' => 3,
                                        'ATRASO5' => 5,
                                        'ATRASO10' => 10,
                                        'TOLERANCIAM' => 0,
                                        'TOLERANCIAT' => 0,
                                    ];

                                    $tiposAtraso = [];
                                    foreach ($costos as $tipo => $costo) {
                                        $cantidad = $asistencias->where('multa.nombre_multa', $tipo)->count();
                                        $tiposAtraso[$tipo] = [
                                            'cantidad' => $cantidad,
                                            'costo' => $costo,
                                            'total' => $cantidad * $costo,
                                        ];
                                    }

                                    // Total general de atrasos
                                    $totalAtrasos = collect($tiposAtraso)->sum('total');
                                @endphp

                                <ul>
                                    @foreach ($tiposAtraso as $tipo => $datos)
                                        <li>
                                            {{ $tipo }}: {{ $datos['cantidad'] }}
                                            ({{ $datos['costo'] }} Bs c/u → <b>{{ $datos['total'] }} Bs</b>)
                                        </li>
                                    @endforeach
                                </ul>
                                <p><b>Total Atrasos: {{ $totalAtrasos }} Bs</b></p>
                            </div>

                            <div class="col-md-6">
                                <p class="btn btn-info btn-block btn-flat fs-6"><b>Atrasos Cancelados o Deudas:</b></p>
                                @php
                                    $costos = [
                                        'ATRASO1' => 1,
                                        'ATRASO2' => 2,
                                        'ATRASO3' => 3,
                                        'ATRASO5' => 5,
                                        'ATRASO10' => 10,
                                    ];

                                    $totales = [
                                        'cancelados' => 0,
                                        'deudas' => 0,
                                    ];
                                @endphp

                                <ul>
                                    @foreach ($costos as $tipo => $costo)
                                        @php
                                            $total = $asistencias->filter(
                                                fn($a) => $a->multa && $a->multa->nombre_multa === $tipo,
                                            );

                                            $cancelados = $total->where('estado', 1)->count();
                                            $deudas = $total->where('estado', 0)->count();

                                            $totalCancelados = $cancelados * $costo;
                                            $totalDeudas = $deudas * $costo;

                                            $totales['cancelados'] += $totalCancelados;
                                            $totales['deudas'] += $totalDeudas;
                                        @endphp

                                        <li>
                                            {{ $tipo }}: {{ $total->count() }}
                                            <span class="ms-2 text-success">✔ Cancelados: {{ $cancelados }}
                                                ({{ $totalCancelados }} Bs)
                                            </span>
                                            <span class="ms-2 text-danger">✘ Deudas: {{ $deudas }}
                                                ({{ $totalDeudas }} Bs)</span>
                                        </li>
                                    @endforeach
                                </ul>

                                <p>
                                    <b>Total Cancelados:</b> {{ $totales['cancelados'] }} Bs <br>
                                    <b>Total Deudas:</b> {{ $totales['deudas'] }} Bs
                                </p>
                                <hr>
                                @php
                                    // Todas las faltas
                                    $faltas = $asistencias->where('asistencia', 'F');
                                    $cantidadFaltas = $faltas->count();

                                    // Total general de faltas
                                    $totalFaltas = 0;
                                    if ($cantidadFaltas > 0) {
                                        if ($cantidadFaltas <= 3) {
                                            $totalFaltas = $cantidadFaltas * 5;
                                        } else {
                                            $totalFaltas = 3 * 5 + ($cantidadFaltas - 3) * 10;
                                        }
                                    }

                                    // Faltas canceladas (estado = 1)
                                    $faltasCanceladas = $faltas->where('estado', 1);
                                    $cantidadCanceladas = $faltasCanceladas->count();

                                    $totalCanceladas = 0;
                                    if ($cantidadCanceladas > 0) {
                                        if ($cantidadCanceladas <= 3) {
                                            $totalCanceladas = $cantidadCanceladas * 5;
                                        } else {
                                            $totalCanceladas = 3 * 5 + ($cantidadCanceladas - 3) * 10;
                                        }
                                    }

                                    // Faltas pendientes (estado = 0)
                                    $faltasDeudas = $faltas->where('estado', 0);
                                    $cantidadDeudas = $faltasDeudas->count();

                                    $totalDeudas = 0;
                                    if ($cantidadDeudas > 0) {
                                        if ($cantidadDeudas <= 3) {
                                            $totalDeudas = $cantidadDeudas * 5;
                                        } else {
                                            $totalDeudas = 3 * 5 + ($cantidadDeudas - 3) * 10;
                                        }
                                    }
                                @endphp
                                <p>
                                    <b>Faltas registradas:</b> {{ $cantidadFaltas }}
                                    (Total: {{ $totalFaltas }} Bs) <br>

                                    <span class="text-success">
                                        ✔ Faltas Canceladas: {{ $cantidadCanceladas }} ({{ $totalCanceladas }} Bs)
                                    </span>

                                    <span class="text-danger">
                                        ✘ Faltas Pendientes: {{ $cantidadDeudas }} ({{ $totalDeudas }} Bs)
                                    </span>
                                </p>
                            </div>
                            <hr>

                            {{-- Control de Asistencias (Modal) --}}
                            <td scope="row" colspan="5">
                                <div class="hora-laboral text-center">
                                    <h5>Asistencias Extras Ganadas</h5>
                                    {{-- Si el usuario tiene permiso --}}
                                    @can('asistencia')
                                        <div class="d-flex justify-content-center align-items-center mb-2">
                                            <button class="btn btn-sm btn-danger me-2"
                                                onclick="cambiarAsistencias(-1)">-</button>

                                            {{-- Input editable --}}
                                            <input type="number" id="inputAsistencias" class="form-control text-center"
                                                style="width: 90px; display: inline-block;" min="0"
                                                value="{{ $totalHora->asistencias_extras ?? 0 }}">

                                            <button class="btn btn-sm btn-success ms-2"
                                                onclick="cambiarAsistencias(1)">+</button>
                                        </div>

                                        <div class="mt-2">
                                            <button class="btn btn-primary btn-sm"
                                                onclick="guardarHorasLocal()">Guardar</button>
                                        </div>
                                    @else
                                        {{-- Vista restringida (sin botones, input bloqueado, guardar deshabilitado) --}}
                                        <div class="d-flex justify-content-center align-items-center mb-2">
                                            <input type="number" id="inputAsistencias" class="form-control text-center"
                                                style="width: 90px; display: inline-block;" min="0"
                                                value="{{ $totalHora->asistencias_extras ?? 0 }}" readonly>
                                        </div>
                                    @endcan

                                    {{-- Vista de EXTRA horas --}}
                                    <div class="mb-1">
                                        <b>Extra (Laborales):</b>
                                        <span id="extraLaboralesTexto">00:00:00</span>
                                        &nbsp; | &nbsp;
                                        <b>Extra (Académicas):</b>
                                        <span id="extraAcademicasTexto">00:00:00</span>
                                    </div>

                                    <small class="d-block mt-2">
                                        1 asistencia = 4:00:00 laborales. Académicas = Laborales × (60/45).
                                    </small>
                                </div>
                            </td>

                            <hr>
                            {{-- Control de Descuento de Horas (Modal) --}}
                            <div class="hora laboral">
                                <div class="hora-laboral text-center w-100">
                                    <h5>Descuento de Horas</h5>

                                    <span id="horas_descuento_total">Descuento de horas totales:
                                        {{ $totalHora->horas_descuento ?? 0 }}</span>
                                    <div
                                        class="w-75 d-flex justify-content-center align-items-center mb-2 mt-2 mx-auto gap-3">
                                        {{-- Si el usuario tiene permiso --}}
                                        @can('asistencia')
                                            <div class="d-flex flex-column">
                                                <b>Agregar motivo de descuento:</b>
                                                <div class="mt-2 mb-2 w-100">
                                                    <div class="w-100">
                                                        <select class="form-select" aria-label="Tipo descuento"
                                                            id="selectMotivo" required>
                                                            <option selected disabled>Seleccione motivo</option>
                                                            <option value="ninguno">Ninguno</option>
                                                            <option value="atrasos">Atrasos</option>
                                                            <option value="informe">Informe semanal</option>
                                                            <option value="uniforme">Uniforme</option>
                                                            <option value="credencial">Credencial</option>
                                                            <option value="limpieza">Limpieza</option>
                                                            <option value="faltas">Faltas</option>
                                                        </select>
                                                        <span id="motivoError"></span>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-center align-items-center mb-2 w-100">
                                                    <button class="btn btn-sm btn-danger me-2"
                                                        onclick="cambiarDescuentoHoras(-1)">-</button>

                                                    <input type="number" id="inputDescuentoHoras"
                                                        class="form-control text-center"
                                                        style="width: 90px; display: inline-block;" min="0"
                                                        value="0">

                                                    <button class="btn btn-sm btn-success ms-2 w-fit"
                                                        onclick="cambiarDescuentoHoras(1)">+</button>
                                                </div>
                                                <button class="btn btn-primary btn-sm mx-auto" style="width: fit-content"
                                                    onclick="guardarDescuentoHoras()">Guardar Descuento</button>
                                            </div>
                                        @else
                                            <div>
                                                <div>
                                                    <input type="number" id="inputDescuentoHoras"
                                                        class="form-control text-center"
                                                        style="width: 90px; display: inline-block;" min="0"
                                                        value="{{ $totalHora->horas_descuento ?? 0 }}" readonly>
                                                </div>
                                            </div>
                                        @endcan

                                        <div>
                                            <button type="button" class="btn btn-secondary" id="btnTipoDescuento">Ver
                                                detalles</button>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="mb-1">
                                            <b>Horas Base:</b>
                                            <span id="horasBaseTexto">00:00:00</span>
                                            &nbsp; | &nbsp;
                                            <b>Horas Descontadas:</b>
                                            <span id="horasDescontadasTexto">00:00:00</span>
                                        </div>

                                        <div class="mb-1">
                                            <b>Total Horas:</b>
                                            <span id="totalConDescuentoTexto">00:00:00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080">
                                <div id="toastGuardado" class="toast align-items-center text-bg-success border-0"
                                    role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="d-flex">
                                        <div class="toast-body" id="toastMensaje">
                                            <!-- Mensaje dinámico -->
                                        </div>
                                        <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                            data-bs-dismiss="toast" aria-label="Cerrar"></button>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-header bg-secondary text-white">
                                <h2 class="modal-title w-100 text-center d-flex align-items-center justify-content-center gap-2"
                                    id="detalleAsistenciasLabel">
                                    <i class="bi bi-bar-chart-fill"></i> Estadísticas de Asistencias
                                </h2>

                            </div><br>
                            <div class="table-responsive mb-4">
                                <table class="table table-hover table-striped table-bordered text-center align-middle"
                                    id="tablaEstadisticas">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Mes</th>
                                            <th>Semana</th>
                                            <th>Total Horas Semana</th>
                                            <th>Total Horas Mes</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>

                            <!-- Gráfico principal responsive -->
                            <div class="chart-container position-relative mb-4" style="height:400px; width:100%;">
                                <canvas id="graficoHorasMes"></canvas>
                            </div>

                            <!-- Repositorio de meses anteriores -->
                            <div>
                                <h6 class="text-secondary mb-2">📁 Meses anteriores (repositorio)</h6>
                                <div id="repositorioMeses" class="d-flex flex-column gap-2"></div>
                            </div>
                            <!-- Calendario de Asistencias -->
<div class="calendario-container">
    <div class="calendario-header">
        <button onclick="cambiarMes(-1)">◀ Mes Anterior</button>
        <span class="calendario-mes-titulo" id="calendarioMesTitulo"></span>
        <button onclick="cambiarMes(1)">Mes Siguiente ▶</button>
    </div>
    
    <div class="calendario-dias-semana" id="calendarioDiasSemana"></div>
    <div class="calendario-grid" id="calendarioGrid"></div>
    
    <div class="calendario-leyenda">
        <div class="leyenda-item">
            <div class="leyenda-color" style="background: #10b981;"></div>
            <span>Presente</span>
        </div>
        <div class="leyenda-item">
            <div class="leyenda-color" style="background: #ef4444;"></div>
            <span>Falta</span>
        </div>
        <div class="leyenda-item">
            <div class="leyenda-color" style="background: #f59e0b;"></div>
            <span>Permiso</span>
        </div>
        <div class="leyenda-item">
            <div class="leyenda-color" style="background: #3b82f6;"></div>
            <span>Retraso</span>
        </div>
    </div>
</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle"></i> Cerrar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- modal descuento -->
            <div class="modal fade" id="tipoDescuento" tabindex="-1" aria-labelledby="tipoDescuentoLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1>Detalles de descuento</h1>
                        </div>
                        <div class="modal-body">
                            @php
                                $motivos = [
                                    'detalle_atraso_descuento' => 'Atrasos',
                                    'detalle_informe_descuento' => 'Informe semanal',
                                    'detalle_uniforme_descuento' => 'Uniforme',
                                    'detalle_credencial_descuento' => 'Credencial',
                                    'detalle_limpieza_descuento' => 'Limpieza',
                                    'detalle_falta_descuento' => 'Faltas',
                                    'horas_descuento' => 'Descuento total',
                                ];

                                $totales = [];
                                foreach ($motivos as $campo => $label) {
                                    $sum = 0;
                                    foreach ($registrosDescuentos as $rec) {
                                        // Intentar obtener valor por propiedad u array
                                        $val = null;
                                        if (is_array($rec) && array_key_exists($campo, $rec)) {
                                            $val = $rec[$campo];
                                        } elseif (is_object($rec) && isset($rec->{$campo})) {
                                            $val = $rec->{$campo};
                                        } elseif (
                                            is_object($rec) &&
                                            isset($rec->horas_descuento) &&
                                            $campo === 'horas_descuento'
                                        ) {
                                            $val = $rec->horas_descuento;
                                        }

                                        if ($val === null) {
                                            continue;
                                        }

                                        // Normalizar: puede venir "2 horas", "2", "02:00:00", etc.
                                        if (is_numeric($val)) {
                                            $sum += (int) $val;
                                        } else {
                                            // Extraer números enteros (horas) si existen
                                            if (preg_match('/\d+/', (string) $val, $m)) {
                                                $sum += (int) $m[0];
                                            } elseif (strpos((string) $val, ':') !== false) {
                                                // Si viene HH:MM:SS convertir a horas (redondeo hacia abajo)
                                                [$h, $mi, $s] = array_pad(explode(':', (string) $val), 3, '0');
                                                $sum += (int) $h;
                                            }
                                        }
                                    }

                                    // Además considerar si existe $totalHora con campos específicos
                                    if (isset($totalHora)) {
                                        // si campo == horas_descuento sumar una vez más (evitar duplicar si ya en registros)
                                        if ($campo === 'horas_descuento' && isset($totalHora->horas_descuento)) {
                                            $sum = max($sum, (int) $totalHora->horas_descuento);
                                        }
                                    }

                                    $totales[$campo] = $sum;
                                }
                            @endphp

                            <p class="lead"><b>Totales de descuentos por motivo (horas)</b></p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped text-center" id="tablaDescuentos">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Motivo</th>
                                            <th>Total (horas)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($motivos as $campo => $label)
                                            <?php
                                            $id = strtolower(explode(' ', $label)[0]);
                                            ?>
                                            <tr @class(['bg-secondary' => $id === 'descuento'])>
                                                <td class="text-start fw-semibold">{{ $label }}</td>
                                                <td class="fw-bold" id={{ $id }}>{{ $totales[$campo] ?? 0 }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal registro de informe -->
        <div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="dataModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title w-100 text-center" id="dataModalLabel">
                            <b>Informe Semanal</b>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>

                    <div class="modal-body">
                        <form action="{{ route('guardarActividad') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_asistencia" value="{{ $asistencias->first()->id ?? '' }}">

                            <div class="row">
                                <!-- COLUMNA IZQUIERDA: Información General -->
                                <div class="col-md-6">
                                    <h6 class="mb-3"><b>Información General</b></h6>

                                    <div class="mb-3">
                                        <label for="mes" class="form-label">Mes Literal <span
                                                class="text-danger">*</span></label>
                                        <select id="mes" name="mesLiteral" class="form-select" required>
                                            <option value="" disabled selected>Seleccione un mes</option>
                                            <option value="Enero">Enero</option>
                                            <option value="Febrero">Febrero</option>
                                            <option value="Marzo">Marzo</option>
                                            <option value="Abril">Abril</option>
                                            <option value="Mayo">Mayo</option>
                                            <option value="Junio">Junio</option>
                                            <option value="Julio">Julio</option>
                                            <option value="Agosto">Agosto</option>
                                            <option value="Septiembre">Septiembre</option>
                                            <option value="Octubre">Octubre</option>
                                            <option value="Noviembre">Noviembre</option>
                                            <option value="Diciembre">Diciembre</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="semana" class="form-label">Semana <span
                                                class="text-danger">*</span></label>
                                        <select id="semana" name="semana" class="form-select" required>
                                            <option value="" disabled selected>Seleccione una semana</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Director de Área <span
                                                class="text-danger">*</span></label>
                                        <div class="row g-2">
                                            <div class="col-4">
                                                <select name="director_titulo" class="form-select" required>
                                                    <option value="" disabled selected>Título</option>
                                                    <option value="AUX.">AUX.</option>
                                                    <option value="LIC.">LIC.</option>
                                                    <option value="TS.">TS.</option>
                                                    <option value="ING.">ING.</option>
                                                </select>
                                            </div>
                                            <div class="col-8">
                                                <input type="text" name="director_nombre"
                                                    class="form-control text-uppercase" placeholder="Nombre completo"
                                                    required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="turno" class="form-label">Turno <span
                                                class="text-danger">*</span></label>
                                        <select id="turno" name="turno" class="form-select" required>
                                            <option value="" disabled selected>Seleccione un turno</option>
                                            <option value="Mañana">Mañana</option>
                                            <option value="Tarde">Tarde</option>
                                            <option value="Completo">Completo</option>
                                        </select>
                                    </div>

                                    <hr class="my-4">

                                    <h6 class="mb-3"><b>Conclusión <span class="text-danger">*</span></b></h6>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" style="color: #fff;">El desarrollo de las
                                            diferentes actividades realizadas dentro de la empresa FaceBol S.R.L. Durante la
                                            semana X, se logró avanzar en actividades de formación.</label>
                                        <label class="form-label fw-semibold" style="color: #fff;">Tu conclusión <span
                                                class="text-danger">*</span></label>
                                        <textarea name="conclusion" id="conclusion" rows="4" maxlength="500"
                                            class="form-control form-control-sm mb-3" placeholder="Escribe tu conclusión aquí..." required></textarea>

                                        <label class="form-label fw-semibold" style="color: #fff;">Sin otro particular me
                                            despido con las consideraciones más distinguidas, deseándole éxitos en las
                                            actividades que desempeña en favor de la empresa.</label>
                                    </div>
                                </div>

                                <!-- COLUMNA DERECHA: Actividades de la Semana -->
                                <div class="col-md-6">
                                    <h6 class="mb-3"><b>Actividades de la Semana</b></h6>

                                    <!-- Lunes -->
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <label class="form-label fw-semibold mb-0">Lunes</label>
                                            <input type="date" name="f1" class="form-control form-control-sm"
                                                style="max-width: 150px;" required>
                                        </div>
                                        <textarea name="actividade1" rows="4" maxlength="255" class="form-control form-control-sm"
                                            placeholder="Actividad realizada..." required></textarea>
                                    </div>

                                    <!-- Martes -->
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <label class="form-label fw-semibold mb-0">Martes</label>
                                            <input type="date" name="f2" class="form-control form-control-sm"
                                                style="max-width: 150px;" required>
                                        </div>
                                        <textarea name="actividade2" rows="4" maxlength="255" class="form-control form-control-sm"
                                            placeholder="Actividad realizada..." required></textarea>
                                    </div>

                                    <!-- Miércoles -->
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <label class="form-label fw-semibold mb-0">Miércoles</label>
                                            <input type="date" name="f3" class="form-control form-control-sm"
                                                style="max-width: 150px;" required>
                                        </div>
                                        <textarea name="actividade3" rows="4" maxlength="255" class="form-control form-control-sm"
                                            placeholder="Actividad realizada..." required></textarea>
                                    </div>

                                    <!-- Jueves -->
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <label class="form-label fw-semibold mb-0">Jueves</label>
                                            <input type="date" name="f4" class="form-control form-control-sm"
                                                style="max-width: 150px;" required>
                                        </div>
                                        <textarea name="actividade4" rows="4" maxlength="255" class="form-control form-control-sm"
                                            placeholder="Actividad realizada..." required></textarea>
                                    </div>

                                    <!-- Viernes -->
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <label class="form-label fw-semibold mb-0">Viernes</label>
                                            <input type="date" name="f5" class="form-control form-control-sm"
                                                style="max-width: 150px;" required>
                                        </div>
                                        <textarea name="actividade5" rows="4" maxlength="255" class="form-control form-control-sm"
                                            placeholder="Actividad realizada..." required></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Generar opciones de semana dinámicamente
            const selectSemana = document.getElementById("semana");
            if (selectSemana) {
                for (let i = 1; i <= 60; i++) {
                    const option = document.createElement("option");
                    option.value = `Semana ${i}`;
                    option.textContent = `Semana ${i}`;
                    selectSemana.appendChild(option);
                }

                // Actualizar texto de entrada cuando cambie la semana
                selectSemana.addEventListener('change', function() {
                    const numeroSemana = this.value.replace('Semana ', '');
                    const textoEntrada = document.getElementById('textoEntrada');
                    if (textoEntrada) {
                        textoEntrada.value =
                            `El desarrollo de las diferentes actividades realizadas dentro de la empresa FaceBol S.R.L. Durante la semana ${numeroSemana}, se logró avanzar en actividades de formación.`;
                    }
                });
            }
        </script>

        <script>
            const registrosDescuentos = @json($registrosDescuentos);
            const map = {
                'atrasos': 'detalle_atraso_descuento',
                'informe': 'detalle_informe_descuento',
                'uniforme': 'detalle_uniforme_descuento',
                'credencial': 'detalle_credencial_descuento',
                'limpieza': 'detalle_limpieza_descuento',
                'faltas': 'detalle_falta_descuento',
            };
            document.getElementById('btnTipoDescuento').addEventListener('click', function() {
                const modalTipoDescuento = new bootstrap.Modal(document.getElementById('tipoDescuento'));
                modalTipoDescuento.show();

                document.querySelectorAll('.modal-backdrop').forEach(b => b.classList.add('d-none'));
            });

            document.getElementById('selectMotivo').addEventListener('change', function() {
                const selectValue = document.getElementById('selectMotivo').value;
                document.getElementById('selectMotivo').classList.remove('is-invalid');
                document.getElementById('motivoError').innerText = '';

                if (selectValue !== 'Seleccione motivo' && selectValue !== '') {
                    const campoBD = map[selectValue];
                    if (campoBD && registrosDescuentos[0][campoBD] !== undefined) {
                        const valor = registrosDescuentos[0][campoBD];
                        document.getElementById('inputDescuentoHoras').value = valor;
                    } else if (campoBD === undefined) {
                        document.getElementById('inputDescuentoHoras').value = 0;
                    } else {
                        console.warn('Campo no encontrado en el mapa o sin datos en registrosDescuentos.');
                    }
                }
            });
        </script>

        <script>
            // ====== CONFIG ======
            const ID_INSCRIPCION = {{ $inscripcions->id }};
            const HORAS_POR_ASISTENCIA = 4 * 3600; // 4 horas en segundos
            const RATIO_ACADEMICAS = 4 / 3; // 60/45

            // URLs para guardar en la base de datos
            const URL_GUARDAR_EXTRA = "{{ route('asistencias.guardar-extra', $inscripcions->id) }}";
            const URL_GUARDAR_DESCUENTO = "{{ route('asistencias.guardar-descuento', $inscripcions->id) }}";

            // ====== VARIABLES GLOBALES ======
            let asistenciasExtrasBD = {{ $totalHora->asistencias_extras ?? 0 }};
            let horasDescuentoBD = {{ $totalHora->horas_descuento ?? 0 }};

            // ====== HELPERS ======
            function timeToSeconds(hms) {
                const [h, m, s] = (hms || '00:00:00').split(':').map(n => parseInt(n || 0, 10));
                return (h * 3600) + (m * 60) + s;
            }

            function secondsToTime(total) {
                total = Math.max(0, Math.floor(total));
                const h = String(Math.floor(total / 3600)).padStart(2, '0');
                const m = String(Math.floor((total % 3600) / 60)).padStart(2, '0');
                const s = String(total % 60).padStart(2, '0');
                return `${h}:${m}:${s}`;
            }

            function getBaseLaborales() {
                const el = document.getElementById('globalTotalHorasLaborales');
                return timeToSeconds(el?.dataset?.base || '00:00:00');
            }

            function getBaseAcademicas() {
                const el = document.getElementById('globalTotalHorasAcademicas');
                return timeToSeconds(el?.dataset?.base || '00:00:00');
            }

            function setGlobalLaborales(seconds, detalleExtra = '') {
                const el = document.getElementById('globalTotalHorasLaborales');
                const sm = document.getElementById('globalDetalleHorasLaborales');
                if (el) el.innerText = secondsToTime(seconds);
                if (sm) sm.innerText = detalleExtra || sm.innerText;
            }

            function setGlobalAcademicas(seconds, detalleExtra = '') {
                const el = document.getElementById('globalTotalHorasAcademicas');
                const sm = document.getElementById('globalDetalleHorasAcademicas');
                if (el) el.innerText = secondsToTime(seconds);
                if (sm) sm.innerText = detalleExtra || sm.innerText;
            }

            // ====== TOAST ======
            function mostrarToast(mensaje) {
                const toastEl = document.getElementById('toastGuardado');
                document.getElementById('toastMensaje').innerText = mensaje;
                const toast = new bootstrap.Toast(toastEl);
                toast.show();
            }

            // ====== CÁLCULO UNIFICADO ======
            function actualizarVistaTotal() {
                // Usar siempre los valores de la base de datos
                const asistencias = asistenciasExtrasBD;
                const descuentoHoras = horasDescuentoBD;

                const baseLab = getBaseLaborales();
                const baseAca = getBaseAcademicas();

                const extraLaborales = asistencias * HORAS_POR_ASISTENCIA;
                const extraAcademicas = Math.round(extraLaborales * RATIO_ACADEMICAS);

                const descuentoSegs = descuentoHoras * 3600;

                const totalLab = Math.max(0, baseLab + extraLaborales - descuentoSegs);
                const totalAca = Math.max(0, baseAca + extraAcademicas - Math.round(descuentoSegs * RATIO_ACADEMICAS));

                const detalleLab =
                    `Base: ${secondsToTime(baseLab)} + Extra: ${secondsToTime(extraLaborales)} - Descuento: ${secondsToTime(descuentoSegs)}`;
                const detalleAca =
                    `Base: ${secondsToTime(baseAca)} + Extra: ${secondsToTime(extraAcademicas)} - Descuento: ${secondsToTime(Math.round(descuentoSegs * RATIO_ACADEMICAS))}`;

                setGlobalLaborales(totalLab, detalleLab);
                setGlobalAcademicas(totalAca, detalleAca);

                document.getElementById('extraLaboralesTexto').innerText = secondsToTime(extraLaborales);
                document.getElementById('extraAcademicasTexto').innerText = secondsToTime(extraAcademicas);
                document.getElementById('horasBaseTexto').innerText = secondsToTime(baseLab);
                document.getElementById('horasDescontadasTexto').innerText = secondsToTime(descuentoSegs);
                document.getElementById('totalConDescuentoTexto').innerText = secondsToTime(totalLab);
            }

            // ====== INTERFAZ ======
            function cambiarAsistencias(delta) {
                const input = document.getElementById('inputAsistencias');
                let val = parseInt(input.value || '0', 10);
                val = isNaN(val) ? 0 : val;
                val += delta;
                if (val < 0) val = 0;
                input.value = val;

                // Actualizar variable global pero NO guardar en BD todavía
                asistenciasExtrasBD = val;
                actualizarVistaTotal();
            }

            function cambiarDescuentoHoras(delta) {
                const input = document.getElementById('inputDescuentoHoras');
                let val = parseInt(input.value || '0', 10);
                val = isNaN(val) ? 0 : val;
                val += delta;
                if (val < 0) val = 0;
                input.value = val;

                // Actualizar variable global pero NO guardar en BD todavía
                horasDescuentoBD = val;
                actualizarVistaTotal();
            }

            // ====== FUNCIONES PARA GUARDAR EN BD ======
            async function guardarHorasLocal() {
                const val = parseInt(document.getElementById('inputAsistencias').value || '0', 10);
                if (isNaN(val) || val < 0) return;

                try {
                    const response = await fetch(URL_GUARDAR_EXTRA, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            asistencias_extras: val
                        })
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        mostrarToast('✅ Horas extras guardadas correctamente');
                        // Actualizar variable global con el valor confirmado de la BD
                        asistenciasExtrasBD = val;

                        // Actualizar los valores en la vista principal
                        if (data.nuevo_total_laborales) {
                            document.getElementById('globalTotalHorasLaborales').textContent = data.nuevo_total_laborales;
                        }
                        // if (data.nuevo_total_academicas) {
                        //     document.getElementById('globalTotalHorasAcademicas').textContent = data.nuevo_total_academicas;
                        // }
                    } else {
                        mostrarToast('⚠️ Error al guardar en la base de datos');
                        console.error('Error:', data.message);
                        // Revertir a los valores anteriores si hay error
                        actualizarDesdeBD();
                    }
                } catch (error) {
                    console.error('Error de conexión:', error);
                    mostrarToast('⚠️ Error de conexión con el servidor');
                    // Revertir a los valores anteriores si hay error
                    actualizarDesdeBD();
                }
            }

            async function guardarDescuentoHoras() {
                const val = parseInt(document.getElementById('inputDescuentoHoras').value || '0', 10);
                const motivo = document.getElementById('selectMotivo');
                const boxMotivoError = document.getElementById('motivoError');

                if (isNaN(val) || val < 0) return;

                try {
                    const motivoValue = (motivo.value === 'Seleccione motivo' || motivo.value === 'validate') ? '' : motivo
                        .value;
                    const response = await fetch(URL_GUARDAR_DESCUENTO, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            horas_descuento: val,
                            motivo: motivoValue
                        })
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        mostrarToast('✅ Descuento de horas guardado correctamente');
                        // Actualizar variable global con el valor confirmado de la BD
                        horasDescuentoBD = val;

                        // Actualizar los valores en la vista principal
                        if (data.nuevo_total_laborales) {
                            document.getElementById('globalTotalHorasLaborales').textContent = data.nuevo_total_laborales;
                        }
                        // if (data.nuevo_total_academicas) {
                        //     document.getElementById('globalTotalHorasAcademicas').textContent = data.nuevo_total_academicas;
                        // }
                        const td = document.getElementById(data.motivo);
                        if (td) {
                            td.textContent = data.horas_en_campo;
                            document.getElementById('descuento').textContent = data.horas_descuento_total;
                            document.getElementById('horas_descuento_total').textContent =
                                `Descuento de horas totales: ${data.horas_descuento_total}`;
                        } else {
                            console.warn('No se encontró la columna en la tabla para actualizar.');
                        }
                    } else if (response.status === 422 && data.errors) {
                        console.log(data.errors);
                        if (data.errors.motivo) {
                            boxMotivoError.innerText = data.errors.motivo.join(', ');
                            boxMotivoError.style.color = 'red';
                            motivo.classList.add('is-invalid');
                        } else {
                            boxMotivoError.innerText = '';
                            motivo.classList.remove('is-invalid');
                        }
                    } else {
                        mostrarToast('⚠️ Error al guardar el descuento');
                        console.error('Error:', data.message);
                        // Revertir a los valores anteriores si hay error
                        actualizarDesdeBD();
                    }
                } catch (error) {
                    console.error('Error de conexión:', error);
                    mostrarToast('⚠️ Error de conexión con el servidor');
                    // Revertir a los valores anteriores si hay error
                    actualizarDesdeBD();
                }
            }

            // ====== SINCRONIZACIÓN CON BD ======
            function actualizarDesdeBD() {
                // Restaurar valores desde las variables globales (que vienen de la BD)
                document.getElementById('inputAsistencias').value = asistenciasExtrasBD;
                // document.getElementById('inputDescuentoHoras').value = horasDescuentoBD;
                actualizarVistaTotal();
            }

            // ====== INICIALIZACIÓN ======
            document.addEventListener('DOMContentLoaded', () => {
                // Siempre usar los valores de la base de datos
                document.getElementById('inputAsistencias').value = asistenciasExtrasBD;
                // document.getElementById('inputDescuentoHoras').value = horasDescuentoBD;

                actualizarVistaTotal();
            });

            document.addEventListener('shown.bs.modal', (e) => {
                if (e.target && e.target.id === 'detalleAsistenciasModal') {
                    // Cuando se abre el modal, asegurarse de que los inputs muestren los valores actuales de BD
                    document.getElementById('inputAsistencias').value = asistenciasExtrasBD;
                    // document.getElementById('inputDescuentoHoras').value = horasDescuentoBD;
                    actualizarVistaTotal();
                }
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>

            @php
    $asistenciasCalendario = $asistencias->map(function($a) {
        return [
            'fecha'      => $a->fecha,
            'horas'      => $a->horas,
            'asistencia' => $a->asistencia,
            'h_llegada'  => $a->h_llegada,
            'h_salida'   => $a->h_salida,
            'multa'      => $a->multa ? ['nombre_multa' => $a->multa->nombre_multa] : null,
        ];
    });
@endphp

const asistencias = @json($asistenciasCalendario);

            function timeToSeconds(hms) {
                const [h, m, s] = (hms || '00:00:00').split(':').map(Number);
                return h * 3600 + m * 60 + s;
            }

            function secondsToTime(sec) {
                const h = Math.floor(sec / 3600).toString().padStart(2, '0');
                const m = Math.floor((sec % 3600) / 60).toString().padStart(2, '0');
                const s = Math.floor(sec % 60).toString().padStart(2, '0');
                return `${h}:${m}:${s}`;
            }

            // ===== Agrupar por mes y semana =====
            const datos = {};
            asistencias.forEach(a => {
                const fecha = new Date(a.fecha);
                const mes = fecha.getMonth() + 1;
                const anio = fecha.getFullYear();
                const keyMes = `${anio}-${mes}`;

                const diaMes = fecha.getDate();
                const primerDia = new Date(anio, mes - 1, 1).getDay();
                const semana = Math.ceil((diaMes + primerDia - 1) / 7);

                if (!datos[keyMes]) datos[keyMes] = {
                    totalMes: 0,
                    semanas: {}
                };
                datos[keyMes].semanas[semana] = (datos[keyMes].semanas[semana] || 0) + timeToSeconds(a.horas);
                datos[keyMes].totalMes += timeToSeconds(a.horas);
            });

            // ===== Ordenar los meses =====
            const clavesOrdenadas = Object.keys(datos)
                .map(k => ({
                    key: k,
                    date: new Date(k.split('-')[0], k.split('-')[1] - 1, 1)
                }))
                .sort((a, b) => a.date - b.date)
                .map(x => x.key);

            // ===== Mostrar en tabla ordenada =====
            const tbody = document.querySelector('#tablaEstadisticas tbody');
            clavesOrdenadas.forEach(keyMes => {
                const [anio, mes] = keyMes.split('-');
                const totalMes = datos[keyMes].totalMes;
                Object.keys(datos[keyMes].semanas).forEach(semana => {
                    const totalSemana = datos[keyMes].semanas[semana];
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                <td class="fw-bold text-primary">${mes}/${anio}</td>
                <td class="fw-semibold">${semana}</td>
                <td class="text-success">${secondsToTime(totalSemana)}</td>
                <td class="text-danger fw-bold">${secondsToTime(totalMes)}</td>
            `;
                    tbody.appendChild(tr);
                });
            });

            // ===== Últimos 5 meses continuos para gráfico principal =====
            const ultimos5 = clavesOrdenadas.slice(-5);
            const labelsMes = [];
            const dataHorasMes = [];
            const semanaDetalles = [];

            ultimos5.forEach(key => {
                const [anio, mes] = key.split('-');
                labelsMes.push(`${mes}/${anio}`);
                dataHorasMes.push(datos[key]?.totalMes || 0); // en segundos

                // Guardamos detalle de semanas para tooltip
                const semanas = [];
                Object.keys(datos[key].semanas).sort((a, b) => a - b).forEach(s => {
                    semanas.push(`Semana ${s}: ${secondsToTime(datos[key].semanas[s])}`);
                });
                semanaDetalles.push(semanas);
            });

            // ===== Gráfico principal con degradado y tooltip por semana =====
            const ctxMes = document.getElementById('graficoHorasMes');
            const gradient = ctxMes.getContext('2d').createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(54,162,235,0.9)');
            gradient.addColorStop(1, 'rgba(54,162,235,0.4)');

            new Chart(ctxMes, {
                type: 'bar',
                data: {
                    labels: labelsMes,
                    datasets: [{
                        label: 'Horas acumuladas por mes',
                        data: dataHorasMes,
                        backgroundColor: gradient,
                        borderColor: 'rgba(54,162,235,1)',
                        borderWidth: 2,
                        borderRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 1000,
                        easing: 'easeOutBounce'
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const index = context.dataIndex;
                                    const totalMes = secondsToTime(context.raw);
                                    const detalleSemanas = semanaDetalles[index].join(' | ');
                                    return [`Total Mes: ${totalMes}`, detalleSemanas];
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Horas acumuladas (HH:MM:SS)'
                            },
                            ticks: {
                                callback: val => secondsToTime(val)
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Meses'
                            }
                        }
                    }
                }
            });

            // ===== Repositorio de meses anteriores =====
            const repo = document.getElementById('repositorioMeses');
            const mesesAntiguos = clavesOrdenadas.slice(0, -5);
            const maxHoras = Math.max(...Object.values(datos).map(d => d.totalMes, 0));

            mesesAntiguos.forEach(key => {
                const div = document.createElement('div');
                const [anio, mes] = key.split('-');
                const horas = datos[key].totalMes;
                const widthPercent = maxHoras > 0 ? (horas / maxHoras) * 100 : 0;

                div.className = 'd-flex justify-content-between align-items-center';
                div.innerHTML = `
            <span style="color:#000;">${mes}/${anio}</span>
            <div class="bg-primary rounded" style="height:12px; width:${widthPercent}%;"></div>
            <span class="ms-2" style="color:#000;">${secondsToTime(horas)}</span>
        `;
                repo.appendChild(div);
            });
        </script>
        <script>
// ===== CALENDARIO DE ASISTENCIAS =====
class CalendarioAsistencias {
    constructor(asistenciasData) {
    this.asistencias = asistenciasData;
    this.fechaActual = new Date();
    // Calcular fecha del primer registro (fecha de ingreso)
    if (asistenciasData.length > 0) {
        const fechas = asistenciasData.map(a => new Date(a.fecha));
        this.fechaIngreso = new Date(Math.min(...fechas));
        this.fechaIngreso.setHours(0, 0, 0, 0);
    } else {
        this.fechaIngreso = null;
    }
    this.meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 
                      'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    this.diasSemana = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];
}
    
    // Obtener estado de asistencia para un día específico
    obtenerEstadoAsistencia(fecha) {
        const fechaStr = fecha.toISOString().split('T')[0];
        const asistencia = this.asistencias.find(a => {
            const asistenciaFecha = new Date(a.fecha).toISOString().split('T')[0];
            return asistenciaFecha === fechaStr;
        });
        
if (!asistencia) {
    const diaSemana = fecha.getDay();
    if (diaSemana === 0 || diaSemana === 6) {
        return { estado: 'finde', clase: '', texto: 'Fin de semana' };
    }
    const hoy = new Date();
    hoy.setHours(0, 0, 0, 0);
    // Días futuros → sin marcar
    if (fecha > hoy) {
        return { estado: 'futuro', clase: '', texto: '' };
    }
    // Días antes del primer registro → sin marcar
    if (this.fechaIngreso && fecha < this.fechaIngreso) {
        return { estado: 'antes-ingreso', clase: '', texto: '' };
    }
    return { estado: 'falta', clase: 'calendario-dia-falta', texto: 'Falta' };
}
        
        switch(asistencia.asistencia) {
            case 'A':
                // Verificar si tuvo retraso
                if (asistencia.multa && asistencia.multa.nombre_multa !== 'NINGUNO') {
                    return { estado: 'retraso', clase: 'calendario-dia-retraso', 
                            texto: `Retraso: ${asistencia.multa.nombre_multa}`,
                            hora: `Llegada: ${asistencia.h_llegada}` };
                }
                return { estado: 'presente', clase: 'calendario-dia-presente', 
                        texto: `Presente: ${asistencia.horas}`,
                        hora: `${asistencia.h_llegada} - ${asistencia.h_salida}` };
            case 'F':
                return { estado: 'falta', clase: 'calendario-dia-falta', texto: 'Falta' };
            case 'P':
                return { estado: 'permiso', clase: 'calendario-dia-permiso', 
                        texto: 'Permiso', motivo: asistencia.multa?.nombre_multa || 'Permiso' };
            default:
                return { estado: 'desconocido', clase: '', texto: 'Sin registro' };
        }
    }
    
    // Renderizar calendario
    renderizar() {
        const año = this.fechaActual.getFullYear();
        const mes = this.fechaActual.getMonth();
        
        // Actualizar título
        document.getElementById('calendarioMesTitulo').textContent = `${this.meses[mes]} ${año}`;
        
        // Renderizar días de la semana
        const diasSemanaHtml = this.diasSemana.map(dia => 
            `<div class="calendario-dia-nombre">${dia}</div>`
        ).join('');
        document.getElementById('calendarioDiasSemana').innerHTML = diasSemanaHtml;
        
        // Obtener primer día del mes y número de días
        const primerDia = new Date(año, mes, 1);
        const ultimoDia = new Date(año, mes + 1, 0);
        const numDias = ultimoDia.getDate();
        const diaInicioSemana = primerDia.getDay();
        
        // Obtener días del mes anterior para completar la primera semana
        const diasMesAnterior = diaInicioSemana;
        const ultimoDiaMesAnterior = new Date(año, mes, 0).getDate();
        
        // Obtener días del mes siguiente
        const totalCasillas = Math.ceil((numDias + diasMesAnterior) / 7) * 7;
        const diasMesSiguiente = totalCasillas - (numDias + diasMesAnterior);
        
        let gridHtml = '';
        let fechaActual = new Date();
        
        // Días del mes anterior
        for (let i = diasMesAnterior - 1; i >= 0; i--) {
            const fecha = new Date(año, mes - 1, ultimoDiaMesAnterior - i);
            const estado = this.obtenerEstadoAsistencia(fecha);
            const esHoy = fecha.toDateString() === fechaActual.toDateString();
            
            gridHtml += `
                <div class="calendario-dia calendario-dia-otro-mes ${estado.clase}" 
                     style="${esHoy ? 'border: 2px solid #58a6ff;' : ''}">
                    <div class="calendario-dia-numero">${fecha.getDate()}</div>
                    <div class="calendario-indicador">${estado.texto}</div>
                    <div class="calendario-dia-tooltip">
                        ${fecha.toLocaleDateString('es-ES')}<br>
                        ${estado.texto}
                        ${estado.hora ? '<br>' + estado.hora : ''}
                        ${estado.motivo ? '<br>' + estado.motivo : ''}
                    </div>
                </div>
            `;
        }
        
        // Días del mes actual
        for (let i = 1; i <= numDias; i++) {
            const fecha = new Date(año, mes, i);
            const estado = this.obtenerEstadoAsistencia(fecha);
            const esHoy = fecha.toDateString() === fechaActual.toDateString();
            const esDiaSemana = fecha.getDay() !== 0 && fecha.getDay() !== 6;
            
            // Solo mostrar tooltip si es día laboral o falta importante
            const mostrarTooltip = estado.estado !== 'finde';
            
            gridHtml += `
                <div class="calendario-dia ${estado.clase}" 
                     style="${esHoy ? 'border: 2px solid #58a6ff;' : ''}">
                    <div class="calendario-dia-numero">${i}</div>
                    <div class="calendario-indicador">${estado.texto}</div>
                    ${mostrarTooltip ? `
                        <div class="calendario-dia-tooltip">
                            ${fecha.toLocaleDateString('es-ES', { weekday: 'long', day: 'numeric', month: 'long' })}<br>
                            ${estado.texto}
                            ${estado.hora ? '<br>' + estado.hora : ''}
                            ${estado.motivo ? '<br>' + estado.motivo : ''}
                        </div>
                    ` : ''}
                </div>
            `;
        }
        
        // Días del mes siguiente
        for (let i = 1; i <= diasMesSiguiente; i++) {
            const fecha = new Date(año, mes + 1, i);
            const estado = this.obtenerEstadoAsistencia(fecha);
            
            gridHtml += `
                <div class="calendario-dia calendario-dia-otro-mes ${estado.clase}">
                    <div class="calendario-dia-numero">${i}</div>
                    <div class="calendario-indicador">${estado.texto}</div>
                </div>
            `;
        }
        
        document.getElementById('calendarioGrid').innerHTML = gridHtml;
    }
    
    cambiarMes(delta) {
        this.fechaActual.setMonth(this.fechaActual.getMonth() + delta);
        this.renderizar();
    }
}

// Inicializar calendario cuando se abre el modal
let calendario;

document.getElementById('detalleAsistenciasModal').addEventListener('shown.bs.modal', function() {
    if (!calendario) {
        calendario = new CalendarioAsistencias(asistencias);
    }
    calendario.renderizar();
});

function cambiarMes(delta) {
    if (calendario) {
        calendario.cambiarMes(delta);
    }
}
</script>
    @endsection
