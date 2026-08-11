<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
         @page {margin: 30pt 18pt;}
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
    top: 42px;     /* Ajusta según tu hoja */
    left: 70px;    /* Ajusta hasta centrar */
    opacity: 0.3;  /* Más baja para que no tape texto */
    width: 350px;
    z-index: -1;    /* IMPORTANTE */
        }

        .table {
            width: 100%;
            margin-bottom: 5px;
            color: #212529;
            border-collapse: collapse;
        }

        .table-bordered {
            border: 1.5px solid #2c3e50; 
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #2c3e50;
            padding: 4px;
            text-align: left;
            font-size: 7pt;
        }

        .table-bordered thead th {
            background-color: #d3d3d3 !important;
            font-weight: bold;
            border: none;
            font-size: 7.5pt;
        }

        .table-bordered tbody td {
            border: 1px solid #2c3e50;
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

        .page-break {
            page-break-after: always;
        }

        .header-section {
            border: 1.5px solid #2c3e50;
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
            border: 1.5px solid #2c3e50;
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
            position: absolute;
            top: 50%;
            left: -50%;
            transform: translate(10%, -50%) rotate(-45deg);
            font-size: 70pt;
            font-weight: bold;
            color: rgba(220, 53, 69, 0.15);
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
        .total-row td {
            font-size: 7pt;
            font-weight: bold;
        }
    </style>

    <title>Reporte de Inventario</title>
</head>
<body>
    <img 
        src="{{ public_path('vendor/adminlte/dist/img/facebolsrl.png') }}"
        class="watermark-logo"
        alt="Marca de agua">
@php
    function fechaInventarioPDF($fecha)
    {
        $carbon = \Carbon\Carbon::parse($fecha);
        $meses = [
            1 => 'ENERO', 2 => 'FEBRERO', 3 => 'MARZO',
            4 => 'ABRIL', 5 => 'MAYO', 6 => 'JUNIO',
            7 => 'JULIO', 8 => 'AGOSTO', 9 => 'SEPTIEMBRE',
            10 => 'OCTUBRE', 11 => 'NOVIEMBRE', 12 => 'DICIEMBRE',
        ];

        return $carbon->day . ' DE ' . $meses[$carbon->month] . ' DE ' . $carbon->year;
    }

    function numeroALetras($numero)
    {
        $formatter = new NumberFormatter('es', NumberFormatter::SPELLOUT);
        $entero = floor($numero);
        $decimal = round(($numero - $entero) * 100);

        $letras = strtoupper($formatter->format($entero));
        return $letras . ' ' . str_pad($decimal, 2, '0', STR_PAD_LEFT) . '/100';
    }

    /*$totalCantidad = $inventarios->sum('cantidad');
    $totalSubtotal = $inventarios->sum('sub_total');
    $totalGeneral  = $inventarios->sum('total');
    $montoEnLetras = numeroALetras($totalGeneral);*/
@endphp

@foreach($inventarios as $inventario)

@php
    $conceptos = json_decode($inventario->concepto, true) ?? [];
    $totalInventario = 0;  
@endphp

<!-- ENCABEZADO -->
<div class="header-section">
    <table class="header-table">
        <tr>
            <td class="text-center" style="width: 12%;">
                <span class="company-name">FACEBOL SRL</span><br>
                <img src="{{ public_path('vendor/adminlte/dist/img/logofacebol.jpg') }}" class="logo-img" alt="Logo">
            </td>

            <td class="text-center" style="width: 40%;">
                <div class="company-name">Ing. Luis Fernando Ilaquita Fernandez</div>
                <div class="address-info">
                    DPTO. LOCAL 2<br>
                    Av. Chacaltaya N°50<br>
                    Zona Alto Lima entre calle Sucre e Ilimani<br>
                    El Alto - La Paz - Bolivia
                </div>
                <div class="receipt-title" style="margin-top: 3px;">
                    REPORTE DE INVENTARIO
                </div>
            </td>

            <td class="text-right" style="width: 30%; font-size: 7pt;">
                <b>SEPREC/NIT:</b> 353354028 <br>
                <b>N°:</b> {{ $inventario->n_inventario ?? 'N/A' }}<br>
                <div class="estado-badge">
                    {{ $inventario->tipo === 'compra' ? 'COMPRA' : ($inventario->tipo === 'venta' ? 'VENTA' : ($inventario->tipo === 'bono' ? 'BONO' : '')) }}
                </div>
            </td>
        </tr>
    </table>

    <table class="info-table">
        <tr>
            <td colspan="2">
                <strong>EL ALTO </strong> {{  fechaInventarioPDF($inventario->fecha_inve) }}
            </td>
        </tr>

        <tr>
            <td style="width: 30%;">
                 <strong>SEÑOR/A:</strong>
                {{ $inventario->facturacion->informacion->nombre }}
                {{ $inventario->facturacion->informacion->apellido_paterno }}
                {{ $inventario->facturacion->informacion->apellido_materno }}
            </td>
            <td style="width: 30%;">
                <strong>NIT/CI:</strong>
                {{ $inventario->facturacion->ci_nit ?? 'N/A' }}
            </td>
        </tr>
    </table>
</div>
@if($inventario->anulado)
    <div class="watermark-anulada">ANULADA</div>
@endif

<!-- TABLA INVENTARIO -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th style="width: 10%;">CANTIDAD</th>
            <th style="width: 40%;">CONCEPTO</th>
            <th style="width: 15%;">P.UNITARIO</th>
            <th style="width: 15%;">SUBTOTAL</th>
            <th style="width: 20%;">TOTAL</th>
        </tr>
    </thead>

    <tbody>

       @foreach($conceptos as $item)
        @php
            $cantidad = $item['cantidad'] ?? 1;
            $precio   = $item['precio_uni'] ?? 0;
            $subTotal = $cantidad * $precio;
            $totalInventario += $subTotal;
        @endphp

        <tr>
            <td class="text-right">{{ $cantidad }}</td>
            <td>{{ strtoupper($item['concepto'] ?? '') }}</td>
            <td class="text-right">Bs. {{ number_format($precio,2,',','.') }}</td>
            <td class="text-right">Bs. {{ number_format($subTotal,2,',','.') }}</td>
            <td class="text-right">Bs. {{ number_format($subTotal,2,',','.') }}</td>
        </tr>
        @endforeach

        <tr class="total-row">
            <td colspan="2" class="no-border"></td>
                <td class="no-border text-right">
                    TOTAL Bs.
                </td>
            <td class="no-border"></td>
                <td class="text-right">
                    Bs. {{ number_format($totalInventario, 2, ',', '.') }}
                </td>
        </tr>
    </tbody>
</table>

<!-- MONTO EN LETRAS -->
<div class="literal-box">
    <strong>SON:</strong> {{ numeroALetras($totalInventario) }} BOLIVIANOS
</div>

@if(!$loop->last)
    <div style="page-break-after: always;"></div>
@endif

@endforeach 

</body>


</html>