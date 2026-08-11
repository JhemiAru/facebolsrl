@php
    use Illuminate\Support\Facades\Session;
@endphp
@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1 class="text-center"><b>Bienvenido a la Administración de Registro Administrativo</b></h1>

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
                        <div class="col-md-12">
                            <div class="info-box">
                                <div class="row align-items-center">
                                    <!-- Columna para el ícono de impresión -->
                                    <div class="col-md-1 col-3">
                                        <span class="info-box-icon bg-warning">
                                            <a href="{{ url('/inscripciones/pdf') }}" target="_blank">
                                                <i class="bi bi-printer-fill"></i>
                                            </a>
                                        </span>
                                    </div>
                                    
                                    <!-- Columna para el formulario -->
                                    <div class="col-md-7 col-12 mt-3 mt-md-0">
                                        <form action="{{ url('inscripciones/pdf_fechas') }}" method="GET" target="_blank" onsubmit="return validarFechas()">
                                            <div class="row">
                                                <div class="col-md-4 col-12 mb-2 mb-md-0">
                                                    <label for="">Fecha Inicio</label>
                                                    <input type="date" id="fechaInicio" name="fi" class="form-control">
                                                </div>
                                                <div class="col-md-4 col-12 mb-2 mb-md-0">
                                                    <label for="">Fecha Final</label>
                                                    <input type="date" id="fechaFinal" name="ff" class="form-control">
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div style="height: 37px;"></div>
                                                    <button type="submit" class="btn btn-success w-100">Generar Reporte</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    {{-- su script para generar reportes --}}
                                    <script>
                                        function validarFechas() {
                                            const fechaInicio = document.getElementById('fechaInicio').value;
                                            const fechaFinal = document.getElementById('fechaFinal').value;
                                    
                                            if (!fechaInicio || !fechaFinal) {
                                                alert('Por favor, seleccione ambas fechas: inicio y final.');
                                                return false; // evita el envío del formulario
                                            }
                                    
                                            return true; // permite el envío si ambas fechas están seleccionadas
                                        }
                                    </script>
                                    
                                    <!-- Columna para el botón de agregar -->
                                    <div class="col-md-4 col-12 text-end mt-3 mt-md-0">
                                        <div style="height: 37px;"></div>
                                        <a href="{{ url('/inscripciones/create') }}" class="btn btn-primary w-100 w-md-auto">
                                            <i class="bi bi-file-plus"></i> <b>Agregar Nuevo Registro</b>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="...">

                        <table  id="example1" class="table table-bordered table-striped table-m">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Estado</th>
                                    <th>Fecha de inscripción</th>
                                    <th>Nombres y Apellidos</th>
                                    <th>Correo</th>
                                    <th>CI</th>
                                    <th>Genero</th>
                                    <th>Recibo/Folio</th>
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
                                                <span class="badge bg-primary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Activo</font></font></span>
                                            @endif
                                        </td>
                                        {{-- <td style="text-align: center">
                                            <button class="btn btn-success btn-sm" style="border-radius: 20px">Activo</button>
                                        </td>--}}
                                        <td>{{ $inscripcion->f_inscripcion }}</td>
                                        <td>{{ $inscripcion->informacion->nombre }} {{ $inscripcion->informacion->apellido_paterno }} {{ $inscripcion->informacion->apellido_materno }} </td>
                                         <td>{{ $inscripcion->users?->email ?? 'Sin usuario' }}</td>
                                        {{-- <td>{{ $inscripcion->users->email }}</td>  --}}


                                        {{-- <td>{{ $inscripcion->users?->email ?? 'No disponible' }}</td> --}}

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
                                            @php
                                                $roles = $inscripcion->users?->getRoleNames();
                                            @endphp
                                            @if ($roles && !$roles->isEmpty())
                                                @foreach ($roles as $rol)
                                                <span class="badge bg-success" ><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $rol }}</font></font></span>
                                                @endforeach
                                            @else
                                                    <span class="badge badge-danger">Sin asignar</span>
                                            @endif
                                        </td>

                                       {{-- <td>
                                            @if (!$inscripcion->users?->getRoleNames()->isEmpty())
                                                @foreach ($inscripcion->users?->getRoleNames() as $rol)
                                                <span class="badge bg-success" ><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $rol }}</font></font></span>
                                                @endforeach
                                            @else
                                                    <span class="badge badge-danger">Sin asignar</span>
                                            @endif
                                        </td>--}}

                                        {{-- <td>
                                            @if ($inscripcion->users && !$inscripcion->users->getRoleNames()->isEmpty())
                                                @foreach ($inscripcion->users->getRoleNames() as $rol)
                                                    <span class="badge bg-success">{{ $rol }}</span>
                                                @endforeach
                                            @else
                                                <span class="badge badge-danger">Sin asignar</span>
                                            @endif
                                        </td> --}}
                                        


                                        {{-- <td>
                                            @php
                                                // Obtener los nombres de roles o una colección vacía si users o getRoleNames() es null
                                                $roles = $inscripcion->users?->getRoleNames() ?? collect();
                                            @endphp
                                        
                                            @if (!$roles->isEmpty())
                                                @foreach ($roles as $rol)
                                                <span class="badge bg-success" ><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $rol }}</font></font></span>
                                                @endforeach
                                            @else
                                                <span class="badge badge-danger">Sin asignar</span>
                                            @endif
                                        </td> --}}
                                        
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ url('inscripciones',$inscripcion->id) }}" type="button" class="btn btn-primary" ><i class="bi bi-eye"></i></a>
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
                                // Configuración optimizada de DataTables
                                var table = $("#example1").DataTable({
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
                                    "searching": true,
                                    "deferRender": true, // Diferir renderizado para mejor performance
                                    "processing": true, // Mostrar mensaje de procesamiento
                                    "serverSide": false, // Cambiar a true si implementas server-side processing
                                    "initComplete": function() {
                                        // Cargar botones después de inicializar la tabla
                                        this.api().buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                                    }
                                });

                                // Si tienes muchos registros, considera implementar server-side processing
                                // Necesitarías modificar el controlador para manejar peticiones AJAX
                            });
                        </script>

                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection