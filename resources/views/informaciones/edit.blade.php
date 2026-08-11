@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="h3 mb-0 text-gray-800">
                    <i class="fas fa-edit mr-2"></i><b>Actualizar Registro De Formulario de Datos</b>
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/informaciones') }}">Registros</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editar</li>
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
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-success">
                        <h6 class="m-0 font-weight-bold text-white">
                            <i class="fas fa-pencil-alt mr-1"></i> Formulario de Actualización
                        </h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/informaciones', $informacion->id) }}" method="POST" id="formActualizar">
                            @csrf
                            @method('PATCH')
                            
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
                                                    value="{{ old('nombre', $informacion->nombre) }}" 
                                                    class="form-control @error('nombre') is-invalid @enderror" 
                                                    required oninput="this.value = this.value.toUpperCase()">
                                                @error('nombre')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="apellido_paterno">Apellido Paterno <span class="text-danger">*</span></label>
                                                <input type="text" name="apellido_paterno" id="apellido_paterno"
                                                    value="{{ old('apellido_paterno', $informacion->apellido_paterno) }}"
                                                    class="form-control @error('apellido_paterno') is-invalid @enderror"
                                                    oninput="this.value = this.value.toUpperCase()">
                                                @error('apellido_paterno')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="apellido_materno">Apellido Materno</label>
                                                <input type="text" name="apellido_materno" id="apellido_materno"
                                                    value="{{ old('apellido_materno', $informacion->apellido_materno) }}"
                                                    class="form-control @error('apellido_materno') is-invalid @enderror"
                                                    oninput="this.value = this.value.toUpperCase()">
                                                @error('apellido_materno')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="celular">Celular <span class="text-danger">*</span></label>
                                                <input type="number" name="celular" id="celular"
                                                    value="{{ old('celular', $informacion->celular) }}"
                                                    class="form-control @error('celular') is-invalid @enderror" required>
                                                @error('celular')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
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
                                                    value="{{ old('insti_univer', $informacion->insti_univer) }}"
                                                    class="form-control @error('insti_univer') is-invalid @enderror" required
                                                    oninput="this.value = this.value.toUpperCase()">
                                                @error('insti_univer')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="carrera">Área de Estudio <span class="text-danger">*</span></label>
                                                <input type="text" name="carrera" id="carrera"
                                                    value="{{ old('carrera', $informacion->carrera) }}"
                                                    class="form-control @error('carrera') is-invalid @enderror" required
                                                    oninput="this.value = this.value.toUpperCase()">
                                                @error('carrera')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            {{-- <div class="form-group">
                                                <label for="año">Nivel de Estudio <span class="text-danger">*</span></label>
                                                <input type="text" name="año" id="año"
                                                    value="{{ old('año', $informacion->año) }}"
                                                    class="form-control @error('año') is-invalid @enderror" required
                                                    oninput="this.value = this.value.toUpperCase()">
                                                @error('año')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div> --}}
                                            <div class="form-group">
                                                <label for="año">Nivel de Estudio <span class="text-danger">*</span></label>
                                                <select name="año" id="año" class="form-control @error('año') is-invalid @enderror" required>
                                                    <option value="">Seleccione un nivel</option>
                                                    <option value="PRIMER AÑO" {{ old('año', $informacion->año) == 'PRIMER AÑO' ? 'selected' : '' }}>PRIMER AÑO</option>
                                                    <option value="SEGUNDO AÑO" {{ old('año', $informacion->año) == 'SEGUNDO AÑO' ? 'selected' : '' }}>SEGUNDO AÑO</option>
                                                    <option value="TERCER AÑO" {{ old('año', $informacion->año) == 'TERCER AÑO' ? 'selected' : '' }}>TERCER AÑO</option>
                                                    <option value="CUARTO AÑO" {{ old('año', $informacion->año) == 'CUARTO AÑO' ? 'selected' : '' }}>CUARTO AÑO</option>
                                                    <option value="QUINTO AÑO" {{ old('año', $informacion->año) == 'QUINTO AÑO' ? 'selected' : '' }}>QUINTO AÑO</option>
                                                    <option value="PRIMER SEMESTRE" {{ old('año', $informacion->año) == 'PRIMER SEMESTRE' ? 'selected' : '' }}>PRIMER SEMESTRE</option>
                                                    <option value="SEGUNDO SEMESTRE" {{ old('año', $informacion->año) == 'SEGUNDO SEMESTRE' ? 'selected' : '' }}>SEGUNDO SEMESTRE</option>
                                                    <option value="TERCER SEMESTRE" {{ old('año', $informacion->año) == 'TERCER SEMESTRE' ? 'selected' : '' }}>TERCER SEMESTRE</option>
                                                    <option value="CUARTO SEMESTRE" {{ old('año', $informacion->año) == 'CUARTO SEMESTRE' ? 'selected' : '' }}>CUARTO SEMESTRE</option>
                                                    <option value="QUINTO SEMESTRE" {{ old('año', $informacion->año) == 'QUINTO SEMESTRE' ? 'selected' : '' }}>QUINTO SEMESTRE</option>
                                                    <option value="SEXTO SEMESTRE" {{ old('año', $informacion->año) == 'SEXTO SEMESTRE' ? 'selected' : '' }}>SEXTO SEMESTRE</option>
                                                    <option value="SEPTIMO SEMESTRE" {{ old('año', $informacion->año) == 'SEPTIMO SEMESTRE' ? 'selected' : '' }}>SEPTIMO SEMESTRE</option>
                                                    <option value="OCTAVO SEMESTRE" {{ old('año', $informacion->año) == 'OCTAVO SEMESTRE' ? 'selected' : '' }}>OCTAVO SEMESTRE</option>
                                                    <option value="NOVENO SEMESTRE" {{ old('año', $informacion->año) == 'NOVENO SEMESTRE' ? 'selected' : '' }}>NOVENO SEMESTRE</option>
                                                    <option value="DECIMO SEMESTRE" {{ old('año', $informacion->año) == 'DECIMO SEMESTRE' ? 'selected' : '' }}>DECIMO SEMESTRE</option>
                                                    <option value="EGRESADO/A" {{ old('año', $informacion->año) == 'EGRESADO/A' ? 'selected' : '' }}>EGRESADO/A</option>
                                                    <option value="LICENCIADO/A" {{ old('año', $informacion->año) == 'LICENCIADO/A' ? 'selected' : '' }}>LICENCIADO/A</option>
                                                    <option value="INGENIERO/A" {{ old('año', $informacion->año) == 'INGENRIERO/A' ? 'selected' : '' }}>INGENRIERO/A</option>
                                                    <option value="TECNICO SUPERIOR" {{ old('año', $informacion->año) == 'TECNICO SUPERIOR' ? 'selected' : '' }}>TECNICO SUPERIOR</option>
                                                    <option value="TECNICO MEDIO" {{ old('año', $informacion->año) == 'TECNICO MEDIO' ? 'selected' : '' }}>TECNICO MEDIO</option>
                                                </select>
                                                @error('año')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="invitado_visita">Referencia <span class="text-danger">*</span></label>
                                                <input type="text" name="invitado_visita" id="invitado_visita"
                                                    value="{{ old('invitado_visita', $informacion->invitado_visita) }}"
                                                    class="form-control @error('invitado_visita') is-invalid @enderror" required
                                                    oninput="this.value = this.value.toUpperCase()">
                                                @error('invitado_visita')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ url('/informaciones') }}" class="btn btn-secondary mr-2">
                                        <i class="fas fa-times mr-1"></i> Cancelar
                                    </a>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save mr-1"></i> Actualizar Registro
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
    document.getElementById('formActualizar').addEventListener('submit', function(e) {
        // Puedes agregar validaciones adicionales aquí si es necesario
        // Por ejemplo, verificar formato de celular, etc.
        
        // Mostrar confirmación
        if(!confirm('¿Está seguro que desea actualizar este registro?')) {
            e.preventDefault();
        }
    });

    // Auto-mayúsculas para todos los campos de texto
    document.querySelectorAll('input[type="text"]').forEach(input => {
        input.addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });
    });
</script>
@endsection

@section('css')
<style>
    .card-header.bg-success {
        background-color: #1cc88a !important;
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
</style>
@endsection