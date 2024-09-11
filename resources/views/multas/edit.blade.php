@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1 class="text-center"><b>Actualizar las multas</b></h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title"><b>Llene los datos de forma correcta</b></h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ url('/multas',$multa->id) }}">
                                @csrf
                                {{ method_field('PATCH') }}
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Nombre de la Multa</label>
                                            <input type="text" name="nombre_multa" value="{{ $multa->nombre_multa }}" class="form-control" required style="text-transform: uppercase;">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Monto de la Multa</label>
                                            <input type="text" name="monto" value="{{ $multa->monto }}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Hora Inicio Multa</label>
                                            <input type="time" name="p1" value="{{ $multa->p1 }}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Hora Fin multa</label>
                                            <input type="time" name="p2" value="{{ $multa->p2 }}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="turno">Turno</label> <b>*</b>
                                            <select id="turno" name="turno" class="form-control" required>
                                                <option value="">Seleccione un turno</option>
                                                <option value="1" {{ $multa->turno == 1 ? 'selected' : '' }}>Mañana</option>
                                                <option value="0" {{ $multa->turno == 0 ? 'selected' : '' }}>Tarde</option>
                                            </select>
                                        </div>
                                    </div>                                    
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-gro">
                                            <a href="{{ url('/multas') }}" class="btn btn-secondary">Cancelar</a>
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
