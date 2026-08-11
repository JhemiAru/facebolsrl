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
        filter: drop-shadow(0 0 8px rgba(126, 231, 135, 0.4));
    }

    .card-body {
        background: transparent;
        padding: 40px;
    }

    .btn-outline-secondary {
        background: transparent;
        border: 2px solid #718096;
        color: #718096;
        border-radius: 50px;
        padding: 10px 25px;
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

    .form-control.rounded-pill {
        border-radius: 50px;
    }

    .form-control.rounded-3 {
        border-radius: 16px;
    }

    /* Estilos específicos para que el texto sea negro y visible */
    input.form-control,
    textarea.form-control {
        color: #000000 !important;
        font-weight: 500;
    }

    /* Efecto de brillo en el texto al escribir */
    .form-control:not(:placeholder-shown) {
        background: #ffffff !important;
        border-color: rgba(126, 231, 135, 0.6) !important;
        box-shadow: 0 0 15px rgba(126, 231, 135, 0.3) !important;
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

    .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.7s ease;
    }

    .btn-primary:hover::before {
        left: 100%;
    }

    .btn-primary:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 12px 30px rgba(46, 160, 67, 0.5);
        background: linear-gradient(135deg, #2ea043 0%, #3fb950 50%, #56d364 100%);
    }

    .text-danger {
        color: #fc8181 !important;
        font-weight: 500;
        margin-top: 8px;
        display: block;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
    }

    #vista-previa {
        border: 3px solid #58a6ff;
        border-radius: 20px;
        box-shadow: 
            0 0 30px rgba(88, 166, 255, 0.3),
            0 8px 20px rgba(0, 0, 0, 0.3);
        transition: all 0.4s ease;
        background: rgba(255, 255, 255, 0.1);
        padding: 8px;
    }

    #vista-previa:hover {
        transform: scale(1.05);
        box-shadow: 
            0 0 40px rgba(88, 166, 255, 0.5),
            0 12px 25px rgba(0, 0, 0, 0.4);
    }

    input[type="file"] {
        background: rgba(255, 255, 255, 0.95) !important;
        border: 2px dashed rgba(88, 166, 255, 0.6) !important;
        border-radius: 16px;
        padding: 15px;
        color: #000000 !important;
        transition: all 0.3s ease;
    }

    input[type="file"]:hover {
        border-color: #58a6ff !important;
        background: #ffffff !important;
    }

    input[type="file"]:focus {
        border-color: #58a6ff !important;
        box-shadow: 0 0 0 3px rgba(88, 166, 255, 0.3) !important;
    }

    .row.g-3 > [class*="col-"] {
        margin-bottom: 10px;
    }

    /* Efecto especial para campos con contenido */
    .form-control:valid {
        border-color: rgba(126, 231, 135, 0.8) !important;
        background: #ffffff !important;
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

    /* Responsive */
    @media (max-width: 768px) {
        .card-body {
            padding: 25px 20px;
        }
        
        .card-header {
            padding: 20px 25px;
        }
        
        .card-header h4 {
            font-size: 1.5rem;
        }
        
        .btn-primary {
            width: 100%;
            margin-top: 10px;
        }
        
        .btn-outline-secondary {
            width: 100%;
            justify-content: center;
            margin-bottom: 20px;
        }
    }
</style>

<div class="card mt-5 shadow-lg border-0">
    <div class="card-header bg-dark text-white">
        <h4 class="mb-0"><i class="bi bi-pencil-square"></i> Editar Empresa</h4>
    </div>
    <div class="card-body bg-light">
        <a href="{{ route('empresas.index') }}" class="btn btn-outline-secondary btn-sm mb-3">
            <i class="bi bi-arrow-left"></i> Atrás
        </a>

        <form action="{{ route('empresas.update', $empresa->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-dark">Nombre de la Empresa</label>
                    <input type="text" name="nombre_empresa" class="form-control rounded-pill" style="text-transform: uppercase; color: #000000 !important; background: rgba(255, 255, 255, 0.95) !important;"
                           value="{{ old('nombre_empresa', $empresa->nombre_empresa) }}">
                    @error("nombre_empresa") <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold text-dark">Propietario</label>
                    <input type="text" name="propietario" class="form-control rounded-pill" style="text-transform: uppercase; color: #000000 !important; background: rgba(255, 255, 255, 0.95) !important;"
                           value="{{ old('propietario', $empresa->propietario) }}">
                    @error("propietario") <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Campo Categoría -->
                <div class="form-group">
                    <label for="id_categoria">Categoría </label>
                    <select name="id_categoria" id="id_categoria" class="form-control" 
                            style="height: 45px !important; padding: 10px 15px !important; font-size: 16px !important;" required>
                        <option value="">Seleccione una categoría</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" 
                                {{ old('id_categoria', $empresa->id_categoria) == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="col-md-6">
    <label class="form-label fw-semibold text-dark">Celular</label>
    <div class="input-group">
        @php
            $celular = $empresa->celular;
            $prefijos = ['591', '51', '55', '56', '54', '595'];
            $prefijoDetectado = '591'; // valor por defecto
            $numero = $celular;

            foreach ($prefijos as $pref) {
                if (strpos($celular, $pref) === 0) {
                    $prefijoDetectado = $pref;
                    $numero = substr($celular, strlen($pref));
                    break;
                }
            }
        @endphp

        <select id="prefijo" name="prefijo"
                class="form-select rounded-start-pill bg-light text-dark border-end-0"
                style="max-width: 110px;">
            <option value="591" {{ $prefijoDetectado == '591' ? 'selected' : '' }}>🇧🇴 +591</option>
            <option value="51"  {{ $prefijoDetectado == '51'  ? 'selected' : '' }}>🇵🇪 +51</option>
            <option value="55"  {{ $prefijoDetectado == '55'  ? 'selected' : '' }}>🇧🇷 +55</option>
            <option value="56"  {{ $prefijoDetectado == '56'  ? 'selected' : '' }}>🇨🇱 +56</option>
            <option value="54"  {{ $prefijoDetectado == '54'  ? 'selected' : '' }}>🇦🇷 +54</option>
            <option value="595" {{ $prefijoDetectado == '595' ? 'selected' : '' }}>🇵🇾 +595</option>
        </select>

        <input type="text" id="celular" name="celular"
               class="form-control rounded-end-pill shadow-sm border-start-0"
               oninput="this.value = this.value.replace(/[^0-9]/g, '');"
               maxlength="15"
               value="{{ old('celular', $numero) }}"
               required
               placeholder="Ej: 73036102">
    </div>
    @error("celular") <small class="text-danger">{{ $message }}</small> @enderror
</div>



                <div class="col-md-6">
                    <label class="form-label fw-semibold text-dark">Correo</label>
                    <input type="email" name="correo" class="form-control rounded-pill" style="color: #000000 !important; background: rgba(255, 255, 255, 0.95) !important;"
                           value="{{ old('correo', $empresa->correo) }}">
                    @error("correo") <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold text-dark">Descripción</label>
                    <textarea name="descripcion" class="form-control rounded-3" style="text-transform: uppercase; color: #000000 !important; background: rgba(255, 255, 255, 0.95) !important;" rows="2">{{ old('descripcion', $empresa->descripcion) }}</textarea>
                    @error("descripcion") <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold text-dark">Longitud</label>
                    <input type="number" name="longitud" class="form-control rounded-pill" style="color: #000000 !important; background: rgba(255, 255, 255, 0.95) !important;"
                           value="{{ old('longitud', $empresa->longitud) }}">
                    @error("longitud") <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold text-dark">Latitud</label>
                    <input type="number" name="latitud" class="form-control rounded-pill" style="color: #000000 !important; background: rgba(255, 255, 255, 0.95) !important;"
                           value="{{ old('latitud', $empresa->latitud) }}">
                    @error("latitud") <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold text-dark">NIT</label>
                    <input type="number" name="nit" class="form-control rounded-pill" style="color: #000000 !important; background: rgba(255, 255, 255, 0.95) !important;"
                           value="{{ old('nit', $empresa->nit) }}">
                    @error("nit") <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold text-dark">Ubicación</label>
                    <textarea name="ubicacion" class="form-control rounded-3" style="text-transform: uppercase; color: #000000 !important; background: rgba(255, 255, 255, 0.95) !important;" rows="2">{{ old('ubicacion', $empresa->ubicacion) }}</textarea>
                    @error("ubicacion") <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold text-dark">Icono (opcional)</label>
                    <input type="file" name="icono" class="form-control rounded-pill shadow-sm" style="color: #000000 !important; background: rgba(255, 255, 255, 0.95) !important;"
                           accept="image/*" onchange="mostrarVistaPrevia(this)">
                    @error("icono") <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold text-dark">Vista previa del ícono</label><br>
                    <img id="vista-previa"
                         src="{{ $empresa->icono ? asset($empresa->icono) : '#' }}"
                         alt="Vista previa del icono"
                         style="max-width: 150px; {{ $empresa->icono ? '' : 'display:none;' }}"
                         class="rounded border shadow-sm p-1 bg-white">
                </div>
               
               <div class="col-md-4">
    <label class="form-label fw-semibold text-dark">Estado</label><br>
    <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-outline-success {{ $empresa->estado == 1 ? 'active' : '' }}">
            <input type="radio" name="estado" value="1" {{ $empresa->estado == 1 ? 'checked' : '' }}> Activo
        </label>
        <label class="btn btn-outline-danger {{ $empresa->estado == 0 ? 'active' : '' }}">
            <input type="radio" name="estado" value="0" {{ $empresa->estado == 0 ? 'checked' : '' }}> Inactivo
        </label>
    </div>
</div>

                <div class="col-12 mt-3 text-end">
                    <button type="submit" class="btn btn-primary rounded-pill shadow-sm px-4">
                        <i class="bi bi-save"></i> Actualizar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Vista previa JS --}}
<script>
function mostrarVistaPrevia(input) {
    const vistaPrevia = document.getElementById('vista-previa');
    if (input.files && input.files[0]) {
        const lector = new FileReader();
        lector.onload = function(e) {
            vistaPrevia.src = e.target.result;
            vistaPrevia.style.display = 'block';
        };
        lector.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection