@php
    use Illuminate\Support\Facades\Session;
@endphp
@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1 class="text-center"><b>Bienvenido a la Administración de Usuarios</b></h1>

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
                        {{-- {{ Auth::user()->role_has_permissions }} --}}
                        <table id="example1" class="table table-bordered table-striped table-m">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Nombres del usuario</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador = 0; ?>
                                @foreach ($usuarios as $usuario)
                                    <tr>
                                        <td>{{ ++$contador }}</td>
                                        <td>{{ $usuario->inscripciones->informacion->apellido_paterno }} {{ $usuario->inscripciones->informacion->apellido_materno }} {{ $usuario->inscripciones->informacion->nombre }}</td>
                                        <td>{{ $usuario->email }}</td>
                                        {{-- <td>{{ $usuario->roles }}</td> --}}
                                        <td style="text-align: center">
                                            @if ( $usuario->roles->name == true)
                                                <span class="badge badge-info">{{ $usuario->roles->name }}</span>
                                            @else
                                                <span class="badge badge-danger">No asignado</span>
                                            @endif
                                        </td>
                                        <td style="text-align: center">
                                            {{-- <a class="btn btn-warning" href="{{route('usuarios.edit', $usuario)}}">
                                                <i class="fa fa-user-secret"></i>
                                            </a> --}}
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ url('usuarios', $usuario->id) }}" type="button" class="btn btn-info">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                {{-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#updateUserModal" data-id="{{ $usuario->id }}" data-name="{{ $usuario->name }}" data-email="{{ $usuario->email }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button> --}}
                                                @include('usuarios.modal', [$usuario -> id])
                                                <form action="{{ url('usuarios', $usuario->id) }}" method="POST">
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
                                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
                                        "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
                                        "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
                                        "lengthMenu": "Mostrar _MENU_ Usuarios",
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
                                    buttons: [
                                        {
                                            extend: 'collection',
                                            text: 'Reportes',
                                            buttons: [
                                                { text: 'Copiar', extend: 'copy' },
                                                { extend: 'pdf' },
                                                { extend: 'csv' },
                                                { extend: 'excel' },
                                                { text: 'Imprimir', extend: 'print' }
                                            ]
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

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $('#updateUserModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id')
            var name = button.data('name')
            var email = button.data('email')

            var modal = $(this)
            modal.find('.modal-title').text('Actualizar Usuario: ' + name)
            modal.find('.modal-body input[name="name"]').val(name)
            modal.find('.modal-body input[name="email"]').val(email)

            var form = modal.find('form')
            form.attr('action', '/usuarios/' + id)
        })
    </script>
@endsection



