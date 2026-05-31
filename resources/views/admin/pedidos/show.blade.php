@extends('plantilla')

@section('titulo', 'Pedido #' . $pedido->id . ' | Admin AgriVall')

@section('contenido')
    <section class="admin-page py-5">
        <div class="container mt-5">
            <a class="btn btn-link text-success px-0 mb-3 text-decoration-none" href="{{ route('admin.pedidos.index') }}">
                Volver a pedidos
            </a>

            <div class="admin-hero card border-0 shadow-sm mb-4">
                <div class="card-body p-4 p-lg-5">
                    <div class="d-flex flex-column flex-lg-row justify-content-between gap-3">
                        <div>
                            <p class="text-uppercase fw-bold text-success small mb-2">Detalle del pedido</p>
                            <h1 class="display-5 fw-bold mb-2">Pedido #{{ $pedido->id }}</h1>
                        </div>
                        <div class="admin-hero__metric align-self-lg-center">
                            <span class="d-block text-secondary small">Total</span>
                            <strong>{{ number_format($pedido->precio_pedido, 2) }} €</strong>
                        </div>
                    </div>
                </div>
            </div>

            @if (session('status_success'))
                <div class="alert alert-success" role="alert">{{ session('status_success') }}</div>
            @endif

            <div class="row g-4 mb-4">
                <article class="col-lg-7">
                    <div class="card border-0 shadow-sm h-100 admin-card">
                        <div class="card-body p-4">
                            <h2 class="h4 mb-3">Datos del cliente</h2>
                            <dl class="row mb-0">
                                <dt class="col-sm-4 text-secondary">Cliente</dt>
                                <dd class="col-sm-8 fw-semibold">{{ $pedido->nombre_cliente }}</dd>

                                <dt class="col-sm-4 text-secondary">Email</dt>
                                <dd class="col-sm-8">{{ $pedido->email_cliente }}</dd>

                                <dt class="col-sm-4 text-secondary">Teléfono</dt>
                                <dd class="col-sm-8">{{ $pedido->tlf_cliente }}</dd>

                                <dt class="col-sm-4 text-secondary">Dirección</dt>
                                <dd class="col-sm-8">{{ $pedido->direccion_envio }}</dd>

                                <dt class="col-sm-4 text-secondary">Total</dt>
                                <dd class="col-sm-8 fw-bold">{{ number_format($pedido->precio_pedido, 2) }} €</dd>
                            </dl>
                        </div>
                    </div>
                </article>

                <article class="col-lg-5">
                    <div class="card border-0 shadow-sm h-100 admin-card">
                        <div class="card-body p-4">
                            <h2 class="h4 mb-3">Estado del pedido</h2>
                            <p class="mb-3">
                                <span class="badge rounded-pill text-bg-success px-3 py-2">{{ $pedido->estado }}</span>
                            </p>

                            <form action="{{ route('admin.pedidos.update-estado', $pedido) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <label class="form-label fw-semibold" for="estado">Estado</label>
                                <select class="form-select mb-3" id="estado" name="estado">
                                    <option value="INICIADO" @selected($pedido->estado === 'INICIADO')>INICIADO</option>
                                    <option value="EN PROCESO" @selected($pedido->estado === 'EN PROCESO')>EN PROCESO</option>
                                    <option value="REPARTO" @selected($pedido->estado === 'REPARTO')>REPARTO</option>
                                    <option value="FINALIZADO" @selected($pedido->estado === 'FINALIZADO')>FINALIZADO</option>
                                </select>

                                <button class="btn btn-success w-100" type="submit">Actualizar estado</button>
                            </form>
                        </div>
                    </div>
                </article>
            </div>

            <article class="card border-0 shadow-sm mb-4 admin-card">
                <div class="card-body p-4">
                    <h2 class="h4 mb-3">Productos</h2>

                    <ul class="list-group list-group-flush">
                        @foreach ($pedido->lineas as $linea)
                            <li class="list-group-item d-md-flex justify-content-between align-items-center px-0 py-3">
                                <div class="mb-2 mb-md-0">
                                    <strong class="d-block">
                                        {{ $linea->producto->nombre }} {{ $linea->producto->variedad }}
                                    </strong>
                                    <span class="text-secondary">
                                        {{ $linea->formato }} · Cantidad: {{ $linea->cantidad }}
                                    </span>
                                </div>
                                <span class="fw-semibold">
                                    {{ number_format($linea->precio_unitario, 2) }} € / unidad
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </article>

            <div class="card border-danger-subtle bg-danger-subtle border-0">
                <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <div>
                        <h2 class="h5 fw-bold text-danger mb-1">Zona de peligro</h2>
                        <p class="mb-0 text-danger-emphasis">Eliminar este pedido borrará también sus líneas asociadas.</p>
                    </div>
                    <form action="{{ route('admin.pedidos.destroy', $pedido) }}" method="POST"
                        onsubmit="return confirm('¿Seguro que quieres eliminar este pedido?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Eliminar pedido</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
