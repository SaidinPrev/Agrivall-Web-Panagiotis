<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Nueva pre-reserva de La Casilla</title>
</head>

<body style="margin: 0; padding: 0; background: #f6f1ea; color: #5c0d18; font-family: Arial, sans-serif;">
    <div style="padding: 32px 16px;">
        <div style="max-width: 640px; margin: 0 auto; border-radius: 18px; background: #fffdf8; overflow: hidden;">
            <div style="padding: 26px 30px; background: #49673f; color: #faf1f6;">
                <p style="margin: 0 0 8px; font-size: 12px; letter-spacing: 0.08em; text-transform: uppercase;">
                    Nueva solicitud
                </p>
                <h1 style="margin: 0; font-size: 28px;">Pre-reserva de La Casilla</h1>
            </div>

            <div style="padding: 26px 30px;">
                <h2 style="margin: 0 0 14px;">Semana solicitada</h2>
                <p style="margin: 0 0 8px;"><strong>Semana:</strong> {{ $semana->numero_semana }} / {{ $semana->anio }}</p>
                <p style="margin: 0 0 8px;"><strong>Fechas:</strong> {{ $semana->descriptor }}</p>
                <p style="margin: 0 0 22px;"><strong>Precio:</strong> {{ number_format($semana->precio, 2) }} €</p>

                <h2 style="margin: 0 0 14px;">Datos del cliente</h2>
                <p style="margin: 0 0 8px;"><strong>Nombre:</strong> {{ $data['nombre'] }}</p>
                <p style="margin: 0 0 8px;"><strong>Email:</strong> {{ $data['email'] }}</p>
                @if (!empty($data['telefono']))
                    <p style="margin: 0 0 8px;"><strong>Teléfono:</strong> {{ $data['telefono'] }}</p>
                @endif
                <p style="margin: 18px 0 6px;"><strong>Observaciones:</strong></p>
                <p style="margin: 0; line-height: 1.6;">{{ $data['observaciones'] ?? 'Sin observaciones.' }}</p>
            </div>
        </div>
    </div>
</body>

</html>
