@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-id-card-alt mr-2"></i>Asignación de Tarjetas RFID
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('asignartarjetas.index') }}">Tarjetas Asignadas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nueva Asignación</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-gradient-primary">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-plus-circle mr-1"></i> Registrar Nueva Asignación
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('asignartarjetas.store') }}" method="POST" id="asignacionForm">
                        @csrf
                        
                        <div class="form-row">
                            <!-- Selección de Tarjeta -->
                            <div class="form-group col-md-6">
                                <label for="id_tarjeta" class="font-weight-bold">Tarjeta RFID <span class="text-danger">*</span></label>
                                <select name="id_tarjeta" id="id_tarjeta" class="form-control select2 @error('id_tarjeta') is-invalid @enderror" required>
                                    <option value="">Seleccione una tarjeta</option>
                                    @foreach ($tarjetas as $tarjeta)
                                        <option value="{{ $tarjeta->id }}" {{ old('id_tarjeta') == $tarjeta->id ? 'selected' : '' }}>
                                            {{ $tarjeta->serie }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_tarjeta')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Seleccione el número de serie de la tarjeta</small>
                            </div>

                            <!-- Selección de Pasante -->
                            <div class="form-group col-md-6">
                                <label for="id_inscripcion" class="font-weight-bold">Pasante <span class="text-danger">*</span></label>
                                <select name="id_inscripcion" id="id_inscripcion" class="form-control select2 @error('id_inscripcion') is-invalid @enderror" required>
                                    <option value="">Seleccione un pasante</option>
                                    @foreach ($inscripcions as $inscripcion)
                                        <option value="{{ $inscripcion->id }}" {{ old('id_inscripcion') == $inscripcion->id ? 'selected' : '' }}>
                                            {{ $inscripcion->informacion->nombre }} 
                                            {{ $inscripcion->informacion->apellido_paterno }} 
                                            {{ $inscripcion->informacion->apellido_materno }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_inscripcion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Busque por nombre o apellido</small>
                            </div>
                        </div>

                        <hr class="mt-4 mb-4">

                        <!-- Botones de Acción -->
                        <div class="form-row">
                            <div class="form-group col-md-12 text-right">
                                <a href="{{ route('asignartarjetas.index') }}" class="btn btn-secondary mr-2">
                                    <i class="fas fa-times mr-1"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-1"></i> Guardar Asignación
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container .select2-selection--single {
        height: calc(2.25rem + 8px);
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 1.5;
        color: #495057;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: calc(2.25rem + 6px);
        right: 8px;
    }
    
    .select2-dropdown {
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    
    .select2-results__option {
        padding: 0.5rem 1rem;
    }
    
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #4e73df;
        color: white;
    }
    
    .select2-container--focus .select2-selection,
    .select2-container--open .select2-selection {
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    
    .card-header.bg-gradient-primary {
        background: linear-gradient(87deg, #4e73df 0, #224abe 100%) !important;
    }
    
    .form-control:disabled, .form-control[readonly] {
        background-color: #f8f9fc;
    }
</style>
@endpush

@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Inicializar Select2 para ambos selectores
        $('.select2').select2({
            placeholder: function() {
                return $(this).data('placeholder');
            },
            allowClear: true,
            width: '100%'
        });

        // Validación del formulario
        $('#asignacionForm').on('submit', function(e) {
            let tarjeta = $('#id_tarjeta').val();
            let pasante = $('#id_inscripcion').val();
            
            if (!tarjeta || !pasante) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Campos requeridos',
                    text: 'Debe seleccionar tanto la tarjeta como el pasante',
                });
            }
        });
    });
</script>
@endpush