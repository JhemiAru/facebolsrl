@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-edit mr-2"></i>Actualización de Tarjeta RFID
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/tarjetas') }}">Tarjetas RFID</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-gradient-success">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-id-card-alt mr-1"></i> Editar Información de la Tarjeta
                    </h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/tarjetas', $tarjeta->id) }}" id="editarTarjetaForm">
                        @csrf
                        @method('PATCH')
                        
                        <div class="row">
                            <!-- Información de la Tarjeta -->
                            <div class="col-md-6">
                                <div class="card mb-4 border-left-primary">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">
                                            <i class="fas fa-qrcode mr-1"></i> Datos de la Tarjeta
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Número de Serie</label>
                                            <input type="text" class="form-control" value="{{ $tarjeta->serie }}" disabled>
                                            <small class="form-text text-muted">El número de serie no puede modificarse</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Estado de la Tarjeta -->
                            <div class="col-md-6">
                                <div class="card mb-4 border-left-info">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-info">
                                            <i class="fas fa-toggle-on mr-1"></i> Estado de la Tarjeta
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Estado Actual</label>
                                            <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                                                <label class="btn btn-outline-success {{ $tarjeta->estado == 1 ? 'active' : '' }}">
                                                    <input type="radio" name="estado" value="1" {{ $tarjeta->estado == 1 ? 'checked' : '' }}> 
                                                    <i class="fas fa-check-circle mr-1"></i> Activo
                                                </label>
                                                <label class="btn btn-outline-danger {{ $tarjeta->estado == 0 ? 'active' : '' }}">
                                                    <input type="radio" name="estado" value="0" {{ $tarjeta->estado == 0 ? 'checked' : '' }}> 
                                                    <i class="fas fa-times-circle mr-1"></i> Inactivo
                                                </label>
                                            </div>
                                            <small class="form-text text-muted">Seleccione el estado actual de la tarjeta</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr class="my-4">
                        
                        <!-- Botones de Acción -->
                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="{{ url('/tarjetas') }}" class="btn btn-secondary mr-2">
                                    <i class="fas fa-times mr-1"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save mr-1"></i> Actualizar Tarjeta
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .card-header.bg-gradient-success {
        background: linear-gradient(87deg, #1cc88a 0, #13855c 100%) !important;
    }
    
    .border-left-primary {
        border-left: 0.25rem solid #4e73df !important;
    }
    
    .border-left-info {
        border-left: 0.25rem solid #36b9cc !important;
    }
    
    .btn-group-toggle .btn {
        transition: all 0.3s ease;
    }
    
    .btn-group-toggle .btn-outline-success.active {
        background-color: #1cc88a;
        color: white;
    }
    
    .btn-group-toggle .btn-outline-danger.active {
        background-color: #e74a3b;
        color: white;
    }
    
    .btn-group-toggle .btn {
        padding: 0.5rem 1rem;
    }
    
    .form-control:disabled {
        background-color: #f8f9fc;
        opacity: 1;
    }
</style>
@endpush

@push('js')
<script>
    $(document).ready(function() {
        // Validación del formulario
        $('#editarTarjetaForm').on('submit', function(e) {
            let estado = $('input[name="estado"]:checked').val();
            
            if (estado === undefined) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Estado requerido',
                    text: 'Debe seleccionar un estado para la tarjeta',
                });
            }
        });
    });
</script>
@endpush