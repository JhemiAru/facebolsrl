@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">
            <!-- Tarjeta Principal -->
            <div class="card shadow border-0 rounded-4 overflow-hidden">
                
                <!-- Header simplificado -->
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0 fw-semibold">
                        <i class="fas fa-user-circle me-2"></i>Perfil de Usuario
                    </h4>
                </div>

                <!-- Cuerpo del Perfil -->
                <div class="card-body p-4">
                    <form method="POST" action="{{ url('/usuarios', $usuario->id . '1') }}" 
                          enctype="multipart/form-data" id="profileForm">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <!-- Foto - Rediseñada con icono lateral -->
                            <div class="col-md-3 text-center mb-4 mb-md-0">
                                <div class="d-flex flex-column align-items-center">
                                    <!-- Contenedor de imagen con icono lateral -->
                                    <div class="d-flex align-items-start gap-3">
                                        <!-- Imagen clickeable para vista ampliada -->
                                        <div class="profile-wrapper" onclick="openFullView('{{ $usuario->foto && file_exists(public_path($usuario->foto)) ? asset($usuario->foto) : asset('fotos/foto_principal.jpg') }}')" style="cursor: pointer;">
                                            <img src="{{ $usuario->foto && file_exists(public_path($usuario->foto)) ? asset($usuario->foto) : asset('fotos/foto_principal.jpg') }}" 
                                                 alt="Foto"
                                                 class="profile-image rounded-circle border border-2 border-primary shadow-sm"
                                                 id="previewFoto"
                                                 width="120"
                                                 height="120"
                                                 title="Click para ver ampliada">
                                        </div>
                                        
                                        <!-- Icono de cambio lateral -->
                                        <div class="change-icon-wrapper" onclick="document.getElementById('fotoInput').click()" style="cursor: pointer;">
                                            <div class="change-icon-circle bg-primary text-white">
                                                <i class="fas fa-camera"></i>
                                                <span class="change-icon-tooltip">Cambiar foto</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Input oculto -->
                                    <input type="file" name="foto" 
                                           class="d-none" 
                                           id="fotoInput" 
                                           accept="image/*"
                                           onchange="previewImage(this)">
                                    
                                    <!-- Texto indicador -->
                                    <small class="text-muted d-block mt-3 small">
                                        <i class="fas fa-info-circle me-1"></i>Click en la imagen para ampliar
                                    </small>
                                </div>
                            </div>

                            <!-- Información -->
                            <div class="col-md-9">
                                <div class="row g-3">
                                    <!-- Nombre Completo -->
                                    <div class="col-12">
                                        <div class="bg-light p-3 rounded">
                                            <label class="text-primary small text-uppercase fw-semibold mb-2">
                                                <i class="fas fa-user me-1"></i>Nombre Completo
                                            </label>
                                            <div class="h5 fw-normal mb-0">
                                                {{ $usuario->inscripciones->informacion->nombre }}
                                                {{ $usuario->inscripciones->informacion->apellido_paterno }}
                                                {{ $usuario->inscripciones->informacion->apellido_materno }}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Credencial y Generación -->
                                    <div class="col-sm-6">
                                        <div class="bg-light p-3 rounded">
                                            <label class="text-primary small text-uppercase fw-semibold mb-2">
                                                <i class="fas fa-id-card me-1"></i>Credencial
                                            </label>
                                            <div class="fw-semibold">
                                                {{ $usuario->inscripciones->codigo_credencial }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="bg-light p-3 rounded">
                                            <label class="text-primary small text-uppercase fw-semibold mb-2">
                                                <i class="fas fa-calendar me-1"></i>Generación
                                            </label>
                                            <div class="fw-semibold">
                                                {{ $usuario->inscripciones->generacion->generacion }}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Área -->
                                    <div class="col-12">
                                        <div class="bg-light p-3 rounded">
                                            <label class="text-primary small text-uppercase fw-semibold mb-2">
                                                <i class="fas fa-building me-1"></i>Área
                                            </label>
                                            <div class="fw-semibold">
                                                {{ $usuario->inscripciones->area->nombre_area }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Línea divisoria -->
                        <hr class="my-4">

                        <!-- Cambiar Contraseña -->
                        <h5 class="fw-semibold mb-3">
                            <i class="fas fa-lock text-primary me-2"></i>Cambiar Contraseña
                        </h5>

                        <!-- Campos de Contraseña -->
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Nueva Contraseña</label>
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           placeholder="••••••••"
                                           oninput="checkPasswords()">
                                    <button class="btn btn-outline-secondary" 
                                            type="button"
                                            onclick="togglePassword('password', this)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div id="passwordStrength" class="small mt-1 fw-bold"></div>
                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Confirmar Contraseña</label>
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control @error('password_confirmation') is-invalid @enderror" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           placeholder="••••••••"
                                           oninput="checkPasswords()">
                                    <button class="btn btn-outline-secondary" 
                                            type="button"
                                            onclick="togglePassword('password_confirmation', this)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div id="passwordMatch" class="small mt-1"></div>
                                @error('password_confirmation')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Botones de Acción -->
                        <div class="d-flex gap-2 justify-content-end mt-4">
                            <button type="button" class="btn btn-outline-secondary px-4" onclick="resetForm()">
                                Cancelar
                            </button>
                            <button type="submit" class="btn btn-primary px-4" id="submitBtn">
                                Guardar Cambios
                                <span class="spinner-border spinner-border-sm d-none ms-1" id="submitSpinner"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para vista ampliada de la imagen -->
<div class="modal fade" id="fullImageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body text-center p-0">
                <div class="position-relative">
                    <img src="" alt="Foto ampliada" class="img-fluid rounded" id="fullImage" style="max-height: 80vh;">
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
// Función para abrir vista ampliada
function openFullView(imageSrc) {
    const modal = new bootstrap.Modal(document.getElementById('fullImageModal'));
    document.getElementById('fullImage').src = imageSrc;
    modal.show();
}

// Funciones para contraseñas
function togglePassword(fieldId, button) {
    const input = document.getElementById(fieldId);
    const icon = button.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

function checkPasswords() {
    const pass = document.getElementById('password').value;
    const confirm = document.getElementById('password_confirmation').value;
    const strengthDiv = document.getElementById('passwordStrength');
    const matchDiv = document.getElementById('passwordMatch');

    // Validar fuerza de contraseña - solo mostrar Débil, Media, Fuerte
    if (pass) {
        let strength = 0;
        if (pass.length >= 8) strength += 25;
        if (/[A-Z]/.test(pass)) strength += 25;
        if (/[0-9]/.test(pass)) strength += 25;
        if (/[^A-Za-z0-9]/.test(pass)) strength += 25;

        let message, color;
        if (strength < 50) {
            message = 'Débil';
            color = 'danger';
        } else if (strength < 75) {
            message = 'Media';
            color = 'warning';
        } else {
            message = 'Fuerte';
            color = 'success';
        }
        
        strengthDiv.innerHTML = `<span class="text-${color}">${message}</span>`;
    } else {
        strengthDiv.innerHTML = '';
    }

    // Validar coincidencia
    if (confirm) {
        if (pass === confirm) {
            matchDiv.innerHTML = '<span class="text-success"><i class="fas fa-check-circle me-1"></i>Coinciden</span>';
        } else {
            matchDiv.innerHTML = '<span class="text-danger"><i class="fas fa-exclamation-circle me-1"></i>No coinciden</span>';
        }
    } else {
        matchDiv.innerHTML = '';
    }
}

// Previsualizar imagen y actualizar vista ampliada
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const newImageSrc = e.target.result;
            document.getElementById('previewFoto').src = newImageSrc;
            // Actualizar también la imagen ampliada
            document.getElementById('fullImage').src = newImageSrc;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Reset del formulario
function resetForm() {
    if (confirm('¿Cancelar los cambios?')) {
        document.getElementById('profileForm').reset();
        const defaultImage = '{{ asset($usuario->foto ?? "fotos/foto_principal.jpg") }}';
        document.getElementById('previewFoto').src = defaultImage;
        document.getElementById('fullImage').src = defaultImage;
        document.getElementById('passwordStrength').innerHTML = '';
        document.getElementById('passwordMatch').innerHTML = '';
    }
}

// Spinner al enviar
document.getElementById('profileForm').addEventListener('submit', function(e) {
    document.getElementById('submitBtn').disabled = true;
    document.getElementById('submitSpinner').classList.remove('d-none');
});

// Cerrar modal con tecla ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('fullImageModal');
        const modalInstance = bootstrap.Modal.getInstance(modal);
        if (modalInstance) {
            modalInstance.hide();
        }
    }
});
</script>

