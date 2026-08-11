<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión Administrativa | FaceBol</title>
    <link rel="icon" type="image/png" href="{{ asset('facebol.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('facebol.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('facebol.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('facebol.png') }}">
    <link rel="manifest" href="{{ asset('facebol.png') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Meta tag obligatorio -->

    <!-- Preconexión para optimización -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=swap">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery debe cargarse primero -->

    <!-- CSS personalizado -->
    <style>
        :root {
            --primary: #38347e;
            --secondary: #2b2763;
            --accent: #FF6584;
            --dark: #2F2E41;
            --light: #F8F9FA;
            --success: #28a745;
            --warning: #ffc107;
        }

        body {
            margin: 0;
            font-family: 'Source Sans Pro', sans-serif;
            background: url('imagenes/fondo_login.jpg') no-repeat center center fixed;
            background-size: cover;
            color: var(--dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .login-container {
            max-width: 600px;
            margin: 0 auto;
            animation: fadeIn 0.8s ease-out;
        }

        .login-wrapper {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            padding: 40px;
        }

        .login-logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-logo img {
            max-width: 150px;
            height: auto;
            border-radius: 50%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .login-logo img:hover {
            transform: scale(1.05);
        }

        .login-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 10px;
            text-align: center;
        }

        .login-subtitle {
            color: #666;
            text-align: center;
            margin-bottom: 30px;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark);
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.2);
        }

        .input-group {
            position: relative;
            display: flex;
            flex-wrap: wrap;
            align-items: stretch;
            width: 100%;
        }

        .input-group-append {
            margin-left: -1px;
            display: flex;
        }

        .input-group-text {
            display: flex;
            align-items: center;
            padding: 0.375rem 0.75rem;
            margin-bottom: 0;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            text-align: center;
            white-space: nowrap;
            background-color: #e9ecef;
            border: 2px solid #e0e0e0;
            border-left: none;
            border-radius: 0 8px 8px 0;
            cursor: pointer;
            transition: all 0.3s;
        }

        .input-group-text:hover {
            background-color: #dde0e3;
        }

        .btn {
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn i {
            margin-right: 8px;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--secondary);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 99, 255, 0.3);
        }

        .btn-success {
            background-color: var(--success);
            color: white;
        }

        .btn-success:hover {
            background-color: #218838;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        }

        .btn-warning {
            background-color: var(--warning);
            color: var(--dark);
        }

        .btn-warning:hover {
            background-color: #e0a800;
            color: var(--dark);
        }

        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: 8px;
            font-size: 0.875rem;
            color: #dc3545;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        /* Estilos para el formulario colapsable */
        .btn-toggle {
            position: relative;
            transition: all 0.3s ease;
            padding: 12px 20px;
            font-weight: 600;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        .btn-toggle:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .btn-toggle:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.3);
        }

        .toggle-icon {
            transition: transform 0.3s ease;
            margin-right: 8px;
        }

        .btn-toggle[aria-expanded="true"] .toggle-icon {
            transform: rotate(180deg);
        }

        .collapse-content {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 25px;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.05);
            border: 1px solid #e9ecef;
            animation: fadeIn 0.5s;
        }

        .input-upper {
            text-transform: uppercase;
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

        .animated {
            animation-duration: 0.5s;
        }
    </style>
    {{-- <script>
        import './bootstrap'; // Si usas Laravel Bootstrap
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script> --}}
</head>

<body>
    <div class="container login-container">
        <div class="login-wrapper">
            <div class="login-logo">
                <a href="{{ url('login') }}"><img src="{{ url('/dist/img/facebol.jpg') }}" alt="FaceBol S.R.L."></a>
            </div>

            <h1 class="login-title">Iniciar Sesión</h1>
            <p class="login-subtitle">Ingrese sus credenciales para continuar</p>

            @if (session('status'))
                <div class="alert alert-warning">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('mensaje'))
                <div class="alert alert-success">
                    {{ session('mensaje') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Correo Electronico</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <div class="input-group">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password">
                        <div class="input-group-append">
                            <span class="input-group-text" onclick="togglePassword()">
                                <i class="fas fa-eye" id="togglePasswordIcon"></i>
                            </span>
                        </div>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="6LenWmMrAAAAAKAas_wE8iAYSGfFS0jq19WHok8S"></div>
                    @error('g-recaptcha-response')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div> --}}

                <div class="form-group">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-sign-in-alt"></i> Iniciar sesión
                    </button>
                </div>
            </form>

            <!-- Botón y formulario colapsable -->
            {{-- <div class="mt-3">
                <button class="btn btn-success btn-toggle" type="button" data-bs-toggle="collapse"
                    data-bs-target="#tableCollapse" aria-expanded="false" aria-controls="tableCollapse">
                    <i class="fas fa-chevron-down toggle-icon"></i> Registre sus Datos
                </button>

                <div class="collapse" id="tableCollapse">
                    <div class="collapse-content mt-3 animated fadeIn">
                        <form action="{{ url('/informaciones') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre">Nombres <span class="text-danger">*</span></label>
                                        <input type="text" name="nombre" value="{{ old('nombre') }}"
                                            class="form-control input-upper" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="apellido_paterno">Apellido Paterno <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="apellido_paterno"
                                            value="{{ old('apellido_paterno') }}" class="form-control input-upper"
                                            required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="apellido_materno">Apellido Materno <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="apellido_materno"
                                                value="{{ old('apellido_materno') }}"
                                                class="form-control input-upper" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="celular">Celular <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" name="celular" value="{{ old('celular') }}"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="insti_univer">Institución<span
                                        class="text-danger">*</span></label>
                                <input type="text" name="insti_univer" value="{{ old('insti_univer') }}"
                                    class="form-control input-upper" required>
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="carrera">Área de Estudio<span class="text-danger">*</span></label>
                                        <input type="text" name="carrera" value="{{ old('carrera') }}"
                                            class="form-control input-upper" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="año">Nivel de Estudio<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="año" value="{{ old('año') }}"
                                            class="form-control input-upper" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="invitado_visita">Referencia / Visto en: <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="invitado_visita"
                                    value="{{ old('invitado_visita') }}" class="form-control input-upper"
                                    required>
                            </div>

                            <input type="hidden" name="formulario" value="1">

                            <div class="form-group text-right mt-4">
                                <a href="{{ url('/') }}" class="btn btn-secondary mr-2">
                                    <i class="fas fa-times"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Guardar registro
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> --}}


        </div>
    </div>

    <!-- Modal para sesión expirada (NUEVO - colócalo aquí) -->
            <div class="modal fade" id="sessionExpiredModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-warning">
                            <h5 class="modal-title">Sesión expirada <span class="countdown">5</span></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center py-4">
                            <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                            <p class="mb-3">Su sesión ha expirado por inactividad.</p>
                            <p>La página se recargará en <span class="countdown">5</span> segundos...</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" onclick="location.reload()">
                                <i class="fas fa-sync-alt"></i> Recargar ahora
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    
    
    {{-- <script>
        // Función para mostrar/ocultar contraseña
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const togglePasswordIcon = document.getElementById('togglePasswordIcon');
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;
            togglePasswordIcon.classList.toggle('fa-eye-slash');
            togglePasswordIcon.classList.toggle('fa-eye');
        }

        // Convertir automáticamente a mayúsculas mientras se escribe
        $(document).ready(function() {
            $('.input-upper').on('input', function() {
                this.value = this.value.toUpperCase();
            });

            // Animación del icono de toggle
            $('#tableCollapse').on('show.bs.collapse', function() {
                $(this).prev('.btn-toggle').find('.toggle-icon').css('transform', 'rotate(180deg)');
            });

            $('#tableCollapse').on('hide.bs.collapse', function() {
                $(this).prev('.btn-toggle').find('.toggle-icon').css('transform', 'rotate(0deg)');
            });
        });
    </script> --}}

    <!-- Versión mínima -->
        {{-- <div class="modal fade" id="sessionExpiredModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    Su sesión ha expirado. Recargando la página...
                </div>
            </div>
        </div>
        </div> --}}

    
        

    <script>
    // --- SECCIÓN MEJORADA (sin cambiar estructura) ---
    // Configuración CSRF para AJAX (debe ir primero)
    /* $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    // 1. Actualización de token CSRF más robusta (mismo código pero optimizado)
    const refreshCSRF = function() {
        $.get('/refresh-csrf')
         .done(function(data) {
            $('meta[name="csrf-token"]').attr('content', data.token);
            // Actualiza también los headers AJAX automáticamente
            $.ajaxSetup.headers.common['X-CSRF-TOKEN'] = data.token;
         })
         .fail(() => console.warn('Error al actualizar CSRF'));
    };

    // Intervalo más inteligente (30 min en lugar de 60)
    let csrfInterval = setInterval(refreshCSRF, 30 * 60 * 1000);
    
    // 2. Manejo de errores 419 mejorado (mismo código pero con reintento)
    $(document).ajaxError(function(event, jqxhr) {
        if(jqxhr.status === 419) {
            // Primero intenta refrescar el token
            refreshCSRF();
            
            // Luego muestra el modal y recarga
            $('#sessionExpiredModal').modal('show');
            setTimeout(() => {
                if (jqxhr.status === 419) { // Si persiste el error
                    location.reload();
                }
            }, 3000);
        }
    });

    // 3. Función togglePassword() optimizada (misma funcionalidad)
    function togglePassword() {
        const pwd = document.getElementById('password');
        const icon = document.getElementById('togglePasswordIcon');
        const isPassword = pwd.type === "password";
        
        pwd.type = isPassword ? "text" : "password";
        icon.classList.toggle("fa-eye", !isPassword);
        icon.classList.toggle("fa-eye-slash", isPassword);
    }

    // 4. Document ready optimizado (misma lógica)
    $(document).ready(function() {
        // Convertir a mayúsculas (mismo código)
        $('.input-upper').on('input', function() {
            this.value = this.value.toUpperCase();
        });

        // Animación del botón toggle (versión optimizada)
        const $collapse = $('#tableCollapse');
        $collapse.on('show.bs.collapse', () => {
            $collapse.prev('.btn-toggle').find('.toggle-icon').css('transform', 'rotate(180deg)');
        }).on('hide.bs.collapse', () => {
            $collapse.prev('.btn-toggle').find('.toggle-icon').css('transform', 'rotate(0deg)');
        });

        // Forzar tipo password (mismo código)
        document.getElementById('password').type = 'password';
        
        // Precargar token al iniciar (nueva optimización)
        refreshCSRF();
    });

    // Limpiar intervalo al salir (optimización adicional)
    $(window).on('beforeunload', () => clearInterval(csrfInterval)); */
    // Configuración mejorada de CSRF
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Función para refrescar el token CSRF
    function refreshCSRFToken() {
        return new Promise((resolve) => {
            $.get('/refresh-csrf-token').done(function(data) {
                $('meta[name="csrf-token"]').attr('content', data.token);
                $.ajaxSetup.headers.common['X-CSRF-TOKEN'] = data.token;
                resolve(true);
            }).fail(() => {
                console.error('Error al actualizar CSRF');
                resolve(false);
            });
        });
    }

    // Verificar estado de sesión cada 15 minutos
    const checkSessionInterval = setInterval(() => {
        $.get('/check-session').fail((jqxhr) => {
            if (jqxhr.status === 419) {
                handleSessionExpired();
            }
        });
    }, 15 * 60 * 1000); // 15 minutos

    // Manejar sesión expirada
    async function handleSessionExpired() {
        const refreshed = await refreshCSRFToken();
        if (!refreshed) {
            showSessionModal();
            setTimeout(() => location.reload(), 5000);
        }
    }

    // Mostrar modal de sesión expirada
    function showSessionModal() {
        const modal = $('#sessionExpiredModal');
        modal.modal('show');
        
        // Configurar cuenta regresiva
        let seconds = 5;
        const countdown = setInterval(() => {
            modal.find('.countdown').text(seconds);
            if (seconds-- <= 0) {
                clearInterval(countdown);
                location.reload();
            }
        }, 1000);
    }

    // Función para mostrar/ocultar contraseña
    function togglePassword() {
        const pwd = $('#password');
        const icon = $('#togglePasswordIcon');
        pwd.attr('type', (i, type) => type === 'password' ? 'text' : 'password');
        icon.toggleClass('fa-eye fa-eye-slash');
    }

    // Document ready
    $(function() {
        // Convertir a mayúsculas
        $('.input-upper').on('input', function() {
            this.value = this.value.toUpperCase();
        });

        // Precargar token al iniciar
        refreshCSRFToken();
        
        // Forzar tipo password al cargar
        $('#password').attr('type', 'password');
    });

    // Limpiar intervalo al salir
    $(window).on('beforeunload', () => clearInterval(checkSessionInterval));
</script>
</body>

</html>