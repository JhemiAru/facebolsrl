@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1>Datos de las areas registradas</h1><br>

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
                                        <label for="">Nombre de las areas</label>
                                        <input type="text" name="nombre_area" value="{{ $area->nombre_area }}" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Siglas</label>
                                    <input type="text" name="sigla" value="{{ $area->sigla }}" class="form-control" disabled>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-gro">
                                        <a href="{{ url('/areas') }}" class="btn btn-secondary">Atras</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
