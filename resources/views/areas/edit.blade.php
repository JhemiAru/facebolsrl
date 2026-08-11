@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1>Actualizacion de las areas</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title"><b>Llene los datos de forma correcta</b></h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ url('/areas', $area->id) }}">
                                @csrf
                                {{ method_field('PATCH') }}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nombre de las areas</label>
                                            <input type="text" name="nombre_area" value="{{ $area->nombre_area }}"
                                                class="form-control" required style="text-transform: uppercase;">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Estado</label>
                                            <br>
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label
                                                    class="btn btn-outline-success {{ $area->estado == 'activo' ? 'active' : '' }}">
                                                    <input type="radio" name="estado" value="1"
                                                        {{ $area->estado == 1 ? 'checked' : '' }}> Activo
                                                </label>
                                                <label
                                                    class="btn btn-outline-danger {{ $area->estado == 'inactivo' ? 'active' : '' }}">
                                                    <input type="radio" name="estado" value="0"
                                                        {{ $area->estado == 0 ? 'checked' : '' }}> Inactivo
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-gro">
                                            <a href="{{ url('/areas') }}" class="btn btn-secondary">Cancelar</a>
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
