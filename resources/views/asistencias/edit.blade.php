@extends('layouts.admin')

@section('content')
<div class="content" style="margin-left: 20px">
    <h1 class="text-center"><b>Actualizar Datos de la Asistencias</b></h1><br>

    {{-- @foreach ($errors->all() as $error)
    <div class="alert alert-danger">
        <li>{{ $error }}</li>
    </div>
    @endforeach --}}

    <div class="row">
        <div class="col-md-11">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title"><b>Llene los Datos</b></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('asistencias.updateFields', $asistencia->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <table class="table table-bordered table-striped table-m text-center">
                                <thead class="thead-custom">
                                    <tr>
                                        <th scope="row">Nombre del Pasante</th>
                                        <th scope="row">Codigo de Credencial</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="row">{{ $inscripcions->informacion->nombre }} {{ $inscripcions->informacion->apellido_paterno }} {{ $inscripcions->informacion->apellido_materno }}</td>
                                        <td scope="row">{{ $inscripcions->codigo_credencial }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <input type="hidden" name="id_inscripcion" value="{{ $inscripcions->id }}">
                            <div class="col-md-4">
                                <label for="fecha">Fecha</label>
                                <input type="date" name="fecha" value="{{ old('fecha', isset($asistencia->fecha) ? $asistencia->fecha->format('Y-m-d') : '') }}" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="h_llegada">Hora de Llegada</label>
                                <input type="time" name="h_llegada" value="{{ $asistencia->h_llegada }}" class="form-control" >
                            </div>
                            <div class="col-md-4">
                                <label for="h_salida">Hora de Salida</label>
                                <input type="time" name="h_salida" value="{{ $asistencia->h_salida }}" class="form-control" >
                            </div>
                            <div class="col-md-4">
                                <label for="horas">Horas</label>
                                <input type="time" name="horas" value="{{ $asistencia->horas }}" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="asistencia">Asistencia</label>
                                <select name="asistencia" id="asistencia" class="form-control" required>
                                    <option value="">Seleccione</option>
                                    <option value="A" {{ old('asistencia', $asistencia->asistencia ?? '') == 'A' ? 'selected' : '' }}>Asistencia</option>
                                    <option value="F" {{ old('asistencia', $asistencia->asistencia ?? '') == 'F' ? 'selected' : '' }}>Falta</option>
                                    <option value="P" {{ old('asistencia', $asistencia->asistencia ?? '') == 'P' ? 'selected' : '' }}>Permiso</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="turno">Turno</label>
                                <select name="turno" id="turno" class="form-control" required>
                                    <option value="1" {{ $asistencia->turno == 1 ? 'selected' : '' }}>MAÑANA</option>
                                    <option value="0" {{ $asistencia->turno == 0 ? 'selected' : '' }}>TARDE</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="id_multa">Multas</label>
                                <select name="id_multa" id="id_multa" class="form-control" required>
                                    <option value="">Seleccione una multa</option>
                                    @foreach($multas as $multa)
                                        <option value="{{ $multa->id }}"
                                            {{ $asistencia->id_multa == $multa->id ? 'selected' : '' }}>
                                            {{ strtoupper($multa->nombre_multa) }}
                                            - {{ $multa->turno == 1 ? 'MAÑANA' : 'TARDE' }} <!-- Mostrar el turno -->
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- <div class="col-md-4">
                                <label for="">Tipo de Asistencia</label>
                                <input type="text" name="asistencia" value="{{ $asistencia->asistencia }}" class="form-control" required style="text-transform: uppercase;">
                            </div> --}}
                            {{-- <div class="col-md-4">
                                <label for="asistencia">Tipo de Asistencia</label>
                                <select name="asistencia" id="asistencia" class="form-control" required>
                                    <option value="0" {{ $asistencia->asistencia == 0 ? 'selected' : '' }}>Asistencia</option>
                                    <option value="1" {{ $asistencia->asistencia == 1 ? 'selected' : '' }}>Falta</option>
                                    <option value="2" {{ $asistencia->asistencia == 2 ? 'selected' : '' }}>Permiso</option>
                                </select>
                            </div> --}}

                            {{-- <div class="col-md-4">
                                <label for="id_actividad">Actividad</label>
                                <select name="id_actividad" id="id_actividad" class="form-control" required>
                                    <option value="">Seleccione una actividad</option>
                                    @foreach($actividads as $actividad)
                                        <option value="{{ $actividad->id }}"
                                            {{ $asistencia->id_actividad == $actividad->id ? 'selected' : '' }}>
                                            {{ $actividad->nombre_actividad }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>   --}}
                            <div class="col-md-4">
                                <label for="id_actividad">Actividad</label>
                                <select name="id_actividad" id="id_actividad" class="form-control" required>
                                    <option value="">Seleccione una actividad</option>
                                    @foreach($actividads as $actividad)
                                        <option value="{{ $actividad->id }}"
                                            {{ $asistencia->id_actividad == $actividad->id ? 'selected' : '' }}>
                                            {{ $actividad->nombre_actividad }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="estado">Estado</label>
                                <select name="estado" id="estado" class="form-control" required>
                                    <option value="2" {{ $asistencia->estado == 2 ? 'selected' : '' }}>Ninguno</option>
                                    <option value="0" {{ $asistencia->estado == 0 ? 'selected' : '' }}>Deuda</option>
                                    <option value="1" {{ $asistencia->estado == 1 ? 'selected' : '' }}>Cancelado</option>
                                </select>
                            </div>


                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <a href="{{ url('/asistencias') }}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-success">Actualizar registro</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    {{-- </div> --}}
</div>
@endsection

<script>
    document.getElementById('h_llegada').addEventListener('change', calculateHours);
    document.getElementById('h_salida').addEventListener('change', calculateHours);

    function calculateHours() {
        const hLlegada = document.getElementById('h_llegada').value;
        const hSalida = document.getElementById('h_salida').value;

        if (hLlegada && hSalida) {
            // Convertir las horas a objetos Date
            const [llegadaHours, llegadaMinutes] = hLlegada.split(':').map(Number);
            const [salidaHours, salidaMinutes] = hSalida.split(':').map(Number);

            const llegada = new Date();
            llegada.setHours(llegadaHours, llegadaMinutes);

            const salida = new Date();
            salida.setHours(salidaHours, salidaMinutes);

            // Calcular la diferencia en milisegundos
            let diff = salida - llegada;

            if (diff < 0) {
                // Si la salida es menor que la llegada, asumimos que es al día siguiente
                diff += 24 * 60 * 60 * 1000; // Agregar 24 horas en milisegundos
            }

            // Convertir la diferencia a horas y minutos
            const hours = Math.floor(diff / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));

            // Formatear el tiempo en formato HH:MM
            const formattedTime = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}`;

            // Asignar el valor calculado al campo de horas
            document.getElementById('horas').value = formattedTime;
        }
    }
</script>
<style>
    .hora-laboral h4,
    .hora-academica h4 {
        margin: 0;
    }

    .hora-laboral,
    .hora-academica {
        padding: 5px;
        border-radius: 5px;
        text-align: center;
    }

    .hora-laboral {
        background-color: #e9f7fd;
        color: #007bff;
    }

    .hora-academica {
        background-color: #eafaf1;
        color: #28a745;
    }

    .table-m th,
    .table-m td {
        vertical-align: middle;
        padding: 5px;
        font-size: 0.9em;
    }

    .thead-dark th {
        background-color: #343a40;
        color: #fff;
    }

    .thead-light th {
        background-color: #f8f9fa;
    }

    .table-m tbody tr:hover {
        background-color: #f1f1f1;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        line-height: 1.5;
        border-radius: 0.2rem;
    }

    .thead-custom {
        background-color: #008080;
        /* Celeste oscuro */
        color: white;
        /* Color del texto */
    }


    .glowing-button {
        display: inline-block;
        padding: 8px 16px;
        font-size: 14px;
        font-weight: bold;
        text-decoration: none;
        text-align: center;
        border-radius: 4px;
        color: #fff;
        background-color: #3a6896;/* Celeste oscuro */
        border: none;
        box-shadow: 0 0 20px #3a6896;/* Sombra del efecto glowing */

        /* Animación de brillo */
        animation: glowing 1.5s infinite;

        /* Transiciones */
        transition: background-color 0.3s, box-shadow 0.3s;
    }

    .glowing-button:hover {
        background-color: #1f4b77;/* Cambia el color al pasar el mouse */
        box-shadow: 0 0 20px #1f4b77;/* Cambia la sombra al pasar el mouse */
    }

    /* Animación de brillo */
    @keyframes glowing {
        0% {
            background-color: #3a6896;
            box-shadow: 0 0 20px #3a6896;
        }

        50% {
            background-color: #1f4b77;
            box-shadow: 0 0 20px #1f4b77;
        }

        100% {
            background-color: #3a6896;
            box-shadow: 0 0 20px #3a6896;
        }
    }
</style>
