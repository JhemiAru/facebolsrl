@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1 class="text-center"><b>Crear una nueva multa</b></h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Llene los datos de forma correcta</b></h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ url('/multas') }}">
                                @csrf

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Nombre de la Multa</label> <b>*</b>
                                            <input type="text" name="nombre_multa" value="{{ old('nombre_multa') }}" class="form-control" required style="text-transform: uppercase;">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Monto Multa</label> <b>*</b>
                                            <input type="text" name="monto" value="{{ old('monto') }}" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Hora Inicio Multa</label> <b>*</b>
                                            <input type="time" name="p1" value="{{ old('p1') }}" class="form-control" step="1" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Hora Fin Multa</label> <b>*</b>
                                            <input type="time" name="p2" value="{{ old('p2') }}" class="form-control" step="1" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="turno">Turno</label> <b>*</b>
                                            <select id="turno" name="turno" class="form-control" required>
                                                <option value="">Seleccione un turno</option>
                                                <option value="1">Mañana</option>
                                                <option value="0">Tarde</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-gro">
                                            <a href="{{ url('/multas') }}" class="btn btn-secondary">Cancelar</a>
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
