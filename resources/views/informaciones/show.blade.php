@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="h3 mb-0 text-gray-800">
                    <i class="fas fa-user-graduate mr-2"></i>Detalles del Registro Académico
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/informaciones') }}">Registros</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detalle</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-info-circle mr-1"></i> Información del Registro
                        </h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" 
                                 aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('informaciones.edit', $informacion->id) }}">
                                    <i class="fas fa-pencil-alt mr-2"></i>Editar
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Datos Personales -->
                            <div class="col-md-6">
                                <div class="card mb-4 border-left-primary">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">
                                            <i class="fas fa-user mr-1"></i> Datos Personales
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Nombre Completo:</label>
                                            <p class="form-control-static">
                                                {{ $informacion->nombre }} 
                                                {{ $informacion->apellido_paterno }} 
                                                {{ $informacion->apellido_materno }}
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Celular:</label>
                                            <p class="form-control-static">
                                                {{ $informacion->celular }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Datos Académicos -->
                            <div class="col-md-6">
                                <div class="card mb-4 border-left-success">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-success">
                                            <i class="fas fa-university mr-1"></i> Datos Académicos
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Institución:</label>
                                            <p class="form-control-static">
                                                {{ $informacion->insti_univer }}
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Área de Estudio:</label>
                                            <p class="form-control-static">
                                                {{ $informacion->carrera }}
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Año/Semestre:</label>
                                            <p class="form-control-static">
                                                {{ $informacion->año }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Información Adicional -->
                            <div class="col-12">
                                <div class="card border-left-info">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-info">
                                            <i class="fas fa-info-circle mr-1"></i> Información Adicional
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Referencia/Invitado por:</label>
                                            <p class="form-control-static">
                                                {{ $informacion->invitado_visita ?? 'No especificado' }}
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Fecha de Registro:</label>
                                            <p class="form-control-static">
                                                {{ $informacion->created_at->format('d/m/Y H:i') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="{{ url('/informaciones') }}" class="btn btn-secondary mr-2">
                                    <i class="fas fa-arrow-left mr-1"></i> Volver
                                </a>
                                <a href="{{ route('informaciones.edit', $informacion->id) }}" class="btn btn-primary">
                                    <i class="fas fa-edit mr-1"></i> Editar
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
        .form-control-static {
            padding: 0.375rem 0;
            margin-bottom: 0;
            min-height: calc(1.5em + 0.75rem + 2px);
            border-bottom: 1px solid #e3e6f0;
        }
        .card {
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        .border-left-primary {
            border-left: 0.25rem solid #4e73df !important;
        }
        .border-left-success {
            border-left: 0.25rem solid #1cc88a !important;
        }
        .border-left-info {
            border-left: 0.25rem solid #36b9cc !important;
        }
    </style>
@endsection