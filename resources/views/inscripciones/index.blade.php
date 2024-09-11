@php
    use Illuminate\Support\Facades\Session;
@endphp
@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1 class="text-center"><b>Bienvenido a la Administración de Inscripciónes</b></h1>

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
                        <h3 class="card-title"><b>Inscritos Registrados</b></h3>
                        <div class="card-tools">
                            <a href="{{ url('/inscripciones/create') }}" class="btn btn-primary">
                                <i class="bi bi-file-plus"></i> <b>Agregar Nuevo Inscrito</b>
                            </a>
                        </div>
                    </div>
                    <div class="card-body" style="...">

                        <table  id="example1" class="table table-bordered table-striped table-m">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Estado</th>
                                    <th>Fecha de inscripcion</th>
                                    <th>Apellidos y Nombres del Pasante</th>
                                    <th>Correo</th>
                                    <th>CI</th>
                                    <th>Genero</th>
                                    <th>Recibos</th>
                                    <th>Porcentaje Requisito</th>
                                    <th>Codigo de Credencial</th>
                                    <th>Tipo de Roles</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador = 0; ?>
                                @foreach ($inscripcions as $inscripcion)
                                    <tr>
                                        <td><?php echo $contador = $contador + 1; ?></td>
                                        <td>
                                            @if ($inscripcion->estado == 0)
                                                <span class="badge bg-danger"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Inactivo</font></font></span>
                                            @else
                                                <span class="badge bg-info"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Activo</font></font></span>
                                            @endif
                                        </td>
                                        {{-- <td style="text-align: center">
                                            <button class="btn btn-success btn-sm" style="border-radius: 20px">Activo</button>
                                        </td>--}}
                                        <td>{{ $inscripcion->f_inscripcion }}</td>
                                        <td>{{ $inscripcion->informacion->apellido_paterno }} {{ $inscripcion->informacion->apellido_materno }} {{ $inscripcion->informacion->nombre }}</td>
                                        <td>{{ $inscripcion->users->email }}</td>
                                        <td>{{ $inscripcion->ci }} {{ $inscripcion->extension->expedido }}</td>

                                        {{-- <td>{{ $inscripcion->informacion->nombre_apellido }}</td> --}}
                                        @if ($inscripcion->genero == 1)
                                            <td>M</td>
                                        @else
                                            <td>F</td>
                                        @endif
                                        <td>{{ $inscripcion->recibos }}</td>
                                        <td>
                                            <span class="badge bg-warning" style="font-size: 1em;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $inscripcion->porcentaje_requisitos }}%</font></font></span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success" style="font-size: 1em;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $inscripcion->codigo_credencial }}</font></font></span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success" ><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $inscripcion->users->roles->name }}</font></font></span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ url('inscripciones',$inscripcion->id) }}" type="button" class="btn btn-info" ><i class="bi bi-eye"></i></a>
                                                <a href="{{ route('inscripciones.edit', $inscripcion->id) }}" type="button" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                                                <form action="{{ url('inscripciones',$inscripcion->id) }}" method="POST">
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
                                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Inscripciones",
                                        "infoEmpty": "Mostrando 0 a 0 de 0 Inscripciones",
                                        "infoFiltered": "(Filtrado de _MAX_ total Inscripciones)",
                                        "infoPostFix": "",
                                        "thousands": ",",
                                        "lengthMenu": "Mostrar _MENU_ Inscripciones",
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
