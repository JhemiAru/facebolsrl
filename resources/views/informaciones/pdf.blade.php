<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Informaciónes</title>
</head>
<body>
    <br>
    <h1>Reporte de Informaciónes</h1>


    <table id="example1" class="table table-bordered table-striped table-m" border="1">
        <thead>
            <tr>
                <th>Nro</th>
                <th>Apellidos y Nombres</th>
                <th>Celular</th>
                <th>Instituto universidad</th>
                <th>carrera</th>
                <th>Año o Semestral</th>
                <th>invitado visita</th>
            </tr>
        </thead>
        <tbody>
            <?php $contador = 0; ?>
            @foreach ($informacions as $informacion)
                <tr>
                    <td><?php echo $contador = $contador + 1; ?></td>
                    <td>{{ $informacion->apellido_paterno }} {{ $informacion->apellido_materno }} {{ $informacion->nombre }}</td>
                    <td>{{ $informacion->celular }}</td>
                    <td>{{ $informacion->insti_univer }}</td>
                    <td>{{ $informacion->carrera }}</td>
                    <td>{{ $informacion->año }}</td>
                    <td>{{ $informacion->invitado_visita }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
