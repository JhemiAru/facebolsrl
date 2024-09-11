{{-- @extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
        <h1>Crear un un nueva tarjeta</h1><br>

        @if ($message = Session::get('mensaje'))
            <script>
                Swal.fire({
                    title: "Buen trabajo!",
                    text: "{{ $message }}",
                    icon: "success"
                });
            </script>
        @endif

        <div class="row">
            <div class="col-md-11">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Llene los datos</b></h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tarjetas.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="codigo">Codigo de la tarjeta</label> <b>*</b>
                                        <input type="text" name="codigo" value="{{ old('codigo') }}" class="form-control @error('codigo') is-invalid @enderror" required>
                                        @error('codigo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="id_inscripcion">Nombre del Pasante</label>
                                    <select name="id_inscripcion" id="id_inscripcion" class="form-control selectpicker @error('id_inscripcion') is-invalid @enderror" data-live-search="true" required>
                                        <option value="">Seleccionar Pasantes</option>
                                        @foreach ($inscripcions as $inscripcion)
                                            <option value="{{ $inscripcion->id }}" >
                                                {{ $inscripcion->informacion->nombre_apellido }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_inscripcion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <a href="{{ route('tarjetas.index') }}" class="btn btn-secondary">Cancelar</a>
                                        <button type="submit" class="btn btn-primary">Guardar Registro</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
 --}}

 @extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1>Crear de una nueva tarjeta</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Llene los datos de forma correcta</b></h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ url('/tarjetas') }}">
                                @csrf

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">tarjetas</label> <b>*</b>
                                            <input type="text" name="serie" value="{{ old('serie') }}" class="form-control" required>
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
                                            <a href="{{ url('/tarjetas') }}" class="btn btn-secondary">Cancelar</a>
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
