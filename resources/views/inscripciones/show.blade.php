@extends('layouts.admin')

@section('content')
<div class="content" style="margin-left: 20px">
    <h1 class="text-center"><b>Datos de la Inscripción</b></h1><br>

    <div class="row">
        <div class="col-md-11">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>Datos Registrados</b></h3>
                </div>
                <div class="card-body" style="...">
                    <div class="row">
                        
                        <div class="col-md-2">
                            <label for="">Estado</label>
                            <span class="form-control {{ $inscripcion->estado ? 'text-success' : 'text-danger' }}">
                                {{ $inscripcion->estado ? 'Activo' : 'Inactivo' }}
                            </span>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="">Fecha de Inscripción</label>
                            <input type="text" value="{{ $inscripcion->f_inscripcion }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="">Apellidos y Nombres del Pasante</label>
                            <input type="text" value="{{ $inscripcion->informacion->apellido_paterno }} {{ $inscripcion->informacion->apellido_materno }} {{ $inscripcion->informacion->nombre }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="">Correo</label>
                            <input type="text" value="{{ $inscripcion->users->email }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="">CI</label>
                            <input type="text" value="{{ $inscripcion->ci }} {{ $inscripcion->extension->expedido }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="">Género</label>
                            <input type="text" value="{{ $inscripcion->genero == 1 ? 'MASCULINO' : 'FEMENINO' }}" class="form-control" disabled>
                        </div>                        
                        <div class="col-md-4">
                            <label for="">Recibos</label>
                            <input type="text" value="{{ $inscripcion->recibos }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="">Porcentaje Requisito</label>
                            <input type="text" value="{{ $inscripcion->porcentaje_requisitos }} %" class="form-control" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="">Dirección</label>
                            <input type="text" value="{{ $inscripcion->direccion }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="">Código Credencial</label>
                            <input type="text" value="{{ $inscripcion->codigo_credencial }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="">Generación</label>
                            <input type="text" value="{{ $inscripcion->generacion->generacion }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="">Área</label>
                            <input type="text" value="{{ $inscripcion->area->nombre_area }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="">Tipo de Roles</label>
                            <input type="text" value="{{ $inscripcion->users->roles->name }}" class="form-control" disabled>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <table id="example1" class="table table-bordered table-striped table-m text-center">
                            <thead>
                                <tr>
                                    <th>Requisito</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requisitos as $requisito)
                                    <tr>
                                        <td>{{ $requisito->requisito }}</td>
                                        <td>
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-outline-success {{ isset($asignarRequisitos[$requisito->id]) && $asignarRequisitos[$requisito->id]->estado == 1 ? 'active' : '' }}">
                                                    <input disabled type="radio" name="requisito[{{ $requisito->id }}]" value="1" {{ isset($asignarRequisitos[$requisito->id]) && $asignarRequisitos[$requisito->id]->estado == 1 ? 'checked' : '' }}>
                                                    Entregado
                                                </label>
                                                <label class="btn btn-outline-danger  {{ isset($asignarRequisitos[$requisito->id]) && $asignarRequisitos[$requisito->id]->estado == 0 ? 'active' : '' }}">
                                                    <input disabled type="radio" name="requisito[{{ $requisito->id }}]" value="0" {{ isset($asignarRequisitos[$requisito->id]) && $asignarRequisitos[$requisito->id]->estado == 0 ? 'checked' : '' }}>
                                                    No entregado
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-gro">
                                <a href="{{ route('inscripciones.index') }}" class="btn btn-secondary">Atrás</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
