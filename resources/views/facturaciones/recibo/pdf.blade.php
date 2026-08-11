<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 8pt;
            color: #000;
            line-height: 1.2;
            position: relative;
            margin: 0;
            padding: 0;
        }

       /* ===== MARCA DE AGUA CON IMAGEN ===== */
        .watermark-logo {
            position: fixed;
            top: 45%;
            left: 40%;
            transform: translate(-50%, -50%);
            opacity: 0.38;
            z-index: 5;
            width: 420px;
        }

        .table {
            width: 100%;
            margin-bottom: 5px;
            color: #212529;
            border-collapse: collapse;
        }

        .table-bordered {
            border: 1.5px solid #5DADE2;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #5DADE2;
            padding: 4px;
            text-align: left;
            font-size: 7pt;
        }

        .table-bordered thead th {
            background-color: #f0f0f0;
            font-weight: bold;
            border: none;
            font-size: 7.5pt;
        }

        .table-bordered tbody td {
            border: 1px solid #5DADE2;
        }

        .content-table {
            width: 100%;
            font-size: 7pt;
            margin-top: 5px;
        }

        .content-table td {
            padding: 4px 0;
        }

        .field-label {
            font-weight: bold;
            color: #000;
            font-size: 7pt;
        }

        .field-value {
            color: #333;
            font-size: 7pt;
        }

        .watermark-anulada {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 50pt;
            font-weight: bold;
            color: rgba(220, 53, 69, 0.2);
            z-index: 1000;
            white-space: nowrap;
            pointer-events: none;
            text-align: center;
            letter-spacing: 15px;
            font-family: Arial, Helvetica, sans-serif;
            text-transform: uppercase;
            border: 5px solid rgba(220, 53, 69, 0.2);
            padding: 20px 40px;
        }

        .header-section {
            border: 1.5px solid #5DADE2;
            padding: 5px;
            margin-bottom: 5px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 6pt;
            font-family: Arial, sans-serif;
            margin-bottom: 5px;
        }

        .header-table td {
            padding: 3px;
            border: none;
        }

        .header-table .company-name {
            font-size: 6.5pt;
            font-weight: bold;
        }

        .header-table .address-info {
            font-size: 5.5pt;
            line-height: 1.1;
        }

        .header-table .receipt-title {
            font-size: 7pt;
            font-weight: bold;
        }

        .logo-img {
            border-radius: 50%;
            width: 30px;
            height: 30px;
            object-fit: cover;
        }

        .info-table {
            width: 100%;
            font-size: 7pt;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 2px 0;
            border: none;
        }

        .literal-box {
            border: 1.5px solid #5DADE2;
            padding: 4px;
            margin-bottom: 5px;
            font-size: 7pt;
        }

        .no-border {
            border: none !important;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .estado-badge {
            display: inline-block;
            border: 2px solid #000;
            padding: 4px 10px;
            margin-top: 4px;
            font-size: 8pt;
            font-weight: bold;
            border-radius: 3px;
            background-color: #f8f9fa;
            color: #000;
        }

        /* Marca de agua ANULADA */
        .watermark-anulada {
            position: fixed;
            top: 50%;
            left: -50%;
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

    <title>Recibo de Pago</title>
</head>

<body>

   <!-- ===== IMAGEN COMO MARCA DE AGUA ===== -->
    <img 
        src="{{ public_path('vendor/adminlte/dist/img/facebolLogo.png') }}"
        class="watermark-logo"
        alt="Marca de agua">

    @php
        function fechaReciboPDF($fecha)
    {
        $carbon = \Carbon\Carbon::parse($fecha);

        $meses = [
            1 => 'ENERO',
            2 => 'FEBRERO',
            3 => 'MARZO',
            4 => 'ABRIL',
            5 => 'MAYO',
            6 => 'JUNIO',
            7 => 'JULIO',
            8 => 'AGOSTO',
            9 => 'SEPTIEMBRE',
            10 => 'OCTUBRE',
            11 => 'NOVIEMBRE',
            12 => 'DICIEMBRE',
        ];

        return $carbon->day . ' DE ' . $meses[$carbon->month] . ' DE ' . $carbon->year;
    }

        $conceptos = $factura->recibo->conceptos ?? collect();
        $totalGeneral = $conceptos->sum('monto');
    @endphp

    <!-- Header + Información del cliente -->
    <div class="header-section">
        <!-- Header -->
        <table class="header-table">
            <tr>
                <td class="text-center" style="width: 12%;">
                    <span class="company-name">FACEBOL SRL</span><br>
                    <img src="{{ public_path('vendor/adminlte/dist/img/logofacebol.jpg') }}" class="logo-img"
                        alt="Logo">
                </td>
                <td class="text-center" style="width: 40%;">
                    <div class="company-name">Ing. Luis Fernando Ilaquita Fernandez</div>
                    <div class="address-info">
                        DPTO. LOCAL 2<br>
                        Av. Chacaltaya N°50<br>
                        Zona Alto Lima entre calle Sucre e Ilimani<br>
                        El Alto - La Paz - Bolivia
                    </div>
                    <div class="receipt-title" style="margin-top: 3px;">RECIBO DE PAGO</div>
                </td>
                <td class="text-right" style="width: 20%; font-size: 7pt;">
                    <b>SEPREC/NIT:</b> 353354028 <br>
                    <b>N°:</b> {{ $factura->recibo->n_recibo ?? 'N/A' }}<br>
                    <div class="estado-badge">
                        {{ $factura->estado === 'pago_deposito' ? 'DEPÓSITO' : ($factura->estado === 'pago_efectivo' ? 'EFECTIVO' : 'OTRO') }}
                    </div>
                </td>
            </tr>
        </table>

        <!-- Información del cliente -->
        <table class="info-table">
            <tr>
                <td colspan="2">
                    <strong>EL ALTO </strong> 
                    {{ fechaReciboPDF($factura->recibo->fecha_recibo) }}
                </td>
            </tr>
            <tr>
                <td style="width: 70%;">
                    <strong>SEÑOR(ES):</strong>
                    @if ($factura->informacion)
                        {{ strtoupper($factura->informacion->nombre) }}
                        {{ strtoupper($factura->informacion->apellido_paterno) }}
                        {{ strtoupper($factura->informacion->apellido_materno) }}
                    @endif
                </td>
                <td style="width: 30%;">
                    <strong>NIT/CI:</strong>
                    @if ($factura->informacion)
                        {{ $factura->ci_nit }}
                    @endif
                </td>
            </tr>
        </table>
    </div>

    @if ($factura->anulado)
        <div class="watermark-anulada">ANULADA</div>
    @endif
    <!-- Tabla de conceptos -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 15%;">FECHA</th>
                <th style="width: 60%;">CONCEPTO</th>
                <th style="width: 25%;">TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($conceptos as $concepto)
                <tr>
                    <td style="width: 15%;">
                        {{ \Carbon\Carbon::parse($concepto->fecha_concepto)->format('d/m/Y') }}
                    </td>
                    <td style="width: 60%;">{{ strtoupper($concepto->concepto) }}</td>
                    <td style="width: 25%;">Bs. {{ number_format($concepto->monto, 2, ',', '.') }}</td>
                </tr>
            @endforeach
            <!-- Fila del total -->
            <tr>
                <td colspan="2" class="no-border" style="text-align: right;"><strong>TOTAL Bs.</strong></td>
                <td style="width: 25%;"><strong>Bs. {{ number_format($totalGeneral, 2, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>

    @php
        function numeroALetras($numero)
        {
            $formatter = new NumberFormatter('es', NumberFormatter::SPELLOUT);
            $entero = floor($numero);
            $decimal = round(($numero - $entero) * 100);

            $letras = strtoupper($formatter->format($entero));
            return $letras . ' ' . str_pad($decimal, 2, '0', STR_PAD_LEFT) . '/100';
        }

        $montoEnLetras = numeroALetras($totalGeneral);
    @endphp

    <!-- Monto literal -->
    <div class="literal-box">
        <strong>SON:</strong> {{ $montoEnLetras }} BOLIVIANOS
    </div>
</body>

</html>