@php
    use Illuminate\Support\Facades\Session;
@endphp
@extends('layouts.admin')

@section('content')
<style>
/* ============================
   VARIABLES GLOBALES
============================ */
:root {
    --color-bg-dark: #000;
    --color-bg-mid: #08141a;
    --color-bg-light: #0f2027;

    --color-primary: #58a6ff;
    --color-primary-soft: rgba(88, 166, 255, 0.3);
    --color-accent: #7ee787;

    --color-text: #f1f5f9;
    --color-text-soft: #e2e8f0;

    --gradient-header: linear-gradient(135deg, #1a365d 0%, #2d3748 100%);
    --gradient-card: linear-gradient(145deg, rgba(20, 25, 35, 0.95) 0%, rgba(15, 20, 30, 0.98) 100%);
    --gradient-btn-primary: linear-gradient(135deg, #238636 0%, #2ea043 50%, #3fb950 100%);
    --gradient-badge-activo: linear-gradient(135deg, #10b981, #34d399);
    --gradient-badge-inactivo: linear-gradient(135deg, #ef4444, #f87171);

    --shadow-strong: 0 20px 40px rgba(0, 0, 0, 0.6);
    --shadow-soft: 0 10px 25px rgba(0, 0, 0, 0.5);
    --radius: 20px;
}

/* ============================
   ESTILOS BASE
============================ */
body {
    background: radial-gradient(ellipse at top, var(--color-bg-light) 0%, var(--color-bg-mid) 40%, var(--color-bg-dark) 100%);
    color: var(--color-text);
    font-family: 'Poppins', sans-serif;
    min-height: 100vh;
    overflow-x: hidden;
}

.content {
    margin-left: 10px;
    padding: 20px;
}

/* ============================
   TITULO PRINCIPAL
============================ */
.text-center h1 {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-accent) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 30px;
    text-shadow: 0 4px 15px var(--color-primary-soft);
    padding: 20px 0;
}

/* ============================
   TARJETAS (CARD)
============================ */
.card {
    background: var(--gradient-card);
    border: 1px solid rgba(88, 166, 255, 0.2);
    border-radius: var(--radius);
    backdrop-filter: blur(20px);
    box-shadow: var(--shadow-strong);
    overflow: hidden;
    transition: transform 0.4s ease, box-shadow 0.4s ease, border 0.4s ease;
}

.card:hover {
    transform: translateY(-8px);
    box-shadow: 0 30px 60px rgba(0,150,255,0.25), var(--shadow-soft);
    border-color: rgba(88,166,255,0.4);
}

.card-primary {
    border-top: 4px solid var(--color-primary);
}

/* ============================
   CARD HEADER
============================ */
.card-header {
    background: var(--gradient-header) !important;
    border-bottom: 1px solid var(--color-primary-soft);
    padding: 25px 30px;
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

.card-header h3 {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--color-primary);
    margin: 0;
    text-shadow: 0 2px 10px var(--color-primary-soft);
}

/* ============================
   BOTONES (UNIFICADO)
============================ */
.btn {
    border-radius: 50px;
    font-weight: 600;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.btn:hover {
    transform: translateY(-3px);
}

.btn-primary {
    background: var(--gradient-btn-primary);
    border: none;
    padding: 12px 25px;
    box-shadow: 0 8px 25px rgba(46, 160, 67, 0.3);
}

.btn-primary:hover {
    box-shadow: 0 12px 30px rgba(46, 160, 67, 0.5);
}

.btn-info {
    background: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 100%);
    color: white;
}

.btn-success {
    background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
    color: white;
}

.btn-danger {
    background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
    color: white;
}

/* ============================
   TABLAS
============================ */
.table {
    background: rgba(255,255,255,0.05);
    border-radius: 15px;
    overflow: hidden;
    border: 1px solid rgba(255,255,255,0.1);
}

.table thead th {
    background: var(--gradient-header);
    color: var(--color-primary);
    font-weight: 700;
    border: none;
    padding: 15px 10px;
    text-align: center;
    font-size: 0.9rem;
    text-transform: uppercase;
}

.table tbody td {
    background: rgba(255,255,255,0.03);
    color: var(--color-text-soft);
    border-color: rgba(255,255,255,0.05);
    padding: 12px 10px;
    transition: background 0.3s ease, transform 0.3s ease;
}

.table tbody tr:hover td {
    background: rgba(88,166,255,0.1);
    color: #fff;
    transform: scale(1.02);
}

.table img {
    border: 2px solid var(--color-primary);
    border-radius: 8px;
    box-shadow: 0 4px 10px var(--color-primary-soft);
    transition: transform 0.3s ease;
}

.table img:hover {
    transform: scale(1.1);
}

/* ============================
   EMPRESA GRID
============================ */
.empresa-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
    gap: 25px;
    margin-top: 25px;
    animation: fadeIn 0.8s ease-out;
}

.empresa-card {
    color: #fff;
    background: linear-gradient(145deg, rgba(20,25,35,0.95), rgba(10,15,25,0.98));
    border: 1px solid rgba(88,166,255,0.2);
    border-radius: var(--radius);
    box-shadow: 0 15px 30px rgba(0,0,0,0.6), inset 0 1px 0 rgba(255,255,255,0.1);
    transition: transform 0.4s ease, box-shadow 0.4s ease, border 0.4s ease;
    padding: 20px;
    min-height: 350px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.empresa-card:hover {
    transform: translateY(-5px);
    border-color: rgba(88,166,255,0.4);
    box-shadow: 0 20px 40px rgba(0,150,255,0.25), 0 10px 25px rgba(0,0,0,0.5);
}

.empresa-card h4 {
    color: var(--color-accent);
    text-align: center;
    font-weight: 700;
    margin-bottom: 15px;
}

.empresa-card p {
    color: var(--color-text-soft);
    font-size: 0.95rem;
    margin: 5px 0;
}

.empresa-card strong {
    color: var(--color-primary);
}

.empresa-icono img {
    width: 90px;
    height: 90px;
    border-radius: 15px;
    border: 2px solid var(--color-primary);
    box-shadow: 0 0 10px var(--color-primary-soft);
    transition: transform 0.3s ease;
}

.empresa-icono img:hover {
    transform: scale(1.08);
}

.empresa-url a {
    color: var(--color-primary);
    word-break: break-all;
}

.empresa-url a:hover {
    color: var(--color-accent);
    text-decoration: underline;
}

.convenio-estado {
    text-align: center;
    margin: 15px 0;
}

.badge-activo {
    background: var(--gradient-badge-activo);
    color: #fff;
    padding: 8px 20px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.9rem;
}

.badge-inactivo {
    background: var(--gradient-badge-inactivo);
    color: #fff;
    padding: 8px 20px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.9rem;
}

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
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
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


/* Paginación */
#pagination button {
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.2);
    color: var(--color-text-soft);
    border-radius: 8px;
    margin: 3px;
    padding: 6px 12px;
    transition: all 0.3s ease;
}

#pagination button:hover {
    background: rgba(88,166,255,0.3);
    color: #fff;
    transform: translateY(-2px);
}

