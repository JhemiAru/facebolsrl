@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1 class="text-center"><b>Datos de las Información Registradas</b></h1><br>

        <div class="row">
            <div class="col-md-11">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Datos Registrados</b></h3>
                    </div>
                    <div class="card-body" style="...">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Apellidos y Nombres</label>
                                        <input type="text" name="nombre_apellido" value="{{ $informacion->apellido_paterno }} {{ $informacion->apellido_materno }} {{ $informacion->nombre }}" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Celular</label>
                                    <input type="number" name="celular" value="{{ $informacion->celular }}" class="form-control" disabled>
                                </div>
                                {{-- <div class="col-md-4">
                                    <label for="">Correo</label>
                                    <input type="email" name="correo" value="{{ $informacion->correo }}" class="form-control" disabled>
                                </div> --}}
                                <div class="col-md-4">
                                    <label for="">Instituto Universidad</label>
                                    <input type="text" name="insti_univer" value="{{ $informacion->insti_univer }}" class="form-control" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Carrera</label>
                                    <input type="text" name="carrera" value="{{ $informacion->carrera }}" class="form-control" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Año Semestral</label>
                                    <input type="text" name="año" value="{{ $informacion->año }}" class="form-control" disabled>
                                </div>
                                {{-- <div class="col-md-4">
                                    <label for="">Turno</label>
                                    <input type="text" name="turno" value="{{ $informacion->turno }}" class="form-control" disabled>
                                </div> --}}
                                <div class="col-md-4">
                                    <label for="">Invitado Visita</label>
                                    <input type="text" name="invitado_visita" value="{{ $informacion->invitado_visita }}" class="form-control" disabled>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-gro">
                                        <a href="{{ url('/informaciones') }}" class="btn btn-secondary">Atras</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
