@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">
    <h1 class="text-center"><b>Actualizar Inscripción</b></h1><br>

    <div class="row">
        <div class="col-md-11">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title"><b>Llene los Datos</b></h3>
                </div>
                <div class="card-body" style="...">
                    <form id="inscripcionForm" action="{{ url('/inscripciones', $inscripcion->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="f_inscripcion">Fecha de Inscripción</label> <b>*</b>
                                    <input type="date" id="f_inscripcion" name="f_inscripcion" value="{{ old('f_inscripcion', $inscripcion->f_inscripcion) }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="recibos">Recibos</label> <b>*</b>
                                <input type="text" name="recibos" value="{{ old('recibos', $inscripcion->recibos) }}" class="form-control" style="text-transform: uppercase;" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="direccion">Dirección</label> <b>*</b>
                                <input type="text" name="direccion" value="{{ old('direccion', $inscripcion->direccion) }}" class="form-control" style="text-transform: uppercase;">
                            </div>
                            <div class="col-md-3">
                                <label for="email">Correo</label> <b>*</b>
                                <input type="email" name="email" value="{{ old('email', $inscripcion->users->email) }}" class="form-control" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="id_informacion">Apellidos y Nombres del Pasante</label>
                                <select name="id_informacion" id="id_informacion" class="form-control selectpicker" data-live-search="true" required >
                                    <option value="">Seleccionar Pasantes</option>
                                    @foreach ($informacions as $informacion)
                                        <option value="{{ $informacion->id }}" {{ $inscripcion->id_informacion == $informacion->id ? 'selected' : '' }}>
                                            {{ $informacion->apellido_paterno }} {{ $informacion->apellido_materno }} {{ $informacion->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="ci">CI</label> <b>*</b>
                                <input type="text" id="ci" name="ci" value="{{ old('ci', $inscripcion->ci) }}" class="form-control" readonly style="text-transform: uppercase;">
                            </div>

                            <div class="col-md-2">
                                <label for="id_extension">Extension</label> <b>*</b>
                                <select name="id_extension" id="id_extension" class="form-control selectpicker" data-live-search="true">
                                    <option value="">Seleccionar Áreas</option>
                                    @foreach ($extensions as $extension)
                                        <option value="{{ $extension->id }}" {{ $inscripcion->id_extension == $extension->id ? 'selected' : '' }}>
                                            {{ $extension->expedido }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="genero">Genero</label> <b>*</b>
                                <select name="genero" class="form-control" required>
                                    <option value="" disabled {{ old('genero', $inscripcion->genero) === null ? 'selected' : '' }}>Seleccionar</option>
                                    <option value="1" {{ old('genero', $inscripcion->genero) == 1 ? 'selected' : '' }}>MASCULINO</option>
                                    <option value="0" {{ old('genero', $inscripcion->genero) == 0 ? 'selected' : '' }}>FEMENINO</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for="id_area">Áreas</label> <b>*</b>
                                <select name="id_area" id="id_area" class="form-control selectpicker" data-live-search="true">
                                    <option value="">Seleccionar Áreas</option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}" {{ $inscripcion->id_area == $area->id ? 'selected' : '' }}>
                                            {{ $area->nombre_area }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="id_generacion">Generación</label> <b>*</b>
                                <select name="id_generacion" id="id_generacion" class="form-control selectpicker" data-live-search="true" required>
                                    <option value="">Seleccionar Generacion</option>
                                    @foreach ($generacions as $generacion)
                                        <option value="{{ $generacion->id }}" {{ $inscripcion->id_generacion == $generacion->id ? 'selected' : '' }}>
                                            {{ $generacion->generacion }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="codigo_credencial">Código Credencial</label><b>*</b>
                                <input type="text" id="codigo_credencial" name="codigo_credencial" value="{{ old('codigo_credencial', $inscripcion->codigo_credencial) }}" class="form-control" style="text-transform: uppercase;" readonly>
                            </div>
                            <div class="col-md-2">
                                <label for="id_role">Tipo de Roles</label> <b>*</b>
                                <select name="id_role" id="id_role" class="form-control selectpicker" data-live-search="true" required>
                                    <option value="">Seleccionar Roles</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ $inscripcion->users->roles->name == $role->name ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Estado</label>
                                    <br>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-outline-success {{ $inscripcion->estado == 'activo' ? 'active' : '' }}">
                                            <input type="radio" name="estado" value="1" {{ $inscripcion->estado == 1 ? 'checked' : '' }}> Activo
                                        </label>
                                        <label class="btn btn-outline-danger {{ $inscripcion->estado == 'inactivo' ? 'active' : '' }}">
                                            <input type="radio" name="estado" value="0" {{ $inscripcion->estado == 0 ? 'checked' : '' }}> Inactivo
                                        </label>
                                    </div>
                                </div>
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
                                                    <label class="btn btn-outline-success {{ isset($asignarRequisitos[$requisito->id]) && $asignarRequisitos[$requisito->id]->estado == 1 ? 'active' : '' }}">
                                                        <input type="radio" name="requisito[{{ $requisito->id }}]" value="1" {{ isset($asignarRequisitos[$requisito->id]) && $asignarRequisitos[$requisito->id]->estado == 1 ? 'checked' : '' }}>
                                                        Entregado
                                                    </label>
                                                    <label class="btn btn-outline-danger {{ isset($asignarRequisitos[$requisito->id]) && $asignarRequisitos[$requisito->id]->estado == 0 ? 'active' : '' }}">
                                                        <input type="radio" name="requisito[{{ $requisito->id }}]" value="0" {{ isset($asignarRequisitos[$requisito->id]) && $asignarRequisitos[$requisito->id]->estado == 0 ? 'checked' : '' }}>
                                                        No entregado
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

        // Habilitar codigo_credencial antes de enviar el formulario
        document.getElementById('inscripcionForm').addEventListener('submit', function() {
            codigoCredencialInput.disabled = false;
        });

        var now = new Date();
        var boliviaOffset = -4 * 60;
        var localOffset = now.getTimezoneOffset();
        var boliviaTime = new Date(now.getTime() + (boliviaOffset - localOffset) * 60 * 1000);
        var today = boliviaTime.toISOString().split('T')[0];
        var dateInput = document.getElementById('f_inscripcion');
        dateInput.value = today;
        dateInput.min = today;
    });
</script>
