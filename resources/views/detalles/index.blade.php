@php
    use Illuminate\Support\Facades\Session;
@endphp
@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1 class="text-center"><b>Bienvenido a la Administración de Detalles</b></h1>

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
                        <div class="card-tools">
                            <a href="{{ url('/detalles/create') }}" class="btn btn-primary">
                                <i class="bi bi-file-plus"></i> Agregar Nuevo Detalle
                            </a>
                        </div>
                    </div>
                    <div class="card-body" style="...">

                        <table id="example1" class="table table-bordered table-striped table-m">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Area</th>
                                    <th>Programa</th>
                                    <th>Descripcion</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador = 0; ?>
                                @foreach ($detalles as $detalle)
                                    <tr>
                                        <td><?php echo $contador = $contador + 1; ?></td>
                                        <td>{{ $detalle->area->nombre_area }}</td>
                                        <td>{{ $detalle->programa->programa }}</td>
                                        <td>{{ $detalle->descripcion }}</td>

                                        <td style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ url('detalles', $detalle->id) }}" type="button" class="btn btn-info"><i class="bi bi-eye"></i></a>
                                                <a href="{{ route('detalles.edit', $detalle->id) }}" type="button" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                                                <form action="{{ url('detalles', $detalle->id) }}" method="POST">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" onclick=" return confirm('Estas seguro de eliminar este registro?')" class="btn btn-danger" value="">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>

                                        </td>
                                    </tr>
                                    {{-- <h1>{{ $miembro->nombre_apellido }}</h1>
                                    <h1>{{ $miembro->email }}</h1> --}}
                                @endforeach
                            </tbody>
                        </table>
                        <script>
                            $(function() {
                                $("#example1").DataTable({
                                    "pageLength": 10,
                                    "language": {
                                        "emptyTable": "No hay información",
                                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Áreas",
                                        "infoEmpty": "Mostrando 0 a 0 de 0 Áreas",
                                        "infoFiltered": "(Filtrado de _MAX_ total Áreas)",
                                        "infoPostFix": "",
                                        "thousands": ",",
                                        "lengthMenu": "Mostrar _MENU_ Áreas",
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
