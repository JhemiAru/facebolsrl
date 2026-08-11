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
                    
                    <div class="card-body" style="...">

                        <table id="example1" class="table table-bordered table-striped table-m text-center">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Apellidos y Nombres del Pasantes</th>
                                    <th>Tarjetas</th>
                                    <th>Asignado</th>
                                    <th>Estado</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador = 0; ?>
                                @foreach ($tarjetas as $tarjeta)
                                    <tr>
                                        <td><?php echo $contador = $contador + 1; ?></td>
                                        
                                        {{-- <td>
                                            @if(isset($tarjeta->asignartarjeta[0]))
                                                {{ $tarjeta->asignartarjeta[0]->inscripcion->informacion->nombre }}
                                                {{ $tarjeta->asignartarjeta[0]->inscripcion->informacion->apellido_paterno }} 
                                                {{ $tarjeta->asignartarjeta[0]->inscripcion->informacion->apellido_materno }} 
                                            @else
                                                <span class="text-muted">Sin asignación</span>
                                            @endif
                                        </td> --}}
                                        <td>
                                            @if (isset($tarjeta->asignartarjeta[0]) && $tarjeta->asignartarjeta[0]->inscripcion && $tarjeta->asignartarjeta[0]->inscripcion->informacion)
                                                {{ $tarjeta->asignartarjeta[0]->inscripcion->informacion->apellido_paterno }}
                                                {{ $tarjeta->asignartarjeta[0]->inscripcion->informacion->apellido_materno }}
                                                {{ $tarjeta->asignartarjeta[0]->inscripcion->informacion->nombre }}
                                            @else
                                                <span class="text-muted">Sin asignación</span>
                                            @endif
                                        </td>
                                        
                                        <td >{{ $tarjeta->serie }}</td>
                                        <td >
                                            @if ($tarjeta->asignartarjeta->isEmpty())
                                                <span class="badge badge-danger">No asignado</span>
                                            @else
                                                <span class="badge badge-info">Asignado</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($tarjeta->estado == 0)
                                                <span class="badge bg-danger"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Inactivo</font></font></span>
                                            @else
                                                <span class="badge bg-primary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Activo</font></font></span>
                                            @endif
                                        </td>
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ url('tarjetas', $tarjeta->id) }}" type="button" class="btn btn-primary"><i class="bi bi-eye"></i></a>
                                                <a href="{{ route('tarjetas.edit', $tarjeta->id) }}" type="button" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                                                <form action="{{ url('tarjetas', $tarjeta->id) }}" method="POST">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" onclick=" return confirm('Estas seguro de eliminar este registro?')" class="btn btn-danger" value="">
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
                                    
                                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                            });
                        </script>

                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection



{{--  @php
    use Illuminate\Support\Facades\Session;
@endphp
@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-id-card-alt mr-2"></i>Administración de Tarjetas RFID
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tarjetas RFID</li>
                </ol>
            </nav>
        </div>
    </div>

    @if ($message = Session::get('mensaje'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle mr-2"></i> {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-gradient-primary">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-table mr-1"></i> Listado de Tarjetas
                    </h6>
                    <div class="card-tools">
                        <a href="{{ url('/tarjetas/create') }}" class="btn btn-light btn-sm float-right">
                            <i class="fas fa-plus-circle mr-1"></i> Nueva Tarjeta
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Filtros de búsqueda -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="searchSerie">Buscar por Serie</label>
                                <input type="text" class="form-control" id="searchSerie" placeholder="Número de serie">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="searchPasante">Buscar por Pasante</label>
                                <input type="text" class="form-control" id="searchPasante" placeholder="Nombre del pasante">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="searchEstado">Estado</label>
                                <select class="form-control" id="searchEstado">
                                    <option value="">Todos</option>
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="searchAsignacion">Asignación</label>
                                <select class="form-control" id="searchAsignacion">
                                    <option value="">Todos</option>
                                    <option value="1">Asignado</option>
                                    <option value="0">No asignado</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="tarjetasTable" class="table table-hover table-bordered" style="width:100%">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Pasante</th>
                                    <th>Serie</th>
                                    <th>Asignación</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tarjetas as $index => $tarjeta)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        @if(isset($tarjeta->asignartarjeta[0]))
                                            {{ $tarjeta->asignartarjeta[0]->inscripcion->informacion->apellido_paterno }} 
                                            {{ $tarjeta->asignartarjeta[0]->inscripcion->informacion->apellido_materno }} 
                                            {{ $tarjeta->asignartarjeta[0]->inscripcion->informacion->nombre }}
                                        @else
                                            <span class="text-muted">Sin asignación</span>
                                        @endif
                                    </td>
                                    <td>{{ $tarjeta->serie }}</td>
                                    <td>
                                        @if ($tarjeta->asignartarjeta->isEmpty())
                                            <span class="badge badge-danger">No asignado</span>
                                        @else
                                            <span class="badge badge-success">Asignado</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($tarjeta->estado == 0)
                                            <span class="badge badge-danger">Inactivo</span>
                                        @else
                                            <span class="badge badge-primary">Activo</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ url('tarjetas', $tarjeta->id) }}" 
                                               class="btn btn-info"
                                               data-toggle="tooltip"
                                               title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('tarjetas.edit', $tarjeta->id) }}" 
                                               class="btn btn-warning"
                                               data-toggle="tooltip"
                                               title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ url('tarjetas', $tarjeta->id) }}" 
                                                  method="POST" 
                                                  class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-danger"
                                                        data-toggle="tooltip"
                                                        title="Eliminar">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap4.min.css">
