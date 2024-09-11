@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1 class="text-center"><b>Crear un Nuevo Requisito</b></h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Llene los datos de forma correcta</b></h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ url('/requisitos') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nombre de los requisitos</label> <b>*</b>
                                            <input type="text" name="requisito" value="{{ old('nombre_requisito') }}" class="form-control" required style="text-transform: uppercase;">
                                        </div>
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
                                            <a href="{{ url('/requisitos') }}" class="btn btn-secondary">Cancelar</a>
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
