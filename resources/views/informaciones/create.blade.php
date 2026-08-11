@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="h3 mb-0 text-gray-800">
                    <i class="fas fa-user-plus mr-2"></i>Nuevo Registro Académico
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/informaciones') }}">Registros</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Nuevo</li>
                    </ol>
                </nav>
            </div>
        </div>

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Error en el formulario!</h5>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
                        <h6 class="m-0 font-weight-bold text-white">
                            <i class="fas fa-file-alt mr-1"></i> Formulario de Registro
                        </h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/informaciones') }}" method="POST" id="formCrear">
                            @csrf
                            
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
                                                <label for="nombre">Nombres <span class="text-danger">*</span></label>
                                                <input type="text" name="nombre" id="nombre" 
                                                    value="{{ old('nombre') }}" 
                                                    class="form-control @error('nombre') is-invalid @enderror" 
                                                    required pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s.-]+" 
                                                    title="Solo se permiten letras, espacios y puntos."
                                                    oninput="this.value = this.value.toUpperCase()">
                                                @error('nombre')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="apellido_paterno">Apellido Paterno <span class="text-danger">*</span></label>
                                                <input type="text" name="apellido_paterno" id="apellido_paterno"
                                                    value="{{ old('apellido_paterno') }}"
                                                    class="form-control @error('apellido_paterno') is-invalid @enderror"
                                                    required pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s.-]+" 
                                                    title="Solo se permiten letras, espacios y puntos."
                                                    oninput="this.value = this.value.toUpperCase()">
                                                @error('apellido_paterno')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="apellido_materno">Apellido Materno <span class="text-danger">*</span></label>
                                                <input type="text" name="apellido_materno" id="apellido_materno"
                                                    value="{{ old('apellido_materno') }}"
                                                    class="form-control @error('apellido_materno') is-invalid @enderror"
                                                    required pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s.-]+" 
                                                    title="Solo se permiten letras, espacios y puntos."
                                                    oninput="this.value = this.value.toUpperCase()">
                                                @error('apellido_materno')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="celular">Celular <span class="text-danger">*</span></label>
                                                <input type="number" name="celular" id="celular"
                                                    value="{{ old('celular') }}" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Datos Académicos -->
                                <div class="col-md-6">
                                    <div class="card mb-4 border-left-info">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-info">
                                                <i class="fas fa-university mr-1"></i> Datos Académicos
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="insti_univer">Institución <span class="text-danger">*</span></label>
                                                <input type="text" name="insti_univer" id="insti_univer"
                                                    value="{{ old('insti_univer') }}"
                                                    class="form-control @error('insti_univer') is-invalid @enderror" required
                                                    pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s.-]+" 
                                                    title="Solo se permiten letras y espacios."
                                                    oninput="this.value = this.value.toUpperCase()">
                                                @error('insti_univer')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="carrera">Área de Estudio <span class="text-danger">*</span></label>
                                                <input type="text" name="carrera" id="carrera"
                                                    value="{{ old('carrera') }}"
                                                    class="form-control @error('carrera') is-invalid @enderror" required
                                                    pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" 
                                                    title="Solo se permiten letras y espacios."
                                                    oninput="this.value = this.value.toUpperCase()">
                                                @error('carrera')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="año">Nivel de Estudio <span class="text-danger">*</span></label>
                                                <select name="año" id="año" class="form-control @error('año') is-invalid @enderror" required>
                                                    <option value="">Seleccione un nivel</option>
                                                    <option value="PRIMER AÑO" {{ old('año') == 'PRIMER AÑO' ? 'selected' : '' }}>PRIMER AÑO</option>
                                                    <option value="SEGUNDO AÑO" {{ old('año') == 'SEGUNDO AÑO' ? 'selected' : '' }}>SEGUNDO AÑO</option>
                                                    <option value="TERCER AÑO" {{ old('año') == 'TERCER AÑO' ? 'selected' : '' }}>TERCER AÑO</option>
                                                    <option value="CUARTO AÑO" {{ old('año') == 'CUARTO AÑO' ? 'selected' : '' }}>CUARTO AÑO</option>
                                                    <option value="QUINTO AÑO" {{ old('año') == 'QUINTO AÑO' ? 'selected' : '' }}>QUINTO AÑO</option>
                                                    <option value="PRIMER SEMESTRE" {{ old('año') == 'PRIMER SEMESTRE' ? 'selected' : '' }}>PRIMER SEMESTRE</option>
                                                    <option value="SEGUNDO SEMESTRE" {{ old('año') == 'SEGUNDO SEMESTRE' ? 'selected' : '' }}>SEGUNDO SEMESTRE</option>
                                                    <option value="TERCER SEMESTRE" {{ old('año') == 'TERCER SEMESTRE' ? 'selected' : '' }}>TERCER SEMESTRE</option>
                                                    <option value="CUARTO SEMESTRE" {{ old('año') == 'CUARTO SEMESTRE' ? 'selected' : '' }}>CUARTO SEMESTRE</option>
                                                    <option value="QUINTO SEMESTRE" {{ old('año') == 'QUINTO SEMESTRE' ? 'selected' : '' }}>QUINTO SEMESTRE</option>
                                                    <option value="SEXTO SEMESTRE" {{ old('año') == 'SEXTO SEMESTRE' ? 'selected' : '' }}>SEXTO SEMESTRE</option>
                                                    <option value="SEPTIMO SEMESTRE" {{ old('año') == 'SEPTIMO SEMESTRE' ? 'selected' : '' }}>SEPTIMO SEMESTRE</option>
                                                    <option value="OCTAVO SEMESTRE" {{ old('año') == 'OCTAVO SEMESTRE' ? 'selected' : '' }}>OCTAVO SEMESTRE</option>
                                                    <option value="NOVENO SEMESTRE" {{ old('año') == 'NOVENO SEMESTRE' ? 'selected' : '' }}>NOVENO SEMESTRE</option>
                                                    <option value="DECIMO SEMESTRE" {{ old('año') == 'DECIMO SEMESTRE' ? 'selected' : '' }}>DECIMO SEMESTRE</option>
                                                    <option value="EGRESADO/A" {{ old('año') == 'EGRESADO/A' ? 'selected' : '' }}>EGRESADO/A</option>
                                                    <option value="LICENCIADO/A" {{ old('año') == 'LICENCIADO/A' ? 'selected' : '' }}>LICENCIADO/A</option>
                                                    <option value="INGENIERO/A" {{ old('año') == 'INGENRIERO/A' ? 'selected' : '' }}>INGENRIERO/A</option>
                                                    <option value="TECNICO SUPERIOR" {{ old('año') == 'TECNICO SUPERIOR' ? 'selected' : '' }}>TECNICO SUPERIOR</option>
                                                    <option value="TECNICO MEDIO" {{ old('año') == 'TECNICO MEDIO' ? 'selected' : '' }}>TECNICO MEDIO</option>
                                                </select>
                                                @error('año')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="invitado_visita">Referencia <span class="text-danger">*</span></label>
                                                <input type="text" name="invitado_visita" id="invitado_visita"
                                                    value="{{ old('invitado_visita') }}"
                                                    class="form-control @error('invitado_visita') is-invalid @enderror" required
                                                    pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" 
                                                    title="Solo se permiten letras y espacios."
                                                    oninput="this.value = this.value.toUpperCase()">
                                                @error('invitado_visita')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <input type="hidden" name="formulario" value="0">
                            
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ url('/informaciones') }}" class="btn btn-secondary mr-2">
                                        <i class="fas fa-times mr-1"></i> Cancelar
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save mr-1"></i> Guardar Registro
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

@section('js')
<script>
    // Validación antes de enviar el formulario
    document.getElementById('formCrear').addEventListener('submit', function(e) {
        // Validar celular peruano (9 dígitos)
        const celular = document.getElementById('celular').value;
        if (celular.length !== 9) {
            alert('El celular debe tener 9 dígitos');
            e.preventDefault();
            return false;
        }
        
        // Mostrar confirmación
        if(!confirm('¿Está seguro que desea crear este registro?')) {
            e.preventDefault();
        }
    });

    // Auto-mayúsculas para todos los campos de texto
    document.querySelectorAll('input[type="text"]').forEach(input => {
        input.addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });
    });

    // Validación en tiempo real para campos numéricos
    document.getElementById('celular').addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>
@endsection

@section('css')
<style>
    .card-header.bg-primary {
        background-color: #4e73df !important;
    }
    .border-left-primary {
        border-left: 0.25rem solid #4e73df !important;
    }
    .border-left-info {
        border-left: 0.25rem solid #36b9cc !important;
    }
    .required-field::after {
        content: " *";
        color: red;
    }
    .form-control.is-invalid {
        border-color: #e74a3b;
    }
    .invalid-feedback {
        color: #e74a3b;
        font-size: 0.875rem;
    }
</style>
@endsection