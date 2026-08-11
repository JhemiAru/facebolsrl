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

    .content {
        margin-left: 10px;
        padding: 20px;
    }

    .text-center h1 {
        background: linear-gradient(135deg, #58a6ff 0%, #7ee787 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 30px;
        text-shadow: 0 4px 15px rgba(88, 166, 255, 0.3);
        padding: 20px 0;
    }

    .card {
        background: linear-gradient(145deg, rgba(20,25,35,0.95), rgba(15,20,30,0.98));
        border-radius: 24px;
        border: 1px solid rgba(88,166,255,0.2);
        box-shadow: 0 20px 40px rgba(0,0,0,0.6), 0 8px 20px rgba(0,0,0,0.4);
        transition: 0.5s;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-8px);
        box-shadow: 0 30px 60px rgba(0,150,255,0.25), 0 15px 30px rgba(0,0,0,0.5);
        border-color: rgba(88,166,255,0.4);
    }

    .card-header {
        background: linear-gradient(135deg, #1a365d, #2d3748);
        color: #58a6ff;
        font-weight: bold;
        font-size: 1.3rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 30px;
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
        background: linear-gradient(90deg, transparent, rgba(88,166,255,0.1), transparent);
        transition: left 0.7s ease;
    }

    .card-header:hover::before {
        left: 100%;
    }

    .card-header span i {
        color: #7ee787;
        margin-right: 8px;
        filter: drop-shadow(0 0 6px rgba(126,231,135,0.4));
    }

    .btn-primary, .btn-success, .btn-danger, .btn-info {
        border-radius: 50px;
        padding: 8px 16px;
        font-weight: 500;
        transition: 0.3s;
        border: none;
    }

    .btn-primary { 
        background: linear-gradient(135deg, #238636 0%, #2ea043 50%, #3fb950 100%); 
        color: #fff; 
    }
    .btn-primary:hover { 
        transform: translateY(-2px) scale(1.05); 
        box-shadow: 0 10px 25px rgba(46,160,67,0.4); 
    }

    .btn-success { background: #2d6a4f; color: #fff; }
    .btn-success:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(45,106,79,0.4); }

    .btn-info { background: #3b82f6; color: #fff; }
    .btn-info:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(59,130,246,0.4); }

    .btn-danger { background: #e53e3e; color: #fff; }
    .btn-danger:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(229,62,62,0.4); }

    /* === ESTILOS PARA TARJETAS DE CONVENIOS === */
    .convenio-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 25px;
        margin-top: 25px;
        animation: fadeIn 0.8s ease-out;
    }

    .convenio-card {
        color: #ffffff;
        background: linear-gradient(145deg, rgba(20, 25, 35, 0.95) 0%, rgba(10, 15, 25, 0.98) 100%);
        border: 1px solid rgba(88, 166, 255, 0.2);
        border-radius: 20px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.6), inset 0 1px 0 rgba(255, 255, 255, 0.1);
        transition: all 0.4s ease;
        padding: 25px;
        overflow: hidden;
        min-height: 420px;
    }

    .convenio-card:hover {
        transform: translateY(-5px);
        border-color: rgba(88, 166, 255, 0.4);
        box-shadow: 0 20px 40px rgba(0, 150, 255, 0.25), 0 10px 25px rgba(0, 0, 0, 0.5);
    }

    .convenio-card h4 {
        color: #7ee787 !important;
        text-align: center;
        font-weight: 700;
        margin-bottom: 20px;
        font-size: 1.4rem;
    }

    .convenio-card p {
        color: #e2e8f0;
        font-size: 0.95rem;
        margin: 8px 0;
        line-height: 1.6;
    }

    .convenio-card strong {
        color: #58a6ff;
    }

    .convenio-folio {
        background: linear-gradient(135deg, #58a6ff, #7ee787);
        color: #000;
        padding: 5px 15px;
        border-radius: 20px;
        display: inline-block;
        font-weight: 700;
        font-size: 0.9rem;
        margin-bottom: 15px;
    }

    .convenio-estado {
        text-align: center;
        margin: 15px 0;
    }

    .badge-activo {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: #fff;
        padding: 8px 20px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .badge-inactivo {
        background: linear-gradient(135deg, #ef4444, #f87171);
        color: #fff;
        padding: 8px 20px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .convenio-redes {
        text-align: center;
        margin: 15px 0;
    }

    .social-icon {
        display: inline-block;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        text-align: center;
        line-height: 38px;
        margin: 0 5px;
        transition: 0.3s;
        font-size: 18px;
        color: #fff;
    }

    .social-icon:hover {
        transform: translateY(-3px) scale(1.15);
        box-shadow: 0 6px 15px rgba(0,0,0,0.4);
    }

    .social-facebook { background: #3b5998; }
    .social-instagram { background: #e4405f; }
    .social-tiktok { background: #010101; }

    .convenio-actions {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }

    .convenio-actions .btn {
        border-radius: 10px;
        font-weight: 600;
        padding: 8px 16px;
    }

    .control-panel {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(88, 166, 255, 0.2);
        border-radius: 15px;
        backdrop-filter: blur(10px);
    }

    .control-panel label {
        color: #7ee787;
        font-weight: 600;
    }

    .control-panel input,
    .control-panel select {
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(88,166,255,0.4);
        color: #fff;
        border-radius: 10px;
        padding: 8px 12px;
    }

    .control-panel input:focus,
    .control-panel select:focus {
        border-color: #58a6ff;
        box-shadow: 0 0 0 2px rgba(88, 166, 255, 0.2);
        outline: none;
    }
    /* Color de las opciones desplegadas */
.control-panel select option {
    color: #000; /* texto negro */
    background-color: #fff; /* fondo blanco */
}

/* Opcional: para compatibilidad en focus o hover dentro del dropdown */
.control-panel select option:hover {
    background-color: #f0f0f0; /* ligero gris al pasar el mouse */
    color: #000;
}


    #pagination button {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #e2e8f0;
        border-radius: 8px;
        margin: 3px;
        padding: 8px 15px;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    #pagination button:hover:not(:disabled) {
        background: rgba(88, 166, 255, 0.3);
        color: #fff;
        transform: translateY(-2px);
    }

    #pagination button.current {
        background: linear-gradient(135deg, #58a6ff 0%, #7ee787 100%);
        color: #000;
        font-weight: 700;
        box-shadow: 0 0 10px rgba(88, 166, 255, 0.4);
    }

    #pagination button:disabled {
        opacity: 0.4;
        cursor: not-allowed;
    }

    @media (max-width: 768px) {
        .convenio-grid {
            grid-template-columns: 1fr;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="content">
    <h1 class="text-center"><b>Gestión de Convenios</b></h1>

    <div class="card card-outline card-primary">
        <div class="card-header">
            <span><i class="fas fa-handshake"></i> Lista de Convenios</span>
            @can('asistencias')
            <a href="{{ route('convenios.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Nuevo Convenio
            </a>
            @endcan
        </div>

        <div class="card-body">
            {{-- Control Panel --}}
            <div class="control-panel p-3 mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="search-box">
                    <label for="searchInput" class="me-2">🔍 Buscar:</label>
                    <input type="text" 
                           id="searchInput" 
                           placeholder="Buscar por folio o empresa..." 
                           class="form-control d-inline-block w-auto text-uppercase">
                </div>

                <div class="status-filter">
                    <label for="estadoFiltro" class="me-2">Estado:</label>
                    <select id="estadoFiltro" class="form-select w-auto">
                        <option value="todos" selected>Todos</option>
                        <option value="activo">Activos</option>
                        <option value="inactivo">Inactivos</option>
                    </select>
                </div>
                
                <div class="pagination-size">
                    <label for="itemsPerPage" class="me-2">Mostrar:</label>
                    <select id="itemsPerPage" class="form-select w-auto">
                        <option value="6">6</option>
                        <option value="10" selected>10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                    </select>
                </div>
            </div>

            {{-- Grid de Convenios --}}
            <div class="convenio-grid">
                @foreach($convenios as $convenio)
                <div class="convenio-card"
     data-folio="{{ strtoupper($convenio->folio) }}"
     data-nombre="{{ strtoupper($convenio->empresa->nombre_empresa ?? '') }}"
     data-estado="{{ $convenio->estado == 1 ? 'activo' : 'inactivo' }}">

                    
                    <div class="text-center">
                        <span class="convenio-folio">{{ $convenio->folio }}</span>
                    </div>

                    <h4>{{ $convenio->empresa->nombre_empresa ?? 'Sin empresa' }}</h4>

                    <p><strong>Inicio:</strong> {{ $convenio->fecha_inicio }}</p>
                    <p><strong>Fin:</strong> {{ $convenio->fecha_fin }}</p>

                    <p><strong>Modalidad:</strong> {{ $convenio->modalidad }}</p>

                    <p><strong>Promoción:</strong>
                        @php
                            $promo = $convenio->promo_descuentos ?? 'Sin promoción';
                            $limite = 50;
                        @endphp
                        @if(strlen($promo) > $limite)
                            <span class="promo-text" title="{{ $promo }}">
                                {{ substr($promo, 0, $limite) . '...' }}
                            </span>
                        @else
                            {{ $promo }}
                        @endif
                    </p>

                    <div class="convenio-estado">
                        @if($convenio->estado == 1)
                            <span class="badge-activo">✓ Activo</span>
                        @else
                            <span class="badge-inactivo">✗ Inactivo</span>
                        @endif
                    </div>

                    @if($convenio->facebook || $convenio->instagram || $convenio->tik_tok)
                    <div class="convenio-redes">
                        <strong style="color: #58a6ff;">Redes Sociales:</strong><br>
                        @if($convenio->facebook)
                            <a href="{{ $convenio->facebook }}" target="_blank" 
                               class="social-icon social-facebook" title="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        @endif
                        @if($convenio->instagram)
                            <a href="{{ $convenio->instagram }}" target="_blank" 
                               class="social-icon social-instagram" title="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                        @endif
                        @if($convenio->tik_tok)
                            <a href="{{ $convenio->tik_tok }}" target="_blank" 
                               class="social-icon social-tiktok" title="TikTok">
                                <i class="fab fa-tiktok"></i>
                            </a>
                        @endif
                    </div>
                    @endif

                    {{-- Acciones --}}
                    <div class="convenio-actions">
                        <a href="{{ url('convenios', $convenio->id) }}" 
                           class="btn btn-info btn-sm" title="Ver">
                            <i class="fas fa-eye"></i> Ver
                        </a>
                        @can('asistencias')
                        <a href="{{ route('convenios.edit', $convenio->id) }}" 
                           class="btn btn-success btn-sm" title="Editar">
                            <i class="fas fa-pencil-alt"></i> Editar
                        </a>
                        <form action="{{ url('convenios', $convenio->id) }}" 
                              method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('¿Estás seguro de eliminar este convenio?')" 
                                    class="btn btn-danger btn-sm" title="Eliminar">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </button>
                        </form>
                        @endcan
                    </div>
                </div>
                @endforeach

                @if($convenios->isEmpty())
                <div class="col-12 text-center py-5">
                    <p style="color: #f87171; font-size: 1.2rem;">
                        <i class="fas fa-inbox fa-3x mb-3"></i><br>
                        No hay convenios registrados.
                    </p>
                </div>
                @endif
            </div>

            {{-- Paginación --}}
            <div id="pagination" class="d-flex justify-content-center mt-4 flex-wrap gap-2"></div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {

    const cards = Array.from(document.querySelectorAll('.convenio-card'));
    const searchInput = document.getElementById('searchInput');
    const estadoFiltro = document.getElementById('estadoFiltro');
    const itemsPerPageSelect = document.getElementById('itemsPerPage');
    const paginationContainer = document.getElementById('pagination');

    let currentPage = 1;
    let itemsPerPage = parseInt(itemsPerPageSelect.value);

    /* ===========================
       🔍 BÚSQUEDA
    ============================ */
    searchInput.addEventListener('input', function() {
        this.value = this.value.toUpperCase();
        currentPage = 1;
        renderCards();
    });

    /* ===========================
       📄 ITEMS POR PÁGINA
    ============================ */
    itemsPerPageSelect.addEventListener('change', function() {
        itemsPerPage = parseInt(this.value);
        currentPage = 1;
        renderCards();
    });

    /* ===========================
       🔵 FILTRO ESTADO
    ============================ */
    estadoFiltro.addEventListener('change', function() {
        currentPage = 1;
        renderCards();
    });

    /* ===========================
       🎯 RENDERIZAR CARDS
    ============================ */
    function renderCards() {

        const searchTerm = searchInput.value.trim().toUpperCase();
        const estadoValor = estadoFiltro.value;

        const filtered = cards.filter(card => {

            const folio = card.getAttribute('data-folio')?.toUpperCase() || '';
            const nombre = card.getAttribute('data-nombre')?.toUpperCase() || '';
            const estado = card.getAttribute('data-estado');

            const matchSearch =
                folio.includes(searchTerm) ||
                nombre.includes(searchTerm);

            const matchEstado =
                (estadoValor === "todos") || (estadoValor === estado);

            return matchSearch && matchEstado;
        });

        // Ocultar todas
        cards.forEach(card => card.style.display = 'none');

        // Paginación
        const totalItems = filtered.length;
        const totalPages = Math.ceil(totalItems / itemsPerPage);

        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;

        filtered.slice(start, end).forEach(card => card.style.display = 'block');

        renderPagination(totalPages, totalItems);
    }

    /* ===========================
       📌 RENDER PAGINACIÓN
    ============================ */
    function renderPagination(totalPages, totalItems) {

        paginationContainer.innerHTML = '';

        if (totalItems === 0) {
            const msg = document.createElement('p');
            msg.style.color = '#f87171';
            msg.style.fontWeight = '600';
            msg.innerHTML = '<i class="fas fa-search me-2"></i>No se encontraron resultados';
            paginationContainer.appendChild(msg);
            return;
        }

        const createBtn = (text, active = false, disabled = false, onClick = null) => {
            const btn = document.createElement('button');
            btn.textContent = text;
            btn.className = 'btn btn-sm mx-1';
            if (active) btn.classList.add('current');
            if (disabled) btn.disabled = true;
            if (onClick) btn.addEventListener('click', onClick);
            return btn;
        };

        paginationContainer.appendChild(
            createBtn('<<', false, currentPage === 1, () => { currentPage = 1; renderCards(); })
        );

        paginationContainer.appendChild(
            createBtn('<', false, currentPage === 1, () => {
                if (currentPage > 1) { currentPage--; renderCards(); }
            })
        );

        const maxVisible = 5;
        let startPage = Math.max(currentPage - Math.floor(maxVisible / 2), 1);
        let endPage = startPage + maxVisible - 1;

        if (endPage > totalPages) {
            endPage = totalPages;
            startPage = Math.max(endPage - maxVisible + 1, 1);
        }

        for (let i = startPage; i <= endPage; i++) {
            paginationContainer.appendChild(
                createBtn(i, i === currentPage, false, () => {
                    currentPage = i;
                    renderCards();
                })
            );
        }

        paginationContainer.appendChild(
            createBtn('>', false, currentPage === totalPages, () => {
                if (currentPage < totalPages) { currentPage++; renderCards(); }
            })
        );

        paginationContainer.appendChild(
            createBtn('>>', false, currentPage === totalPages, () => {
                currentPage = totalPages;
                renderCards();
            })
        );

        // Info
        const info = document.createElement('div');
        info.className = 'w-100 text-center mt-3';
        info.style.color = '#58a6ff';
        info.style.fontSize = '0.95rem';
        info.style.fontWeight = '500';

        const showing = Math.min(currentPage * itemsPerPage, totalItems);
        const from = totalItems > 0 ? ((currentPage - 1) * itemsPerPage) + 1 : 0;

        info.innerHTML = `<i class="fas fa-info-circle me-2"></i>
            Mostrando <strong>${from}</strong> a <strong>${showing}</strong> de <strong>${totalItems}</strong> convenios`;

        paginationContainer.appendChild(info);
    }

    renderCards();
});
</script>

@endsection