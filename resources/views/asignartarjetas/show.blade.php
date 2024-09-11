@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1 class="text-center"><b>Detalles de la Asignación de Tarjeta RFID</b></h1><br>

        <div class="row">
            <div class="col-md-11">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Información de la Asignartarjeta</b></h3>
                    </div>
                    <div class="card-body" style="...">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="codigo">Codigo de la asignartarjeta</label>
                                    <input type="text" id="codigo" value="{{ $asignartarjeta->tarjeta->serie }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombre_pasante">Nombre del Pasante</label>
                                    <input type="text" id="nombre_pasante" value="{{ $asignartarjeta->inscripcion->informacion->nombre_apellido }}" class="form-control" readonly>
                                </div>
                            </div>
                            <!-- Agregar más campos si es necesario -->
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <a href="{{ route('asignartarjetas.index') }}" class="btn btn-secondary">Regresar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
