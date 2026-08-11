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
        background: linear-gradient(145deg, rgba(20, 25, 35, 0.95) 0%, rgba(15, 20, 30, 0.98) 100%);
        border: 1px solid rgba(88, 166, 255, 0.2);
        border-radius: 24px;
        backdrop-filter: blur(20px);
        box-shadow: 
            0 20px 40px rgba(0, 0, 0, 0.6),
            0 8px 20px rgba(0, 0, 0, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        animation: cardEntrance 0.8s ease-out;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 
            0 30px 60px rgba(0, 150, 255, 0.2),
            0 15px 30px rgba(0, 0, 0, 0.5),
            inset 0 1px 0 rgba(255, 255, 255, 0.15);
        border-color: rgba(88, 166, 255, 0.4);
    }

    .card-header {
        background: linear-gradient(135deg, #1a365d 0%, #2d3748 100%) !important;
        border-bottom: 1px solid rgba(88, 166, 255, 0.3);
        padding: 25px 30px;
    }

    .card-header h4 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #58a6ff;
        margin: 0;
        text-shadow: 0 2px 10px rgba(88, 166, 255, 0.3);
    }

    .card-header h4 i {
        color: #7ee787;
        margin-right: 12px;
    }

    .btn-outline-secondary {
        background: transparent;
        border: 2px solid #718096;
        color: #718096;
        border-radius: 50px;
        padding: 10px 25px;
        font-weight: 600;
        transition: all 0.4s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-outline-secondary:hover {
        background: #718096;
        color: #1a202c;
        transform: translateY(-2px);
    }

    .form-label {
        font-weight: 600;
        color: #e2e8f0;
        margin-bottom: 12px;
        font-size: 1rem;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.95) !important;
        border: 2px solid rgba(255, 255, 255, 0.3) !important;
        border-radius: 16px;
        color: #000 !important;
        padding: 14px 20px;
        font-size: 1rem;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .form-control:focus {
        border-color: #58a6ff !important;
        box-shadow: 0 0 0 3px rgba(88, 166, 255, 0.3);
    }

    .btn-primary {
        background: linear-gradient(135deg, #238636 0%, #2ea043 50%, #3fb950 100%);
        border: none;
        border-radius: 50px;
        padding: 14px 35px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.4s ease;
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        background: linear-gradient(135deg, #2ea043 0%, #3fb950 50%, #56d364 100%);
    }

    @keyframes cardEntrance {
        from { opacity: 0; transform: translateY(30px) scale(0.95); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }
</style>

<div class="card mt-5 shadow-lg border-0">
    <div class="card-header bg-dark text-white">
        <h4 class="mb-0"><i class="bi bi-pencil-square"></i> Editar Lugar</h4>
    </div>
    <div class="card-body bg-light">
        <a href="{{ route('lugar.index') }}" class="btn btn-outline-secondary btn-sm mb-3">
            <i class="bi bi-arrow-left"></i> Atrás
        </a>

        <form action="{{ route('lugar.update', $lugar->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold text-dark">Ciudad</label>
                    <input type="text" name="ciudad" class="form-control rounded-pill text-uppercase"
                           value="{{ old('ciudad', $lugar->ciudad) }}" required>
                    @error("ciudad") <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold text-dark">Departamento</label>
                    <input type="text" name="departamento" class="form-control rounded-pill text-uppercase"
                           value="{{ old('departamento', $lugar->departamento) }}" required>
                    @error("departamento") <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold text-dark">Provincia</label>
                    <input type="text" name="provincia" class="form-control rounded-pill text-uppercase"
                           value="{{ old('provincia', $lugar->provincia) }}" required>
                    @error("provincia") <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-3 mt-3">
                    <label class="form-label fw-semibold text-dark">Estado</label><br>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-outline-success {{ $lugar->estado == 1 ? 'active' : '' }}">
                            <input type="radio" name="estado" value="1" {{ $lugar->estado == 1 ? 'checked' : '' }}> Activo
                        </label>
                        <label class="btn btn-outline-danger {{ $lugar->estado == 0 ? 'active' : '' }}">
                            <input type="radio" name="estado" value="0" {{ $lugar->estado == 0 ? 'checked' : '' }}> Inactivo
                        </label>
                    </div>
                </div>

                <div class="col-12 mt-4 text-end">
                    <button type="submit" class="btn btn-primary rounded-pill shadow-sm px-4">
                        <i class="bi bi-save"></i> Actualizar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
