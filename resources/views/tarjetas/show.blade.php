{{-- @extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1>Detalles de la Tarjeta RFID</h1><br>

        <div class="row">
            <div class="col-md-11">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Información de la Tarjeta</b></h3>
                    </div>
                    <div class="card-body" style="...">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="codigo">Codigo de la tarjeta</label>
                                    <input type="text" id="codigo" value="{{ $tarjeta->codigo }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombre_pasante">Nombre del Pasante</label>
                                    <input type="text" id="nombre_pasante" value="{{ $tarjeta->inscripcion->informacion->nombre_apellido }}" class="form-control" readonly>
                                </div>
                            </div>
                            
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <a href="{{ route('tarjetas.index') }}" class="btn btn-secondary">Regresar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}

@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1 class="text-center"><b>Datos de Tarjetas Registradas</b></h1><br>

        <div class="row">
            <div class="col-md-11">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Datos registrados</b></h3>
                    </div>
                    <div class="card-body" style="...">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Tarjeta</label>
                                    <input type="text" name="tarjeta" value="{{ $tarjeta->serie }}"
                                        class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-gro">
                                    <a href="{{ url('/tarjetas') }}" class="btn btn-secondary">Atras</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
