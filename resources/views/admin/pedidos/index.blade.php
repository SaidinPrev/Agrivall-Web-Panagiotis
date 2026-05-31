@extends('plantilla')

@section('titulo', 'Pedidos | Admin AgriVall')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
@endpush

@section('contenido')
    <section class="admin-page py-5">
        <div class="container mt-5">
            <div class="mb-4">
                <h1 class="display-5 fw-bold mb-2">Pedidos</h1>
            </div>

            @if (session('status_success'))
                <div class="alert alert-success" role="alert">{{ session('status_success') }}</div>
            @endif

            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>Email</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pedidos as $pedido)
                                    <tr>
                                        <td class="fw-semibold">#{{ $pedido->id }}</td>
                                        <td class="fw-semibold">{{ $pedido->nombre_cliente }}</td>
                                        <td>{{ $pedido->email_cliente }}</td>
                                        <td>{{ number_format($pedido->precio_pedido, 2) }} €</td>
                                        <td>
                                            <span class="badge rounded-pill text-bg-success">{{ $pedido->estado }}</span>
                                        </td>
                                        <td>{{ $pedido->fecha_pedido }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-2">
                                                <a class="btn btn-sm btn-outline-success"
                                                    href="{{ route('admin.pedidos.show', $pedido) }}">Ver</a>
                                                <form action="{{ route('admin.pedidos.destroy', $pedido) }}" method="POST"
                                                    onsubmit="return confirm('¿Seguro que quieres eliminar este pedido?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-danger" type="submit">Eliminar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center text-secondary py-4" colspan="7">
                                            Todavía no hay pedidos registrados.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
