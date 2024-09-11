@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1 class="text-center"><b>Actualización de Roles</b></h1>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title"><b>Llene los datos de forma correcta</b></h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/usuarios', $usuario->id . '1') }}">
                            @csrf
                            {{ method_field('PATCH') }}

                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre del Usuario</label>
                                <input id="name" type="text" class="form-control" name="name"
                                    value="{{ $usuario->inscripciones->informacion->apellido_paterno }} {{ $usuario->inscripciones->informacion->apellido_materno }} {{ $usuario->inscripciones->informacion->nombre }}"
                                    autocomplete="name" autofocus readonly>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ $usuario->email }}" autocomplete="email" readonly>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input id="password" type="password" class="form-control" name="password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="passwordConfirm" class="form-label">Confirmar Contraseña</label>
                                <input id="passwordConfirm" type="password" class="form-control" name="passwordConfirm">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{--           <div class="mb-3">
                                <label class="form-label">Listado de Roles</label>
                                <div>
                                    <select name="id_role" id="id_role" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="">Seleccionar Roles</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="{{ url('/usuarios') }}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-success">Asignar Roles</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
