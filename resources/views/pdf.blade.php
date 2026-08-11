<!doctype html>
<html lang="es">

<head>
<meta charset="utf-8">

<style>
 :root {
    --light: #f8f9fa;
    --dark: #1d1b31; 
}
/* ===== RESET PARA PDF ===== */
@page {
    size: letter portrait;
     margin-top: 3.5cm;
}
@page :first {
    margin: 0;
    background: url("{{ public_path('img/cat2.png') }}") no-repeat center center;
    background-size: cover;
}
html, body {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
}
/* ===== FONDO COMPLETO ===== */
body {
    font-family: 'Inter', sans-serif;;
    font-size: 10pt;
    color: #aaaaaa;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
}
/* ===== PORTADA ===== */
.page-cover {
     page-break-after: always;
    width: 100%;
    height: 11in;
    margin: 0;
    padding: 0;
    overflow: hidden;
}
.cover-img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
/* ===== PAGINAS NORMALES ===== */
.page-normal {
     position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    object-fit: contain
}
/* ===== CONTENEDOR  ===== */
.page {
    padding-top: 10px;
    padding-left: 50px;
    padding-right: 50px;
    padding-bottom: 0;
}
/* =====EMPRESA ===== */
.empresa {
    margin-bottom: 20px;
    padding: 18px;
    border-radius: 12px;
}
.empresa table {
    width: 100%;
}
.logo {
    width: 22%;
    text-align: center;
}
.logo img {
    max-width: 200px;
    padding-right: 40px;
    margin-top: 20px;
}
.info {
    margin-top: 40px;
    width: 39%;
    padding-left: 160px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 10px 30px 10px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.35);
    color: var(--light);
}
.info p {
    margin: 4px 0;
    line-height: 1.4;
}
.label {
    color: #f5b041;
    font-weight: bold;
}
.spacer-top {
    height: 2cm;
}
/* ===== CONVENIO ===== */
.convenio {
    margin-top: 15px;
    padding: 10px 15px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
    border-left: 3px solid #f5b041;
    font-size: 9pt;
}
.convenio p {
    margin: 2px 0;
    line-height: 1.3;
}
.convenio-titulo {
    color: #f5b041;
    font-weight: bold;
    font-size: 10pt;
    margin-bottom: 5px;
    text-align: center; 
    
}
.convenio-item {
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 1px dashed #ccc;
}

.social-links {
    margin-top: 6px;
    display: inline-block;
    line-height: 28px; 
}

.social-links .label {
    display: inline-block;
    vertical-align: middle;
    margin-right: 4px;
}

.social-links a {
    display: inline-block;
    vertical-align: middle;
    margin-right: 6px;
}

.social-links img {
    display: inline-block;
    vertical-align: middle;
}


</style>
   </head>
      <body>
         <div class="page-cover">
            <img src="{{ public_path('img/cat2.png') }}" class="cover-img">
        </div>
         <img src="{{ public_path('img/cate2.png') }}" class="page-normal">
                <div class="page">
                    <!-- EMPRESAS -->
                    @foreach ($empresas as $i => $empresa)

                        @if ($i % 2 == 0)
                            <div class="spacer-top"></div>
                        @endif

                    <div class="empresa">
                        <table>
                            <tr>
                                <td class="logo">
                                    @if($empresa->icono)
                                        <img src="file://{{ public_path($empresa->icono) }}">
                                    @elseif($empresa->icono_url)
                                        <img src="file://{{ public_path($empresa->icono_url) }}">
                                    @else
                                    <span> Sin imagen </span>
                                    @endif
                                </td>
                              <td class="info">
                                        <p style="text-align: center; color: #ffffff; font-size: 11pt; font-weight: bold; "><span class="label"></span> {{ $empresa->nombre_empresa }}</p>
                                        <p><span class="label">Categoria:</span> {{ $empresa->categoria->nombre ?? 'Sin categoría' }}</p>
                                        <p><span class="label">Propietario:</span> {{ $empresa->propietario }}</p>
                                        <p><span class="label">Celular:</span> {{ $empresa->celular }}</p>
                                        <p><span class="label">Correo:</span> {{ $empresa->correo }}</p>
                                        <p><span class="label">Descripción:</span> {{ $empresa->descripcion }}</p>
                                        <p><span class="label">NIT:</span> {{ $empresa->nit }}</p>

                                        @if($empresa->convenios->count())

                                            <div class="convenio">
                                                <div class="convenio-titulo">Convenios</div>

                                                @foreach($empresa->convenios as $convenio)
                                                    <div class="convenio-item">

                                                        <p><span class="label">Folio:</span> {{ $convenio->folio }}</p>

                                                        <p>
                                                            <span class="label">Vigencia:</span>
                                                            {{ \Carbon\Carbon::parse($convenio->fecha_inicio)->format('d/m/Y') }}
                                                            -
                                                            {{ \Carbon\Carbon::parse($convenio->fecha_fin)->format('d/m/Y') }}
                                                        </p>

                                                        <p><span class="label">Modalidad:</span> {{ $convenio->modalidad }}</p>

                                                        @if($convenio->facebook || $convenio->instagram || $convenio->tik_tok)
                                                            <div class="social-links">
                                                                <span class="label">Redes:</span>

                                                                @if($convenio->facebook)
                                                                    <a href="{{ $convenio->facebook }}" target="_blank" title="Facebook">
                                                                        <img src="file://{{ public_path('img/facebook.png') }}" width="25"  >
                                                                    </a>
                                                                    @endif
                                                                    
                                                                @if($convenio->instagram)
                                                                    <a href="{{ $convenio->instagram }}" target="_blank" title="Instagram">
                                                                        <img src="file://{{ public_path('img/instagram.png') }}" width="47">
                                                                    </a>
                                                                @endif

                                                                @if($convenio->tik_tok)
                                                                    <a href="{{ $convenio->tik_tok }}" target="_blank" title="TikTok">
                                                                        <img src="file://{{ public_path('img/tik_tok.png') }}" width="35">
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        @else
                                                            <p><em>No se registraron redes sociales para este convenio.</em></p>
                                                        @endif

                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p><em>Esta empresa no tiene convenios registrados.</em></p>
                                        @endif
                                    </td>

                            </tr>
                        </table>
                    </div>

                    @if (($i + 1) % 2 == 0)
                        <div style="page-break-after: always;"></div>
                    @endif

                    @endforeach
                </div> 
        </body>
</html>