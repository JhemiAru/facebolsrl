@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1 class="text-center"><b>Actualizacion de las Generaciones</b></h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title"><b>Llene los Datos de Forma Correcta</b></h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ url('/generaciones',$generacion->id) }}">
                                @csrf
                                {{ method_field('PATCH') }}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Generaciones</label>
                                            <input type="text" name="generacion" value="{{ $generacion->generacion }}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Año</label>
                                        <input type="text" name="año" value="{{ $generacion->año }}" class="form-control" required>
                                    </div>                            
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Estado</label>
                                            <br>
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-outline-success {{ $generacion->estado == 'activo' ? 'active' : '' }}">
                                                    <input type="radio" name="estado" value="1" {{ $generacion->estado == 1 ? 'checked' : '' }}> Activo
                                                </label>
                                                <label class="btn btn-outline-danger {{ $generacion->estado == 'inactivo' ? 'active' : '' }}">
                                                    <input type="radio" name="estado" value="0" {{ $generacion->estado == 0 ? 'checked' : '' }}> Inactivo
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-gro">
                                            <a href="{{ url('/generaciones') }}" class="btn btn-secondary">Cancelar</a>
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