<style>
    .card-header.bg-gradient-primary {
        background: linear-gradient(87deg, #4e73df 0, #224abe 100%) !important;
    }
    
    .table thead th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
    
    .badge {
        font-size: 0.75rem;
        font-weight: 500;
        padding: 0.35em 0.65em;
    }
    
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
    
    .dataTables_wrapper .dataTables_info {
        font-size: 0.8rem;
    }
    
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 1rem;
    }
    
    .badge-danger {
        background-color: #e74a3b;
    }
    
    .badge-success {
        background-color: #1cc88a;
    }
    
    .badge-primary {
        background-color: #4e73df;
    }
    
    .badge-warning {
        background-color: #f6c23e;
    }
</style>
@endpush

@push('js')
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>

<script>
    $(document).ready(function() {
        // Inicializar DataTable
        var table = $('#tarjetasTable').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.11.4/i18n/es_es.json"
            },
            responsive: true,
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                 "<'row'<'col-sm-12'tr>>" +
                 "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [
                {
                    extend: 'collection',
                    text: '<i class="fas fa-download mr-1"></i> Exportar',
                    className: 'btn btn-sm btn-primary',
                    buttons: [
                        {
                            extend: 'copy',
                            text: '<i class="fas fa-copy mr-1"></i> Copiar',
                            className: 'btn-sm',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'excel',
                            text: '<i class="fas fa-file-excel mr-1"></i> Excel',
                            className: 'btn-sm',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'pdf',
                            text: '<i class="fas fa-file-pdf mr-1"></i> PDF',
                            className: 'btn-sm',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'print',
                            text: '<i class="fas fa-print mr-1"></i> Imprimir',
                            className: 'btn-sm',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'colvis',
                            text: '<i class="fas fa-columns mr-1"></i> Columnas',
                            className: 'btn-sm'
                        }
                    ]
                }
            ],
            columnDefs: [
                { orderable: false, targets: [5] },
                { className: "text-center", targets: [0, 3, 4, 5] }
            ],
            order: [[0, 'asc']],
            pageLength: 10,
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]]
        });

        // Filtros personalizados
        $('#searchSerie').keyup(function() {
            table.column(2).search(this.value).draw();
        });
        
        $('#searchPasante').keyup(function() {
            table.column(1).search(this.value).draw();
        });
        
        $('#searchEstado').change(function() {
            if (this.value === '') {
                table.column(4).search('').draw();
            } else {
                table.column(4).search(this.value == '1' ? 'Activo' : 'Inactivo').draw();
            }
        });
        
        $('#searchAsignacion').change(function() {
            if (this.value === '') {
                table.column(3).search('').draw();
            } else {
                table.column(3).search(this.value == '1' ? 'Asignado' : 'No asignado').draw();
            }
        });

        // Tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Confirmación para eliminar
        $('.delete-form').on('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Está seguro?',
                text: "Esta acción no se puede deshacer!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
</script>
@endpush --}}