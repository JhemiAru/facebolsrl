@extends('layouts.admin')

@section('content')
    <style>
        .select2-container .select2-selection--single {
            height: 38px;
            padding: 6px 12px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 26px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
            right: 10px;
        }

        .select2-dropdown {
            border-radius: 0;
        }

        .select2-results__option {
            padding: 8px 12px;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #007bff;
            color: white;
        }

        .camera {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-top: 20px;
        }

        #video,
        #canvas {
            width: 320px;
            height: 240px;
            border: 1px solid black;
        }

        #fotoCapturada {
            margin-top: 20px;
            width: 320px;
            height: 240px;
        }
    </style>

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
                <div class="card card-outline card-primary">
                    <div class="card-header py-3 bg-primary">
                        <h6 class="m-0 font-weight-bold text-white">
                            <i class="fas fa-id-card mr-1"></i> Datos de la Inscripción
                        </h6>
                </div>
                    <div class="card card-body">
                        <form id="inscripcionForm" action="{{ url('/inscripciones') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="f_inscripcion">Fecha Inscripción</label>
                                        <input type="date" id="f_inscripcion" name="f_inscripcion"
                                            value="{{ old('f_inscripcion') }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="recibos">Recibo/Folio</label> <b>*</b>
                                    <input type="number" name="recibos" value="{{ old('recibos') }}" class="form-control"
                                        required pattern="\d+" title="Solo se permiten números" style="text-transform: uppercase;">
                                </div>
                                <div class="col-md-4">
                                    <label for="direccion">Dirección</label> <b>*</b>
                                    <input type="text" name="direccion" value="{{ old('direccion') }}"
                                        class="form-control" required style="text-transform: uppercase;">
                                </div>
                                <div class="col-md-4">
                                    <label for="email">Correo</label> <b>*</b>
                                    <span class="input-group-text"><i class="fas fa-fas fa-envelope"></i>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                        required></span>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="id_informacion">Apellidos y Nombres del Pasante</label>
                                        <select name="id_informacion" id="id_informacion" class="form-control" required>
                                            <option value="">Seleccionar Pasantes</option>
                                            @foreach ($informacions as $informacion)
                                                <option value="{{ $informacion->id }}">
                                                    {{ $informacion->nombre }}
                                                    {{ $informacion->apellido_paterno }}
                                                    {{ $informacion->apellido_materno }} 
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="ci">C.I.</label> <b>*</b>
                                    <input type="number" name="ci" value="{{ old('ci') }}" class="form-control"
                                        pattern="[0-9\-]+" title="Solo se permiten números y guiones (-)" required style="text-transform: uppercase;">
                                    @error('ci')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label for="id_extension">Extensión</label>
                                    <select name="id_extension" id="id_extension" class="form-control selectpicker"
                                        data-live-search="true" required>
                                        <option value="">Seleccionar</option>
                                        @foreach ($extensions as $extension)
                                            <option value="{{ $extension->id }}">
                                                {{ $extension->expedido }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="genero">Genero</label> <b>*</b>
                                    <select name="genero" class="form-control" required>
                                        <option value="" disabled {{ old('genero') ? '' : 'selected' }}>Seleccionar
                                            Genero</option>
                                        <option value="1" {{ old('genero') == 'MASCULINO' ? 'selected' : '' }}>
                                            MASCULINO</option>
                                        <option value="0" {{ old('genero') == 'FEMENINO' ? 'selected' : '' }}>FEMENINO
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="id_area">Áreas</label> <b>*</b>
                                    <select name="id_area" id="id_area" class="form-control selectpicker"
                                        data-live-search="true" required>
                                        <option value="">Seleccionar</option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id }}">
                                                {{ $area->nombre_area }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="id_generacion">Generación</label> <b>*</b>
                                    <select name="id_generacion" id="id_generacion" class="form-control selectpicker"
                                        data-live-search="true" required>
                                        <option value="">Seleccionar Generación</option>
                                        @foreach ($generacions as $generacion)
                                            <option value="{{ $generacion->id }}">
                                                {{ $generacion->generacion }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="codigo_credencial">Codigo Credencial</label> <b>*</b>
                                    <input type="text" name="codigo_credencial" id="codigo_credencial" value=""
                                        class="form-control" required style="text-transform: uppercase;" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="id_role">Tipos de Roles</label> <b>*</b>
                                    <select name="id_role" id="id_role" class="form-control selectpicker"
                                        data-live-search="true" >
                                        <option value="">Seleccionar Roles</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- su scrip de roles -->
                                <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                        document.getElementById("inscripcionForm").addEventListener("submit", function (event) {
                                            let idRole = document.getElementById("id_role").value;
                                            if (!idRole) {
                                                event.preventDefault();
                                                alert("Debe seleccionar un tipo de rol.");
                                            }
                                        });
                                    });
                                    </script>
                                    
                            </div>

                            <hr>
                            <!-- Sección para capturar la foto -->

                            <center>
                                <div class="col-md-5">
                                    <label for="">Fotografía</label>
                                    <input type="file" id="file" name="foto" class="form-control"> <br>
                                    <center><output id="list"></output> </center>
                                </div>
                            
                                <div class="button-container" style="display: flex; justify-content:center; gap: 10px; margin-top: 10px;">
                                    <button id="start-camera" type="button" class="btn btn-outline-primary">Usar cámara web</button>
                                    <button id="take-photo" type="button" class="btn btn-outline-success">Capturar foto</button>
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
                            
                            <!-- Mostrar la imagen cargada o tomada -->
                            {{-- <div class="form-group">
                                <label>Vista previa</label>
                                <img id="previewImage" src="" alt="Vista previa de la imagen"
                                    style="max-width: 100%; display:none;">
                            </div> --}}

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
                                                        <label class="btn btn-outline-success">
                                                            <input type="radio" name="requisito[{{ $requisito->id }}]"
                                                                value="1"> Entregado
                                                        </label>
                                                        <label class="btn btn-outline-danger">
                                                            <input type="radio" name="requisito[{{ $requisito->id }}]"
                                                                value="0"> No entregado
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

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
    </div>

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

            var now = new Date();
            var boliviaOffset = -4 * 60;
            var localOffset = now.getTimezoneOffset();
            var boliviaTime = new Date(now.getTime() + (boliviaOffset - localOffset) * 60 * 1000);
            var today = boliviaTime.toISOString().split('T')[0];
            var dateInput = document.getElementById('f_inscripcion');
            /* dateInput.value = today;
            dateInput.min = today; */
            dateInput.max = today; // ← Esto bloquea las fechas futuras

            // Frontend validation for radio buttons
            document.getElementById('inscripcionForm').addEventListener('submit', function(event) {
                let requisitos = document.querySelectorAll('[name^="requisito"]');
                let valid = true;
                requisitos.forEach(function(requisito) {
                    if (!document.querySelector('input[name="' + requisito.name + '"]:checked')) {
                        valid = false;
                    }
                });

                if (!valid) {
                    event.preventDefault();
                    alert('Debe seleccionar una opción para cada requisito.');
                }
            });

            /* busqueda de apellidos y nombres del pasantes */
            $(document).ready(function() {
                $('#id_informacion').select2({
                    placeholder: 'Seleccionar Pasantes',
                    allowClear: false
                });
            });

        });
    </script>
@endsection