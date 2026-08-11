<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Recibos de Pago - FACEBOL SRL</title>
    <!--[if mso]>
    <style type="text/css">
        body, table, td {font-family: Arial, Helvetica, sans-serif !important;}
    </style>
    <![endif]-->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333333;
            max-width: 650px;
            margin: 0 auto;
            padding: 0;
            background-color: #f4f4f4;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        img {
            border: 0;
            outline: none;
            text-decoration: none;
            display: block;
        }

        .email-container {
            background-color: #ffffff;
            margin: 20px auto;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            max-width: 650px;
        }

        .header {
            background: linear-gradient(135deg, #1a365d 0%, #0f2847 100%);
            padding: 0;
            position: relative;
            border-bottom: 4px solid #d4af37;
        }

        .header-top {
            background-color: #0f2847;
            padding: 20px 30px;
            text-align: left;
        }

        .company-name {
            color: #ffffff;
            margin: 0 0 5px 0;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-align: center;
        }

        .company-tagline {
            color: #d4af37;
            margin: 0;
            font-size: 12px;
            font-weight: 400;
            letter-spacing: 2px;
            text-transform: uppercase;
            text-align: center;
        }

        .header-title {
            background: linear-gradient(to right, #1a365d 0%, #2a4a7d 100%);
            padding: 25px 30px;
            text-align: center;
            border-top: 1px solid rgba(212, 175, 55, 0.2);
        }

        .header-title h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .content {
            background: #ffffff;
            padding: 35px 40px;
        }

        .content p {
            color: #444444;
            margin: 15px 0;
            line-height: 1.8;
            font-size: 15px;
        }

        .greeting {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .info-box {
            background: linear-gradient(to right, #f8f9fa 0%, #ffffff 100%);
            padding: 20px 25px;
            border-left: 5px solid #d4af37;
            margin: 25px 0;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .info-box p {
            margin: 0;
            white-space: pre-wrap;
            color: #2c3e50;
            font-size: 14px;
            line-height: 1.7;
        }

        .signature {
            margin-top: 35px;
            padding-top: 25px;
            border-top: 2px solid #e0e0e0;
        }

        .signature p {
            margin: 8px 0;
            color: #555555;
            font-size: 14px;
        }

        .signature strong {
            color: #1a365d;
            font-weight: 700;
        }

        .footer {
            background: linear-gradient(to right, #0f2847 0%, #1a365d 100%);
            padding: 30px;
            text-align: center;
            color: #ffffff;
            border-top: 3px solid #d4af37;
        }

        .footer p {
            margin: 10px 0;
            font-size: 13px;
            color: #b8c5d6;
            line-height: 1.6;
        }

        .footer .copyright {
            color: #d4af37;
            font-weight: 600;
            font-size: 14px;
        }

        .divider {
            height: 2px;
            background: linear-gradient(to right, transparent 0%, #d4af37 50%, transparent 100%);
            margin: 25px 0;
        }

        .attachment-notice {
            background-color: #f0f7ff;
            border: 1px solid #d4af37;
            border-radius: 6px;
            padding: 15px;
            margin: 20px 0;
            text-align: center;
        }

        .attachment-notice p {
            margin: 5px 0;
            color: #1a365d;
            font-weight: 600;
        }

        @media only screen and (max-width: 600px) {
            .email-container {
                margin: 10px;
                border-radius: 4px;
            }

            .content {
                padding: 20px 15px;
            }

            .company-name {
                font-size: 22px;
            }

            .header-title h1 {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <div class="header-top">
                <p class="company-name">FACEBOL SRL</p>
                <p class="company-tagline">Excelencia y Profesionalismo</p>
            </div>
            <div class="header-title">
                <h1>🧾 Recibos de Pago</h1>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <p class="greeting">
                Estimado/a Cliente,
            </p>

            <p>Por medio del presente, le hacemos llegar sus recibos de pago correspondientes a su solicitud.</p>

            <div class="info-box">
                <p>{{ !empty($mensajeExtra) ? $mensajeExtra : 'Adjunto encontrará su(s) recibo(s) de pago en formato PDF. Le recordamos que este documento es importante para su registro contable y financiero. Por favor, conserve este comprobante para futuras referencias.' }}
                </p>
            </div>

            <div class="attachment-notice">
                <p>📎 Documento adjunto en formato PDF</p>
                <p style="font-size: 12px; color: #666; font-weight: normal;">El archivo adjunto contiene todos los
                    detalles de sus recibos de pago.</p>
            </div>

            <div class="divider"></div>

            <p>Le recordamos que puede acercarse ante cualquier consulta o aclaración que necesite.</p>

            <p>Agradecemos su confianza y preferencia.</p>

            <div class="signature">
                <p><em>Atentamente,</em></p>
                <p><strong>FACEBOL SRL</strong></p>
                {{-- <p style="color: #666;">Ing. Luis Fernando Ilaquita Fernandez</p>
                <p style="color: #888; font-size: 13px;">Departamento de Administración</p> --}}
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p class="copyright">© {{ date('Y') }} FACEBOL SRL - Todos los derechos reservados</p>
            <p><strong>Dirección:</strong> Av. Chacaltaya N°50, Zona Alto Lima</p>
            <p>El Alto, La Paz - Bolivia</p>
            <p style="font-size: 11px; margin-top: 15px; color: #90a4b8;">
                Este correo electrónico fue enviado desde una cuenta de notificaciones automáticas.<br>
                Por favor, no responda directamente a este mensaje.
            </p>
        </div>
    </div>
</body>

</html>
