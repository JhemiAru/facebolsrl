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
    
    <title>Reportes de Informaciónes</title>
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
                <h1 style="margin: 0; color: #333;">Reporte de Registros de Pasantes</h1>
                {{-- <h3 style="margin: 0; font-size: 12pt; color: #777;">MARKETING Y PUBLICIDAD</h3> --}}
            </td>
        </tr>
    </table>
    

    <br>
    <table style="width: 100%; border-collapse: collapse; font-size: 10pt; table-layout: fixed;">
        <thead>
            <tr>
                <th width="30px" style="background-color: #cccccc; text-align: center;"><b>Nro</b></th>
                <th width="100px" style="background-color: #cccccc; text-align: center;"><b>Fecha de Registro</b></th>
                <th width="200px" style="background-color: #cccccc; text-align: center;"><b>Nombres y Apellidos</b></th>
                <th width="180px" style="background-color: #cccccc; text-align: center;"><b>Correo Electrónico</b></th>
                <th width="120px" style="background-color: #cccccc; text-align: center;"><b>CI</b></th>
                <th width="100px" style="background-color: #cccccc; text-align: center;"><b>Porcentaje Requisito</b></th>
                <th width="100px" style="background-color: #cccccc; text-align: center;"><b>Código Credencial</b></th>
            </tr>
        </thead>
        
        <tbody>
            <?php $contador = 0; ?>
            @foreach ($inscripcions as $inscripcion)
                <tr>
                    <td style="text-align: center"><?php echo $contador = $contador + 1; ?></td>
                    <td>{{ $inscripcion->f_inscripcion }}</td>
                    <td>{{ $inscripcion->informacion->nombre }} {{ $inscripcion->informacion->apellido_paterno }} {{ $inscripcion->informacion->apellido_materno }}</td>
                    <td style="text-align: center; width: 200px; overflow-wrap: break-word;">
                        {{ $inscripcion->users->email }}
                    </td>
                    
                    <td style="text-align: center">{{ $inscripcion->ci }} {{ $inscripcion->extension->expedido }}</td>
                    <td style="text-align: center">
                        <span style="background-color: #ffc107; color: black; padding: 3px 6px; border-radius: 4px; display: inline-block;">
                            {{ $inscripcion->porcentaje_requisitos }}%
                        </span>
                    </td>
                    <td style="text-align: center">
                        <span style="background-color: #198754; color: white; padding: 3px 6px; border-radius: 4px; display: inline-block;">
                            {{ $inscripcion->codigo_credencial }}
                        </span>
                    </td>
                    {{-- <td>
                        @if (!$inscripcion->users?->getRoleNames()->isEmpty())
                            @foreach ($inscripcion->users?->getRoleNames() as $rol)
                            <span class="badge bg-success" ><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $rol }}</font></font></span>
                            @endforeach
                        @else
                                <span class="badge badge-danger">Sin asignar</span>
                        @endif
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>


    
</body>

</html>
