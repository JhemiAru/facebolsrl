@extends('layouts.admin')

@section('title', 'Detalles del Tipo de Sede')

@section('content')
<style>
    body {
        background: radial-gradient(ellipse at top, #0f2027 0%, #08141a 40%, #000 100%);
        color: #f1f5f9;
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
        overflow-x: hidden;
    }

    .sede-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 90vh;
        padding: 20px;
    }

    .sede-card {
        background: linear-gradient(145deg, rgba(20, 25, 35, 0.85) 0%, rgba(15, 20, 30, 0.9) 100%);
        border: 1px solid rgba(88, 166, 255, 0.15);
        border-radius: 24px;
        backdrop-filter: blur(20px);
        box-shadow: 
            0 15px 35px rgba(0, 0, 0, 0.5),
            0 5px 15px rgba(0, 0, 0, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
        max-width: 720px;
        width: 100%;
        padding: 40px 35px;
        position: relative;
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        animation: cardEntrance 0.8s ease-out;
    }

    .sede-card:hover {
        transform: translateY(-8px) scale(1.01);
        box-shadow: 
            0 25px 50px rgba(0, 150, 255, 0.25),
            0 15px 30px rgba(0, 0, 0, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.15);
        border-color: rgba(88, 166, 255, 0.3);
    }

    .sede-titulo {
        font-size: 2.2rem;
        font-weight: 700;
        background: linear-gradient(135deg, #58a6ff 0%, #7ee787 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 25px;
        text-align: center;
        text-shadow: 0 2px 10px rgba(88, 166, 255, 0.3);
    }

    .info-item {
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        font-size: 1.05rem;
        padding: 12px 15px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.03);
        border-left: 3px solid transparent;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .info-item:hover {
        background: rgba(255, 255, 255, 0.06);
        border-left: 3px solid #7ee787;
        transform: translateX(5px);
    }

    .info-item i {
        color: #7ee787;
        font-size: 1.3rem;
        margin-right: 15px;
        min-width: 25px;
        text-align: center;
        filter: drop-shadow(0 0 5px rgba(126, 231, 135, 0.5));
    }

    .badge-custom {
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
        color: white;
        box-shadow: 0 0 8px rgba(0,0,0,0.3);
    }

    .badge-activo {
        background: linear-gradient(135deg, #238636 0%, #3fb950 100%);
    }

    .badge-inactivo {
        background: linear-gradient(135deg, #da3633 0%, #f85149 100%);
    }

    .btn-volver {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        margin-top: 30px;
        background: linear-gradient(135deg, #238636 0%, #2ea043 50%, #3fb950 100%);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 12px 30px;
        text-decoration: none;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(46, 160, 67, 0.3);
    }

    .btn-volver:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 25px rgba(46, 160, 67, 0.5);
        background: linear-gradient(135deg, #2ea043 0%, #3fb950 50%, #56d364 100%);
    }

    @keyframes cardEntrance {
        from {
            opacity: 0;
            transform: translateY(30px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    @media (max-width: 768px) {
        .sede-card {
            padding: 30px 20px;
        }
    }
</style>

<div class="sede-container">
    <div class="sede-card">
        <h3 class="sede-titulo">Datos del Tipo de Sede</h3>

        <div class="empresa-info text-start mt-4">
            <div class="info-item">
                <i class="bi bi-building"></i>
                <strong>Nombre del Tipo de Sede:</strong>&nbsp; {{ $tipo_sede->nombreSede }}
            </div>

            <div class="info-item">
                <i class="bi bi-toggle-on"></i>
                <strong>Estado:</strong>&nbsp;
                @if ($tipo_sede->estado == 0)
                    <span class="badge-custom badge-inactivo">Inactivo</span>
                @else
                    <span class="badge-custom badge-activo">Activo</span>
                @endif
            </div>
        </div>

        <a href="{{ url('/tipo_sedes') }}" class="btn-volver">
            <i class="bi bi-arrow-left-circle"></i> Volver al listado
        </a>
    </div>
</div>
@endsection