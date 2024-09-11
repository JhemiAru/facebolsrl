@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1 class="text-center"><b>Actualizar Datos de la Información</b></h1><br>

        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                <li>{{ $error }}</li>
            </div>
        @endforeach

        <div class="row">
            <div class="col-md-11">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title"><b>Llene los Datos</b></h3>
                    </div>
                    <div class="card-body" style="...">
                        <form action="{{ url('/informaciones', $informacion->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PATCH') }}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Apellido Paterno</label>
                                        <input type="text" name="apellido_paterno"
                                            value="{{ $informacion->apellido_paterno }}" class="form-control" 
                                            style="text-transform: uppercase;">
                                        @error('apellido_paterno')
                                            <small style="color: red;">* Este campo es requerido</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Apellidos Materno</label>
                                    <input type="text" name="apellido_materno"
                                        value="{{ $informacion->apellido_materno }}" class="form-control" 
                                        style="text-transform: uppercase;">
                                    @error('apellido_materno')
                                        <small style="color: red;">* Este campo es requerido</small>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="">Nombres</label>
                                    <input type="text" name="nombre"
                                        value="{{ $informacion->nombre }}" class="form-control" required
                                        style="text-transform: uppercase;">
                                    @error('nombre')
                                        <small style="color: red;">* Este campo es requerido</small>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="">Celular</label>
                                    <input type="number" name="celular" value="{{ $informacion->celular }}"
                                        class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Instituto Universidad</label>
                                    <input type="text" name="insti_univer" value="{{ $informacion->insti_univer }}"
                                        class="form-control" required style="text-transform: uppercase;">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Carrera</label>
                                    <input type="text" name="carrera" value="{{ $informacion->carrera }}"
                                        class="form-control" required style="text-transform: uppercase;">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Año o Semestral</label>
                                    <input type="text" name="año" value="{{ $informacion->año }}"
                                        class="form-control" required style="text-transform: uppercase;">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Invitado Visita</label>
                                    <input type="text" name="invitado_visita" value="{{ $informacion->invitado_visita }}"
                                        class="form-control" required style="text-transform: uppercase;">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-gro">
                                        <a href="{{ url('/informaciones') }}" class="btn btn-secondary">Cancelar</a>
                                        <button type="submit" class="btn btn-success">Actualizar registro</button>
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
