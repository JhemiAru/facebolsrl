@php
    use Illuminate\Support\Facades\Session;
@endphp
@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1 class="text-center"><b>Bienvenido a la Administración de las Generaciónes</b></h1>

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
                            <a href="{{ url('/generaciones/create') }}" class="btn btn-primary">
                                <i class="bi bi-file-plus"></i>Crear Nueva Generación
                            </a>
                        </div>
                    </div>
                    <div class="card-body" style="...">

                        <table id="example1" class="table table-bordered table-striped table-m">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Generaciones</th>
                                    <th>Estado</th>
                                    <th>Año</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador = 0; ?>
                                @foreach ($generacions as $generacion)
                                    <tr>
                                        <td><?php echo $contador = $contador + 1; ?></td>
                                        <td style="text-align: center">{{ $generacion->generacion }}</td>
                                        <td style="text-align: center">
                                            {{-- <button class="btn btn-success btn-sm" style="border-radius: 20px">Activo</button> --}}
                                            @if ($generacion->estado == 0)
                                                <span class="badge badge-danger">Inactivo</span>
                                            @else
                                                <span class="badge badge-info">Activo</span>
                                            @endif
                                        </td>
                                        <td style="text-align: center">{{ $generacion->año }}</td>
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ url('generaciones', $generacion->id) }}" type="button" class="btn btn-info"><i class="bi bi-eye"></i></a>
                                                <a href="{{ route('generaciones.edit', $generacion->id) }}" type="button" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                                                <form action="{{ url('generaciones', $generacion->id) }}" method="POST">
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
                                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Generaciones",
                                        "infoEmpty": "Mostrando 0 a 0 de 0 Generaciones",
                                        "infoFiltered": "(Filtrado de _MAX_ total Generaciones)",
                                        "infoPostFix": "",
                                        "thousands": ",",
                                        "lengthMenu": "Mostrar _MENU_ Generaciones",
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
