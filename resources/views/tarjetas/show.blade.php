{{-- @extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1>Detalles de la Tarjeta RFID</h1><br>

        <div class="row">
            <div class="col-md-11">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Información de la Tarjeta</b></h3>
                    </div>
                    <div class="card-body" style="...">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="codigo">Codigo de la tarjeta</label>
                                    <input type="text" id="codigo" value="{{ $tarjeta->codigo }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombre_pasante">Nombre del Pasante</label>
                                    <input type="text" id="nombre_pasante" value="{{ $tarjeta->inscripcion->informacion->nombre_apellido }}" class="form-control" readonly>
                                </div>
                            </div>
                            
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <a href="{{ route('tarjetas.index') }}" class="btn btn-secondary">Regresar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}

@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-id-card-alt mr-2"></i>Detalles de Tarjeta RFID
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/tarjetas') }}">Tarjetas RFID</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detalles</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-gradient-primary">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-info-circle mr-1"></i> Información de la Tarjeta
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Información Básica -->
                        <div class="col-md-6">
                            <div class="card mb-4 border-left-primary">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-qrcode mr-1"></i> Datos Principales
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Número de Serie</label>
                                        <div class="form-control-plaintext">
                                            <span class="badge badge-primary p-2">
                                                <i class="fas fa-rss mr-1"></i>{{ $tarjeta->serie }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="font-weight-bold">Estado</label>
                                        <div class="form-control-plaintext">
                                            @if($tarjeta->estado)
                                                <span class="badge badge-success p-2">
                                                    <i class="fas fa-check-circle mr-1"></i> Activa
                                                </span>
                                            @else
                                                <span class="badge badge-danger p-2">
                                                    <i class="fas fa-times-circle mr-1"></i> Inactiva
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Información de Asignación -->
                        <div class="col-md-6">
                            <div class="card mb-4 border-left-info">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-info">
                                        <i class="fas fa-user-tag mr-1"></i> Asignación
                                    </h6>
                                </div>
                                <div class="card-body">
                                    @if($tarjeta->asignartarjeta->isNotEmpty())
                                        <div class="form-group">
                                            <label class="font-weight-bold">Pasante Asignado</label>
                                            <div class="form-control-plaintext">
                                                <i class="fas fa-user mr-1"></i>
                                                {{ $tarjeta->asignartarjeta[0]->inscripcion->informacion->apellido_paterno }} 
                                                {{ $tarjeta->asignartarjeta[0]->inscripcion->informacion->apellido_materno }} 
                                                {{ $tarjeta->asignartarjeta[0]->inscripcion->informacion->nombre }}
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="font-weight-bold">Fecha de Asignación</label>
                                            <div class="form-control-plaintext">
                                                <i class="far fa-calendar-alt mr-1"></i>
                                                {{ $tarjeta->asignartarjeta[0]->created_at->format('d/m/Y H:i') }}
                                            </div>
                                        </div>
                                    @else
                                        <div class="alert alert-warning">
                                            <i class="fas fa-exclamation-circle mr-1"></i> Esta tarjeta no está asignada a ningún pasante.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <!-- Botones de Acción -->
                    <div class="row">
                        <div class="col-12 text-right">
                            <a href="{{ url('/tarjetas') }}" class="btn btn-secondary mr-2">
                                <i class="fas fa-arrow-left mr-1"></i> Volver
                            </a>
                            @if($tarjeta->asignartarjeta->isEmpty())
                                <a href="{{ route('asignartarjetas.create') }}?tarjeta_id={{ $tarjeta->id }}" class="btn btn-primary">
                                    <i class="fas fa-id-card-alt mr-1"></i> Asignar Tarjeta
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .card-header.bg-gradient-primary {
        background: linear-gradient(87deg, #4e73df 0, #224abe 100%) !important;
    }
    
    .border-left-primary {
        border-left: 0.25rem solid #4e73df !important;
    }
    
    .border-left-info {
        border-left: 0.25rem solid #36b9cc !important;
    }
    
    .form-control-plaintext {
        padding: 0.5rem 0;
        margin-bottom: 0;
        line-height: 1.5;
        background-color: transparent;
        border: solid transparent;
        border-width: 1px 0;
    }
    
    .badge {
        font-size: 0.9rem;
        font-weight: 500;
        padding: 0.5em 0.8em;
    }
    
    .badge-primary {
        background-color: #4e73df;
    }
    
    .badge-success {
        background-color: #1cc88a;
    }
    
    .badge-danger {
        background-color: #e74a3b;
    }
    
    .alert-warning {
        background-color: #f6c23e;
        border-color: #f6c23e;
        color: #1f2d3d;
    }
</style>
@endpush
