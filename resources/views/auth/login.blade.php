<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FaceBol S.R.L.</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet"
        href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css') }}">
    {{-- Animate.css --}}
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <!-- Custom CSS -->
    <style>
        body {
            background: url('imagenes/fondo_login.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .login-box {
            margin-top: 75px;
            padding: 20px;
            background: #fff;
            text-align: center;
            box-shadow: 0px 0px 10px 0px #000;
        }

        .login-logo img {
            max-width: 100%;
            height: auto;
            width: 150px;
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            animation: bounceIn 2s, pulse 2s infinite;
        }

        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.3);
            }

            50% {
                opacity: 1;
                transform: scale(1.05);
            }

            70% {
                transform: scale(0.9);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .login-logo a {
            font-size: 2rem;
            font-weight: bold;
            color: #000;
        }

        .login-box-msg {
            margin: 0;
            padding: 10px;
            font-size: 1.2rem;
            color: #666;
        }

        .form-control {
            font-size: 14px;
            background: #fff;
            border: 2px solid #e9ecef;
            border-radius: 3px;
            box-shadow: 0px 0px 0px 1px #000;
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-info {
            margin-top: 10px;
        }

        .card-body {
            padding: 15px;
        }

        .collapse .form-control {
            margin-bottom: 10px;
        }

        .collapse .btn {
            width: 100%;
        }

        .collapse .btn-secondary {
            margin-bottom: 10px;
        }

        .titulo1 {
            font-family: 'Andalia';
            font-size: 35pt;
            color: white;
            text-shadow: 0.1em 0.1em 0.5em black;
        }

        .input-group-text {
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .input-group-text:hover {
            transform: scale(1.2);
        }

        .fa-eye,
        .fa-eye-slash {
            transition: transform 0.3s ease;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="animate__animated animate__bounceInDown">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="login-box">
                        <div class="login-logo">
                            <a href="{{ url('login') }}"><img src="{{ url('/dist/img/facebol.jpg') }}"
                                    alt="FaceBol S.R.L."></a>
                        </div>
                        <div class="card">
                            <div class="card-body login-card-body">
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
                                <p class="login-box-msg">Ingrese sus credenciales</p>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Correo Electrónico</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>
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
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password">
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
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                                    </div>
                                </form>
                                <button class="btn btn-success btn-block" type="button" data-toggle="collapse"
                                    data-target="#tableCollapse" aria-expanded="false" aria-controls="tableCollapse">
                                    <i class="fas fa-minus"></i> Inscripción de la Información
                                </button>
                                <div class="collapse mt-3" id="tableCollapse">
                                    <div class="card card-body">
                                        <form action="{{ url('/informaciones') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="apellido_paterno">Apellido Paterno</label> <b>*</b>
                                                <input type="text" name="apellido_paterno"
                                                    value="{{ old('apellido_paterno') }}" class="form-control"
                                                    style="text-transform: uppercase;">
                                            </div>
                                            <div class="form-group">
                                                <label for="apellido_materno">Apellido Materno</label> <b>*</b>
                                                <input type="text" name="apellido_materno"
                                                    value="{{ old('apellido_materno') }}" class="form-control"
                                                    style="text-transform: uppercase;">
                                            </div>
                                            <div class="form-group">
                                                <label for="nombre">Nombres</label> <b>*</b>
                                                <input type="text" name="nombre" value="{{ old('nombre') }}"
                                                    class="form-control" required style="text-transform: uppercase;">
                                            </div>
                                            <div class="form-group">
                                                <label for="celular">Celular</label> <b>*</b>
                                                <input type="number" name="celular" value="{{ old('celular') }}"
                                                    class="form-control" required>
                                            </div>
                                            {{-- <div class="form-group">
                                                <label for="correo">Correo</label> <b>*</b>
                                                <input type="email" name="correo" value="{{ old('correo') }}" class="form-control" required>
                                            </div> --}}
                                            <div class="form-group">
                                                <label for="insti_univer">Instituto Universidad</label> <b>*</b>
                                                <input type="text" name="insti_univer"
                                                    value="{{ old('insti_univer') }}" class="form-control" required
                                                    style="text-transform: uppercase;">
                                            </div>
                                            <div class="form-group">
                                                <label for="carrera">Carrera</label> <b>*</b>
                                                <input type="text" name="carrera" value="{{ old('carrera') }}"
                                                    class="form-control" required style="text-transform: uppercase;">
                                            </div>
                                            <div class="form-group">
                                                <label for="año">Año o Semestral</label> <b>*</b>
                                                <input type="text" name="año" value="{{ old('año') }}"
                                                    class="form-control" required style="text-transform: uppercase;">
                                            </div>
                                            {{-- <div class="form-group">
                                                <label for="turno">Turno</label> <b>*</b>
                                                <input type="text" name="turno" value="{{ old('turno') }}" class="form-control" required style="text-transform: uppercase;">
                                            </div> --}}
                                            <div class="form-group">
                                                <label for="invitado_visita">Invitado Visita</label> <b>*</b>
                                                <input type="text" name="invitado_visita"
                                                    value="{{ old('invitado_visita') }}" class="form-control"
                                                    required style="text-transform: uppercase;">
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" name="formulario" value="1"
                                                    class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <a href="{{ url('/') }}" class="btn btn-secondary">Cancelar</a>
                                                <button type="submit" class="btn btn-success">Guardar
                                                    registro</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /.login-card-body -->
                        </div>
                    </div>
                    <!-- /.login-box -->
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const togglePasswordIcon = document.getElementById('togglePasswordIcon');
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;
            togglePasswordIcon.classList.toggle('fa-eye-slash');
        }
    </script>
</body>

</html>






{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FaceBol S.R.L.</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Animate.css -->   
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">

    <style>
        body {
            background: url('imagenes/fondo_login.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .login-box {
            margin-top: 75px;
            padding: 20px;
            background: #fff;
            text-align: center;
            box-shadow: 0px 0px 10px 0px #000;
        }
        .login-logo a {
            font-size: 2rem;
            font-weight: bold;
            color: #000;
        }
        .login-box-msg {
            margin: 0;
            padding: 10px;
            font-size: 1.2rem;
            color: #666;
        }
        .form-control {
            font-size: 14px;
            background: #fff;
            border: 2px solid #e9ecef;
            border-radius: 3px;
            box-shadow: 0px 0px 0px 1px #000;
            margin-bottom: 15px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn-info {
            margin-top: 10px;
        }
        .card-body {
            padding: 15px;
        }
        .collapse .form-control {
            margin-bottom: 10px;
        }
        .collapse .btn {
            width: 100%;
        }
        .collapse .btn-secondary {
            margin-bottom: 10px;
        }
        .titulo1{
            font-family: 'Andalia';
            font-size: 35pt;
            color: white;
            text-shadow: 0.1em 0.1em 0.5em black
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="animated bounceInDown delay-2s">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="login-box">
                        <div class="login-logo">
                            <a href="{{ url('login') }}"><b>FaceBol</b> S.R.L.</a>
                        </div>
                        <div class="card">
                            <div class="card-body login-card-body">
                                <p class="login-box-msg">Ingrese sus credenciales</p>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Correo Electrónico</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Contraseña</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                                    </div>
                                </form>
                                <button class="btn btn-info btn-block" type="button" data-toggle="collapse" data-target="#tableCollapse" aria-expanded="false" aria-controls="tableCollapse">
                                    Inscripción de la Información 
                                </button>
                                <div class="collapse mt-3" id="tableCollapse">
                                    <div class="card card-body">
                                        <form action="{{ url('/informaciones') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="nombre_apellido">Nombres y Apellidos</label> <b>*</b>
                                                <input type="text" name="nombre_apellido" value="{{ old('nombre_apellido') }}" class="form-control" required style="text-transform: uppercase;">
                                            </div>
                                            <div class="form-group">
                                                <label for="celular">Celular</label> <b>*</b>
                                                <input type="number" name="celular" value="{{ old('celular') }}" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="correo">Correo</label> <b>*</b>
                                                <input type="email" name="correo" value="{{ old('correo') }}" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="insti_univer">Instituto Universidad</label> <b>*</b>
                                                <input type="text" name="insti_univer" value="{{ old('insti_univer') }}" class="form-control" required style="text-transform: uppercase;">
                                            </div>
                                            <div class="form-group">
                                                <label for="carrera">Carrera</label> <b>*</b>
                                                <input type="text" name="carrera" value="{{ old('carrera') }}" class="form-control" required style="text-transform: uppercase;">
                                            </div>
                                            <div class="form-group">
                                                <label for="año">Año Semestral</label> <b>*</b>
                                                <input type="text" name="año" value="{{ old('año') }}" class="form-control" required style="text-transform: uppercase;">
                                            </div>
                                            <div class="form-group">
                                                <label for="turno">Turno</label> <b>*</b>
                                                <input type="text" name="turno" value="{{ old('turno') }}" class="form-control" required style="text-transform: uppercase;">
                                            </div>
                                            <div class="form-group">
                                                <label for="invitado_visita">Invitado Visita</label> <b>*</b>
                                                <input type="text" name="invitado_visita" value="{{ old('invitado_visita') }}" class="form-control" required style="text-transform: uppercase;">
                                            </div>
                                            <div class="form-group">
                                               
                                                <input type="hidden" name="formulario" value="1" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <a href="{{ url('/') }}" class="btn btn-secondary">Cancelar</a>
                                                <button type="submit" class="btn btn-primary">Guardar registro</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /.login-card-body -->
                        </div>
                    </div>
                    <!-- /.login-box -->
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html> --}}




{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
