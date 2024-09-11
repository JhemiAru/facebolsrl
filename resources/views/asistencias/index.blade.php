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
                                    <th>Nro</th>
                                    <th>Informacion pasante</th>
                                    <th>Fecha de inscripcion</th>
                                    <th>Codigo de Credencial</th>
                                    <th>Generacion</th>
                                    <th>Area</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador = 0; ?>
                                @foreach ($inscripcions as $inscripcion)
                                    <tr>
                                        <td><?php echo $contador = $contador + 1; ?></td>
                                        <td>{{ $inscripcion->informacion->apellido_paterno }} {{ $inscripcion->informacion->apellido_materno }} {{ $inscripcion->informacion->nombre }}</td>
                                        <td>{{ $inscripcion->f_inscripcion }}</td>
                                        <td>{{ $inscripcion->codigo_credencial }}</td>
                                        <td>{{ $inscripcion->generacion->generacion }}</td>
                                        <td>{{ $inscripcion->area->nombre_area }}</td>
                                        <td class="center-text">
                                            <div class="btn-group btn-group-custom" role="group"
                                                aria-label="Basic example">
                                                <a href="{{ url('asistencias', $inscripcion->id) }}" type="button"
                                                    class="btn btn-info btn-custom glowing-button">
                                                    <i class="bi bi-eye"></i>
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
