@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1 class="text-center"><b>Actualización de las Tarjetas</b></h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title"><b>Llene los datos de forma correcta</b></h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ url('/tarjetas', $tarjeta->id) }}">
                                @csrf
                                {{ method_field('PATCH') }}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">tarjetas</label>
                                            <input type="text" name="tarjeta" value="{{ $tarjeta->serie }}"
                                                class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Estado</label>
                                            <br>
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label
                                                    class="btn btn-outline-success {{ $tarjeta->estado == 'activo' ? 'active' : '' }}">
                                                    <input type="radio" name="estado" value="1"
                                                        {{ $tarjeta->estado == 'activo' ? 'checked' : '' }}> Activo
                                                </label>
                                                <label
                                                    class="btn btn-outline-danger {{ $tarjeta->estado == 'inactivo' ? 'active' : '' }}">
                                                    <input type="radio" name="estado" value="0"
                                                        {{ $tarjeta->estado == 'inactivo' ? 'checked' : '' }}> Inactivo
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-gro">
                            <a href="{{ url('/tarjetas') }}" class="btn btn-secondary">Cancelar</a>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
