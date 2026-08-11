@php
    use Illuminate\Support\Facades\Session;
            use Illuminate\Support\Str;
@endphp


@extends('layouts.admin')

@section('content')
<style>
    /* === ESTILOS GENERALES === */
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

/* === TITULO PRINCIPAL === */
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
    animation: fadeIn 0.8s ease-out;
}

/* === TARJETAS === */
.card {
    background: linear-gradient(145deg, rgba(20, 25, 35, 0.95) 0%, rgba(15, 20, 30, 0.98) 100%);
    border: 1px solid rgba(88, 166, 255, 0.2);
    border-radius: 20px;
    backdrop-filter: blur(20px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.6), 0 8px 20px rgba(0,0,0,0.4);
    overflow: hidden;
    transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    margin-bottom: 25px;
    animation: fadeIn 0.8s ease-out;
}

.card:hover {
    transform: translateY(-8px);
    box-shadow: 0 30px 60px rgba(0,150,255,0.25), 0 15px 30px rgba(0,0,0,0.5);
    border-color: rgba(88,166,255,0.4);
}

.card-primary { border-top: 4px solid #58a6ff; }

.card-header {
    background: linear-gradient(135deg, #1a365d 0%, #2d3748 100%);
    border-bottom: 1px solid rgba(88,166,255,0.3);
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

.card-header:hover::before { left: 100%; }

.card-header h3 {
    font-size: 1.8rem;
    font-weight: 700;
    color: #58a6ff;
    margin: 0;
    text-shadow: 0 2px 10px rgba(88,166,255,0.3);
}

/* === BOTONES === */
.btn-primary {
    background: linear-gradient(135deg, #238636 0%, #2ea043 50%, #3fb950 100%);
    border: none;
    border-radius: 50px;
    padding: 12px 25px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.4s cubic-bezier(0.175,0.885,0.32,1.275);
    position: relative;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(46,160,67,0.3);
}

.btn-primary::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.7s ease;
}

.btn-primary:hover::before { left: 100%; }

.btn-primary:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 12px 30px rgba(46,160,67,0.5);
    background: linear-gradient(135deg, #2ea043 0%, #3fb950 50%, #56d364 100%);
}

.btn-success { background: #2d6a4f; color: #fff; }
.btn-success:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(45,106,79,0.4); }

.btn-info { background: #3b82f6; color: #fff; }
.btn-info:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(59,130,246,0.4); }

.btn-danger { background: #e53e3e; color: #fff; }
.btn-danger:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(229,62,62,0.4); }

/* === GRID DE SUCURSALES === */
.convenio-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 25px;
    margin-top: 25px;
    animation: fadeIn 0.8s ease-out;
}

.convenio-card {
    color: #ffffff;
    background: linear-gradient(145deg, rgba(20,25,35,0.95) 0%, rgba(10,15,25,0.98) 100%);
    border: 1px solid rgba(88,166,255,0.2);
    border-radius: 20px;
    box-shadow: 0 15px 30px rgba(0,0,0,0.6), inset 0 1px 0 rgba(255,255,255,0.1);
    transition: all 0.4s ease;
    padding: 25px;
    overflow: hidden;
    min-height: 320px;
    animation: fadeIn 0.8s ease-out;
}

.convenio-card:hover {
    transform: translateY(-5px);
    border-color: rgba(88,166,255,0.4);
    box-shadow: 0 20px 40px rgba(0,150,255,0.25), 0 10px 25px rgba(0,0,0,0.5);
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

.convenio-card strong { color: #58a6ff; }

.convenio-actions {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 20px;
}

.convenio-actions .btn { border-radius: 10px; font-weight: 600; padding: 8px 16px; }

/* === PANEL DE CONTROL === */
.control-panel {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(88,166,255,0.2);
    border-radius: 15px;
    backdrop-filter: blur(10px);
}

.control-panel label { color: #7ee787; font-weight: 600; }

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
    box-shadow: 0 0 0 2px rgba(88,166,255,0.2);
    outline: none;
}

.control-panel input::placeholder { color: rgba(255,255,255,0.5); }

/* === PAGINACIÓN === */
#paginationSucursal button {
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.2);
    color: #e2e8f0;
    border-radius: 8px;
    margin: 3px;
    padding: 8px 15px;
    transition: all 0.3s ease;
    font-weight: 500;
}

#paginationSucursal button:hover:not(:disabled) {
    background: rgba(88,166,255,0.3);
    color: #fff;
    transform: translateY(-2px);
}

#paginationSucursal button.current {
    background: linear-gradient(135deg, #58a6ff 0%, #7ee787 100%);
    color: #000;
    font-weight: 700;
    box-shadow: 0 0 10px rgba(88,166,255,0.4);
}

#paginationSucursal button:disabled { opacity: 0.4; cursor: not-allowed; }

/* === RESPONSIVE === */
@media (max-width: 768px) {
    .convenio-grid { grid-template-columns: 1fr; }

    .text-center h1 { font-size: 2rem; }
    .card-header h3 { font-size: 1.4rem; }

    .control-panel { flex-direction: column !important; align-items: flex-start !important; }
    .control-panel .search-box,
    .control-panel .pagination-size { width: 100%; }
    .control-panel input,
    .control-panel select { width: 100% !important; }

    .convenio-actions .btn { font-size: 0; }
    .convenio-actions .btn i { font-size: 1.1rem; }
}

/* === ANIMACIONES === */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

</style>

    <div class="content">
    <h1 class="text-center"><b>Bienvenido a la Administración de Sucursales</b></h1>

    @if ($message = Session::get('success'))
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
                    <h3 class="card-title"><b>Sucursales Registradas</b></h3>
                    <div class="card-tools">
                        <a href="{{ url('/sucursal/create') }}" class="btn btn-primary">
                            <i class="bi bi-file-plus"></i> Agregar nueva sucursal
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="control-panel p-3 mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div class="search-box">
                            <label for="searchInputSucursal" class="me-2">Buscar:</label>
                            <input type="text"
                                   id="searchInputSucursal"
                                   placeholder="Buscar por dirección, empresa o teléfono..."
                                   class="form-control d-inline-block w-auto text-uppercase">
                        </div>

                        <div class="pagination-size d-flex align-items-center">
                            <label for="itemsPerPageSucursal" class="me-2">Mostrar:</label>
                            <select id="itemsPerPageSucursal" class="form-select w-auto">
                                <option value="6">6</option>
                                <option value="10" selected>10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </div>

                    {{-- GRID DE TARJETAS --}}
                    <div id="sucursalGrid" class="convenio-grid">

                        @forelse ($sucursales as $sucursal)
                            @php
                                // Asegurar compatibilidad con objeto o array
                                $telefono = is_array($sucursal) ? ($sucursal['telefono'] ?? '') : ($sucursal->telefono ?? '');
                                $empresa = is_array($sucursal) ? ($sucursal['empresa'] ?? null) : ($sucursal->empresa ?? null);
                                $lugarObj = is_array($sucursal) ? ($sucursal['lugar'] ?? null) : ($sucursal->lugar ?? null);
                                $tipoSedeObj = is_array($sucursal) ? ($sucursal['tiposede'] ?? null) : ($sucursal->tiposede ?? null);

                                $prefijos = [
                                    '591' => '🇧🇴 +591',
                                    '51'  => '🇵🇪 +51',
                                    '55'  => '🇧🇷 +55',
                                    '56'  => '🇨🇱 +56',
                                    '54'  => '🇦🇷 +54',
                                    '595' => '🇵🇾 +595',
                                ];

                                $telefonoNum = preg_replace('/[^0-9]/', '', $telefono);
                                $telefonoFormateado = $telefonoNum;

                                foreach ($prefijos as $codigo => $bandera) {
                                    if (\Illuminate\Support\Str::startsWith($telefonoNum, $codigo)) {
                                        $telefonoFormateado = $bandera . ' ' . substr($telefonoNum, strlen($codigo));
                                        break;
                                    }
                                }

                                $empresaNombre = $empresa->nombre_empresa ?? 'Sin empresa';
                                $lugar = $lugarObj->departamento ?? 'Sin ciudad';
                                $tipoSede = $tipoSedeObj->nombreSede ?? 'Sin tipo de sede';
                            @endphp

                            <div class="convenio-card sucursal-card"
                                 data-busqueda="{{ strtoupper(($sucursal['direccion'] ?? $sucursal->direccion ?? '') . ' ' . $empresaNombre . ' ' . $telefonoFormateado . ' ' . $lugar) }}">
                                <div class="text-center">
                                    <h4>{{ $empresaNombre }}</h4>
                                </div>

                                <p><strong>Dirección:</strong> {{ $sucursal['direccion'] ?? $sucursal->direccion ?? 'Sin dirección' }}</p>
                                <p><strong>Teléfono:</strong> {{ $telefonoFormateado }}</p>
                                <p><strong>Lugar:</strong> {{ $lugar }}</p>
                                <p><strong>Tipo de Sede:</strong> {{ $tipoSede }}</p>

                                <div class="convenio-actions">
                                    <a href="{{ url('sucursal', is_array($sucursal) ? $sucursal['id'] : $sucursal->id) }}"
                                       class="btn btn-info btn-sm" title="Ver"><i class="fas fa-eye"></i> Ver</a>
                                    <a href="{{ route('sucursal.edit', is_array($sucursal) ? $sucursal['id'] : $sucursal->id) }}"
                                       class="btn btn-success btn-sm" title="Editar"><i class="fas fa-pencil-alt"></i> Editar</a>
                                    <form action="{{ url('sucursal', is_array($sucursal) ? $sucursal['id'] : $sucursal->id) }}"
                                          method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este registro?')"
                                                class="btn btn-danger btn-sm" title="Eliminar"><i class="fas fa-trash-alt"></i> Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <p style="color: #f87171; font-size: 1.2rem;">No hay sucursales registradas.</p>
                            </div>
                        @endforelse

                    </div>

                    <div id="paginationSucursal" class="d-flex justify-content-center mt-4 flex-wrap gap-2"></div>

                    {{-- Aquí va tu script de paginación y búsqueda que ya tenías --}}
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const cards = Array.from(document.querySelectorAll('.sucursal-card'));
                            const searchInput = document.getElementById('searchInputSucursal');
                            const paginationContainer = document.getElementById('paginationSucursal');
                            const itemsPerPageSelect = document.getElementById('itemsPerPageSucursal');
                            let currentPage = 1;
                            let itemsPerPage = parseInt(itemsPerPageSelect.value);

                            searchInput.addEventListener('input', function() {
                                this.value = this.value.toUpperCase();
                                currentPage = 1;
                                renderCards();
                            });

                            itemsPerPageSelect.addEventListener('change', function() {
                                itemsPerPage = parseInt(this.value);
                                currentPage = 1;
                                renderCards();
                            });

                            function renderCards() {
                                const searchTerm = searchInput.value.trim().toUpperCase();
                                const filtered = cards.filter(card => {
                                    const text = (card.getAttribute('data-busqueda') || '').toUpperCase();
                                    return text.includes(searchTerm);
                                });

                                cards.forEach(card => card.style.display = 'none');

                                const totalPages = Math.ceil(filtered.length / itemsPerPage) || 1;
                                if (currentPage > totalPages) currentPage = totalPages;
                                if (currentPage < 1) currentPage = 1;

                                const start = (currentPage - 1) * itemsPerPage;
                                const end = start + itemsPerPage;

                                filtered.slice(start, end).forEach(card => card.style.display = 'block');

                                renderPagination(totalPages, filtered.length);
                            }

                            function renderPagination(totalPages, totalItems) {
                                paginationContainer.innerHTML = '';

                                if (totalItems === 0) {
                                    const noResults = document.createElement('p');
                                    noResults.style.color = '#f87171';
                                    noResults.style.fontWeight = '600';
                                    noResults.innerHTML = 'No se encontraron resultados';
                                    paginationContainer.appendChild(noResults);
                                    return;
                                }

                                const createButton = (text, active = false, disabled = false, onClick = null) => {
                                    const btn = document.createElement('button');
                                    btn.textContent = text;
                                    btn.className = 'btn btn-sm';
                                    if (active) btn.classList.add('current');
                                    if (disabled) btn.disabled = true;
                                    if (onClick) btn.addEventListener('click', onClick);
                                    return btn;
                                };

                                paginationContainer.appendChild(createButton('← Anterior', false, currentPage === 1, () => {
                                    if (currentPage > 1) { currentPage--; renderCards(); }
                                }));

                                const maxButtons = 5;
                                let startPage = Math.max(1, currentPage - Math.floor(maxButtons / 2));
                                let endPage = Math.min(totalPages, startPage + maxButtons - 1);
                                if (endPage - startPage < maxButtons - 1) {
                                    startPage = Math.max(1, endPage - maxButtons + 1);
                                }

                                for (let i = startPage; i <= endPage; i++) {
                                    paginationContainer.appendChild(createButton(i.toString(), i === currentPage, false, () => {
                                        currentPage = i;
                                        renderCards();
                                    }));
                                }

                                paginationContainer.appendChild(createButton('Siguiente →', false, currentPage === totalPages, () => {
                                    if (currentPage < totalPages) { currentPage++; renderCards(); }
                                }));

                                const info = document.createElement('div');
                                info.className = 'w-100 text-center mt-3';
                                info.style.color = '#58a6ff';
                                info.style.fontSize = '0.95rem';
                                info.style.fontWeight = '500';
                                const showing = Math.min(currentPage * itemsPerPage, totalItems);
                                const from = totalItems > 0 ? ((currentPage - 1) * itemsPerPage) + 1 : 0;
                                info.innerHTML = `Mostrando <strong>${from}</strong> a <strong>${showing}</strong> de <strong>${totalItems}</strong> sucursales`;
                                paginationContainer.appendChild(info);
                            }

                            renderCards();
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>



{{-- SCRIPT DE BUSCADOR Y PAGINACIÓN --}}
<script>
document.addEventListener("DOMContentLoaded", function() {
    const cards = [...document.querySelectorAll('.sucursal-card')];
    const searchInput = document.getElementById('searchInputSucursal');
    const pagination = document.getElementById('paginationSucursal');
    const perPageSelect = document.getElementById('itemsPerPageSucursal');

    let currentPage = 1;
    let itemsPerPage = parseInt(perPageSelect.value);

    searchInput.addEventListener('input', () => {
        searchInput.value = searchInput.value.toUpperCase();
        currentPage = 1;
        render();
    });

    perPageSelect.addEventListener('change', () => {
        itemsPerPage = parseInt(perPageSelect.value);
        currentPage = 1;
        render();
    });

    function render() {
        const term = searchInput.value.trim().toUpperCase();

        const filtered = cards.filter(c =>
            c.dataset.busqueda.includes(term)
        );

        cards.forEach(c => c.style.display = "none");

        const totalPages = Math.max(1, Math.ceil(filtered.length / itemsPerPage));

        currentPage = Math.min(currentPage, totalPages);

        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;

        filtered.slice(start, end).forEach(c => c.style.display = "block");

        renderPagination(totalPages, filtered.length);
    }

    function renderPagination(totalPages, totalItems) {
        pagination.innerHTML = "";

        if (totalItems === 0) {
            pagination.innerHTML = `<p style="color:#f87171;font-weight:bold;">No se encontraron resultados</p>`;
            return;
        }

        const addBtn = (text, disabled, active, click) => {
            const btn = document.createElement('button');
            btn.textContent = text;
            btn.className = 'btn btn-sm';
            if (active) btn.classList.add('current');
            btn.disabled = disabled;
            btn.onclick = click;
            return btn;
        };

        pagination.appendChild(addBtn("← Anterior", currentPage === 1, false, () => {
            if (currentPage > 1) { currentPage--; render(); }
        }));

        const maxButtons = 5;
        let start = Math.max(1, currentPage - 2);
        let end = Math.min(totalPages, start + maxButtons - 1);

        if (end - start < maxButtons - 1)
            start = Math.max(1, end - maxButtons + 1);

        for (let i = start; i <= end; i++) {
            pagination.appendChild(addBtn(i, false, i === currentPage, () => {
                currentPage = i;
                render();
            }));
        }

        pagination.appendChild(addBtn("Siguiente →", currentPage === totalPages, false, () => {
            if (currentPage < totalPages) { currentPage++; render(); }
        }));
    }

    render();
});
</script>

@endsection