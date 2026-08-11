@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1 class="text-center"><b>Datos de los Detalles Registradas</b></h1><br>

        <div class="row">
            <div class="col-md-11">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Datos Registrados</b></h3>
                    </div>
                    <div class="card-body" style="...">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Area</label>
                                        <input type="text" name="sigla" value="{{ $detalle->area->nombre_area }}" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Programa</label>
                                    <input type="text" name="sigla" value="{{ $detalle->programa->programa }}" class="form-control" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Nombre del programa</label>
                                    <textarea name="nombre_programa" class="form-control" style="width: 100%; height: 150px; text-transform: uppercase;" disabled>{{ $detalle->descripcion }}</textarea>
                                </div>                              
               
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-gro">
                                        <a href="{{ url('/detalles') }}" class="btn btn-secondary">Atras</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
