@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 10px">
        <h1>Crear de una nuevo certificado</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Llene los datos de forma correcta</b></h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ url('/certificados') }}">
                                @csrf

                                <div class="row">


                                    <div class="col-md-4">
                                        <label for="id_detalle">Detalles</label>
                                        <select name="id_detalle" id="id_detalle" class="form-control selectpicker"
                                            data-live-search="true" required>
                                            <option value="">Seleccionar Area</option>
                                            @foreach ($detalles as $detalle)
                                                <option value="{{ $detalle->id }}">
                                                    {{ $detalle->area->nombre_area }} | {{ $detalle->programa->programa }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="id_inscripcion">Pasantes Inscritos</label>
                                        <select name="id_inscripcion" id="id_inscripcion" class="form-control select2"
                                            data-live-search="true" required>
                                            <option value="">Seleccionar Pasante</option>
                                            @foreach ($inscripcions as $inscripcion)
                                                <option value="{{ $inscripcion->id }}">
                                                    {{ $inscripcion->informacion->nombre }}
                                                    {{ $inscripcion->informacion->apellido_paterno }}
                                                    {{ $inscripcion->informacion->apellido_materno }}
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
                                            <a href="{{ url('/certificados') }}" class="btn btn-secondary">Cancelar</a>
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
<!-- Include jQuery -->
<script src="{{ asset('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>

<!-- Include Select2 CSS and JS -->
<link href="{{ asset('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css') }}"
    rel="stylesheet" />
<script src="{{ asset('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js') }}"></script>

<script>
    /* busqueda de apellidos y nombres del pasantes */
    $(document).ready(function() {
        // Inicializa Select2 en el select con id #id_inscripcion
        $('#id_inscripcion').select2({
            placeholder: 'Seleccionar Pasantes', // Texto que aparece cuando no se ha seleccionado nada
            allowClear: true // Permite limpiar la selección
        });
    });
</script>
