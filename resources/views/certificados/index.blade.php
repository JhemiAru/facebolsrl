@php
    use Illuminate\Support\Facades\Session;
@endphp
@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1 class="text-center"><b>Bienvenido a la Administración de certificados</b></h1>

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
                        <h3 class="card-title"><b>Áreas Registrados</b></h3>
                        <div class="card-tools">
                            <a href="{{ url('/certificados/create') }}" class="btn btn-primary">
                                <i class="bi bi-file-plus"></i> Agregar nuevo certificado
                            </a>
                        </div>
                    </div> --}}
                    <div class="card-body" style="...">

                        <table id="example1" class="table table-bordered table-striped table-m text-center">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Meses</th>
                                    <th>Horas</th>
                                    <th>fecha_inicio</th>
                                    <th>fecha_fin</th>
                                    <th>fecha_entrega</th>
                                    <th>Programa</th>
                                    <th>Nombre y Apellido</th>
                                    <th>Acción</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador = 0; ?>
                                @foreach ($certificados as $certificado)
                                    <tr>
                                        <td><?php echo $contador = $contador + 1; ?></td>
                                        <td>{{ $certificado->meses }}</td>
                                        <td>{{ \Illuminate\Support\Str::before($certificado->horas, ':') }}</td>
                                        <td>{{ $certificado->fecha_inicio }}</td>
                                        <td>{{ $certificado->fecha_fin }}</td>
                                        <td>{{ $certificado->fecha_entrega }}</td>
                                        <td>{{ $certificado->detalle->programa->programa }}</td>
                                        <td>{{ $certificado->inscripcion->informacion->nombre }} {{ $certificado->inscripcion->informacion->apellido_materno }} {{ $certificado->inscripcion->informacion->apellido_paterno }}</td>


                                        <td style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ url('certificados', $certificado->id) }}" type="button" class="btn btn-info"><i class="bi bi-eye"></i></a>
                                                <a href="{{ route('certificados.edit', $certificado->id) }}" type="button" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                                                <a class="btn btn-sm btn-info" target="_blank"  href="{{ url('certificadopdf',$certificado->id) }}"><i class="fa fa-file-pdf"></i></a>
                                                <form action="{{ url('certificados', $certificado->id) }}" method="POST">
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
