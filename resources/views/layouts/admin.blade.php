@php
    use Illuminate\Support\Facades\Auth;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FaceBol S.R.L.</title>

    <link rel="stylesheet" href="{{ asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0') }}">
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    {{-- iconos de bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- JQuery --}}
    <script src="{{ asset('/plugins/jquery/jquery.js') }}"></script>
    {{-- datetables --}}
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    {{-- sweetalert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- ckeditor para el text area --}}
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>

    {{--  bootstrap --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css') }}"> --}}

    <!-- Incluye los estilos de Select2 -->
    <link href="{{ asset('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css') }}" rel="stylesheet" />
    <!-- Incluye los estilos de Bootstrap -->
    <link rel="stylesheet" href="{{ asset('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css') }}">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    @if (!auth()->check())
        @php
            header('Location: ' . URL::to('/login'));
            exit();
        @endphp
    @else
    <div class="wrapper">

        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('dist/img/facebol.jpg') }}" alt="facebol" height="60"
                width="60">
        </div>

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/') }}" class="nav-link"><b>FACEBOL</b> S.R.L. Hazlo Diferente!</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    {{-- <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a> --}}
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button" id="fullscreen-btn">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true"
                        href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li> --}}
            </ul>
        </nav>


        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <a href="{{ url('/') }}" class="brand-link">
                <img src="{{ url('/dist/img/facebol.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light"><b>FACEBOL</b> S.R.L.</span>
            </a>

            <div class="sidebar">

                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ url('/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Bienvenido, {{ Auth::user()->roles->name }} <br> Hola, {{ Auth::user()->inscripciones->informacion->nombre }} {{ Auth::user()->inscripciones->informacion->apellido_paterno }}</a>
                    </div>
                </div>

                {{-- <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div> --}}

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                            <li class="nav-item">
                                <a href="{{ url('usuarios/create') }}" class="nav-link " style="background-color: rgb(63, 69, 90)">
                                    <i class="nav-icon ">
                                        <i class="bi bi-person-lines-fill"></i>
                                    </i>
                                    <p>
                                        Perfil
                                    </p>
                                </a>
                            </li>

                        {{-- @can('usuarios') --}}
                        <li class="nav-item">
                            <a href="#" class="nav-link " style="background-color: rgb(63, 69, 90)">
                                <i class="nav-icon fas">
                                    <i class="bi bi-person-check"></i>
                                </i>
                                <p>
                                    Usuarios
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                {{-- <li class="nav-item">
                                    <a href="{{ url('usuarios/create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Nuevo usuario</p>
                                    </a>
                                </li> --}}
                                <li class="nav-item">
                                    <a href="{{ url('usuarios') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Listado de usuarios</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('roles') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Roles</p>
                                    </a>
                                    <a href="{{ url('permisos') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Permisos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- @endcan --}}


                        <li class="nav-item">
                            <a href="#" class="nav-link " style="background-color: rgb(63, 69, 90)">
                                <i class="nav-icon fas">
                                    <i class="bi bi-file-person-fill"></i>
                                </i>
                                <p>
                                    Informaciones
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('informaciones/create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Nueva Informacion</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('informaciones') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Listado de informacion</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link " style="background-color: rgb(63, 69, 90)">
                                <i class="nav-icon fas">
                                    <i class="bi bi-pc-display-horizontal"></i>
                                </i>
                                <p>
                                    Inscripciones
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" >
                                <li class="nav-item">
                                    <a href="{{ url('inscripciones/create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Nueva inscripcion</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('inscripciones') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Listado de inscritos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link " >
                                        <i class="nav-icon fas">
                                            <i class="bi bi-person-lines-fill"></i>
                                        </i>
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
                                <li class="nav-item">
                                    <a href="#" class="nav-link " >
                                        <i class="nav-icon fas">
                                            <i class="bi bi-file-person-fill"></i>
                                        </i>
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
                                <li class="nav-item">
                                    <a href="#" class="nav-link" >
                                        <i class="nav-icon fas">
                                            <i class="bi bi-clipboard2-data-fill"></i>
                                        </i>
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
                                <li class="nav-item">
                                    <a href="#" class="nav-link" >
                                        <i class="nav-icon fas">
                                            <i class="bi bi-person-vcard-fill"></i>
                                        </i>
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
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link " style="background-color: rgb(63, 69, 90)">
                                <i class="nav-icon fas">
                                    <i class="bi bi-pci-card-network"></i>
                                </i>
                                <p>
                                    Tarjetas RFID
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('asignartarjetas') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Asignar Tarjeta</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('tarjetas') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Listado de Tarjetas RFID</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-item">
                            <a href="#" class="nav-link" style="background-color: rgb(63, 69, 90)">
                                <i class="nav-icon fas">
                                    <i class="bi bi-pencil-square"></i>
                                </i>
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
                                <li class="nav-item">
                                    <a href="#" class="nav-link" >
                                        <i class="nav-icon fas">
                                            <i class="bi bi-person-fill-gear"></i>
                                        </i>
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
                                <li class="nav-item">
                                    <a href="#" class="nav-link" >
                                        <i class="nav-icon fas">
                                            <i class="bi bi-currency-dollar"></i>
                                        </i>
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
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link" style="background-color: rgb(63, 69, 90)">
                                <i class="nav-icon fas">
                                    <i class="bi bi-calendar2-week"></i>
                                </i>
                                <p>
                                    Certificados
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link" >
                                        <i class="nav-icon fas">
                                            <i class="bi bi-journal-bookmark-fill"></i>
                                        </i>
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
                                <li class="nav-item">
                                    <a href="#" class="nav-link" >
                                        <i class="nav-icon fas">
                                            <i class="bi bi-clipboard-data-fill"></i>
                                        </i>
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

                        <li class="nav-item">
                            <a href="#" class="nav-link" style="background-color: rgb(103, 151, 101)">
                                <i class="nav-icon fas">
                                    <i class="bi bi-printer-fill"></i>
                                </i>
                                <p>
                                    Reportes
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('informaciones/reportes') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Informaciones</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">

                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="background-color: rgb(216, 59, 59)">
                                <i class="nav-icon">
                                    <i class="bi bi-door-open-fill"></i>
                                </i>
                                Cerrar Sesion
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>

            </div>

        </aside>

        <div class="content-wrapper">
            <br>
            <div class="content">
                @yield('content')
            </div>
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; 2024-2025 <a href="https://facebolsrl.net/">FaceBol S.R.L.</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <aside class="control-sidebar control-sidebar-dark">

        </aside>

    </div>
    @endif


    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
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


    {{-- es para la busqueda de apellidos y nombres del pasantes --}}
    <!-- Incluye jQuery -->
    {{-- <script src="{{ asset('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script> --}}
    <!-- Incluye los scripts de Select2 -->
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js') }}"></script>
    <!-- Incluye los scripts de Bootstrap -->
    <script src="{{ asset('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js') }}"></script>
    

</body>

</html>
<script>
    let inactivityTime = function () {
        let time;
        window.onload = resetTimer;
        document.onmousemove = resetTimer;
        document.onkeypress = resetTimer;
        document.onscroll = resetTimer;

        function logout() {
            alert('Su sesión ha expirado por inactividad.');
            window.location.href = "{{ route('login') }}";  // Redirigir al login
        }

        function resetTimer() {
            clearTimeout(time);
            time = setTimeout(logout, 1800000);  // 30 minutos (1800000 ms)
        }
    };

    inactivityTime();
</script>



