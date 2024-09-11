@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1 class="text-center"><b>Crear una Nueva Información</b></h1><br>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-md-11">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Llene los Datos</b></h3>
                    </div>
                    <div class="card card-body" style="...">
                        <form action="{{ url('/informaciones') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Apellido Paterno</label> <b>*</b>
                                        <input type="text" name="apellido_paterno" value="{{ old('apellido_paterno') }}"
                                            class="form-control" style="text-transform: uppercase;">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Apellidos Materno</label> <b>*</b>
                                        <input type="text" name="apellido_materno" value="{{ old('apellido_materno') }}"
                                            class="form-control" style="text-transform: uppercase;">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Nombres</label> <b>*</b>
                                        <input type="text" name="nombre" value="{{ old('nombre') }}"
                                            class="form-control" required style="text-transform: uppercase;">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Celular</label> <b>*</b>
                                    <input type="number" name="celular" value="{{ old('celular') }}" class="form-control"
                                        required>
                                    @if ($errors->has('celular'))
                                        <span class="text-danger">{{ $errors->first('celular') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label for="">Instituto Universidad</label> <b>*</b>
                                    <input type="text" name="insti_univer" value="{{ old('insti_univer') }}"
                                        class="form-control" required style="text-transform: uppercase;">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Carrera</label> <b>*</b>
                                    <input type="text" name="carrera" value="{{ old('carrera') }}" class="form-control"
                                        required style="text-transform: uppercase;">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Año o Semestral</label> <b>*</b>
                                    <input type="text" name="año" value="{{ old('año') }}" class="form-control"
                                        required style="text-transform: uppercase;">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Invitado Visita</label> <b>*</b>
                                    <input type="text" name="invitado_visita" value="{{ old('invitado_visita') }}"
                                        class="form-control" required style="text-transform: uppercase;">
                                </div>
                                <div class="form-group">

                                    <input type="hidden" name="formulario" value="0" class="form-control" required>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-gro">
                                        <a href="{{ url('/informaciones') }}" class="btn btn-secondary">Cancelar</a>
                                        <button type="submit" class="btn btn-primary">Guardar registro</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
