@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1>Actualizacion de las certificados</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title"><b>Llene los datos de forma correcta</b></h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ url('/certificados',$certificado->id) }}">
                                @csrf
                                {{ method_field('PATCH') }}
                                <div class="row">

                                    <div class="col-md-4">
                                        <label for="id_detalle">Detalles</label>
                                        <select name="id_detalle" id="id_detalle" class="form-control selectpicker"
                                            data-live-search="true" required>
                                            <option value="">Seleccionar Area</option>
                                            @foreach ($detalles as $detalle)
                                                <option value="{{ $detalle->id }}" {{ old('id_detalle', $certificado->id_detalle) == $detalle->id ? 'selected' : '' }}>
                                                    {{ $detalle->area->nombre_area }} | {{ $detalle->programa->programa }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="id_inscripcion">Inscritos</label>
                                        <select name="id_inscripcion" id="id_inscripcion" class="form-control selectpicker"
                                            data-live-search="true" required>
                                            <option value="">Seleccionar Pasante</option>
                                            @foreach ($inscripcions as $inscripcion)
                                                <option value="{{ $inscripcion->id }}" {{ old('id_inscripcion', $certificado->id_inscripcion) == $inscripcion->id ? 'selected' : '' }}>
                                                    {{ $inscripcion->informacion->nombre_apellido }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-gro">
                                            <a href="{{ url('/certificados') }}" class="btn btn-secondary">Cancelar</a>
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

    </div>
@endsection
