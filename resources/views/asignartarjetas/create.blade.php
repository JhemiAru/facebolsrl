@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1 class="text-center"><b>Asignar un Nuevo Registro de RFID</b></h1><br>

        <div class="row">
            <div class="col-md-11">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Llene los Datos</b></h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('asignartarjetas.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="id_tarjeta">Tarjeta</label>
                                    <select name="id_tarjeta" id="id_tarjeta" class="form-control selectpicker @error('id_tarjeta') is-invalid @enderror" data-live-search="true" required>
                                        <option value="">Seleccionar Nro de tarjeta</option>
                                        @foreach ($tarjetas as $tarjeta)
                                            <option value="{{ $tarjeta->id }}" {{ old('id_tarjeta') == $tarjeta->id ? 'selected' : '' }}>
                                                {{ $tarjeta->serie }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_inscripcion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="id_inscripcion">Nombre del Pasante</label>
                                    <select name="id_inscripcion" id="id_inscripcion" class="form-control selectpicker @error('id_inscripcion') is-invalid @enderror" data-live-search="true" required>
                                        <option value="">Seleccionar Pasantes</option>
                                        @foreach ($inscripcions as $inscripcion)
                                            <option value="{{ $inscripcion->id }}" {{ old('id_inscripcion') == $inscripcion->id ? 'selected' : '' }}>
                                                {{ $inscripcion->informacion->apellido_paterno }} {{ $inscripcion->informacion->apellido_materno }} {{ $inscripcion->informacion->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_inscripcion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <a href="{{ route('asignartarjetas.index') }}" class="btn btn-secondary">Cancelar</a>
                                        <button type="submit" class="btn btn-primary">Guardar Registro</button>
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
