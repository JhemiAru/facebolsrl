@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-id-card mr-2"></i>Detalles de la Inscripción
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('inscripciones.index') }}">Inscripciones</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detalles</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-info-circle mr-1"></i> Información del Pasante
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Foto del usuario -->
                        <div class="col-md-3 text-center mb-4">
                            <div class="profile-picture-container">
                                 <img src="{{ $inscripcion->users->foto ? asset($inscripcion->users->foto) : asset('fotos/foto_principal.jpg') }}"
                                        class="img-thumbnail rounded-circle" style="width: 190px; height: 190px; border-radius: 50%; border: 2px solid #007bff; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);" id="previewFoto"><hr>
                                <div class="status-badge {{ $inscripcion->estado ? 'badge-success' : 'badge-danger' }}">
                                    {{ $inscripcion->estado ? 'Activo' : 'Inactivo' }}
                                </div>
                            </div>
                        </div>

                        <!-- Información principal -->
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="info-card">
                                        <label class="info-label">Fecha de Inscripción</label>
                                        <div class="info-value">{{ $inscripcion->f_inscripcion }}</div>
                                    </div>
                                </div>

                                <div class="col-md-8 mb-3">
                                    <div class="info-card">
                                        <label class="info-label">Nombre Completo</label>
                                        <div class="info-value">
                                            {{ $inscripcion->informacion->nombre }}
                                            {{ $inscripcion->informacion->apellido_paterno }} 
                                            {{ $inscripcion->informacion->apellido_materno }} 
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="info-card">
                                        <label class="info-label">Correo Electrónico</label>
                                        <div class="info-value">{{ $inscripcion->users->email }}</div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="info-card">
                                        <label class="info-label">Documento de Identidad</label>
                                        <div class="info-value">
                                            {{ $inscripcion->ci }} {{ $inscripcion->extension->expedido }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="info-card">
                                        <label class="info-label">Género</label>
                                        <div class="info-value">{{ $inscripcion->genero == 1 ? 'MASCULINO' : 'FEMENINO' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Información académica -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="info-card">
                                <label class="info-label">Recibos/Folio</label>
                                <div class="info-value">{{ $inscripcion->recibos }}</div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="info-card">
                                <label class="info-label">Porcentaje de Requisitos</label>
                                <div class="info-value">
                                    <div class="progress">
                                        <div class="progress-bar bg-{{ $inscripcion->porcentaje_requisitos >= 80 ? 'success' : ($inscripcion->porcentaje_requisitos >= 50 ? 'warning' : 'danger') }}" 
                                             role="progressbar" 
                                             style="width: {{ $inscripcion->porcentaje_requisitos }}%" 
                                             aria-valuenow="{{ $inscripcion->porcentaje_requisitos }}" 
                                             aria-valuemin="0" 
                                             aria-valuemax="100">
                                            {{ $inscripcion->porcentaje_requisitos }}%
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="info-card">
                                <label class="info-label">Dirección</label>
                                <div class="info-value">{{ $inscripcion->direccion }}</div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="info-card">
                                <label class="info-label">Código de Credencial</label>
                                <div class="info-value">
                                    <span class="badge badge-primary">{{ $inscripcion->codigo_credencial }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="info-card">
                                <label class="info-label">Generación</label>
                                <div class="info-value">{{ $inscripcion->generacion->generacion }}</div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="info-card">
                                <label class="info-label">Área</label>
                                <div class="info-value">{{ $inscripcion->area->nombre_area }}</div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Requisitos -->
                    <div class="card mb-4 border-left-info">
                        <div class="card-header py-3 bg-info">
                            <h6 class="m-0 font-weight-bold text-white">
                                <i class="fas fa-clipboard-check mr-1"></i> Requisitos
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Requisito</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($requisitos as $requisito)
                                            <tr>
                                                <td>{{ $requisito->requisito }}</td>
                                                <td>
                                                    @if(isset($asignarRequisitos[$requisito->id]))
                                                        <span class="badge badge-{{ $asignarRequisitos[$requisito->id]->estado == 1 ? 'success' : 'danger' }}">
                                                            {{ $asignarRequisitos[$requisito->id]->estado == 1 ? 'Entregado' : 'No entregado' }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-secondary">No especificado</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="row">
                        <div class="col-12 text-right">
                            <a href="{{ route('inscripciones.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left mr-1"></i> Volver
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    .badge-success {
        background-color: #28a745;
    }

    .badge-danger {
        background-color: #dc3545;
    }

    .info-card {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        height: 100%;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .info-label {
        font-size: 12px;
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 5px;
        text-transform: uppercase;
    }

    .info-value {
        font-size: 16px;
        font-weight: 500;
        color: #343a40;
    }

    .progress {
        height: 20px;
        border-radius: 10px;
    }

    .progress-bar {
        border-radius: 10px;
        font-size: 12px;
        line-height: 20px;
    }

    .card-header.bg-primary {
        background-color: #4e73df !important;
    }

    .card-header.bg-info {
        background-color: #36b9cc !important;
    }

    .border-left-info {
        border-left: 0.25rem solid #36b9cc !important;
    }
</style>
@endsection