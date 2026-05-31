<h1>Nueva consulta sobre hierbas comestibles</h1>

<p><strong>Nombre:</strong> {{ $data['nombre'] }}</p>
<p><strong>Email:</strong> {{ $data['email'] }}</p>

@if (!empty($data['telefono']))
    <p><strong>Teléfono:</strong> {{ $data['telefono'] }}</p>
@endif

<p><strong>Mensaje:</strong></p>
<p>{{ $data['mensaje'] }}</p>