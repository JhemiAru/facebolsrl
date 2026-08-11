<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            color: #000;
            line-height: 1.6;
            position: relative;
        }

        /* Marca de agua del logo */
        .watermark-logo {
            position: fixed;
            top: 50%;
            left: 40%;
            transform: translate(-40%, -50%);
            opacity: 0.45;
            z-index: 5;
            width: 400px;
            height: auto;
            pointer-events: none;
            filter: grayscale(100%);
            -webkit-filter: grayscale(100%);
        }


        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }

        .table-bordered {
            border: 1px solid #000000;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #000000;
        }

        .table-bordered thead th {
            border-bottom-width: 2px;
        }

        .content-table {
            width: 100%;
            font-size: 10pt;
            margin-top: 10px;
        }

        .content-table td {
            padding: 8px 0;
        }

        .field-label {
            font-weight: bold;
            color: #000;
            font-size: 10pt;
        }

        .field-value {
            color: #333;
            font-size: 10pt;
        }

        .amount-box {
            border: 2px solid #000;
            padding: 10px;
            text-align: center;
            font-size: 10pt;
            font-weight: bold;
            background-color: #f8f8f8;
            margin: 10px 0;
        }

        .signature-table {
            width: 100%;
            margin-top: 80px;
            font-size: 10pt;
        }

        .signature-table td {
            text-align: center;
            vertical-align: bottom;
            padding: 0 20px;
        }

        .signature-line {
            border-top: 2px solid #000;
            margin-bottom: 5px;
            padding-top: 5px;
        }

        .footer {
            text-align: center;
            font-size: 10pt;
            color: #666;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #ccc;
        }

        .footer p {
            margin: 5px 0;
        }

        /* Marca de agua ANULADA */
        .watermark-anulada {
            position: fixed;
            top: 50%;
            left: -10%;
            transform: translate(10%, -50%) rotate(-45deg);
            font-size: 70pt;
            font-weight: bold;
            color: rgba(220, 53, 69, 0.3);
            z-index: 1000;
            white-space: nowrap;
            pointer-events: none;
            text-align: center;
            letter-spacing: 20px;
            font-family: Arial, Helvetica, sans-serif;
            text-transform: uppercase;
            border: 8px solid rgba(220, 53, 69, 0.3);
            padding: 40px 80px;
        }
    </style>

    <title>Reportes de Asistencias</title>
</head>

<body>
    <!-- Marca de agua del logo de fondo -->
    <img src="{{ public_path('vendor/adminlte/dist/img/facebolLogo.png') }}" class="watermark-logo" alt="FaceBol">

    @if ($factura->anulado)
        <div class="watermark-anulada">ANULADA</div>
    @endif
    <table style="width: 100%; border-collapse: collapse; font-size: 8pt; font-family: Arial, sans-serif;">
        <tr>
            <td style="text-align: center; padding: 10px; border-bottom: 2px solid #333;">
                <img src="{{ public_path('vendor/adminlte/dist/img/logofacebol.jpg') }}" width="60px" alt="Logo">
            </td>
            <td style="text-align: center; font-size: 10pt; font-weight: bold; border-bottom: 2px solid #333;">
                <span>Comprobante de pago</span>
                <span style="display: block;">FaceBol S.R.L Hazlo Diferente!</span>
                <span style="font-size: 8pt; color: #666;">www.facebolsrl.net | facebolsrl@gmail.com | 76266570</span>
            </td>
            <td style="text-align: right; padding: 10px; border-bottom: 2px solid #333;">
                <b>SEPREC/NIT:</b> 353354028 <br>
            </td>
        </tr>
        <tr>
            <td style="text-align: left; padding: 15px; font-size: 10pt;">
                <b>Fecha:</b> {{ \Carbon\Carbon::parse($factura->registro->fecha)->format('d/m/Y') }}
            </td>
            <td style="text-align: center; padding: 15px; font-size: 10pt;">
                <b>Recibo N°:</b> {{ $factura->registro->n_registro }}
            </td>
            <td style="text-align: right; padding: 15px; font-size: 10pt;">
                <b>Bs:</b> {{ number_format($factura->registro->monto, 2, ',', '.') }}<br>
                <b>Estado:</b> {{ $factura->estado }}
            </td>
        </tr>
    </table>

    <!-- Contenido del recibo -->
    <table class="content-table">
        <tr>
            <td>
                <span class="field-label">Recibí del Señor(a):</span>
                <span class="field-value">
                    {{ $factura->informacion->nombre }}
                    {{ $factura->informacion->apellido_paterno }}
                    {{ $factura->informacion->apellido_materno }}
                </span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="field-label">La suma de:</span>
                <span class="field-value">
                    @if ($factura->registro->monto_literal)
                        {{ $factura->registro->monto_literal }}
                    @else
                        _________________________________________________________________
                    @endif
                </span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="field-label">Por concepto de:</span>
                <span class="field-value">{{ $factura->registro->concepto }}</span>
            </td>
        </tr>
    </table>

    <!-- Cuadro del monto destacado -->
    <div class="amount-box">
        MONTO TOTAL: Bs. {{ number_format($factura->registro->monto, 2, ',', '.') }}
    </div>

    <!-- Pie de página -->
    <div class="footer">
        <p><strong>Gracias por su preferencia</strong></p>
        <p>FaceBol S.R.L. - Todos los derechos reservados © {{ date('Y') }}</p>
    </div>
</body>

</html>