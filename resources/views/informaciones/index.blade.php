@php
    use Illuminate\Support\Facades\Session;
@endphp
@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1 class="text-center"><b>Bienvenido a la Administración de Formulario de datos</b></h1>

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
                        <h3 class="card-title"><b>Inforamciones Registrados</b></h3>
                        <div class="card-tools">
                            <a href="{{ url('/informaciones/pdf') }}" class="btn btn-warning" target="_blank">
                                <i class="bi bi-printer-fill"></i> Imprimir Reporte
                            </a>
                            <a href="{{ url('/informaciones/create') }}" class="btn btn-primary">
                                <i class="bi bi-file-plus"></i> Agregar nueva informacion
                            </a>
                        </div>
                    </div>
                    <div class="card-body" style="...">

                        <table id="example1" class="table table-bordered table-striped table-m">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Nombres</th>
                                    <th>Apellido Paterno</th>
                                    <th>Apellido materno</th>
                                    <th>Celular</th>
                                    <th>Institución</th>
                                    <th>Área de Estudio</th>
                                    <th>Nivel de Estudio</th>
                                    <th>Referencia</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador = 0; ?>
                                @foreach ($informacions as $informacion)
                                    <tr>
                                        <td><?php echo $contador = $contador + 1; ?></td>
                                        <td>{{ $informacion->nombre }}</td>
                                        <td>{{ $informacion->apellido_paterno }}</td>
                                        <td>{{ $informacion->apellido_materno }}</td>
                                        <td>{{ $informacion->celular }}</td>
                                        <td>{{ $informacion->insti_univer }}</td>
                                        <td>{{ $informacion->carrera }}</td>
                                        <td>{{ $informacion->año }}</td>
                                        <td>{{ $informacion->invitado_visita }}</td>
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ url('informaciones', $informacion->id) }}" type="button"
                                                    class="btn btn-primary"><i class="bi bi-eye"></i></a>
                                                <a href="{{ route('informaciones.edit', $informacion->id) }}"
                                                    type="button" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                                                <form action="{{ url('informaciones', $informacion->id) }}" method="POST">
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
                                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Informacion",
                                        "infoEmpty": "Mostrando 0 a 0 de 0 Informacion",
                                        "infoFiltered": "(Filtrado de _MAX_ total Informacion)",
                                        "infoPostFix": "",
                                        "thousands": ",",
                                        "lengthMenu": "Mostrar _MENU_ Informacion",
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
                                    "searching": true, // Habilitar búsqueda en todos los campos
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
