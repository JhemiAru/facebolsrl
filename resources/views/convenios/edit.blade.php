@extends("layouts.admin")

@section("content")
<style>
    body {
        background: radial-gradient(ellipse at top, #0f2027 0%, #08141a 40%, #000 100%);
        color: #f1f5f9;
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
        overflow-x: hidden;
    }

    .card {
        background: linear-gradient(145deg, rgba(20,25,35,0.95), rgba(15,20,30,0.98));
        border: 1px solid rgba(88,166,255,0.2);
        border-radius: 24px;
        backdrop-filter: blur(20px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.6);
        transition: all 0.5s ease;
        animation: cardEntrance 0.8s ease-out;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 50px rgba(88,166,255,0.3);
    }

    .card-header {
        background: linear-gradient(135deg, #1a365d, #2d3748);
        border-bottom: 1px solid rgba(88,166,255,0.3);
        padding: 25px 30px;
    }

    .card-header h4 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #58a6ff;
        margin: 0;
    }

    .form-label {
        font-weight: 600;
        color: #000000;
        margin-bottom: 8px;
    }

    .form-control, select {
        background: rgba(255,255,255,0.95) !important;
        border: 2px solid rgba(255,255,255,0.3) !important;
        border-radius: 16px;
        color: #000 !important;
        padding: 0px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
        width: 100%;
    }

    .form-control:focus, select:focus {
        border-color: #58a6ff !important;
        box-shadow: 0 0 0 3px rgba(88,166,255,0.3);
        transform: translateY(-2px);
    }

    .btn-primary {
        background: linear-gradient(135deg, #238636, #3fb950);
        border: none;
        border-radius: 50px;
        padding: 14px 35px;
        font-weight: 600;
        font-size: 1.1rem;
        box-shadow: 0 8px 25px rgba(46,160,67,0.3);
        transition: all 0.4s ease;
    }

    .btn-primary:hover {
        transform: translateY(-3px) scale(1.05);
        background: linear-gradient(135deg, #2ea043, #56d364);
        box-shadow: 0 12px 30px rgba(46,160,67,0.5);
    }

    .btn-outline-secondary {
        border: 2px solid #718096;
        color: #718096;
        border-radius: 50px;
        padding: 10px 25px;
        font-weight: 600;
        transition: all 0.4s ease;
        text-decoration: none;
    }

    .btn-outline-secondary:hover {
        background: #718096;
        color: #1a202c;
        box-shadow: 0 5px 15px rgba(113,128,150,0.3);
    }

    @keyframes cardEntrance {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="card mt-5 shadow-lg border-0">
    <div class="card-header text-white">
        <h4><i class="bi bi-pencil-square"></i> Editar Convenio</h4>
    </div>
    <div class="card-body bg-light">
        <a href="{{ route('convenios.index') }}" class="btn btn-outline-secondary mb-3">
            <i class="bi bi-arrow-left"></i> Atrás
        </a>

        <form action="{{ route('convenios.update', $convenio->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Folio</label>
                    <input type="text" name="folio" class="form-control" 
                           value="{{ old('folio', $convenio->folio) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Empresa</label>
                    <select name="empresa_id" id="empresa_id" class="form-control" required>
                        <option value="">Seleccione una empresa...</option>
                        @foreach($empresas as $id => $nombre)
                            <option value="{{ $id }}" 
                                {{ old('empresa_id', $convenio->empresa_id) == $id ? 'selected' : '' }}>
                                {{ $nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Fecha de inicio</label>
                    <input type="date" name="fecha_inicio" class="form-control" 
                           value="{{ old('fecha_inicio', $convenio->fecha_inicio) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Fecha de fin</label>
                    <input type="date" name="fecha_fin" class="form-control" 
                           value="{{ old('fecha_fin', $convenio->fecha_fin) }}">
                </div>

                <div class="col-12">
                    <label class="form-label">Modalidad</label>
                    <textarea name="modalidad" class="form-control" rows="2">{{ old('modalidad', $convenio->modalidad) }}</textarea>
                </div>

                

                <div class="col-12">
                    <label class="form-label">Promoción en Descuentos (%)</label>
                    <input type="text" name="promo_descuentos" class="form-control" 
                           value="{{ old('promo_descuentos', $convenio->promo_descuentos) }}">
                </div>
                
                <div class="col-md-4">
                    <label class="form-label">Facebook</label>
                    <input type="text" name="facebook" class="form-control" 
                           value="{{ old('facebook', $convenio->facebook) }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Instagram</label>
                    <input type="text" name="instagram" class="form-control" 
                           value="{{ old('instagram', $convenio->instagram) }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label">TikTok</label>
                    <input type="text" name="tik_tok" class="form-control" 
                           value="{{ old('tik_tok', $convenio->tik_tok) }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Estado</label><br>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-outline-success {{ $convenio->estado == 1 ? 'active' : '' }}">
                            <input type="radio" name="estado" value="1" {{ $convenio->estado == 1 ? 'checked' : '' }}> Activo
                        </label>
                        <label class="btn btn-outline-danger {{ $convenio->estado == 0 ? 'active' : '' }}">
                            <input type="radio" name="estado" value="0" {{ $convenio->estado == 0 ? 'checked' : '' }}> Inactivo
                        </label>
                    </div>
                </div>

                <div class="col-12 text-end mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Actualizar Convenio
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
