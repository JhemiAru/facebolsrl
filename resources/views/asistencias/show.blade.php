@php
    use Illuminate\Support\Facades\Session;
@endphp
@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1 class="text-center"><b>Bienvenido a la Planillas de las Asistencias</b></h1>

        @if ($message = Session::get('mensaje'))
            <script>
                Swal.fire({
                    title: "Buen trabajo!",
                    text: "{{ $message }}",
                    icon: "success"
                });
            </script>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <table class="table table-bordered table-striped table-m text-center">
                            <thead class="thead-custom">
                                <tr>
                                    <th scope="row">Nombre del Pasante</th>
                                    <th scope="row">Codigo de Credencial</th>
                                    {{-- <th scope="row">Codigo de Serie</th> --}}
                                    <th scope="row">Total Horas Laborales</th>
                                    <th scope="row">Total Horas Académicas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">{{ $inscripcions->informacion->apellido_paterno }} {{ $inscripcions->informacion->apellido_materno }} {{ $inscripcions->informacion->nombre }}</td>
                                    <td scope="row">{{ $inscripcions->codigo_credencial }}</td>
                                    {{-- <td scope="row">{{ $inscripcions->tarjeta->serie }}</td> --}}
                                    <td scope="row">
                                        <div class="hora-laboral">
                                            <h4>{{ $horaacumulada->total_horas }}</h4>
                                            <small>{{ $horaacumulada->detalle_horas_laborales }}</small>
                                        </div>
                                    </td>
                                    <td scope="row">
                                        <div class="hora-academica">
                                            <h4>{{ $horaResultado->horas_academicas }}</h4>
                                            <small>{{ $horaResultado->detalle_horas_academicas }}</small>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="card-tools">
                            <a href="{{ url('/asistencias') }}" class="btn btn-info btn-custom glowing-button">
                                <i class="bi bi-file-plus"></i> Volver
                            </a>
                        </div>
                    </div>
                    <div class="card-body" style="...">

                        <table id="example1" class="table table-bordered table-striped table-m">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    {{-- <th>Informacion pasante</th> --}}
                                    <th>Dia</th>
                                    <th>Fecha</th>
                                    <th>Hora de llegada</th>
                                    <th>Hora de salida</th>
                                    <th>Horas</th>
                                    <th>Turno</th>
                                    <th>Tipo</th>
                                    <th>Multas</th>
                                    <th>Actividades</th>
                                    <th>Estado</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador = 0; ?>
                                @foreach ($asistencias as $asistencia)
                                    <tr>
                                        <td><?php echo $contador = $contador + 1; ?></td>
                                        {{-- <td>{{ $asistencia->inscripciones->informacion->nombre_apellido }}</td> --}}
                                        <td>{{ $asistencia->fecha->translatedFormat('l') }}</td>
                                        <td>{{ $asistencia->fecha->translatedFormat('d-m-Y') }}</td>
                                        <td>{{ $asistencia->h_llegada }}</td>
                                        <td>{{ $asistencia->h_salida }}</td>
                                        <td>{{ $asistencia->horas }}</td>
                                        {{-- <td>{{ $asistencia->turno }}</td> --}}
                                        <td>
                                            @if ($asistencia->multa->turno == 1)
                                                <span class="badge bg-info"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">MAÑANA</font></font></span>
                                            @else
                                                <span class="badge bg-warning"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">TARDE</font></font></span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-warning"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $asistencia->asistencia }}sistencia</font></font></span>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">
                                                        {{ $asistencia->multa->nombre_multa }}
                                                    </font>
                                                </font>{{-- 
                                                <br>
                                                <select name="multa" class="form-select" style="margin-top: 5px;">
                                                    <option class="badge bg-light" value="ninguno" {{ $asistencia->multa->nombre_multa == 'ninguno' ? 'selected' : '' }}>ninguno</option>
                                                    <option class="badge bg-warning" value="cancelado1" {{ $asistencia->multa->nombre_multa == 'cancelado1' ? 'selected' : '' }}>cancelado1</option>
                                                    <option class="badge bg-success" value="cancelado2" {{ $asistencia->multa->nombre_multa == 'cancelado2' ? 'selected' : '' }}>cancelado2</option>
                                                    <option class="badge bg-info" value="cancelado3" {{ $asistencia->multa->nombre_multa == 'cancelado3' ? 'selected' : '' }}>cancelado3</option>
                                                    <option class="badge bg-primary" value="cancelado5" {{ $asistencia->multa->nombre_multa == 'cancelado5' ? 'selected' : '' }}>cancelado5</option>
                                                </select> --}}
                                            </span>
                                        </td>                                        
                                        <td>{{ $asistencia->actividad->nombre_actividad }}</td>
                                        <td>{{ $asistencia->estado }}</td>
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                {{-- <a href="{{ url('asistencias', $asistencia->id) }}" type="button"
                                                    class="btn btn-info"><i class="bi bi-eye"></i></a> --}}
                                                <a href="{{ route('asistencias.edit', $asistencia->id) }}" type="button"
                                                    class="btn btn-success"><i class="bi bi-pencil"></i></a>
                                                <form action="{{ url('asistencias', $asistencia->id) }}" method="POST">
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <script>
                            $(function() {
                                $("#example1").DataTable({
                                    "pageLength": 10,
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
        }

        .hora-academica {
            background-color: #eafaf1;
            color: #28a745;
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

        .table-m tbody tr:hover {
            background-color: #f1f1f1;
        }

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
            background-color: #3a6896;/* Celeste oscuro */
            border: none;
            box-shadow: 0 0 20px #3a6896;/* Sombra del efecto glowing */

            /* Animación de brillo */
            animation: glowing 1.5s infinite;

            /* Transiciones */
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .glowing-button:hover {
            background-color: #1f4b77;/* Cambia el color al pasar el mouse */
            box-shadow: 0 0 20px #1f4b77;/* Cambia la sombra al pasar el mouse */
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
@endsection
