<div class="form-group">
    <label for="direccion" class="font-weight-bold">Dirección</label>
    <input type="text" name="direccion" class="form-control rounded shadow-sm"
           value="{{ old('direccion', $sucursal->direccion ?? '') }}" required>
</div>

<div class="form-group">
    <label for="telefono" class="font-weight-bold">Teléfono</label>
    <input type="text" name="telefono" class="form-control rounded shadow-sm"
           value="{{ old('telefono', $sucursal->telefono ?? '') }}" required>
</div>

<div class="form-group">
    <label for="id_lugar" class="font-weight-bold">Ciudad</label>
    <select name="id_lugar" class="form-control rounded shadow-sm" required>
        <option value="" disabled selected>Seleccione una ciudad</option>
        @foreach($lugares as $id => $ciudad)
            <option value="{{ $id }}" {{ old('id_lugar', $sucursal->id_lugar ?? '') == $id ? 'selected' : '' }}>
                {{ $ciudad }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="id_empresa" class="font-weight-bold">Empresa</label>
    <select name="id_empresa" class="form-control rounded shadow-sm" required>
        <option value="" disabled selected>Seleccione una empresa</option>
        @foreach($empresas as $id => $nombre)
            <option value="{{ $id }}" {{ old('id_empresa', $sucursal->id_empresa ?? '') == $id ? 'selected' : '' }}>
                {{ $nombre }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="id_tiposede" class="font-weight-bold">Tipo de Sede</label>
    <select name="id_tiposede" class="form-control rounded shadow-sm" required>
        <option value="" disabled selected>Seleccione un tipo de sede</option>
        @foreach($tiposede as $id => $nombre)
            <option value="{{ $id }}" {{ old('id_tiposede', $sucursal->id_tiposede ?? '') == $id ? 'selected' : '' }}>
                {{ $nombre }}
            </option>
        @endforeach
    </select>
</div>
