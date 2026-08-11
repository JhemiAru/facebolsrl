@php
    use Illuminate\Support\Facades\Session;
@endphp
@extends('layouts.admin')

@section('content')
<style>
    body {
        background: radial-gradient(ellipse at top, #0f2027 0%, #08141a 40%, #000 100%);
        color: #f1f5f9;
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
        overflow-x: hidden;
    }

    .content {
        margin-left: 10px;
        padding: 20px;
    }

    .text-center h1 {
        background: linear-gradient(135deg, #58a6ff 0%, #7ee787 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 30px;
        text-shadow: 0 4px 15px rgba(88, 166, 255, 0.3);
        padding: 20px 0;
    }

    .card {
        background: linear-gradient(145deg, rgba(20, 25, 35, 0.95) 0%, rgba(15, 20, 30, 0.98) 100%);
        border: 1px solid rgba(88, 166, 255, 0.2);
        border-radius: 20px;
        backdrop-filter: blur(20px);
        box-shadow: 
            0 20px 40px rgba(0, 0, 0, 0.6),
            0 8px 20px rgba(0, 0, 0, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        margin-bottom: 25px;
    }

    .card:hover {
        transform: translateY(-8px);
        box-shadow: 
            0 30px 60px rgba(0, 150, 255, 0.25),
            0 15px 30px rgba(0, 0, 0, 0.5),
            inset 0 1px 0 rgba(255, 255, 255, 0.15);
        border-color: rgba(88, 166, 255, 0.4);
    }

    .card-primary {
        border-top: 4px solid #58a6ff;
    }

    .card-header {
        background: linear-gradient(135deg, #1a365d 0%, #2d3748 100%) !important;
        border-bottom: 1px solid rgba(88, 166, 255, 0.3);
        padding: 25px 30px;
        position: relative;
        overflow: hidden;
    }

    .card-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(88, 166, 255, 0.1), transparent);
        transition: left 0.7s ease;
    }

    .card-header:hover::before {
        left: 100%;
    }

    .card-header h3 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #58a6ff;
        margin: 0;
        text-shadow: 0 2px 10px rgba(88, 166, 255, 0.3);
    }

    .btn-primary {
        background: linear-gradient(135deg, #238636 0%, #2ea043 50%, #3fb950 100%);
        border: none;
        border-radius: 50px;
        padding: 12px 25px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(46, 160, 67, 0.3);
    }

    .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.7s ease;
    }

    .btn-primary:hover::before {
        left: 100%;
    }

    .btn-primary:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 12px 30px rgba(46, 160, 67, 0.5);
        background: linear-gradient(135deg, #2ea043 0%, #3fb950 50%, #56d364 100%);
    }

    .table {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 15px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .table thead th {
        background: linear-gradient(135deg, #1a365d 0%, #2d3748 100%);
        color: #58a6ff !important;
        font-weight: 700;
        border: none;
        padding: 15px 10px;
        text-align: center;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table tbody td {
        background: rgba(255, 255, 255, 0.03);
        color: #e2e8f0 !important;
        border-color: rgba(255, 255, 255, 0.05);
        padding: 12px 10px;
        vertical-align: middle;
        transition: all 0.3s ease;
    }

    .table tbody tr:hover td {
        background: rgba(88, 166, 255, 0.1);
        transform: scale(1.02);
        color: #ffffff !important;
    }

    .table tbody tr {
        transition: all 0.3s ease;
    }

    .table tbody tr:hover {
        background: rgba(88, 166, 255, 0.05);
    }

    .btn-group .btn {
        border-radius: 10px;
        margin: 2px;
        transition: all 0.3s ease;
        border: none;
        font-weight: 600;
    }

    .btn-info {
        background: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 100%);
        color: white;
    }

    .btn-success {
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        color: white;
    }

    .btn-danger {
        background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
        color: white;
    }

    .btn-group .btn:hover {
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .dataTables_wrapper {
        color: #e2e8f0;
    }

    .dataTables_length,
    .dataTables_filter,
    .dataTables_info,
    .dataTables_paginate {
        color: #e2e8f0 !important;
    }

    .dataTables_filter input,
    .dataTables_length select {
        background: rgba(255, 255, 255, 0.1) !important;
        border: 1px solid rgba(255, 255, 255, 0.2) !important;
        border-radius: 10px;
        color: #ffffff !important;
        padding: 8px 12px;
    }

    .dataTables_filter input:focus,
    .dataTables_length select:focus {
        border-color: #58a6ff !important;
        box-shadow: 0 0 0 2px rgba(88, 166, 255, 0.2) !important;
    }

    .paginate_button {
        background: rgba(255, 255, 255, 0.1) !important;
        border: 1px solid rgba(255, 255, 255, 0.2) !important;
        color: #e2e8f0 !important;
        border-radius: 8px;
        margin: 2px;
        transition: all 0.3s ease;
    }

    .paginate_button:hover {
        background: rgba(88, 166, 255, 0.3) !important;
        border-color: #58a6ff !important;
        color: #ffffff !important;
        transform: translateY(-1px);
    }

    .paginate_button.current {
        background: linear-gradient(135deg, #58a6ff 0%, #7ee787 100%) !important;
        border-color: #58a6ff !important;
        color: #000000 !important;
        font-weight: 600;
    }

    .dt-button {
        background: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%) !important;
        border: none !important;
        border-radius: 10px !important;
        color: white !important;
        margin: 2px;
        transition: all 0.3s ease;
    }

    .dt-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(139, 92, 246, 0.4);
    }

    .table img {
        border: 2px solid #58a6ff;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(88, 166, 255, 0.3);
        transition: all 0.3s ease;
    }

    .table img:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 15px rgba(88, 166, 255, 0.5);
    }

    .btn-success.copy-btn {
        background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
        border: none;
        border-radius: 8px;
        padding: 6px 12px;
        font-size: 0.8rem;
        margin-top: 5px;
    }

    .btn-success.copy-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .text-center h1 {
            font-size: 2rem;
        }
        
        .card-header h3 {
            font-size: 1.4rem;
        }
        
        .table thead th {
            font-size: 0.8rem;
            padding: 10px 5px;
        }
        
        .table tbody td {
            padding: 8px 5px;
            font-size: 0.85rem;
        }
        
        .btn-group {
            display: flex;
            flex-direction: column;
        }
        
        .btn-group .btn {
            margin: 2px 0;
            width: 100%;
        }
    }

    /* Animaciones */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card, .table {
        animation: fadeIn 0.8s ease-out;
    }
</style>

    <div class="content">
        <h1 class="text-center"><b>Bienvenido a la Administración de las Lugar</b></h1>

        @if ($message = Session::get('mensaje'))
            <script>
                Swal.fire({
                    title: "Buen trabajo!",
                    text: "{{ $message }}",
                    icon: "success",
                    background: 'linear-gradient(145deg, rgba(20, 25, 35, 0.95) 0%, rgba(15, 20, 30, 0.98) 100%)',
                    color: '#ffffff',
                    confirmButtonColor: '#58a6ff'
                });
            </script>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Lugar Registradas</b></h3>
                        <div class="card-tools">
                            <a href="{{ url('/lugar/create') }}" class="btn btn-primary">
                                <i class="bi bi-file-plus"></i> Agregar nueva lugar
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                        <table id="example1" class="table table-bordered table-striped table-m">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Estado</th>
                                    <!-- <th>Ciudad</th> -->
                                    <th>Departamento</th>
                                    <th>Provincia</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador = 0; ?>
                                @foreach ($lugares as $lugar)
                                    <tr>
                                        <td><?php echo $contador = $contador + 1; ?></td>
                                        <td style="text-align: center">
                                            @if (strtoupper($lugar->estado == 0))
                                                <span class="badge badge-danger">Inactivo</span>
                                            @else
                                                <span class="badge badge-primary">Activo</span>
                                            @endif
                                        </td>
                                        <!-- <td>{{ strtoupper($lugar->ciudad) }}</td> -->
                                        <td>{{ strtoupper($lugar->departamento) }}</td>
                                        <td>{{ strtoupper($lugar->provincia) }}</td>
                                                             
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ url('lugar', $lugar->id) }}" type="button" class="btn btn-info" title="Ver">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('lugar.edit', $lugar->id) }}" type="button" class="btn btn-success" title="Editar">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ url('lugar', $lugar->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este registro?')" class="btn btn-danger" title="Eliminar">
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
                                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Lugar",
                                        "infoEmpty": "Mostrando 0 a 0 de 0 Lugar",
                                        "infoFiltered": "(Filtrado de _MAX_ total Lugar)",
                                        "infoPostFix": "",
                                        "thousands": ",",
                                        "lengthMenu": "Mostrar _MENU_ Lugar",
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
                            
                            function copiarUrl(texto) {
                                navigator.clipboard.writeText(texto).then(() => {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Copiado!',
                                        text: 'La URL se copió al portapapeles',
                                        timer: 1500,
                                        showConfirmButton: false,
                                        background: 'linear-gradient(145deg, rgba(20, 25, 35, 0.95) 0%, rgba(15, 20, 30, 0.98) 100%)',
                                        color: '#ffffff'
                                    });
                                }).catch(err => {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'No se pudo copiar la URL: ' + err,
                                        background: 'linear-gradient(145deg, rgba(20, 25, 35, 0.95) 0%, rgba(15, 20, 30, 0.98) 100%)',
                                        color: '#ffffff'
                                    });
                                });
                            }
                        </script>

                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection