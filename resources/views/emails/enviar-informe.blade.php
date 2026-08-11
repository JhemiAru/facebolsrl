<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Actividad Semanal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            margin: -30px -30px 20px -30px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            margin: 20px 0;
            padding: 20px;
            background-color: #fafafa;
            border-radius: 4px;
            border: 1px solid #e5e7eb;
            white-space: pre-line;
        }

        .attachment-note {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 12px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .attachment-note strong {
            color: #92400e;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #e5e7eb;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>📋 Reporte de Actividad Semanal</h1>
        </div>

        <div class="content">{{ $contenido }}</div>

        <div class="attachment-note">
            <strong>📎 Archivo Adjunto:</strong> El informe detallado de actividades se encuentra adjunto en formato
            PDF.
        </div>

        <div class="footer">
            <p><strong>FaceBol S.R.L.</strong></p>
            <p>Sistema de Gestión de Reportes de Actividades</p>
            <p style="font-size: 12px; color: #9ca3af;">
                Este es un correo automático, por favor no responder directamente a este mensaje.
            </p>
        </div>
    </div>
</body>

</html>