#pagination button.current {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-accent) 100%);
    color: #000;
    font-weight: 700;
    box-shadow: 0 0 10px var(--color-primary-soft);
}

/* Botones copiar URL */
.btn-success.copy-btn {
    background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
    border: none;
    border-radius: 8px;
    padding: 6px 12px;
    font-size: 0.8rem;
    margin-top: 5px;
}

.btn-success.copy-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(245,158,11,0.4);
}

/* ============================
   ANIMACIONES
============================ */
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

/* ============================
   RESPONSIVE
============================ */
@media (max-width: 768px) {
    .text-center h1 { font-size: 2rem; }
    .card-header h3 { font-size: 1.4rem; }
    .empresa-grid { grid-template-columns: 1fr; }
    .btn-group { display: flex; flex-direction: column; }
}

</style>




    <div class="content">
        <h1 class="text-center"><b>Bienvenido a la Administración de las Empresas</b></h1>

        @if ($message = Session::get('mensaje'))
            <script>
                Swal.fire({
                    title: "Buen trabajo!",
                    text: "{{ $message }}",
                    icon: "success",
                    background: 'linear-gradient(145deg, rgba(20, 25, 35, 0.95) 0%, rgba(15, 20, 30, 0.98) 100%)',
                    color: '#ffffff',
                    confirmButtonColor: '#58a6ff'
                });
            </script>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Empresas Registradas</b></h3>
                        <div class="card-tools">
                            @can('asistencias')
                            <a href="{{ url('/empresas/create') }}" class="btn btn-primary">
                                <i class="bi bi-file-plus"></i> Agregar nueva empresa
                            </a>
                            <a href="{{ route('empresas.pdf') }}" class="btn btn-success ml-2" target="_blank">
                                <i class="bi bi-printer"></i> Imprimir Catalogos Activos
                            </a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">

                         {{-- 🔹 Controles de búsqueda y cantidad --}}
