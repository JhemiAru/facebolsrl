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
                <h1 style="margin: 0; color: #333;">Reporte de Información</h1>
                {{-- <h3 style="margin: 0; font-size: 12pt; color: #777;">MARKETING Y PUBLICIDAD</h3> --}}
            </td>
        </tr>
    </table>
    

    <br>
    <table style="width: 100%; border-collapse: collapse; font-size: 10pt; table-layout: fixed;">
        <thead>
            <tr>
                <th width="30px" style="background-color: #cccccc;text-align: center"><b>Nro</b></th>
                <th width="190px" style="background-color: #cccccc;text-align: center"><b>Nombres y Apellidos</b></th>
                <th width="80px" style="background-color: #cccccc;text-align: center"><b>Celular</b></th>
                <th width="100px" style="background-color: #cccccc;text-align: center"><b>Institución</b></th>
                <th width="100px" style="background-color: #cccccc;text-align: center"><b>Área de Estudio</b></th>
                <th width="50px" style="background-color: #cccccc;text-align: center"><b>Nivel de Estudio</b></th>
                <th width="100px" style="background-color: #cccccc;text-align: center"><b>Referencia</b></th>
            </tr>
        </thead>
        <tbody>
            <?php $contador = 0; ?>
            @foreach ($informacions as $informacion)
                <tr>
                    <td style="text-align: center"><?php echo $contador = $contador + 1; ?></td>
                    <td>{{ $informacion->nombre }} {{ $informacion->apellido_paterno }} {{ $informacion->apellido_materno }}</td>
                    <td style="text-align: center">{{ $informacion->celular }}</td>
                    <td style="text-align: center">{{ $informacion->insti_univer }}</td>
                    <td style="text-align: center">{{ $informacion->carrera }}</td>
                    <td style="text-align: center">{{ $informacion->año }}</td>
                    <td style="text-align: center">{{ $informacion->invitado_visita }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    
</body>

</html>