<!-- Estilos -->
<style>
/* Foto de perfil - Layout con icono lateral */
.profile-wrapper {
    display: inline-block;
    transition: transform 0.2s ease;
}

.profile-wrapper:hover {
    transform: scale(1.02);
}

.profile-image {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border: 3px solid #fff;
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
}

.profile-image:hover {
    box-shadow: 0 6px 20px rgba(0,123,255,0.3);
}

/* Icono de cambio lateral */
.change-icon-wrapper {
    position: relative;
    margin-top: 5px;
}

.change-icon-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    position: relative;
}

.change-icon-circle:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 15px rgba(0,123,255,0.4);
}

/* Tooltip del icono */
.change-icon-tooltip {
    position: absolute;
    left: 50px;
    background: rgba(0,0,0,0.8);
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 12px;
    white-space: nowrap;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    pointer-events: none;
    z-index: 10;
}

.change-icon-circle:hover .change-icon-tooltip {
    opacity: 1;
    visibility: visible;
    left: 55px;
}

/* Modal de imagen ampliada */
.modal-content.bg-transparent {
    background: transparent !important;
}

.modal .btn-close-white {
    background-color: rgba(0,0,0,0.5);
    border-radius: 50%;
    padding: 10px;
    opacity: 0.8;
    transition: all 0.3s ease;
}

.modal .btn-close-white:hover {
    opacity: 1;
    transform: scale(1.1);
    background-color: rgba(0,0,0,0.7);
}

/* Tarjetas de información */
.bg-light {
    background-color: #f8f9fa !important;
    transition: all 0.2s ease;
    border-left: 3px solid transparent;
}

.bg-light:hover {
    background-color: #f1f3f5 !important;
    border-left-color: #007bff;
}

/* Responsive */
@media (max-width: 768px) {
    .profile-image {
        width: 100px;
        height: 100px;
    }
    
    .change-icon-circle {
        width: 35px;
        height: 35px;
        font-size: 16px;
    }
    
    .btn {
        width: 100%;
        margin-top: 0.5rem;
    }
    
    .d-flex.gap-2 {
        flex-direction: column-reverse;
    }
    
    .change-icon-tooltip {
        left: auto;
        right: 50px;
    }
    
    .change-icon-circle:hover .change-icon-tooltip {
        left: auto;
        right: 55px;
    }
}
</style>
@endsection