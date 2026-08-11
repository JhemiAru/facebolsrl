<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10pt;
            color: #333;
        }
        .table{
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }
        .table-bordered{
            border: 1px solid #000000;
        }
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #000000;
        }
        .table-bordered thead th {
            border-bottom-width: 2px;
        }
    </style>
    
    <title>Reportes de Asistencias</title>
</head>

<body>
    <table style="width: 100%; border-collapse: collapse; font-size: 10pt; font-family: Arial, sans-serif;">
        <tr>
            <td style="text-align: center; padding: 10px; border-bottom: 2px solid #333;">
                <img src="{{ public_path('vendor/adminlte/dist/img/logofacebol.jpg') }}" width="90px" alt="Logo">
            </td>
            <td style="text-align: center; font-size: 14pt; font-weight: bold; border-bottom: 2px solid #333;">
                <span style="display: block;">FaceBol S.R.L Hazlo Diferente!</span>
                <span style="font-size: 10pt; color: #666;">www.facebolsrl.net | facebolsrl@gmail.com | 76266570</span>
            </td>
            <td style="text-align: right; padding: 10px; border-bottom: 2px solid #333;">
                <b>SEPREC/NIT:</b> 353354028 <br>
                {{-- <b>Licencia de Funcionamiento</b> --}}
            </td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center; padding: 15px;">
                <h1 style="margin: 0; color: #333;">Reporte de Asistencias</h1><br>
                <table style="width: 100%; border-collapse: collapse; font-size: 10pt; table-layout: fixed;">
                    <thead>
                        <tr>
                            <th>Nombres y Apellidos</th>
                            <th>Area</th>
                            <th>Codigo de Area</th>
                            <th>Horas Acumuladas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="background-color: #225588; color: white; text-align: center;"> {{ $inscripcion->informacion->nombre ?? 'No disponible' }} {{ $inscripcion->informacion->apellido_paterno ?? 'No disponible' }} {{ $inscripcion->informacion->apellido_materno  ?? 'No disponible' }} </td>
                            <td style="background-color: #225588; color: white; text-align: center;"> {{ $inscripcion->area->nombre_area ?? 'No disponible' }} </td>
                            <td style="background-color: #225588; color: white; text-align: center;"> {{ $inscripcion->codigo_credencial ?? 'No disponible' }} </td>
                            <td style="background-color: #225588; color: white; text-align: center;"> {{ $totales_horas }} </td>
                        </tr>
                    </tbody>
                </table>
                {{-- <h3 style="margin: 0; font-size: 12pt; color: #777;">MARKETING Y PUBLICIDAD</h3> --}}
            </td>
        </tr>
    </table>
    

    <br>
    <table style="width: 100%; border-collapse: collapse; font-size: 10pt; table-layout: fixed;">
        <thead>
            <tr>
                <th width="30px" style="background-color: #cccccc;text-align: center"><b>Nro</b></th>
                <th width="190px" style="background-color: #cccccc;text-align: center"><b>Dia</b></th>
                <th width="80px" style="background-color: #cccccc;text-align: center"><b>Fecha</b></th>
                <th width="100px" style="background-color: #cccccc;text-align: center"><b>Hora de Llegada</b></th>
                <th width="100px" style="background-color: #cccccc;text-align: center"><b>Hora de Salida</b></th>
                <th width="50px" style="background-color: #cccccc;text-align: center"><b>Horas</b></th>
                <th width="100px" style="background-color: #cccccc;text-align: center"><b>Turno</b></th>
                <th width="100px" style="background-color: #cccccc;text-align: center"><b>Asistencia</b></th>
                <th width="100px" style="background-color: #cccccc;text-align: center"><b>Multas</b></th>
                <th width="100px" style="background-color: #cccccc;text-align: center"><b>Actividades</b></th>
            </tr>
        </thead>
        <tbody>
            <?php $contador = 0; ?>
            @foreach ($asistencias as $asistencia)
                <tr>
                    <td style="text-align: center"><?php echo $contador = $contador + 1; ?></td>
                    <td style="text-align: center">{{ $asistencia->fecha->translatedFormat('l') }}</td>
                    <td style="text-align: center">{{ $asistencia->fecha->translatedFormat('d-m-Y') }}</td>
                    <td style="text-align: center">{{ $asistencia->h_llegada }}</td>
                    <td style="text-align: center">{{ $asistencia->h_salida }}</td>
                    <td style="text-align: center">{{ $asistencia->horas }}</td>
                    <td style="text-align: center">
                        @if ($asistencia->multa->turno == 1)
                            <span style="background-color: #0d6efd; color: white; padding: 3px 6px; border-radius: 4px; display: inline-block;">
                                MAÑANA
                            </span>
                        @else
                            <span style="background-color: #ffc107; color: black; padding: 3px 6px; border-radius: 4px; display: inline-block;">
                                TARDE
                            </span>
                        @endif
                    </td>
                    
                    <td style="text-align: center">
                        <span style="background-color: #ffc107; color: black; padding: 3px 6px; border-radius: 4px; display: inline-block;">
                            {{ $asistencia->asistencia }}
                        </span>
                    </td>
                    
                    <td style="text-align: center">
                        <span style="background-color: #6c757d; color: white; padding: 3px 6px; border-radius: 4px; display: inline-block;">
                            {{ $asistencia->multa->nombre_multa }}
                        </span>
                    </td>                    
                    <td style="text-align: center">
                        <span style="background-color: #198754; color: white; padding: 3px 6px; border-radius: 4px; display: inline-block;">
                            {{ $asistencia->actividad->nombre_actividad }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    
</body>

</html>