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
                <div class="card-body">
                    <form action="{{ url('/asistencias', $asistencia->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Día</label>
                                    <input type="text" name="fecha" value="{{ $asistencia->fecha }}" class="form-control" required style="text-transform: uppercase;">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="">Fecha</label>
                                <input type="fecha" name="fecha" value="{{ $asistencia->fecha }}" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="">Hora de Llegada</label>
                                <input type="text" name="h_llegada" value="{{ $asistencia->h_llegada }}" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="">Hora de Salida</label>
                                <input type="text" name="h_salida" value="{{ $asistencia->h_salida }}" class="form-control" required style="text-transform: uppercase;">
                            </div>
                            <div class="col-md-4">
                                <label for="">Horas</label>
                                <input type="text" name="horas" value="{{ $asistencia->horas }}" class="form-control" required style="text-transform: uppercase;">
                            </div>
                            <div class="col-md-4">
                                <label for="">Turno</label>
                                <input type="text" name="turno" value="{{ $asistencia->turno }}" class="form-control" required style="text-transform: uppercase;">
                            </div>
                            <div class="col-md-4">
                                <label for="">Tipo</label>
                                <input type="text" name="asistencia" value="{{ $asistencia->asistencia }}" class="form-control" required style="text-transform: uppercase;">
                            </div>
                            <div class="col-md-4">
                                <label for="">Multas</label>
                                <input type="text" name="id_multa" value="{{ $asistencia->id_multa }}" class="form-control" required style="text-transform: uppercase;">
                            </div>
                            <div class="col-md-4">
                                <label for="">Actividad</label>
                                <input type="text" name="id_actividad" value="{{ $asistencia->id_actividad }}" class="form-control" required style="text-transform: uppercase;">
                            </div>
                            <div class="col-md-4">
                                <label for="">Estado</label>
                                <input type="text" name="estado" value="{{ $asistencia->estado }}" class="form-control" required style="text-transform: uppercase;">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <a href="{{ url('/asistencias') }}" class="btn btn-secondary">Cancelar</a>
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
