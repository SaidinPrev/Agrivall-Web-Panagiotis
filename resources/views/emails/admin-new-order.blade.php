<h1>Nuevo pedido #{{ $pedido->id }}</h1>

<p>Cliente: {{ $pedido->nombre_cliente }}</p>
<p>Email: {{ $pedido->email_cliente }}</p>
<p>Teléfono: {{ $pedido->tlf_cliente }}</p>
<p>Dirección: {{ $pedido->direccion_envio }}</p>
<p>Total: {{ number_format($pedido->precio_pedido, 2) }} €</p>

<ul>
    @foreach ($pedido->lineas as $linea)
        <li>
            {{ $linea->producto->nombre }} {{ $linea->producto->variedad }}
            - {{ $linea->formato }}
            - Cantidad: {{ $linea->cantidad }}
            - {{ number_format($linea->precio_unitario, 2) }} €
        </li>
    @endforeach
</ul>