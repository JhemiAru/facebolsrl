@extends('layouts.admin')

@section('title', 'Detalles de la Empresa')

@section('content')
<style>
    body {
        background: radial-gradient(ellipse at top, #0f2027 0%, #08141a 40%, #000 100%);
        color: #f1f5f9;
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
        overflow-x: hidden;
    }

    .empresa-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 90vh;
        padding: 20px;
    }

    .empresa-card {
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

    .empresa-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(88, 166, 255, 0.1), transparent);
        transition: left 0.7s ease;
    }

    .empresa-card:hover::before {
        left: 100%;
    }

    .empresa-card:hover {
        transform: translateY(-8px) scale(1.01);
        box-shadow: 
            0 25px 50px rgba(0, 150, 255, 0.25),
            0 15px 30px rgba(0, 0, 0, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.15);
        border-color: rgba(88, 166, 255, 0.3);
    }

    .icono-container {
        position: relative;
        display: inline-block;
        margin-bottom: 15px;
    }

    .empresa-icono {
        width: 130px;
        height: 130px;
        object-fit: cover;
        border-radius: 24px;
        border: 3px solid #58a6ff;
        box-shadow: 
            0 0 30px rgba(88, 166, 255, 0.5),
            0 10px 20px rgba(0, 0, 0, 0.3);
        transition: all 0.4s ease;
        position: relative;
        z-index: 2;
    }

    .icono-container::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 150px;
        height: 150px;
        background: radial-gradient(circle, rgba(88, 166, 255, 0.3) 0%, transparent 70%);
        border-radius: 50%;
        z-index: 1;
        animation: pulse 3s infinite ease-in-out;
    }

    .empresa-icono:hover {
        transform: scale(1.05) rotate(2deg);
        box-shadow: 
            0 0 40px rgba(88, 166, 255, 0.7),
            0 15px 30px rgba(0, 0, 0, 0.4);
    }

    .empresa-nombre {
        font-size: 2.2rem;
        font-weight: 700;
        background: linear-gradient(135deg, #58a6ff 0%, #7ee787 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 15px 0 5px;
        text-shadow: 0 2px 10px rgba(88, 166, 255, 0.3);
        position: relative;
        display: inline-block;
    }

    .empresa-nombre::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 10%;
        width: 80%;
        height: 3px;
        background: linear-gradient(90deg, transparent, #58a6ff, transparent);
        border-radius: 50%;
    }

    .empresa-info {
        margin-top: 30px;
        position: relative;
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

    .info-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(126, 231, 135, 0.1), transparent);
        transition: left 0.5s ease;
    }

    .info-item:hover::before {
        left: 100%;
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

    .btn-volver::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.7s ease;
    }

    .btn-volver:hover::before {
        left: 100%;
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

    @keyframes pulse {
        0%, 100% {
            opacity: 0.6;
            transform: translate(-50%, -50%) scale(1);
        }
        50% {
            opacity: 0.3;
            transform: translate(-50%, -50%) scale(1.1);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .empresa-card {
            padding: 30px 20px;
        }
        
        .empresa-nombre {
            font-size: 1.8rem;
        }
        
        .empresa-icono {
            width: 110px;
            height: 110px;
        }
        
        .icono-container::after {
            width: 130px;
            height: 130px;
        }
    }
</style>

<div class="empresa-container">
    <div class="empresa-card text-center">
        <div class="icono-container">
            @if($empresa->icono)
                <img src="{{ asset($empresa->icono) }}" alt="Icono de la empresa" class="empresa-icono">
            @else
                <img src="{{ asset('dist/img/default.png') }}" alt="Sin icono" class="empresa-icono">
            @endif
        </div>

        <h3 class="empresa-nombre">{{ $empresa->nombre_empresa }}</h3>

        <div class="empresa-info text-start mt-4">
            <div class="info-item"><i class="bi bi-tags-fill"></i> <strong>Categoria:</strong>&nbsp; {{ $empresa->categoria->nombre }}</div>
            <div class="info-item"><i class="bi bi-person-fill"></i> <strong>Propietario:</strong>&nbsp; {{ $empresa->propietario }}</div>
            <div class="info-item"><i class="bi bi-geo-alt-fill"></i> <strong>Ubicación:</strong>&nbsp; {{ $empresa->ubicacion }}</div>
            <div class="info-item"><i class="bi bi-telephone-fill"></i> <strong>Celular:</strong>&nbsp; {{ $empresa->celular }}</div>
            <div class="info-item"><i class="bi bi-envelope-fill"></i> <strong>Correo:</strong>&nbsp; {{ $empresa->correo }}</div>
            <div class="info-item"><i class="bi bi-receipt"></i> <strong>NIT:</strong>&nbsp; {{ $empresa->nit }}</div>
            <div class="info-item"><i class="bi bi-file-text-fill"></i> <strong>Descripción:</strong>&nbsp; {{ $empresa->descripcion }}</div>
            <div class="info-item"><i class="bi bi-geo"></i> <strong>Coordenadas:</strong>&nbsp; Lat: {{ $empresa->latitud }}, Lng: {{ $empresa->longitud }}</div>
        </div>

        <a href="{{ route('empresas.index') }}" class="btn-volver">
            <i class="bi bi-arrow-left-circle"></i> Volver al listado
        </a>
    </div>
</div>
@endsection