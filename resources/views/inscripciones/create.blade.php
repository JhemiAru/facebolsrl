@extends('layouts.admin')

@section('content')

<style>
    .select2-container .select2-selection--single {
        height: 38px;
        padding: 6px 12px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 26px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px;
        right: 10px;
    }
    .select2-dropdown {
        border-radius: 0;
    }
    .select2-results__option {
        padding: 8px 12px;
    }
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #007bff;
        color: white;
    }
</style>

    <div class="content" style="margin-left: 20px">
        <h1 class="text-center"><b>Datos de la Inscripción</b></h1><br>
        <div class="row">
            <div class="col-md-11">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Llene los datos</b></h3>
                    </div>
                    <div class="card card-body" style="...">
                        <form id="inscripcionForm" action="{{ url('/inscripciones') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="f_inscripcion">Fecha Inscripción</label>
                                        <input type="date" id="f_inscripcion" name="f_inscripcion"
                                            value="{{ old('f_inscripcion') }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="recibos">Recibos</label> <b>*</b>
                                    <input type="text" name="recibos" value="{{ old('recibos') }}" class="form-control"
                                        required style="text-transform: uppercase;">
                                </div>
                                <div class="col-md-4">
                                    <label for="direccion">Dirección</label> <b>*</b>
                                    <input type="text" name="direccion" value="{{ old('direccion') }}"
                                        class="form-control" required style="text-transform: uppercase;">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Correo</label> <b>*</b>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="id_informacion">Apellidos y Nombres del Pasante</label>
                                        <select name="id_informacion" id="id_informacion" class="form-control" required>
                                            <option value="">Seleccionar Pasantes</option>
                                            @foreach ($informacions as $informacion)
                                                <option value="{{ $informacion->id }}">
                                                    {{ $informacion->apellido_paterno }} {{ $informacion->apellido_materno }} {{ $informacion->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="ci">C.I.</label> <b>*</b>
                                    <input type="number" name="ci" value="{{ old('ci') }}"
                                        class="form-control" required style="text-transform: uppercase;">
                                </div>
                                <div class="col-md-2">
                                    <label for="id_informacion">Extensión</label>
                                    <select name="id_extension" id="id_extension" class="form-control selectpicker"
                                        data-live-search="true" required>
                                        <option value="">Seleccionar</option>
                                        @foreach ($extensions as $extension)
                                            <option value="{{ $extension->id }}">
                                                {{ $extension->expedido }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="genero">Genero</label> <b>*</b>
                                    <select name="genero" class="form-control" required style="">
                                        <option value="" disabled {{ old('genero') ? '' : 'selected' }}>Seleccionar Genero</option>
                                        <option value="1" {{ old('genero') == 'MASCULINO' ? 'selected' : '' }}>MASCULINO</option>
                                        <option value="0" {{ old('genero') == 'FEMENINO' ? 'selected' : '' }}>FEMENINO</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="id_area">Áreas</label> <b>*</b>
                                    <select name="id_area" id="id_area" class="form-control selectpicker"
                                        data-live-search="true" required>
                                        <option value="">Seleccionar</option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id }}">
                                                {{ $area->nombre_area }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="id_generacion">Generación</label> <b>*</b>
                                    <select name="id_generacion" id="id_generacion" class="form-control selectpicker"
                                        data-live-search="true" required>
                                        <option value="">Seleccionar Generación</option>
                                        @foreach ($generacions as $generacion)
                                            <option value="{{ $generacion->id }}">
                                                {{ $generacion->generacion }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="codigo_credencial">Codigo Credencial</label> <b>*</b>
                                    <input type="text" name="codigo_credencial" id="codigo_credencial"
                                        value="" class="form-control" required
                                        style="text-transform: uppercase;" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="id_role">Tipos de Roles</label> <b>*</b>
                                    <select name="id_role" id="id_role" class="form-control selectpicker"
                                        data-live-search="true" required>
                                        <option value="">Seleccionar Roles</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <table id="example1" class="table table-bordered table-striped table-m text-center">
                                    <thead>
                                        <tr>
                                            <th>Requisito</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($requisitos as $requisito)
                                            <tr>
                                                <td>{{ $requisito->requisito }}</td>
                                                <td>
                                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                        <label class="btn btn-outline-success">
                                                            <input type="radio" name="requisito[{{ $requisito->id }}]"
                                                                value="1"> Entregado
                                                        </label>
                                                        <label class="btn btn-outline-danger">
                                                            <input type="radio" name="requisito[{{ $requisito->id }}]"
                                                                value="0"> No entregado
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <a href="{{ url('/inscripciones') }}" class="btn btn-secondary">Cancelar</a>
                                        <button type="submit" class="btn btn-success">Guardar Registro</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    {{-- </div> --}}

    
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var areaSelect = document.getElementById('id_area');
        var generacionSelect = document.getElementById('id_generacion');
        var codigoCredencialInput = document.getElementById('codigo_credencial');

        // Datos del controlador
        var inscripciones = @json($c_inscritos);

        function updateCodigoCredencial() {
            var areaText = areaSelect.options[areaSelect.selectedIndex].text;
            var generacionText = generacionSelect.options[generacionSelect.selectedIndex].text;

            if (areaText && generacionText && areaSelect.value && generacionSelect.value) {
                var areaCode = areaText.substring(0, 3).toUpperCase();
                var generacionCode = generacionText;
                console.log(inscripciones);
                var count = 0;
                var cantidad = 0;
                inscripciones.forEach(function(inscripcion) {
                    if (inscripcion.area_id == areaSelect.value && inscripcion.generacion_id ==
                        generacionSelect.value) {
                        cantidad = inscripcion.c_inscritos;
                        console.log(inscripcion.area_id + " , " + areaSelect.value + " c_inscritos " +
                            cantidad);
                    }
                });

                var countFormatted = (cantidad + 1).toString().padStart(2, '0');
                codigoCredencialInput.value = areaCode + generacionCode + countFormatted;
            } else {
                codigoCredencialInput.value = '';
            }
        }

        areaSelect.addEventListener('change', updateCodigoCredencial);
        generacionSelect.addEventListener('change', updateCodigoCredencial);

        var now = new Date();
        var boliviaOffset = -4 * 60;
        var localOffset = now.getTimezoneOffset();
        var boliviaTime = new Date(now.getTime() + (boliviaOffset - localOffset) * 60 * 1000);
        var today = boliviaTime.toISOString().split('T')[0];
        var dateInput = document.getElementById('f_inscripcion');
        dateInput.value = today;
        dateInput.min = today;

        // Frontend validation for radio buttons
        document.getElementById('inscripcionForm').addEventListener('submit', function(event) {
            let requisitos = document.querySelectorAll('[name^="requisito"]');
            let valid = true;
            requisitos.forEach(function(requisito) {
                if (!document.querySelector('input[name="' + requisito.name + '"]:checked')) {
                    valid = false;
                }
            });

            if (!valid) {
                event.preventDefault();
                alert('Debe seleccionar una opción para cada requisito.');
            }
        });

        /* busqueda de apellidos y nombres del pasantes */
        $(document).ready(function() {
            $('#id_informacion').select2({
                placeholder: 'Seleccionar Pasantes',
                allowClear: false
            });
        });

    });
</script>
