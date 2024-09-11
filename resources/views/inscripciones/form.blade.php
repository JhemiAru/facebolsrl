{{-- <div class="container">
    <form
        action="{{ isset($inscripcion) ? route('inscripciones.update', $inscripcion->id) : route('inscripciones.store') }}"
        method="POST">
        @csrf
        @if (isset($inscripcion))
            @method('PUT')
        @endif

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="f_inscripcion">Fecha de Inscripción</label> <b>*</b>
                    <input type="date" name="f_inscripcion"
                        value="{{ old('f_inscripcion', isset($inscripcion) ? $inscripcion->f_inscripcion : '') }}"
                        class="form-control" required>
                </div>
            </div>
            <div class="col-md-2">
                <label for="recibos">Recibos</label> <b>*</b>
                <input type="text" name="recibos"
                    value="{{ old('recibos', isset($inscripcion) ? $inscripcion->recibos : '') }}"
                    class="form-control" required>
            </div>
            <div class="col-md-5">
                <label for="direccion">Dirección</label> <b>*</b>
                <input type="text" name="direccion"
                    value="{{ old('direccion', isset($inscripcion) ? $inscripcion->direccion : '') }}"
                    class="form-control" required>
            </div>
            <div class="col-md-2">
                <label for="codigo_credencial">Código Credencial</label> <b>*</b>
                <input type="text" name="codigo_credencial"
                    value="{{ old('codigo_credencial', isset($inscripcion) ? $inscripcion->codigo_credencial : '') }}"
                    class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for="id_informacion">Información del Pasante</label>
                <select name="id_informacion" id="id_informacion" class="form-control selectpicker"
                    data-live-search="true" required>
                    <option value="">Seleccionar Pasantes</option>
                    @foreach ($informacions as $informacion)
                        <option value="{{ $informacion->id }}"
                            {{ isset($inscripcion) && $inscripcion->id_informacion == $informacion->id ? 'selected' : '' }}>
                            {{ $informacion->nombre_apellido }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="id_generacion">Generación</label> <b>*</b>
                <select name="id_generacion" id="id_generacion" class="form-control selectpicker"
                    data-live-search="true" required>
                    <option value="">Seleccionar Generacion</option>
                    @foreach ($generacions as $generacion)
                        <option value="{{ $generacion->id }}"
                            {{ isset($inscripcion) && $inscripcion->id_generacion == $generacion->id ? 'selected' : '' }}>
                            {{ $generacion->generacion }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="id_area">Áreas</label> <b>*</b>
                <select name="id_area" id="id_area" class="form-control selectpicker" data-live-search="true">
                    <option value="">Seleccionar Áreas</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}"
                            {{ isset($inscripcion) && $inscripcion->id_area == $area->id ? 'selected' : '' }}>
                            {{ $area->nombre_area }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <hr>
        <div class="row">

            <table id="example1" class="table table-bordered table-striped table-m">
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
                                    <label class="btn btn-outline-success {{ $requisito->estado == 'entregado' ? 'active' : '' }}">
                                        <input type="radio" name="requisito[{{ $requisito->id }}]" value="1" {{ $requisito->estado == 'entregado' ? 'checked' : '' }}> Entregado
                                    </label>
                                    <label class="btn btn-outline-danger {{ $requisito->estado == 'no_entregado' ? 'active' : '' }}">
                                        <input type="radio" name="requisito[{{ $requisito->id }}]" value="0" {{ $requisito->estado == 'no_entregado' ? 'checked' : '' }}> No entregado
                                    </label>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
 --}}