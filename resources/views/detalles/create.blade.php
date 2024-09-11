@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1>Crear de una nuevo detalle</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Llene los datos de forma correcta</b></h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ url('/detalles') }}">
                                @csrf

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Descripción</label> <b>*</b>
                                            <input type="text" name="descripcion" value="{{ old('descripcion') }}" class="form-control" required >
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="id_area">Area</label>
                                        <select name="id_area" id="id_area" class="form-control selectpicker"
                                            data-live-search="true" required>
                                            <option value="">Seleccionar Area</option>
                                            @foreach ($areas as $area)
                                                <option value="{{ $area->id }}">
                                                    {{ $area->nombre_area }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="id_programa">Inscritos</label>
                                        <select name="id_programa" id="id_programa" class="form-control selectpicker"
                                            data-live-search="true" required>
                                            <option value="">Seleccionar Programa</option>
                                            @foreach ($programas as $programa)
                                                <option value="{{ $programa->id }}">
                                                    {{ $programa->programa }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- <div class="col-md-4">
                                        <label for="">Siglas</label> <b>*</b>
                                        <input type="text" name="sigla" value="{{ old('sigla') }}" class="form-control" required>
                                        @error('sigla')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    </div> --}}
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-gro">
                                            <a href="{{ url('/detalles') }}" class="btn btn-secondary">Cancelar</a>
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
