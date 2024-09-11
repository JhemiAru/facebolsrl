@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1 class="text-center"><b>Datos de los Requisitos Registrados</b></h1><br>

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
                                        <label for="">Nombre de las requisitos</label>
                                        <input type="text" name="requisito" value="{{ $requisito->requisito }}" class="form-control" disabled>
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">
                                    <label for="">Siglas</label>
                                    <input type="text" name="sigla" value="{{ $requisito->sigla }}" class="form-control" disabled>
                                </div> --}}
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-gro">
                                        <a href="{{ url('/requisitos') }}" class="btn btn-secondary">Atras</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
