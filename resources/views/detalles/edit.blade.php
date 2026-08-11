@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1 class="text-center"><b>Actualizacion de Detalles</b></h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title"><b>Llene los Datos de Forma Correcta</b></h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ url('/detalles',$detalle->id) }}">
                                @csrf
                                {{ method_field('PATCH') }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Descripción</label>
                                            <textarea name="descripcion" class="form-control" style="width: 100%; height: 150px;">{{ $detalle->descripcion }}</textarea>
                                        </div>
                                    </div>                                    
                                    <div class="col-md-2">
                                        <label for="id_area">Áreas</label> <b>*</b>
                                        <select name="id_area" id="id_area" class="form-control selectpicker" data-live-search="true">
                                            <option value="">Seleccionar Áreas</option>
                                            @foreach ($areas as $area)
                                                <option value="{{ $area->id }}" {{ $detalle->id_area == $area->id ? 'selected' : '' }}>
                                                    {{ $area->nombre_area }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="id_programa">Programas</label> <b>*</b>
                                        <select name="id_programa" id="id_programa" class="form-control selectpicker" data-live-search="true">
                                            <option value="">Seleccionar Programas</option>
                                            @foreach ($programas as $programa)
                                                <option value="{{ $programa->id }}" {{ $detalle->id_programa == $programa->id ? 'selected' : '' }}>
                                                    {{ $programa->programa }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-gro">
                                            <a href="{{ url('/detalles') }}" class="btn btn-secondary">Cancelar</a>
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
