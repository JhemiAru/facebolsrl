@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-id-card-alt mr-2"></i>Detalles de Asignación RFID
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('asignartarjetas.index') }}">Asignaciones RFID</a></li>
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
                        <i class="fas fa-info-circle mr-1"></i> Información de la Asignación
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Tarjeta RFID -->
                        <div class="col-md-6 mb-4">
                            <div class="info-card">
                                <label class="info-label">Código de Tarjeta RFID</label>
                                <div class="info-value">
                                    <span class="badge badge-primary p-2">
                                        <i class="fas fa-rss mr-2"></i>{{ $asignartarjeta->tarjeta->serie }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Pasante Asignado -->
                        <div class="col-md-6 mb-4">
                            <div class="info-card">
                                <label class="info-label">Pasante Asignado</label>
                                <div class="info-value">
                                    <i class="fas fa-user mr-2"></i>
                                    {{ $asignartarjeta->inscripcion->informacion->nombre }} 
                                    {{ $asignartarjeta->inscripcion->informacion->apellido_paterno }} 
                                    {{ $asignartarjeta->inscripcion->informacion->apellido_materno }}
                                </div>
                            </div>
                        </div>

                        <!-- Fecha de Asignación -->
                        <div class="col-md-6 mb-4">
                            <div class="info-card">
                                <label class="info-label">Fecha de Asignación</label>
                                <div class="info-value">
                                    <i class="far fa-calendar-alt mr-2"></i>
                                    {{ $asignartarjeta->created_at->format('d/m/Y H:i') }}
                                </div>
                            </div>
                        </div>

                        <!-- Estado -->
                        {{-- <div class="col-md-6 mb-4">
                            <div class="info-card">
                                <label class="info-label">Estado</label>
                                <div class="info-value">
                                    @if($asignartarjeta->estado)
                                        <span class="badge badge-success p-2"><i class="fas fa-check-circle mr-1"></i> Activo</span>
                                    @else
                                        <span class="badge badge-danger p-2"><i class="fas fa-times-circle mr-1"></i> Inactivo</span>
                                    @endif
                                </div>
                            </div>
                        </div> --}}
                    </div>

                    <hr class="my-4">

                    <!-- Botón de Regreso -->
                    <div class="row">
                        <div class="col-12 text-right">
                            <a href="{{ route('asignartarjetas.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left mr-1"></i> Volver al Listado
                            </a>
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
    .info-card {
        background-color: #f8f9fc;
        border-radius: 8px;
        padding: 20px;
        height: 100%;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .info-label {
        font-size: 14px;
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    .info-value {
        font-size: 16px;
        font-weight: 500;
        color: #343a40;
    }

    .card-header.bg-gradient-primary {
        background: linear-gradient(87deg, #4e73df 0, #224abe 100%) !important;
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

    .badge {
        font-size: 0.85rem;
        font-weight: 500;
        padding: 0.35em 0.65em;
    }
</style>
@endpush