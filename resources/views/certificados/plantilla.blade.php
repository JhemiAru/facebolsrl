<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificado de {{ $certificado->detalle->programa->programa }}</title>
</head>
<body contenteditable="true">
    <div style="text-align: right;">La Paz, {{ $fecha }}</div>

    <h2 style="text-align: center;">CERTIFICADO DE {{ $certificado->detalle->programa->programa }}</h2>

    <p>
        FaceBol SRL, tiene a bien certificar, {{ $certificado->inscripcion->genero == 1 ? 'al Señor' : 'a la Señorita' }}
        {{ $certificado->inscripcion->informacion->nombre }} {{ $certificado->inscripcion->informacion->apellido_paterno }}
        {{ $certificado->inscripcion->informacion->apellido_materno }} con C.I. {{ $certificado->inscripcion->ci }}
        {{ $certificado->inscripcion->extension->expedido }}.
        Cumplió satisfactoriamente la etapa de {{ $certificado->detalle->programa->programa }} en nuestra institución,
        colaborando en el Área de {{ $certificado->detalle->area->nombre_area }}.
        {{ $certificado->detalle->descripcion }}, durante {{ $certificado->meses }} meses consecutivos,
        del {{ $fechainicio }} al {{ $fechafinal }},
        acumulando una carga horaria de {{ \Illuminate\Support\Str::before($certificado->horas, ':') }} Horas
        {{ $certificado->tipo_horas }}.
    </p>

    <p>
        Durante este periodo, {{ $certificado->inscripcion->genero == 1 ? 'el Señor' : 'la Señorita' }}
        {{ $certificado->inscripcion->informacion->nombre_apellido }}
        demostró ser una persona responsable, puntual, honesta y dedicada en todas las labores que le fueron encomendadas.
    </p>

    <p>A tal efecto se extiende el presente certificado para fines del interesado.</p>

    <p style="text-align: center; margin-top: 50px;">GERENTE GENERAL</p>
    <p style="text-align: center;">LUIS FERNANDO ILAQUITA FERNANDEZ</p>
</body>
</html>
