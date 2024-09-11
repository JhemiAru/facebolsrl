@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1>Actualizacion las Extensiónes</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title"><b>Llene los datos de forma correcta</b></h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ url('/extensiones',$extension->id) }}">
                                @csrf
                                {{ method_field('PATCH') }}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Ciudad</label>
                                            <input type="text" name="ciudad" value="{{ $extension->ciudad }}" class="form-control" required style="text-transform: uppercase;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Expedido</label>
                                        <input type="text" name="expedido" value="{{ $extension->expedido }}" class="form-control" required style="text-transform: uppercase;">
                                    </div>                       
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-gro">
                                            <a href="{{ url('/extensiones') }}" class="btn btn-secondary">Cancelar</a>
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
