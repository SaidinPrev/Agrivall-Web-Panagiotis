@extends('plantilla')

@section('titulo', 'Pedidos | Admin AgriVall')

@section('contenido')
    <section class="admin-page py-5">
        <div class="container mt-5">
            <div class="admin-hero card border-0 shadow-sm mb-4">
                <div class="card-body p-4 p-lg-5">
                    <div class="d-flex flex-column flex-lg-row justify-content-between gap-3">
                        <div>
                            <p class="text-uppercase fw-bold text-success small mb-2">Gestión de pedidos</p>
                            <h1 class="display-5 fw-bold mb-2">Pedidos</h1>
                        </div>
                        <div class="admin-hero__metric align-self-lg-center">
                            <span class="d-block text-secondary small">Total registrados</span>
                            <strong>{{ $pedidos->count() }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            @if (session('status_success'))
                <div class="alert alert-success" role="alert">{{ session('status_success') }}</div>
            @endif

            <div class="card border-0 shadow-sm admin-card">
                <div class="card-header bg-white border-0 px-4 pt-4 pb-0">
                    <h2 class="h5 fw-bold mb-0">Listado de pedidos</h2>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 admin-table">
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
                                        <td class="fw-bold">{{ number_format($pedido->precio_pedido, 2) }} €</td>
                                        <td>
                                            <span class="badge rounded-pill text-bg-success px-3 py-2">
                                                {{ $pedido->estado }}
                                            </span>
                                        </td>
                                        <td>{{ $pedido->fecha_pedido }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-2 justify-content-start">
                                                <a class="btn btn-sm btn-success"
                                                    href="{{ route('admin.pedidos.show', $pedido) }}">Ver</a>
                                                <form action="{{ route('admin.pedidos.destroy', $pedido) }}" method="POST"
                                                    onsubmit="return confirm('¿Seguro que quieres eliminar este pedido?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-danger" type="submit">
                                                        Eliminar
                                                    </button>
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
