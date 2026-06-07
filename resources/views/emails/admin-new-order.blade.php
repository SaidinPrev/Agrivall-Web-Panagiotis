<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Nuevo pedido #{{ $pedido->id }}</title>
</head>

<body style="margin: 0; padding: 0; background: #f6f1ea; color: #5c0d18; font-family: Arial, sans-serif;">
    <div style="padding: 32px 16px;">
        <div
            style="max-width: 680px; margin: 0 auto; overflow: hidden; border-radius: 20px; background: #fffdf8; box-shadow: 0 18px 45px rgba(92, 13, 24, 0.16);">
            <div style="padding: 28px 32px; background: #49673f; color: #faf1f6;">
                <p style="margin: 0 0 8px; font-size: 12px; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase;">
                    Nuevo pedido recibido
                </p>
                <h1 style="margin: 0; font-size: 30px; line-height: 1.1;">Pedido #{{ $pedido->id }}</h1>
            </div>

            <div style="padding: 28px 32px;">
                <h2 style="margin: 0 0 16px; font-size: 20px;">Datos del cliente</h2>
                <p style="margin: 0 0 8px;"><strong>Cliente:</strong> {{ $pedido->nombre_cliente }}</p>
                <p style="margin: 0 0 8px;"><strong>Email:</strong> {{ $pedido->email_cliente }}</p>
                <p style="margin: 0 0 8px;"><strong>Teléfono:</strong> {{ $pedido->tlf_cliente }}</p>
                <p style="margin: 0 0 20px;"><strong>Dirección:</strong> {{ $pedido->direccion_envio }}</p>

                <h2 style="margin: 0 0 14px; font-size: 20px;">Productos</h2>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="padding: 10px 0; border-bottom: 1px solid #eadfd6; text-align: left; font-size: 12px; text-transform: uppercase;">
                                Producto
                            </th>
                            <th style="padding: 10px 0; border-bottom: 1px solid #eadfd6; text-align: center; font-size: 12px; text-transform: uppercase;">
                                Cant.
                            </th>
                            <th style="padding: 10px 0; border-bottom: 1px solid #eadfd6; text-align: right; font-size: 12px; text-transform: uppercase;">
                                Precio
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedido->lineas as $linea)
                            <tr>
                                <td style="padding: 14px 0; border-bottom: 1px solid #f0e7df;">
                                    <strong>{{ $linea->producto->nombre }} {{ $linea->producto->variedad }}</strong><br>
                                    <span style="color: #7b6257;">{{ $linea->formato }}</span>
                                </td>
                                <td style="padding: 14px 0; border-bottom: 1px solid #f0e7df; text-align: center;">
                                    {{ $linea->cantidad }}
                                </td>
                                <td style="padding: 14px 0; border-bottom: 1px solid #f0e7df; text-align: right;">
                                    {{ number_format($linea->precio_unitario, 2) }} €
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div style="margin-top: 22px; padding: 18px; border-radius: 14px; background: #f2eadf; text-align: right;">
                    <span style="display: block; color: #7b6257; font-size: 13px;">Total del pedido</span>
                    <strong style="font-size: 26px;">{{ number_format($pedido->precio_pedido, 2) }} €</strong>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
