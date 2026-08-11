@extends('layouts.admin')

@section('content')
<style>
    body {
        background: radial-gradient(ellipse at top, #0f2027 0%, #08141a 40%, #000 100%);
        color: #f1f5f9;
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
    }

    .card {
        background: linear-gradient(145deg, rgba(20,25,35,0.95), rgba(15,20,30,0.98));
        border-radius: 24px;
        border: 1px solid rgba(88,166,255,0.2);
        box-shadow: 0 20px 40px rgba(0,0,0,0.6), 0 8px 20px rgba(0,0,0,0.4);
        transition: 0.5s;
        overflow: hidden;
    }

    .card-header {
        background: linear-gradient(135deg, #1a365d, #2d3748);
        color: #58a6ff;
        font-weight: bold;
        font-size: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 25px 30px;
        position: relative;
        overflow: hidden;
    }

    .card-header span i {
        color: #7ee787;
        margin-right: 8px;
        filter: drop-shadow(0 0 6px rgba(126,231,135,0.4));
    }

    .card-body {
        padding: 40px;
        background: rgba(255,255,255,0.95);
        border-radius: 0 0 24px 24px;
        color: #000;
    }

    .info-label {
        font-weight: 600;
        margin-bottom: 6px;
    }

    .info-value {
        font-size: 1.1rem;
        margin-bottom: 15px;
    }

    a.social-icon {
        display: inline-block;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        text-align: center;
        line-height: 40px;
        margin: 0 5px;
        font-size: 18px;
        color: #fff;
        transition: 0.3s;
    }
    a.social-icon:hover {
        transform: translateY(-3px) scale(1.1);
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    }
    a.social-facebook { background: #3b5998; }
    a.social-instagram { background: #e4405f; }
    a.social-tiktok { background: #010101; }

    .btn-back {
        background: #718096;
        color: #fff;
        border-radius: 50px;
        padding: 10px 25px;
        font-weight: 600;
        transition: 0.3s;
    }
    .btn-back:hover {
        background: #4a5568;
        transform: translateY(-2px);
    }
</style>

<div class="container-fluid py-4">
    <div class="card shadow-lg border-0">
        <div class="card-header">
            <span><i class="fas fa-building"></i> Detalles del Convenio</span>
            <a href="{{ route('convenios.index') }}" class="btn-back">
                <i class="fas fa-arrow-left me-1"></i> Volver
            </a>
        </div>
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="info-label">Folio</div>
                    <div class="info-value">{{ $convenio->folio }}</div>
                </div>

                <div class="col-md-6">
                    <div class="info-label">Empresa</div>
                    <div class="info-value">{{ $convenio->empresa->nombre_empresa ?? 'Sin empresa' }}</div>
                </div>

                <div class="col-md-6">
                    <div class="info-label">Fecha de inicio</div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($convenio->fecha_inicio)->format('d/m/Y') }}</div>
                </div>

                <div class="col-md-6">
                    <div class="info-label">Fecha de fin</div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($convenio->fecha_fin)->format('d/m/Y') }}</div>
                </div>

                <div class="col-md-6">
                    <div class="info-label">Modalidad</div>
                    <div class="info-value">{{ $convenio->modalidad }}</div>
                </div>

                <div class="col-md-6">
                    <div class="info-label">Promoción / Descuentos</div>
                    <div class="info-value">{{ $convenio->promo_descuentos ?? '-' }}</div>
                </div>

                <div class="col-12">
                    <div class="info-label">Redes Sociales</div>
                    <div>
                        @if($convenio->facebook)
                            <a href="{{ $convenio->facebook }}" target="_blank" class="social-icon social-facebook" title="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        @endif
                        @if($convenio->instagram)
                            <a href="{{ $convenio->instagram }}" target="_blank" class="social-icon social-instagram" title="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                        @endif
                        @if($convenio->tik_tok)
                            <a href="{{ $convenio->tik_tok }}" target="_blank" class="social-icon social-tiktok" title="TikTok">
                                <i class="fab fa-tiktok"></i>
                            </a>
                        @endif
                        @if(!$convenio->facebook && !$convenio->instagram && !$convenio->tik_tok)
                            <span class="text-muted">No hay redes sociales registradas</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