<div class="control-panel p-3 mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
    
    <!-- Izquierda -->
    <div class="search-box">
        <label for="buscadorEmpresas" class="me-2">🔍 Buscar Empresa:</label>
        <input id="buscadorEmpresas" type="text" placeholder="Escriba el nombre..." 
            class="form-control d-inline-block w-auto text-uppercase">
    </div>

    <!-- Centro -->
    <div class="status-filter">
        <label for="estadoFiltro" class="me-2">Estado:</label>
        <select id="estadoFiltro" class="form-select w-auto">
            <option value="todos" selected>Todos</option>
            <option value="activo">Activos</option>
            <option value="inactivo">Inactivos</option>
        </select>
    </div>

    <!-- Derecha -->
    <div class="pagination-size">
        <label for="itemsPerPage" class="me-2">Mostrar:</label>
        <select id="itemsPerPage" class="form-select w-auto">
            <option value="6" selected>6</option>
            <option value="10">10</option>
            <option value="26">26</option>
            <option value="100">100</option>
        </select>
    </div>

</div>


{{-- 🔹 Contenedor flexible para las tarjetas --}}
<div class="empresa-grid">
    @foreach ($empresas as $empresa)
        <div class="empresa-card card card-primary" 
            data-estado="{{ $empresa->estado == 1 ? 'activo' : 'inactivo' }}">

            {{-- Icono (logo) arriba --}}
            <div class="empresa-icono text-center mb-3">
                <img src="{{ asset($empresa->icono) }}" alt="Logo de {{ $empresa->nombre_empresa }}" style="width: 90px; height: 90px; border-radius: 15px; border: 2px solid #58a6ff;">
            </div>

            {{-- Nombre principal --}}
            <h4 class="empresa-nombre text-center mb-3" style="color:#7ee787; font-weight:700;">
                {{ $empresa->nombre_empresa }}
            </h4>

            {{-- Datos generales --}}
            <p><strong>Categoría:</strong> 
                <span class="badge" style="background: linear-gradient(135deg, #58a6ff, #7ee787); color: #000; padding: 5px 12px;">
                    <i class="{{ $empresa->categoria->icono ?? 'fas fa-tag' }} me-1"></i>
                    {{ $empresa->categoria->nombre ?? 'Sin categoría' }}
                </span>
            </p>
            {{-- Datos generales --}}
            <p><strong>Propietario:</strong> {{ $empresa->propietario }}</p>

            {{-- Celular con bandera --}}
            @php
                $celular = $empresa->celular;
                $prefijos = [
                    '591' => '🇧🇴 +591',
                    '51'  => '🇵🇪 +51',
                    '55'  => '🇧🇷 +55',
                    '56'  => '🇨🇱 +56',
                    '54'  => '🇦🇷 +54',
                    '595' => '🇵🇾 +595',
                ];
                $celularFormateado = $celular;
                foreach ($prefijos as $codigo => $bandera) {
                    if (str_starts_with($celular, $codigo)) {
                        $numero = substr($celular, strlen($codigo));
                        $celularFormateado = $bandera . ' ' . $numero;
                        break;
                    }
                }
            @endphp
            <p><strong>Celular:</strong> {{ $celularFormateado }}</p>

            <p><strong>Correo:</strong> {{ $empresa->correo }}</p>
            <p><strong>Descripción:</strong> {{ $empresa->descripcion }}</p>
            <p><strong>Ubicación:</strong> {{ $empresa->ubicacion }}</p>
            {{-- <p><strong>Latitud:</strong> {{ $empresa->latitud }}</p>
            <p><strong>Longitud:</strong> {{ $empresa->longitud }}</p> --}}
            <p><strong>NIT:</strong> {{ $empresa->nit }}</p>

            {{-- Enlace al icono URL --}}
            <div class="empresa-url mt-3">
                <p><strong>Imagen del Icono:</strong></p>
                <a href="{{ $empresa->icono_url }}" target="_blank" style="color:#e9edf1;">{{ $empresa->icono_url }}</a>
                <button type="button" class="btn btn-success copy-btn" onclick="copiarUrl('{{ $empresa->icono_url }}')">
                    <i class="bi bi-clipboard"></i> Copiar
                </button>
            </div>

            <div class="convenio-estado">
                @if($empresa->estado == 1)
                    <span class="badge-activo">✓ Activo</span>
                @else
                    <span class="badge-inactivo">✗ Inactivo</span>
                @endif
            </div>


            {{-- Botones de acción --}}
            <div class="convenio-actions">
                        <a href="{{ url('empresas', $empresa->id) }}" 
                           class="btn btn-info btn-sm" title="Ver">
                            <i class="fas fa-eye"></i> Ver
                        </a>
                        @can('asistencias')
                        <a href="{{ route('empresas.edit', $empresa->id) }}" 
                           class="btn btn-success btn-sm" title="Editar">
                            <i class="fas fa-pencil-alt"></i> Editar
                        </a>
                        <form action="{{ url('empresas', $empresa->id) }}" 
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
</div>


{{-- 🔹 Contenedor de paginación --}}
<div id="pagination" class="d-flex justify-content-center mt-4 flex-wrap gap-2"></div>

