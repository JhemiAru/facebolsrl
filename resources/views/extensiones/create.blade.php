@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1>Crear una Nuevo Extensión</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Llene los datos de forma correcta</b></h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ url('/extensiones') }}">
                                @csrf

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Ciudad</label> <b>*</b>
                                            <input type="text" name="ciudad" value="{{ old('ciudad') }}" class="form-control" required style="text-transform: uppercase;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Expedido</label> <b>*</b>
                                        <input type="text" name="expedido" value="{{ old('expedido') }}" class="form-control" required style="text-transform: uppercase;">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-gro">
                                            <a href="{{ url('/extensiones') }}" class="btn btn-secondary">Cancelar</a>
                                            <button type="submit" class="btn btn-primary">Guardar registro</button>
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
