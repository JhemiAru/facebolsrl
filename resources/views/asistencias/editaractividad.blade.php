@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="h3 mb-0 text-gray-800">
                    <i class="fas fa-calendar-edit mr-2"></i>Editar Reporte Semanal de Actividades
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('asistencias.reporteactividad') }}">Reportes</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editar</li>
                    </ol>
                </nav>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Error en el formulario!</h5>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-gradient-primary">
                        <h6 class="m-0 font-weight-bold text-white">
                            <i class="fas fa-edit mr-1"></i> Formulario de Edición
                        </h6>
                    </div>
                    <div class="card-body">
                        <form id="editarReporteForm"
                            action="{{ route('reporteactividad.actualizar', $reporteactividad->id ?? '') }}" method="POST">
                            @csrf
                            @method('PUT')

                            @if (isset($asistencias) && $asistencias->isNotEmpty())
                                <input type="hidden" name="id_asistencia" value="{{ $reporteactividad->id_asistencia }}">
                            @endif

                            <div class="row">
                                <!-- Configuración del Reporte -->
                                <div class="col-md-12">
                                    <div class="card mb-4 border-left-info">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-info">
                                                <i class="fas fa-cog mr-1"></i> Configuración del Reporte
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex gap-4">
                                                <div class="form-group">
                                                    <label for="mesLiteral">Mes</label>
                                                    <select id="mesLiteral" name="mesLiteral" class="form-control select2"
                                                        required>
                                                        <option disabled>Seleccione un mes</option>
                                                        @php
                                                            $meses = [
                                                                'Enero',
                                                                'Febrero',
                                                                'Marzo',
                                                                'Abril',
                                                                'Mayo',
                                                                'Junio',
                                                                'Julio',
                                                                'Agosto',
                                                                'Septiembre',
                                                                'Octubre',
                                                                'Noviembre',
                                                                'Diciembre',
                                                            ];
                                                        @endphp
                                                        @foreach ($meses as $mes)
                                                            <option value="{{ $mes }}"
                                                                {{ $reporteactividad->mesLiteral == $mes ? 'selected' : '' }}>
                                                                {{ $mes }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="semana">Semana</label>
                                                    <select id="semana" name="semana" class="form-control select2"
                                                        required>
                                                        <option disabled selected>Seleccione una semana</option>
                                                        @for ($i = 1; $i <= 60; $i++)
                                                            <option value="Semana {{ $i }}"
                                                                {{ $reporteactividad->semana == "Semana $i" ? 'selected' : '' }}>
                                                                Semana {{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="turno">Turno</label>
                                                    <select name="turno" id="turno" class="form-control select2"
                                                        required>
                                                        <option disabled selected>Seleccione un turno</option>
                                                        <option value="Mañana"
                                                            {{ $reporteactividad->turno == 'Mañana' ? 'selected' : '' }}>
                                                            Mañana
                                                        </option>
                                                        <option value="Tarde"
                                                            {{ $reporteactividad->turno == 'Tarde' ? 'selected' : '' }}>
                                                            Tarde
                                                        </option>
                                                        <option value="Noche"
                                                            {{ $reporteactividad->turno == 'Noche' ? 'selected' : '' }}>
                                                            Noche
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            @php
                                                // Dividir el nombre completo en título y nombre
                                                $adminParts = explode(' ', $reporteactividad->admin, 2);
                                                $adminTitle = $adminParts[0] ?? '';
                                                $adminName = $adminParts[1] ?? '';
                                            @endphp
                                            <div class="form-group">
                                                <label for="director_area">Director de área</label>
                                                <div class="d-flex gap-2">
                                                    <select name="director_area" id="director_area"
                                                        class="form-control select2 w-25" required>
                                                        <option value="" disabled selected>Título</option>
                                                        <option value="AUX."
                                                            {{ $adminTitle == 'AUX.' ? 'selected' : '' }}>
                                                            AUX.</option>
                                                        <option value="LIC."
                                                            {{ $adminTitle == 'LIC.' ? 'selected' : '' }}>
                                                            LIC.</option>
                                                        <option value="TS."
                                                            {{ $adminTitle == 'TS.' ? 'selected' : '' }}>TS.
                                                        </option>
                                                        <option value="ING."
                                                            {{ $adminTitle == 'ING.' ? 'selected' : '' }}>
                                                            ING.</option>
                                                    </select>
                                                    <input type="text" name="director_area_nombre"
                                                        id="director_area_nombre" class="form-control"
                                                        value="{{ $adminName }}"
                                                        placeholder="Nombre del Director de área" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Días de la Semana -->
                                <div class="col-md-12">
                                    <div class="card mb-4 border-left-success">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-success">
                                                <i class="fas fa-calendar-week mr-1"></i> Días de la Semana
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            @php
                                                $dias = [
                                                    [
                                                        'num' => 1,
                                                        'nombre' => 'Lunes',
                                                        'fecha' => 'f1',
                                                        'actividad' => 'actividade1',
                                                    ],
                                                    [
                                                        'num' => 2,
                                                        'nombre' => 'Martes',
                                                        'fecha' => 'f2',
                                                        'actividad' => 'actividade2',
                                                    ],
                                                    [
                                                        'num' => 3,
                                                        'nombre' => 'Miércoles',
                                                        'fecha' => 'f3',
                                                        'actividad' => 'actividade3',
                                                    ],
                                                    [
                                                        'num' => 4,
                                                        'nombre' => 'Jueves',
                                                        'fecha' => 'f4',
                                                        'actividad' => 'actividade4',
                                                    ],
                                                    [
                                                        'num' => 5,
                                                        'nombre' => 'Viernes',
                                                        'fecha' => 'f5',
                                                        'actividad' => 'actividade5',
                                                    ],
                                                ];
                                            @endphp

                                            @foreach ($dias as $dia)
                                                <div class="dia-container mb-3 p-3 border rounded">
                                                    <h6 class="font-weight-bold text-primary">
                                                        <i class="far fa-calendar-alt mr-1"></i> {{ $dia['nombre'] }}
                                                    </h6>
                                                    <div class="form-group">
                                                        <label for="{{ $dia['fecha'] }}">Fecha</label>
                                                        <input type="date" class="form-control"
                                                            name="{{ $dia['fecha'] }}"
                                                            value="{{ $reporteactividad->{$dia['fecha']} }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="{{ $dia['actividad'] }}">Actividad</label>
                                                        <textarea name="{{ $dia['actividad'] }}" id="{{ $dia['actividad'] }}" class="form-control" rows="2" required>{{ $reporteactividad->{$dia['actividad']} }}</textarea>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!-- conclusion -->
                                <div>
                                    <div class="form-group">
                                        <label for="conclusion">Conclusión Semanal</label>
                                        <textarea name="conclusion" id="conclusion" class="form-control" rows="3" required>{{ $reporteactividad->conclusion }}</textarea>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="row">
                                    <div class="col-12 text-right">
                                        <a href="{{ route('asistencias.reporteactividad') }}"
                                            class="btn btn-secondary mr-2">
                                            <i class="fas fa-times mr-1"></i> Cancelar
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save mr-1"></i> Actualizar Reporte
                                        </button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .card-header.bg-gradient-primary {
            background: linear-gradient(87deg, #4e73df 0, #224abe 100%) !important;
        }

        .border-left-info {
            border-left: 0.25rem solid #36b9cc !important;
        }

        .border-left-success {
            border-left: 0.25rem solid #1cc88a !important;
        }

        .dia-container {
            transition: all 0.3s ease;
            background-color: #f8f9fc;
        }

        .dia-container:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .select2-container .select2-selection--single {
            height: 38px;
            padding: 6px 12px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }
    </style>
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inicializar Select2
            $('.select2').select2({
                placeholder: 'Seleccione una opción',
                allowClear: false
            });

            // Validación del formulario
            $('#editarReporteForm').on('submit', function(e) {
                let valid = true;

                // Validar que todas las actividades tengan contenido
                $('textarea[required]').each(function() {
                    if ($(this).val().trim() === '') {
                        valid = false;
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });

                if (!valid) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Campos requeridos',
                        text: 'Por favor complete todas las actividades antes de enviar',
                    });
                }
            });

            // Resaltar el día actual al pasar el mouse
            $('.dia-container').hover(
                function() {
                    $(this).css('border-color', '#4e73df');
                },
                function() {
                    $(this).css('border-color', '#ddd');
                }
            );
        });
    </script>
@endpush
