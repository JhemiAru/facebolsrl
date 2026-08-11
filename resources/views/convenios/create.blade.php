@extends('layouts.admin')

@section('content')
<style>
    body {
        background: radial-gradient(ellipse at top, #0f2027 0%, #08141a 40%, #000 100%);
        color: #f1f5f9;
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
        overflow-x: hidden;
    }

    .container-fluid {
        background: transparent;
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
        transform: translateY(-8px);
        box-shadow:
            0 30px 60px rgba(0, 150, 255, 0.2),
            0 15px 30px rgba(0, 0, 0, 0.5),
            inset 0 1px 0 rgba(255, 255, 255, 0.15);
        border-color: rgba(88, 166, 255, 0.4);
    }

    .card-header {
        background: linear-gradient(135deg, #1a365d 0%, #2d3748 100%) !important;
        border-bottom: 1px solid rgba(88, 166, 255, 0.3);
        padding: 30px 40px;
        position: relative;
        overflow: hidden;
    }

    .card-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(88, 166, 255, 0.1), transparent);
        transition: left 0.7s ease;
    }

    .card-header:hover::before {
        left: 100%;
    }

    .card-header h5 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #58a6ff;
        margin: 0;
        text-shadow: 0 2px 10px rgba(88, 166, 255, 0.3);
    }

    .card-header h5 i {
        color: #7ee787;
        margin-right: 12px;
        filter: drop-shadow(0 0 8px rgba(126, 231, 135, 0.4));
    }

    .card-body {
        background: transparent;
        padding: 40px;
    }

    .form-label {
        font-weight: 600;
        color: #e2e8f0;
        margin-bottom: 12px;
        font-size: 1rem;
        display: block;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
    }

    .form-control {
        background: rgba(255, 255, 255, 0.95) !important;
        border: 2px solid rgba(255, 255, 255, 0.3) !important;
        border-radius: 16px;
        color: #000000 !important;
        padding: 14px 20px;
        font-size: 1rem;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        font-weight: 500;
    }

    .form-control::placeholder {
        color: #666666 !important;
        font-weight: 400;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
        color: #000000 !important;
        background: rgba(255, 255, 255, 0.95) !important;
    }

    .form-control:focus {
        background: #ffffff !important;
        border-color: #58a6ff !important;
        color: #000000 !important;
        box-shadow: 0 0 0 3px rgba(88, 166, 255, 0.3), 0 0 25px rgba(88, 166, 255, 0.4) !important;
        transform: translateY(-2px);
    }

    .btn-primary {
        background: linear-gradient(135deg, #238636 0%, #2ea043 50%, #3fb950 100%);
        border: none;
        border-radius: 50px;
        padding: 14px 35px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(46, 160, 67, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 12px 30px rgba(46, 160, 67, 0.5);
        background: linear-gradient(135deg, #2ea043 0%, #3fb950 50%, #56d364 100%);
    }

    .btn-outline-secondary {
        background: transparent;
        border: 2px solid #718096;
        color: #718096;
        border-radius: 50px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.4s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-outline-secondary:hover {
        background: #718096;
        color: #1a202c;
        border-color: #718096;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(113, 128, 150, 0.3);
    }

    .text-danger {
        color: #fc8181 !important;
        font-weight: 500;
        margin-top: 8px;
        display: block;
    }

    /* Select2 Estilizado */
    .select2-container .select2-selection--single {
        height: 52px !important;
        border-radius: 50px !important;
        background: rgba(255, 255, 255, 0.95) !important;
        border: 2px solid rgba(88, 166, 255, 0.4) !important;
        padding: 8px 16px !important;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
        font-weight: 500;
        color: #000000 !important;
    }

    .select2-container--default .select2-selection--single:hover,
    .select2-container--default.select2-container--open .select2-selection--single {
        border-color: #58a6ff !important;
        box-shadow: 0 0 12px rgba(88, 166, 255, 0.3);
        background: #ffffff !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #000000 !important;
        font-size: 1rem !important;
        padding-left: 4px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        border-color: #1e3a8a transparent transparent transparent !important;
        transition: transform 0.3s ease;
    }

    .select2-container--open .select2-selection__arrow b {
        transform: rotate(180deg);
        border-color: #f97316 transparent transparent transparent !important;
    }

    .select2-container--default .select2-results > .select2-results__options {
        background: rgba(255, 255, 255, 0.98);
        border-radius: 20px;
        border: 2px solid rgba(88, 166, 255, 0.3);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .select2-container--default .select2-results__option {
        padding: 10px 15px;
        font-size: 1rem;
        color: #000000;
        transition: all 0.2s ease;
    }

    .select2-container--default .select2-results__option--highlighted {
        background: linear-gradient(135deg, #1e3a8a, #3b82f6);
        color: #ffffff !important;
    }

    .select2-search--dropdown .select2-search__field {
        border: 2px solid rgba(88, 166, 255, 0.4) !important;
        border-radius: 12px;
        padding: 10px;
        color: #000000;
        background: rgba(255, 255, 255, 0.95);
        outline: none;
        transition: 0.3s ease;
    }

    .select2-search--dropdown .select2-search__field:focus {
        border-color: #58a6ff !important;
        box-shadow: 0 0 10px rgba(88, 166, 255, 0.3);
    }

    .select2-container {
        width: 100% !important;
    }
    /* --- ESTILO MODERNO PARA SELECT (MODALIDAD) --- */
    .styled-select {
        width: 100%;
        height: 52px;
        border-radius: 50px;
        background: rgba(255, 255, 255, 0.95);
        border: 2px solid rgba(88, 166, 255, 0.4);
        color: #000000;
        font-size: 1rem;
        font-weight: 500;
        padding: 10px 20px;
        appearance: none;
        outline: none;
        cursor: pointer;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        background-image: linear-gradient(to bottom, #ffffff 0%, #f8faff 100%), 
                        url("data:image/svg+xml;charset=UTF-8,<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%231e3a8a'><path d='M4 6l4 4 4-4z'/></svg>");
        background-repeat: no-repeat;
        background-position: right 1.2rem center;
        background-size: 16px;
    }

    /* Hover y Focus */
    .styled-select:hover {
        border-color: #58a6ff;
        box-shadow: 0 0 12px rgba(88, 166, 255, 0.3);
        background-color: #ffffff;
    }

    .styled-select:focus {
        border-color: #1e3a8a;
        box-shadow: 0 0 15px rgba(30, 58, 138, 0.4);
    }

    /* Opciones dentro del menú desplegable */
    .styled-select option {
        background: #ffffff;
        color: #000000;
        padding: 10px;
        font-size: 1rem;
    }

    /* Opciones hover (solo visible en algunos navegadores) */
    .styled-select option:hover {
        background: linear-gradient(135deg, #1e3a8a, #3b82f6);
        color: #ffffff;
    }
</style>

<div class="container-fluid py-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header rounded-top-4 p-4" style="background: linear-gradient(135deg, #1e3a8a, #f97316);">
            <h5 class="mb-0 text-white fw-bold d-flex align-items-center">
                <i class="fas fa-building me-2"></i> Adicionar Convenios
            </h5>
        </div>

        <div class="card-body bg-white p-5 rounded-bottom-4">
            <form action="{{ route('convenios.store') }}" method="POST" enctype="multipart/form-data" id="empresaForm">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label text-dark fw-semibold">Folio</label>
                        <input type="text" name="folio" class="form-control rounded-pill shadow-sm"
                               value="{{ old('folio') }}" placeholder="Ej: CNV-2025-001" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-dark fw-semibold">Empresa</label>
                        <select name="empresa_id" id="empresa_id" required>
                            <option value="">Seleccione una empresa...</option>
                            @foreach($empresas as $id => $nombre)
                                <option value="{{ $id }}">{{ $nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-dark fw-semibold">Fecha de inicio</label>
                        <input type="date" name="fecha_inicio" class="form-control rounded-pill shadow-sm"
                               value="{{ old('fecha_inicio') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-dark fw-semibold">Fecha de fin</label>
                        <input type="date" name="fecha_fin" class="form-control rounded-pill shadow-sm"
                               value="{{ old('fecha_fin') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="modalidad" class="form-label text-dark fw-semibold">Modalidad</label>
                        <select name="modalidad" id="modalidad" class="styled-select" required>
                            <option value="">Seleccione una opción...</option>
                            <option value="Presencial">Presencial</option>
                            <option value="Virtual">Virtual</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-dark fw-semibold">Promoción / Descuentos</label>
                        <input type="text" name="promo_descuentos" class="form-control rounded-pill shadow-sm"
                               placeholder="Ej: 20% de descuento..." value="{{ old('promo_descuentos') }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label text-dark fw-semibold">Facebook</label>
                        <input type="text" name="facebook" class="form-control rounded-pill shadow-sm"
                               placeholder="Ej: https://facebook.com/empresa" value="{{ old('facebook') }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label text-dark fw-semibold">Instagram</label>
                        <input type="text" name="instagram" class="form-control rounded-pill shadow-sm"
                               placeholder="Ej: https://instagram.com/empresa" value="{{ old('instagram') }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label text-dark fw-semibold">TikTok</label>
                        <input type="text" name="tik_tok" class="form-control rounded-pill shadow-sm"
                               placeholder="Ej: https://tiktok.com/@empresa" value="{{ old('tik_tok') }}">
                    </div>

                </div>

                <div class="d-flex justify-content-start gap-3 mt-4">
                    <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold rounded-pill shadow-sm">
                        <i class="fa fa-save me-2"></i> Adicionar
                    </button>
                    <a href="{{ route('convenios.index') }}" class="btn btn-outline-secondary px-4 py-2 fw-semibold rounded-pill">
                        <i class="fa fa-arrow-left me-2"></i> Atrás
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script>
    $(document).ready(function() {
        $('#empresa_id').select2({
            placeholder: '🔍 Buscar o seleccionar empresa...',
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endsection