{{-- 🔹 Script de búsqueda y paginación sin recarga --}}
<script>
document.addEventListener("DOMContentLoaded", function() {
    const cards = Array.from(document.querySelectorAll('.empresa-card'));
    const searchInput = document.getElementById('buscadorEmpresas');
    const estadoFiltro = document.getElementById('estadoFiltro');
    const itemsPerPageSelect = document.getElementById('itemsPerPage');
    const paginationContainer = document.getElementById('pagination');

    let currentPage = 1;
    let itemsPerPage = parseInt(itemsPerPageSelect.value);

    // 🔍 Búsqueda (mayúsculas)
    searchInput.addEventListener('input', function() {
        this.value = this.value.toUpperCase();
        currentPage = 1;
        renderCards();
    });

    // 📄 Cambio de items por página
    itemsPerPageSelect.addEventListener('change', function() {
        itemsPerPage = parseInt(this.value);
        currentPage = 1;
        renderCards();
    });

    // 🔹 Filtro de estado
    estadoFiltro.addEventListener('change', function() {
        currentPage = 1;
        renderCards();
    });

    // 🧩 Renderizado de tarjetas y paginación
    function renderCards() {
        const searchTerm = searchInput.value.trim().toUpperCase();
        const estadoValor = estadoFiltro.value;

        // Filtrar tarjetas por búsqueda y estado
        const filtered = cards.filter(card => {
            const nombre = card.querySelector('.empresa-nombre')?.textContent.toUpperCase() || '';
            const estado = card.getAttribute('data-estado');
            return nombre.includes(searchTerm) && (estadoValor === "todos" || estadoValor === estado);
        });

        // Ocultar todas las tarjetas antes
        cards.forEach(card => card.style.display = 'none');

        // Paginación
        const totalItems = filtered.length;
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;

        // Mostrar solo las tarjetas de la página actual
        filtered.slice(start, end).forEach(card => card.style.display = 'block');

        renderPagination(totalPages, totalItems);
    }

    // 🔢 Renderizar paginación
    function renderPagination(totalPages, totalItems) {
        paginationContainer.innerHTML = '';

        // Mensaje si no hay resultados
        if (totalItems === 0) {
            const noResults = document.createElement('p');
            noResults.style.color = '#f87171';
            noResults.style.fontWeight = '600';
            noResults.innerHTML = '<i class="fas fa-search me-2"></i>No se encontraron resultados';
            paginationContainer.appendChild(noResults);
            return;
        }

        const createButton = (text, active = false, disabled = false, onClick = null) => {
            const btn = document.createElement('button');
            btn.textContent = text;
            btn.className = 'btn btn-sm mx-1';
            if (active) btn.classList.add('current');
            if (disabled) btn.disabled = true;
            if (onClick) btn.addEventListener('click', onClick);
            return btn;
        };

        const maxVisible = 5; // máximo botones visibles

        // << Ir al inicio
        paginationContainer.appendChild(createButton('<<', false, currentPage === 1, () => {
            currentPage = 1;
            renderCards();
        }));

        // < Página anterior
        paginationContainer.appendChild(createButton('<', false, currentPage === 1, () => {
            if (currentPage > 1) { currentPage--; renderCards(); }
        }));

        // Calcular rango de páginas visibles
        let startPage = Math.max(currentPage - Math.floor(maxVisible / 2), 1);
        let endPage = startPage + maxVisible - 1;
        if (endPage > totalPages) {
            endPage = totalPages;
            startPage = Math.max(endPage - maxVisible + 1, 1);
        }

        // Botones de páginas numeradas
        for (let i = startPage; i <= endPage; i++) {
            paginationContainer.appendChild(createButton(i, i === currentPage, false, () => {
                currentPage = i;
                renderCards();
            }));
        }

        // > Página siguiente
        paginationContainer.appendChild(createButton('>', false, currentPage === totalPages, () => {
            if (currentPage < totalPages) { currentPage++; renderCards(); }
        }));

        // >> Ir al final
        paginationContainer.appendChild(createButton('>>', false, currentPage === totalPages, () => {
            currentPage = totalPages;
            renderCards();
        }));

        // Info de visualización
        const info = document.createElement('div');
        info.className = 'w-100 text-center mt-3';
        info.style.color = '#58a6ff';
        info.style.fontSize = '0.95rem';
        info.style.fontWeight = '500';
        const showing = Math.min(currentPage * itemsPerPage, totalItems);
        const from = totalItems > 0 ? ((currentPage - 1) * itemsPerPage) + 1 : 0;
        info.innerHTML = `<i class="fas fa-info-circle me-2"></i>Mostrando <strong>${from}</strong> a <strong>${showing}</strong> de <strong>${totalItems}</strong> empresas`;
        paginationContainer.appendChild(info);
    }

    // 🔹 Inicializar
    renderCards();
});
</script>


                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection