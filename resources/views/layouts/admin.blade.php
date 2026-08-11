@php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\URL;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

     <!-- Preconexión a recursos externos -->
   {{--  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net"> --}}

    <title>Gestión Administrativa | FaceBolito</title>
    <link rel="icon" type="image/png" href="{{ asset('facebol.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('facebol.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('facebol.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('facebol.png') }}">
    <link rel="manifest" href="{{ asset('facebol.png') }}">

    
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/all.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0') }}">

    <!-- Animate -->
    <link rel="stylesheet" href="{{ asset('vendor/animate/css/animate.min.css') }}">

    <!-- Ionicons (desde CDN) -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0') }}">
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    {{-- iconos de bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
     <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=swap" rel="stylesheet">
    {{-- JQuery --}}
    <script src="{{ asset('/plugins/jquery/jquery.js') }}"></script>
    {{-- datetables --}}
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    {{-- sweetalert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- ckeditor para el text area --}}
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>

    {{--  bootstrap --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css') }}"> --}}

    <!-- Incluye los estilos de Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Incluye los estilos de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    
    
    <!-- bootstrap -->
    {{-- <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css') }}" rel="stylesheet"> --}}
    <!-- Agregar el CSS de Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    
    <!-- Usando Bootstrap 5.3.0-alpha1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

   <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @livewireStyles
    <style>
        :root {
            --primary-color: #3f455a;
            --secondary-color: #4e73df;
            --accent-color: #f8f9fa;
            --text-dark: #343a40;
            --text-light: #cdd1d6;
            --sidebar-width: 250px;
        }
        
        
        /* Pie de página */
        .main-footer {
            background-color: #f4f6f9;
            color: rgb(49, 48, 48);
            padding: 1rem;
            font-size: 0.9rem;
        }
        

/* ========== MODO OSCURO OPTIMIZADO ========== */
/* Transiciones SOLO en elementos específicos, no globales */

/* Solo transición en el body (fondo y texto principal) */
body {
    transition: background-color 0.2s ease, color 0.2s ease;
}

/* Navbar - transición solo en elementos clave */
.navbar,
.navbar * {
    transition: background-color 0.2s ease, border-color 0.2s ease;
}

/* Tarjetas */
.card {
    transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease;
}

/* Tablas */
.table,
.table th,
.table td {
    transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease;
}

/* Formularios */
.form-control {
    transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease;
}

/* ========== ESTILOS MODO OSCURO (SIN TRANSICIONES AQUÍ) ========== */

/* Fondo general - INMEDIATO */
body.dark-mode {
    background-color: #0f172a !important;
    color: #e2e8f0 !important;
}

/* Navbar en modo oscuro - INMEDIATO */
.dark-mode .main-header.navbar {
    background-color: #1e293b !important;
    border-bottom-color: #334155 !important;
}

.dark-mode .navbar-nav .nav-link {
    color: #cbd5e1 !important;
}

.dark-mode .navbar-nav .nav-link.text-dark {
    color: #ffffff !important;
}

.dark-mode .navbar-nav .nav-link.text-dark .text-warning {
    color: #fbbf24 !important;
}

/* Botón de tema específico */
#theme-toggle .fa-sun {
    color: #f59e0b; /* Naranja suave para el sol */
}

#theme-toggle .fa-moon {
    color: #94a3b8; /* Gris para la luna */
}

.dark-mode #theme-toggle .fa-sun {
    color: #fbbf24 !important;
    text-shadow: 0 0 8px rgba(251, 191, 36, 0.4);
}

/* Botón pantalla completa */
#fullscreen-btn i {
    color: inherit;
}

.dark-mode #fullscreen-btn i {
    color: #94a3b8 !important;
}

/* Dropdown de usuario */
.dark-mode .dropdown-menu {
    background-color: #1e293b !important;
    border-color: #334155 !important;
}

.dark-mode .dropdown-item {
    color: #cbd5e1 !important;
}

/* Tarjetas - INMEDIATO */
.dark-mode .card:not(.bg-light):not(.bg-white) {
    background-color: #1e293b !important;
    color: #e2e8f0 !important;
    border-color: #334155 !important;
}

.dark-mode .card-header {
    background-color: #0f172a !important;
    color: #ffffff !important;
    border-bottom-color: #334155 !important;
}

/* Tablas - INMEDIATO */
.dark-mode .table:not(.table-light):not(.table-striped) {
    background-color: #1e293b !important;
    color: #e2e8f0 !important;
    border-color: #334155 !important;
}

.dark-mode .table th {
    background-color: #0f172a !important;
    color: #94a3b8 !important;
    border-color: #334155 !important;
}

.dark-mode .table td {
    border-color: #334155 !important;
    color: #cbd5e1 !important;
}

/* Formularios - INMEDIATO */
.dark-mode .form-control:not(.form-control-light) {
    background-color: #1e293b !important;
    color: #e2e8f0 !important;
    border-color: #475569 !important;
}

.dark-mode .form-control:not(.form-control-light):focus {
    background-color: #1e293b !important;
    color: #ffffff !important;
    border-color: #3b82f6 !important;
}

.dark-mode .form-label {
    color: #cbd5e1 !important;
}

/* Botones generales */
.dark-mode .btn:not(.btn-primary):not(.btn-success):not(.btn-danger):not(.btn-warning):not(.btn-info) {
    background-color: #334155 !important;
    color: #e2e8f0 !important;
    border-color: #475569 !important;
}

.dark-mode .btn-primary {
    background-color: #3b82f6 !important;
    border-color: #3b82f6 !important;
}

/* Enlaces generales */
.dark-mode a:not(.btn):not(.dropdown-item):not(.nav-link) {
    color: #60a5fa !important;
}

/* Scrollbar - sin transición */
.dark-mode ::-webkit-scrollbar-track {
    background: #1e293b;
}

.dark-mode ::-webkit-scrollbar-thumb {
    background: #475569;
}

/* ========== CLASE PARA TRANSICIONES RÁPIDAS ========== */
/* Se aplica temporalmente durante el cambio */
.theme-changing * {
    transition: background-color 0.15s ease-out, 
                border-color 0.15s ease-out, 
                color 0.15s ease-out !important;
}




        
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

    @if (!auth()->check())
        @php
            header('Location: ' . URL::to('/login'));
            exit();
        @endphp
    @else
    <div class="wrapper">

        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('dist/img/facebol.jpg') }}" alt="facebol" height="60"
                width="60" loading="lazy">
        </div> --}}
        <div class="preloader flex-column justify-content-center align-items-center" id="preloader">
            <img class="animation__shake" src="{{ asset('dist/img/facebol.jpg') }}" alt="facebol" height="60" width="60">
        </div>
        
        {{-- <script>
            window.addEventListener('load', () => {
                setTimeout(() => {
                    document.getElementById('preloader').style.display = 'none';
                }, 1000); // Espera 1 segundo y luego oculta el preloader
            });
        </script> --}}
        

             <!-- Barra de navegación superior -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm">

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                            <i class="fas fa-bars"></i>
                        </a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ url('/') }}" class="nav-link text-dark font-weight-bold">
                            <i class="fas fa-bolt text-warning mr-1"></i> 
                            <b>FACEBOL</b> S.R.L. - Hazlo Diferente!
                        </a>
                    </li>
                </ul>
                <!-- Último acceso con estilo -->
                <small class="text-muted" id="ultimo-acceso"></small>

                <ul class="navbar-nav ml-auto">

                    <li class="nav-item">
                        
                    </li>
                    <li class="nav-item">
                    <!-- Botón para alternar tema -->
                    <li class="nav-item">
                        <a class="nav-link" href="#" role="button" id="theme-toggle" style="padding: 11px">
                            <i id="theme-icon" class="fas fa-sun" style="font-size: 19px;"></i>
                        </a>
                    </li>
                    <br>
                    <!-- Menú de usuario -->
                    <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="d-flex flex-column text-right mr-2 d-none d-sm-block">
                                    <span class="font-weight-bold">{{ Auth::user()->inscripciones->informacion->nombre }}</span>
                                    <small class="text-muted">{{ Auth::user()->getRoleNames()->implode(', ') }}</small>
                                </div>
                                <!-- Imagen de perfil -->
                                    <img src="{{ Auth::user()->inscripciones->users->foto ? asset( Auth::user()->inscripciones->users->foto) : asset('/fotos/foto_principal.jpg') }}"
                                    class="rounded-circle me-2"
                                    style="width: 40px; height: 40px; object-fit: cover; border: 2px solid #007bff; box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ url('usuarios/create') }}">
                                        <i class="fas fa-user-cog mr-2"></i> Perfil
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
                                    </a>
                                </li>
                            </ul>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
            </ul>
        </nav>


        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <div class="text-center">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="brand-link text-decoration-none">
                    <img src="{{ asset('dist/img/facebol.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" loading="lazy">
                    <span class="brand-text font-weight-light"><b>FACEBOL</b> S.R.L.</span>
                </a>
            </div>

             <!-- Panel de usuario -->
            <div class="sidebar">
                <div class="container">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex flex-column flex-md-row align-items-center justify-content-center text-center">
                    <div class="info">
                        <small style="color: rgb(255, 255, 255)"><b>Bienvenido,<br>{{ Auth::user()->getRoleNames()->implode(', ') }}</small></b> <br>
                        <a href="{{ url('/') }}" class="d-block text-wrap" style="text-decoration: none;">
                            Hola, {{ Auth::user()->inscripciones->informacion->nombre }} <br>
                            {{ Auth::user()->inscripciones->informacion->apellido_paterno }} <br>
                            {{ Auth::user()->inscripciones->informacion->apellido_materno }} <br>
                        </a>
                    </div>
                    </div>
                </div>

                <!-- Menú de navegación -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                            <!-- Perfil de Usuario -->
                            {{-- @can('create', App\Models\User::class) --}}
                            <li class="nav-item">
                                <a href="{{ url('usuarios/create') }}" class="nav-link " style="background-color: rgb(63, 69, 90)">
                                     <i class="nav-icon fas fa-user-cog"></i>
                                    <p>
                                        Perfil de Usuario
                                    </p>
                                </a>
                            </li>
                            {{-- @endcan --}}


                        @can('usuarios')
                        <li class="nav-item">
                            <a href="#" class="nav-link " style="background-color: rgb(63, 69, 90)">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>
                                    Usuarios
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('usuarios') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Listado de usuarios</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    @can('roles')
                                    <a href="{{ url('roles') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Roles</p>
                                    </a>
                                    @endcan
                                    @can('permisos')
                                    <a href="{{ url('permisos') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Permisos</p>
                                    </a>
                                    @endcan
                                </li>
                            </ul>
                        </li>
                        @endcan

                        @can('informaciones')
                        <li class="nav-item">
                            <a href="#" class="nav-link " style="background-color: var(--primary-color)">
                                <i class="nav-icon fas fa-id-card"></i>
                                <p>
                                    Formulario de Datos
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('informaciones/create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Nuevo Dato</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('informaciones') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Listado de Datos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        
                        @can('inscripciones')
                        <li class="nav-item">
                            <a href="#" class="nav-link " style="background-color: var(--primary-color)">
                                <i class="nav-icon fas fa-desktop"></i>
                                <p>
                                    Registro Administrativo
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" >
                                <li class="nav-item">
                                    <a href="{{ url('inscripciones/create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Nuevo Registro</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('inscripciones') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Listado de Registro</p>
                                    </a>
                                </li>
                                @can('areas')
                                <li class="nav-item">
                                    <a href="#" class="nav-link " >
                                        <i class="nav-icon fas fa-sitemap"></i>
                                        <p>
                                            Areas
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ url('areas/create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Nueva area</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('areas') }}" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Listado de areas</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @endcan
                                @can('generaciones')
                                <li class="nav-item">
                                    <a href="#" class="nav-link " >
                                        <i class="nav-icon fas fa-users-between-lines"></i>
                                        <p>
                                            Generaciones
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ url('generaciones/create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Nueva generacion</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('generaciones') }}" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Listado de generaciones</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @endcan
                                @can('requisitos')
                                <li class="nav-item">
                                    <a href="#" class="nav-link" >
                                         <i class="nav-icon fas fa-clipboard-check"></i>
                                        <p>
                                            Requisitos
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ url('requisitos/create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Nuevo Requisito</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('requisitos') }}" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Listado de Requisitos</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @endcan
                                @can('extensiones')
                                <li class="nav-item">
                                    <a href="#" class="nav-link" >
                                        <i class="nav-icon fas fa-id-card"></i>
                                        <p>
                                            Extensiones
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ url('extensiones/create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Nuevo Extension</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('extensiones') }}" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Listado de Extensiones</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcan
                        @can('tarjetas')
                        <li class="nav-item">
                            <a href="#" class="nav-link " style="background-color: var(--primary-color)">
                                <i class="nav-icon fas fa-credit-card"></i>
                                <p>
                                    Tarjetas RFID
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('asignartarjetas')
                                <li class="nav-item">
                                    <a href="{{ url('asignartarjetas') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Asignar Tarjeta</p>
                                    </a>
                                </li>
                                @endcan
                                @can('tarjetas')
                                <li class="nav-item">
                                    <a href="{{ url('tarjetas') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Listado Tarjetas RFID</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>

                        @can('configuraciones')
                        <li class="nav-item">
                            <a href="{{ url('cron-schedule/edit') }}" class="nav-link " style="background-color: var(--primary-color)">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Configuraciones
                                </p>
                            </a>
                        </li>
                        @endcan

                        @endcan
                        @can('asistencia.show')
                        <li class="nav-item">
                            <a href="{{ route('asistencias.show', Auth::user()->inscripciones->id) }}" class="nav-link " style="background-color: var(--primary-color)">
                                <i class="nav-icon fas fa-calendar-check"></i>
                                <p>
                                    Asistencia local
                                </p>
                            </a>
                        </li>
                        @endcan
                        
                        <li class="nav-item">
                            <a href="{{ url('reporteactividad') }}" class="nav-link " style="background-color: var(--primary-color)">
                                <i class="bi bi-clipboard-data-fill"></i>
                                <p>
                                    Informe Semanal
                                </p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="#" class="nav-link" style="background-color: var(--primary-color)">
                                 <i class="nav-icon fas fa-file-invoice-dollar"></i>
                                 <p>
                                     Facturación
                                     <i class="right fas fa-angle-left"></i>
                                 </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('facturacion.registros.admin')
                                    <li class="nav-item">
                                        <a href="{{ url('facturacion/comprobantes') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Comprobantes</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('facturacion.recibos.admin')
                                    <li class="nav-item">
                                        <a href="{{ url('facturacion/recibos') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Recibos</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('facturacion.recibos.ver')
                                    <li class="nav-item">
                                        <a href="{{ url('facturacion/mis-recibos') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Mis Recibos</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('inventarios')
                                    <li class="nav-item">
                                        <a href="{{ url('inventarios') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Inventarios</p>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>

                        @can('asistencias')
                        <li class="nav-item">
                            <a href="#" class="nav-link" style="background-color: var(--primary-color)">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>
                                    Asistencias
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('asistencias') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Listado de asistencia</p>
                                    </a>
                                </li>
                                    {{-- <li class="nav-item">
                                        <a href="{{ url('reporteactividad') }}" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Reporte de Actividades</p>
                                        </a>
                                    </li> --}}
                                {{-- <li class="nav-item">
                                    <a href="#" class="nav-link" >
                                        <i class="nav-icon fas fa-file-alt"></i>
                                        <p>
                                            Rports Actividades
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ url('/reporteactividad') }}" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Listado Rpts actividad</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li> --}}
                                @can('actividads')
                                <li class="nav-item">
                                    <a href="#" class="nav-link" >
                                        <i class="nav-icon fas fa-tasks"></i>
                                        <p>
                                            Actividades
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ url('actividads/create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Nueva actividades </p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('actividads') }}" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Listado de actividades</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @endcan
                                @can('multas')
                                <li class="nav-item">
                                    <a href="#" class="nav-link" >
                                        <i class="nav-icon fas fa-money-bill-wave"></i>
                                        <p>
                                            Multas
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ url('multas/create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Nueva multa</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('multas') }}" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Listado de multas</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcan

                        @can('certificados')
                        <li class="nav-item">
                            <a href="#" class="nav-link" style="background-color: var(--primary-color)">
                                 <i class="nav-icon fas fa-certificate"></i>
                                <p>
                                    Certificados
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('programas')
                                <li class="nav-item">
                                    <a href="#" class="nav-link" >
                                        <i class="nav-icon fas fa-book"></i>
                                        <p>
                                            Programas
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ url('programas/create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Crear programa</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('programas') }}" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Listado Programa</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @endcan
                                @can('detalles')
                                <li class="nav-item">
                                    <a href="#" class="nav-link" >
                                        <i class="nav-icon fas fa-info-circle"></i>
                                        <p>
                                            Detalles
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ url('detalles/create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Crear Detalle</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('detalles') }}" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Listar Detalles</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @endcan
                                <li class="nav-item">
                                    <a href="#" class="nav-link" >
                                        <i class="nav-icon fas">
                                            <i class="bi bi-card-list"></i>
                                        </i>
                                        <p>
                                            Certificados
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ url('certificados/create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Crear Certificado</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('certificados') }}" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Listar Certificados</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        @endcan

                        {{-- <hr> --}}

                        <li class="nav-item">
                            <a href="#" class="nav-link" style="background-color: var(--primary-color)">
                                 <i class="nav-icon fas fa-building"></i>
                                <p>
                                    Convenios Empresarial
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                {{-- @can('programas') --}}
                                <li class="nav-item">
                                    <a href="#" class="nav-link" >
                                        <i class="nav-icon fas fa-building-circle-arrow-right"></i>
                                        <p>
                                            Empresas
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @can('asistencias')
                                        <li class="nav-item">
                                            <a href="{{ url('empresas/create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Crear Empresa</p>
                                            </a>
                                        </li>
                                        @endcan
                                   
                                        <li class="nav-item">
                                            <a href="{{ url('empresas') }}" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Listado Empresa</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                {{-- @endcan --}}
                                @can('asistencias')
                                <li class="nav-item">
                                    <a href="#" class="nav-link" >
                                        <i class="nav-icon fas fa-code-branch"></i>
                                        <p>
                                            Sucursal
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @can('asistencias')
                                        <li class="nav-item">
                                            <a href="{{ url('sucursal/create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Crear Sucursal</p>
                                            </a>
                                        </li>
                                        @endcan
                                        <li class="nav-item">
                                            <a href="{{ url('sucursal') }}" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Listado Sucursal</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @endcan
                                @can('asistencias')
                                <li class="nav-item">
                                    <a href="#" class="nav-link" >
                                        <i class="nav-icon fas">
                                            <i class="nav-icon fas fa-map-marker-alt"></i>
                                        </i>
                                        <p>
                                            Lugar
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ url('lugar/create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Crear Lugar</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('lugar') }}" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Listado Lugar</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @endcan
                                @can('asistencias')
                                <li class="nav-item">
                                    <a href="#" class="nav-link" >
                                        <i class="nav-icon fas">
                                            <i class="nav-icon fas fa-object-group"></i>
                                        </i>
                                        <p>
                                            Tipo de Sedes
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ url('tipo_sedes/create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Crear Tipo Sede</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href=" {{ url('tipo_sedes') }}" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Listado Tipo Sede</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @endcan

                                @can('asistencias')
                                 <li class="nav-item">
                                    <a href="#" class="nav-link" >
                                        <i class="nav-icon fas">
                                            <i class="nav-icon fas fa-bars"></i>
                                        </i>
                                        <p>
                                            Categorias
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ url('categorias/create') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Crear Categorias</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href=" {{ url('categorias') }}" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Listado de Categorias</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @endcan                               

                            </ul>
                        </li>
                        
                        <li class="nav-item">
                            <a href="#" class="nav-link " style="background-color: var(--primary-color)">
                                <i class="nav-icon fas fa-handshake"></i>
                                <p>
                                    Convenios
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('asistencias')
                                <li class="nav-item">
                                    <a href="{{ url('convenios/create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Crear Convenios</p>
                                    </a>
                                </li>
                                @endcan
                                <li class="nav-item">
                                    <a href="{{ url('convenios') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Listado de Convenios</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Contenido principal -->
        <div class="content-wrapper">
            <br>
            <div class="content pt-3">
                @yield('content')
                @stack('scripts')
                @yield('scripts')
            </div>
        </div>

        <!-- Pie de página -->
        <footer class="main-footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <strong><b>Sitio Web Interactivo</b> &copy; 2024-2025 <a href="https://facebolsrl.net/" target="_blank" class="">FaceBol S.R.L.</a></strong>
                        <span class="d-none d-md-inline"> | Política de Privacidad</span>
                    </div>
                        <div class="col-md-6 text-md-right">
                        <b>Versión</b> 12.9.0
                    </div>
                </div>
            </div>
        </footer>
    </div>
    @endif

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>


    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    

    <!-- Bootstrap 4 -->
    {{-- <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Incluye los scripts de Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Importar SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    // Preloader (opcional)
    window.addEventListener('load', () => {
        const preloader = document.getElementById('preloader');
        if (preloader) preloader.style.display = 'none';
    });

    document.addEventListener('DOMContentLoaded', function () {
        initializeSessionTimer();
    });

    function initializeSessionTimer() {
        let inactivityTimer;
        const warningTime = 5 * 60 * 1000; // ⏱️ 5 minuto de inactividad
        const events = ['mousedown', 'mousemove', 'keypress', 'scroll', 'touchstart', 'click'];

        const resetTimer = () => {
            clearTimeout(inactivityTimer);
            inactivityTimer = setTimeout(forceLogout, warningTime);
        };

        const forceLogout = () => {
            Swal.fire({
                title: "⚠️ Sesión cerrada",
                text: "Por seguridad, tu sesión ha sido cerrada por inactividad.",
                icon: "warning",
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                timer: 7000, // muestra el mensaje 7 segundos
                timerProgressBar: true
            }).then(() => {
                document.getElementById('logout-form').submit();
            });
        };

        // Detectar actividad del usuario
        events.forEach(event => {
            window.addEventListener(event, resetTimer);
        });

        resetTimer(); // Iniciar temporizador
    }

    // Menú activo
        const currentPath = window.location.pathname;
        $('.nav-link').each(function() {
            if (this.pathname === currentPath) {
                $(this).addClass('active');
                $(this).closest('.nav-treeview').siblings('.nav-link').addClass('active');
            }
        });


        document.addEventListener("DOMContentLoaded", function () {
        let ultimoAcceso = localStorage.getItem("ultimoAcceso"); 

        // Si existe un último acceso guardado, lo mostramos
        if (ultimoAcceso) {
            document.getElementById("ultimo-acceso").innerText = "Último acceso: " + ultimoAcceso;
        } else {
            document.getElementById("ultimo-acceso").innerText = "Último acceso: Primera vez en el sistema";
        }

        // Guardamos el acceso actual como "último acceso" para la próxima vez
        let ahora = new Date();
        let fecha = ahora.toLocaleDateString("es-ES");
        let hora  = ahora.toLocaleTimeString("es-ES");

        localStorage.setItem("ultimoAcceso", fecha + " " + hora);
    });



    // Usar requestAnimationFrame para máximo rendimiento
document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.getElementById("theme-toggle");
    const icon = document.getElementById("theme-icon");
    
    // Prevenir múltiples clics rápidos
    let isChangingTheme = false;

    // Cargar tema guardado - INMEDIATO
    const savedTheme = localStorage.getItem("theme");
    
    if (savedTheme === "dark") {
        // Aplicar inmediatamente sin transición
        document.body.classList.add("dark-mode");
        icon.className = "fas fa-moon";
    } else {
        // Asegurar modo claro
        document.body.classList.remove("dark-mode");
        icon.className = "fas fa-sun";
        if (!savedTheme) localStorage.setItem("theme", "light");
    }

    // Manejar clic en el botón de tema - OPTIMIZADO
    toggleBtn.addEventListener("click", function(e) {
        e.preventDefault();
        
        if (isChangingTheme) return;
        isChangingTheme = true;
        
        // Usar requestAnimationFrame para máxima fluidez
        requestAnimationFrame(() => {
            const isDarkMode = document.body.classList.contains("dark-mode");
            
            // 1. Agregar clase para transiciones rápidas
            document.body.classList.add("theme-changing");
            
            // 2. Cambiar tema inmediatamente
            if (isDarkMode) {
                // Cambiar a modo claro
                document.body.classList.remove("dark-mode");
                icon.className = "fas fa-sun";
                localStorage.setItem("theme", "light");
            } else {
                // Cambiar a modo oscuro
                document.body.classList.add("dark-mode");
                icon.className = "fas fa-moon";
                localStorage.setItem("theme", "dark");
            }
            
            // 3. Animación del icono (rápida)
            icon.style.transform = "scale(1.2) rotate(90deg)";
            
            // 4. Remover clase de transición después del cambio
            setTimeout(() => {
                document.body.classList.remove("theme-changing");
                icon.style.transform = "";
                isChangingTheme = false;
            }, 150); // Muy rápido: 150ms
        });
    });

    // Sincronizar entre pestañas (sin animación para mantener velocidad)
    window.addEventListener('storage', function(e) {
        if (e.key === 'theme') {
            // Cambiar inmediatamente sin transición
            if (e.newValue === 'dark') {
                document.body.classList.add("dark-mode");
                icon.className = "fas fa-moon";
            } else {
                document.body.classList.remove("dark-mode");
                icon.className = "fas fa-sun";
            }
        }
    });
});

// Inyectar CSS optimizado dinámicamente Para tema Oscuro y Claro
(function() {
    const style = document.createElement('style');
    style.textContent = `
        /* Transiciones optimizadas solo en elementos que cambian */
        body, .navbar, .card, .table, .form-control {
            transition: background-color 0.15s ease-out, 
                       border-color 0.15s ease-out, 
                       color 0.15s ease-out;
        }
        
        /* Remover transiciones durante carga inicial */
        .no-transitions * {
            transition: none !important;
        }
    `;
    document.head.appendChild(style);
    
    // Remover transiciones durante la carga inicial
    document.body.classList.add('no-transitions');
    setTimeout(() => {
        document.body.classList.remove('no-transitions');
    }, 50);
})();

</script>
    
    

    @livewireScripts
    
</body>

</html>