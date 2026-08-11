@php
    use Illuminate\Support\Facades\Session;
@endphp
@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1 class="text-center"><b>Bienvenido a la Administración de Asistencias</b></h1>

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
                    {{-- <div class="card-header">
                        <h3 class="card-title"><b>Inscritos Registrados</b></h3>
                        <div class="card-tools">
                            <a href="{{ url('/inscripciones/create') }}" class="btn btn-primary">
                                <i class="bi bi-file-plus"></i> Agregar nuevo inscrito
                            </a>
                        </div>
                    </div> --}}
                    <div class="card-body" style="...">

                        <table id="example1" class="table table-bordered table-striped table-m text-center">
                            <thead>
                                <tr>
                                    {{-- <th>Nro</th> --}}
                                    <th>Estado</th>
                                    <th>Informacion pasante</th>
                                    <th>Fecha de inscripcion</th>
                                    <th>Turno</th>
                                    <th>Codigo de Credencial</th>
                                    <th>Generacion</th>
                                    <th>Area</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($inscripcions as $inscripcion)
                                    <tr>
                                        
                                        <td>
                                            @if ($inscripcion->estado == 0)
                                                <span class="badge bg-danger"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Inactivo</font></font></span>
                                            @else
                                                <span class="badge bg-primary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Activo</font></font></span>
                                            @endif
                                        </td>
                                        <td>{{ $inscripcion->informacion->nombre }}
                                            {{ $inscripcion->informacion->apellido_paterno }}
                                            {{ $inscripcion->informacion->apellido_materno }}
                                            </td>
                                        <td>{{ $inscripcion->f_inscripcion }}</td>
                                        <td>{{-- {{ $inscripcion->asistencias->first()->multa->turno ?? '' }} --}}
                                            @if ($inscripcion->asistencias->first()->multa->turno ?? '' == 1)
                                                <span class="badge bg-primary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">MAÑANA</font></font></span>
                                            @else
                                                <span class="badge bg-warning"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">TARDE</font></font></span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-success" style="font-size: -1em;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $inscripcion->codigo_credencial }}</font></font></span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success" style="font-size: -1em;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $inscripcion->generacion->generacion }}</font></font></span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success" style="font-size: -1em;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $inscripcion->area->nombre_area }}</font></font></span>
                                        </td>
                                        <td class="center-text">
                                            <div class="btn-group btn-group-custom" role="group"
                                                aria-label="Basic example">
                                                <a href="{{ url('asistencias', $inscripcion->id) }}" type="button"
                                                    class="btn btn-info btn-custom glowing-button">
                                                    <i class="bi bi-eye"></i> Ver Planillas
                                                </a>
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
                                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Asistencia",
                                        "infoEmpty": "Mostrando 0 a 0 de 0 Asistencia",
                                        "infoFiltered": "(Filtrado de _MAX_ total Asistencia)",
                                        "infoPostFix": "",
                                        "thousands": ",",
                                        "lengthMenu": "Mostrar _MENU_ Asistencia",
                                        "loadingRecords": "Cargando...",
                                        "processing": "Procesando...",
                                        "search": "Buscador:",
                                        "zeroRecords": "Sin resultados encontrados",
                                        "paginate": {
                                            "first": "Primero",
                                            "last": "Último",
                                            "next": "Siguiente",
                                            "previous": "Anterior"
                                        }
                                    },
                                    "responsive": true,
                                    "lengthChange": true,
                                    "autoWidth": false,
                                    "searching": true, // Habilitar búsqueda en todos los campos
                                    "order": [[2, 'desc']], // Ordenar por "Código de Credencial" (columna 4) en orden descendente
                                    "columnDefs": [{
                                        "targets": [2], // Índice de la columna "Código de Credencial"
                                        "orderable": true // Asegura que la columna sea ordenable
                                    }],
                                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                            });
                        </script>

                    </div>

                </div>

            </div>
        </div>

    </div>

    <style>
        .glowing-button {
            display: inline-block;
            padding: 8px 8px;
            font-size: 12px;
            font-weight: bold;
            text-decoration: none;
            text-align: center;
            border-radius: 8px;
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
@endsection
