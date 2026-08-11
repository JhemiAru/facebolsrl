@extends('layouts.admin')

@section('content')
<div class="content" style="margin-left: 20px">
    
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-user-plus mr-2"></i><b>Datos del Registro Administrativos</b>
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/inscripciones') }}">Inscripciones</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nueva</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header py-3 bg-success">
                        <h6 class="m-0 font-weight-bold text-white">
                            <i class="fas fa-id-card mr-1"></i> Actualizar registro
                        </h6>
                </div>
                <div class="card-body" style="...">
                    <form id="inscripcionForm" action="{{ url('/inscripciones', $inscripcion->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="f_inscripcion">Fecha de Inscripción</label> <b>*</b>
                                    <input type="date" id="f_inscripcion" name="f_inscripcion" value="{{ old('f_inscripcion', $inscripcion->f_inscripcion) }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="recibos">Recibos/Folio</label> <b>*</b>
                                <input type="number" name="recibos" value="{{ old('recibos', $inscripcion->recibos) }}" class="form-control" style="text-transform: uppercase;" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="direccion">Dirección</label> <b>*</b>
                                <input type="text" name="direccion" value="{{ old('direccion', $inscripcion->direccion) }}" class="form-control" style="text-transform: uppercase;">
                            </div>
                            <div class="col-md-3">
                                <label for="email">Correo</label> <b>*</b>
                                <input type="email" name="email" value="{{ old('email', $inscripcion->users?->email ?? '') }}" class="form-control" required> 
                                {{-- <input type="email" name="email" value="{{ old('email', $inscripcion->users->email) }}" class="form-control" required> --}}

                            </div>
                            <div class="col-md-4">
                                <label for="id_informacion">Nombres y Apellidos</label>
                                <select name="id_informacion" id="id_informacion" class="form-control selectpicker" data-live-search="true" required >
                                    <option value="">Seleccionar Pasantes</option>
                                    @foreach ($informacions as $informacion)
                                        <option value="{{ $informacion->id }}" {{ $inscripcion->id_informacion == $informacion->id ? 'selected' : '' }}>
                                            {{ $informacion->nombre }} {{ $informacion->apellido_paterno }} {{ $informacion->apellido_materno }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="ci">CI</label> <b>*</b>
                                <input type="number" id="ci" name="ci" value="{{ old('ci', $inscripcion->ci) }}" class="form-control" style="text-transform: uppercase;">
                            </div>

                            <div class="col-md-2">
                                <label for="id_extension">Extension</label> <b>*</b>
                                <select name="id_extension" id="id_extension" class="form-control selectpicker" data-live-search="true">
                                    <option value="">Seleccionar Áreas</option>
                                    @foreach ($extensions as $extension)
                                        <option value="{{ $extension->id }}" {{ $inscripcion->id_extension == $extension->id ? 'selected' : '' }}>
                                            {{ $extension->expedido }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="genero">Genero</label> <b>*</b>
                                <select name="genero" class="form-control" required>
                                    <option value="" disabled {{ old('genero', $inscripcion->genero) === null ? 'selected' : '' }}>Seleccionar</option>
                                    <option value="1" {{ old('genero', $inscripcion->genero) == 1 ? 'selected' : '' }}>MASCULINO</option>
                                    <option value="0" {{ old('genero', $inscripcion->genero) == 0 ? 'selected' : '' }}>FEMENINO</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for="id_area">Áreas</label> <b>*</b>
                                <select name="id_area" id="id_area" class="form-control selectpicker" data-live-search="true">
                                    <option value="">Seleccionar Áreas</option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}" {{ $inscripcion->id_area == $area->id ? 'selected' : '' }}>
                                            {{ $area->nombre_area }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="id_generacion">Generación</label> <b>*</b>
                                <select name="id_generacion" id="id_generacion" class="form-control selectpicker" data-live-search="true" required>
                                    <option value="">Seleccionar Generacion</option>
                                    @foreach ($generacions as $generacion)
                                        <option value="{{ $generacion->id }}" {{ $inscripcion->id_generacion == $generacion->id ? 'selected' : '' }}>
                                            {{ $generacion->generacion }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="codigo_credencial">Código Credencial</label><b>*</b>
                                <input type="text" id="codigo_credencial" name="codigo_credencial" value="{{ old('codigo_credencial', $inscripcion->codigo_credencial) }}" class="form-control" style="text-transform: uppercase;" readonly>
                            </div>
                            <div class="col-md-2">
                                <label for="id_role">Tipo de Roles</label> <b>*</b>
                                <select name="id_role" id="id_role" class="form-control selectpicker" data-live-search="true" required>
                                    <option value="">Seleccionar Roles</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ $inscripcion->users?->hasRole($role->name) ? 'selected' : '' }}>
                                       {{--<option value="{{ $role->id }}" {{ $inscripcion->users->hasRole($role->name) ? 'selected' : '' }}>--}} 
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Estado</label>
                                    <br>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-outline-success {{ $inscripcion->estado == 'activo' ? 'active' : '' }}">
                                            <input type="radio" name="estado" value="1" {{ $inscripcion->estado == 1 ? 'checked' : '' }}> Activo
                                        </label>
                                        <label class="btn btn-outline-danger {{ $inscripcion->estado == 'inactivo' ? 'active' : '' }}">
                                            <input type="radio" name="estado" value="0" {{ $inscripcion->estado == 0 ? 'checked' : '' }}> Inactivo
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <!-- Sección para capturar la foto -->
                        <center>
                            <div class="col-md-5">
                                <label for="">Fotografía</label>
                                <input type="file" id="file" name="foto" class="form-control" onchange="previewImage(event)"> <br>
                                <!-- Mostrar la imagen cargada, si existe -->
                                <center>
                                    <output id="list">
                                        @if (isset($inscripcion->users->foto) && !empty($inscripcion->users->foto)) <!-- Verifica si hay una imagen previamente cargada -->
                                            <!-- Asegúrate de que la ruta sea la correcta -->
                                            <img class="thumb thumbnail" src="{{ asset($inscripcion->users->foto) }}" width="60%" alt="Imagen Cargada">
                                        @else
                                            <p>No hay imagen cargada.</p>
                                        @endif
                                    </output>
                                </center>
                            </div>
                            
                        
                            <div class="button-container" style="display: flex; justify-content:center; gap: 10px; margin-top: 10px;">
                                <button id="start-camera" type="button" class="btn btn-primary">Usar cámara web</button>
                                <button id="take-photo" type="button" class="btn btn-success">Capturar foto</button>
                            </div>
                        
                            <br><br>
                            <video id="video" width="250" height="160" autoplay></video> <br>
                            <canvas id="canvas" style="display: none;"></canvas>
                        
                            <!-- Campo oculto para almacenar la imagen capturada desde la cámara -->
                            <input type="hidden" id="foto_capturada" name="foto_capturada" />
                        
                            <script>
                                function archivo(evt) {
                                    var files = evt.target.files;
                                    for (var i = 0, f; f = files[i]; i++) {
                                        if (!f.type.match('image.*')) {
                                            continue;
                                        }
                                        var reader = new FileReader();
                                        reader.onload = (function(theFile) {
                                            return function(e) {
                                                document.getElementById("list").innerHTML = ['<img class="thumb thumbnail" src="', e.target.result,
                                                    '" width="60%" title="', escape(theFile.name), '"/>'
                                                ].join('');
                                            };
                                        })(f);
                                        reader.readAsDataURL(f);
                                    }
                                }
                                document.getElementById('file').addEventListener('change', archivo, false);
                        
                                // Acceso a la cámara
                                const video = document.getElementById('video');
                                const canvas = document.getElementById('canvas');
                                const startCamera = document.getElementById('start-camera');
                                const takePhoto = document.getElementById('take-photo');
                                const output = document.getElementById('list');
                                const fotoCapturada = document.getElementById('foto_capturada'); // Campo oculto
                        
                                // Iniciar la cámara web
                                startCamera.addEventListener('click', async function() {
                                    try {
                                        const stream = await navigator.mediaDevices.getUserMedia({
                                            video: true
                                        });
                                        video.srcObject = stream;
                                    } catch (err) {
                                        console.error("Error al acceder a la cámara: ", err);
                                    }
                                });
                        
                                // Capturar la foto desde la cámara
                                takePhoto.addEventListener('click', function() {
                                    const context = canvas.getContext('2d');
                                    canvas.width = video.videoWidth;
                                    canvas.height = video.videoHeight;
                                    context.drawImage(video, 0, 0, canvas.width, canvas.height);
                        
                                    // Convertir la imagen a formato base64 y mostrarla
                                    const dataURL = canvas.toDataURL('image/png');
                                    output.innerHTML = '<img class="thumb thumbnail" src="' + dataURL + '" width="60%"/>';
                        
                                    // Guardar la imagen capturada en el campo oculto del formulario
                                    fotoCapturada.value = dataURL;
                                });
                                
                            </script>
                        </center>

                        <hr>
                        <div class="row">
                            <table id="example1" class="table table-bordered table-striped table-m text-center">
                                <thead>
                                    <tr>
                                        <th>Requisito</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requisitos as $requisito)
                                        <tr>
                                            <td>{{ $requisito->requisito }}</td>
                                            <td>
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <label class="btn btn-outline-success {{ isset($asignarRequisitos[$requisito->id]) && $asignarRequisitos[$requisito->id]->estado == 1 ? 'active' : '' }}">
                                                        <input type="radio" name="requisito[{{ $requisito->id }}]" value="1" {{ isset($asignarRequisitos[$requisito->id]) && $asignarRequisitos[$requisito->id]->estado == 1 ? 'checked' : '' }}>
                                                        Entregado
                                                    </label>
                                                    <label class="btn btn-outline-danger {{ isset($asignarRequisitos[$requisito->id]) && $asignarRequisitos[$requisito->id]->estado == 0 ? 'active' : '' }}">
                                                        <input type="radio" name="requisito[{{ $requisito->id }}]" value="0" {{ isset($asignarRequisitos[$requisito->id]) && $asignarRequisitos[$requisito->id]->estado == 0 ? 'checked' : '' }}>
                                                        No entregado
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <a href="{{ url('/inscripciones') }}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-success">Guardar Registro</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
{{-- </div> --}}

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var areaSelect = document.getElementById('id_area');
        var generacionSelect = document.getElementById('id_generacion');
        var codigoCredencialInput = document.getElementById('codigo_credencial');

        // Datos del controlador
        var inscripciones = @json($c_inscritos);

        function updateCodigoCredencial() {
            var areaText = areaSelect.options[areaSelect.selectedIndex].text;
            var generacionText = generacionSelect.options[generacionSelect.selectedIndex].text;

            if (areaText && generacionText && areaSelect.value && generacionSelect.value) {
                var areaCode = areaText.substring(0, 4).toUpperCase();
                var generacionCode = generacionText;
                console.log(inscripciones);
                var count = 0;
                var cantidad = 0;
                inscripciones.forEach(function(inscripcion) {
                    if (inscripcion.area_id == areaSelect.value && inscripcion.generacion_id ==
                        generacionSelect.value) {
                        cantidad = inscripcion.c_inscritos;
                        console.log(inscripcion.area_id + " , " + areaSelect.value + " c_inscritos " +
                            cantidad);
                    }
                });

                var countFormatted = (cantidad + 1).toString().padStart(2, '0');
                codigoCredencialInput.value = areaCode + generacionCode + countFormatted;
            } else {
                codigoCredencialInput.value = '';
            }
        }

        areaSelect.addEventListener('change', updateCodigoCredencial);
        generacionSelect.addEventListener('change', updateCodigoCredencial);

        // Habilitar codigo_credencial antes de enviar el formulario
        document.getElementById('inscripcionForm').addEventListener('submit', function() {
            codigoCredencialInput.disabled = false;
        });

        var now = new Date();
        var boliviaOffset = -4 * 60;
        var localOffset = now.getTimezoneOffset();
        var boliviaTime = new Date(now.getTime() + (boliviaOffset - localOffset) * 60 * 1000);
        var today = boliviaTime.toISOString().split('T')[0];
        var dateInput = document.getElementById('f_inscripcion');
        /* dateInput.value = today;
        dateInput.min = today; */
        dateInput.max = today; // ← Esto bloquea las fechas futuras
    });
</script>