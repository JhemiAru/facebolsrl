@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1 class="text-center"><b>Datos de Generaciones Registradas</b></h1><br>

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
                                    <label for="">Gneraciones</label>
                                    <input type="text" name="generacion" value="{{ $generacion->generacion }}"
                                        class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Año</label>
                                <input type="text" name="año" value="{{ $generacion->año }}"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-gro">
                                    <a href="{{ url('/generaciones') }}" class="btn btn-secondary">Atras</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
