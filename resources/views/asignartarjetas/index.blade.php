@php
    use Illuminate\Support\Facades\Session;
@endphp
@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1 class="text-center"><b>Bienvenido a la Administración de Tajetas RFID</b></h1>

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
                        <h3 class="card-title"><b>Inscritos y Registrados de Trajetas RFID</b></h3>
                        <div class="card-tools">
                            <a href="{{ url('/asignartarjetas/create') }}" class="btn btn-primary">
                                <i class="bi bi-file-plus"></i> Registrar y Asignar Nueva Tarjeta
                            </a>
                        </div>
                    </div>
                    <div class="card-body" style="...">

                        <table id="example1" class="table table-bordered table-striped table-m text-center">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Nombes Apellidos del Pasante</th>
                                    <th>Codigo de asignartarjeta RFID</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador = 0; ?>
                                @foreach ($asignartarjetas as $asignartarjeta)
                                    <tr>
                                        <td><?php echo $contador = $contador + 1; ?></td>
                                        {{-- <td> {{ $asignartarjeta->inscripcion->informacion->nombre }} {{ $asignartarjeta->inscripcion->informacion->apellido_paterno }} {{ $asignartarjeta->inscripcion->informacion->apellido_materno }} </td> --}}
                                        <td>
                                            @if($asignartarjeta->inscripcion && $asignartarjeta->inscripcion->informacion)
                                                {{ $asignartarjeta->inscripcion->informacion->nombre }}
                                                {{ $asignartarjeta->inscripcion->informacion->apellido_paterno }}
                                                {{ $asignartarjeta->inscripcion->informacion->apellido_materno }}
                                            @else
                                                <span class="text-muted">Sin información</span>
                                            @endif
                                        </td>
                                        <td>{{ $asignartarjeta->tarjeta?->serie ?? 'Sin asignar' }}</td>
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ url('asignartarjetas',$asignartarjeta->id) }}" type="button" class="btn btn-primary" ><i class="bi bi-eye"></i></a>
                                                {{-- <a href="{{ route('asignartarjetas.edit', $asignartarjeta->id) }}" type="button" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                                                <form action="{{ url('asignartarjetas',$asignartarjeta->id) }}" method="POST">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" onclick=" return confirm('Estas seguro de eliminar este registro?')" class="btn btn-danger" value="">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form> --}}
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
                                        "info": "Mostrando _START_ a _END_ de _TOTAL_ asignartarjetas",
                                        "infoEmpty": "Mostrando 0 a 0 de 0 asignartarjetas",
                                        "infoFiltered": "(Filtrado de _MAX_ total asignartarjetas)",
                                        "infoPostFix": "",
                                        "thousands": ",",
                                        "lengthMenu": "Mostrar _MENU_ asignartarjetas",
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
@endsection