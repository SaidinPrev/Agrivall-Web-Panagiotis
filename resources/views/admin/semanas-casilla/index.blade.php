@extends('plantilla')

@section('titulo', 'Semanas La Casilla | Admin AgriVall')

@push('styles')
    @vite('resources/sass/admin.scss')
@endpush

@section('contenido')
    <section class="admin-page py-5">
        <div class="container mt-5">
            <div class="admin-hero card border-0 shadow-sm mb-4">
                <div class="card-body p-4 p-lg-5">
                    <p class="text-uppercase fw-bold text-success small mb-2">Reservas por semanas</p>
                    <h1 class="display-5 fw-bold mb-2">Semanas de La Casilla</h1>

                </div>
            </div>

            @if (session('status_success'))
                <div class="alert alert-success">{{ session('status_success') }}</div>
            @endif

            <div class="card border-0 shadow-sm admin-card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 admin-table">
                            <thead class="table-light">
                                <tr>
                                    <th>Semana</th>
                                    <th>Fechas</th>
                                    <th>Año</th>
                                    <th>Precio</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($semanas as $semana)
                                    <tr>
                                        <td class="fw-bold">{{ $semana->numero_semana }}</td>
                                        <td>{{ $semana->descriptor }}</td>
                                        <td>{{ $semana->anio }}</td>
                                        <td>
                                            <form class="admin-inline-price" data-admin-inline-price
                                                action="{{ route('admin.semanas-casilla.update', $semana) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="estado" value="{{ $semana->estado }}">

                                                <button type="button"
                                                    class="admin-inline-price__display btn btn-link p-0 text-decoration-none fw-semibold"
                                                    data-admin-price-trigger>
                                                    {{ $semana->estado === 'NO DISPONIBLE' || !$semana->precio ? '-' : number_format($semana->precio, 2) . ' €' }}
                                                </button>

                                                <div class="admin-inline-price__editor d-none" data-admin-price-editor>
                                                    <div class="input-group input-group-sm">
                                                        <input class="form-control" name="precio" type="number"
                                                            min="0" step="0.01"
                                                            value="{{ old('precio', $semana->precio) }}">
                                                        <button class="btn btn-success" type="submit">Guardar</button>
                                                        <button class="btn btn-outline-secondary" type="button"
                                                            data-admin-price-cancel>
                                                            Cancelar
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <button type="button"
                                                class="admin-status admin-status--button admin-status--{{ \Illuminate\Support\Str::slug($semana->estado) }}"
                                                data-admin-status-open="status-modal-{{ $semana->id }}">
                                                {{ $semana->estado }}
                                            </button>

                                            <dialog id="status-modal-{{ $semana->id }}" class="admin-status-dialog"
                                                data-admin-status-dialog>
                                                <div class="admin-status-dialog__header">
                                                    <div>
                                                        <strong>Semana {{ $semana->numero_semana }}</strong>
                                                        <p>{{ $semana->descriptor }} · {{ $semana->anio }}</p>
                                                    </div>
                                                    <button type="button" class="admin-status-dialog__close"
                                                        data-admin-status-close aria-label="Cerrar">
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </button>
                                                </div>

                                                <form action="{{ route('admin.semanas-casilla.update', $semana) }}"
                                                    method="POST" class="admin-status-dialog__form">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="precio" value="{{ $semana->precio }}">

                                                    <label class="form-label fw-semibold"
                                                        for="estado-{{ $semana->id }}">Estado</label>
                                                    <select class="form-select" id="estado-{{ $semana->id }}"
                                                        name="estado">
                                                        @foreach (['DISPONIBLE', 'PRE-RESERVA', 'RESERVADO', 'NO DISPONIBLE'] as $estado)
                                                            <option value="{{ $estado }}"
                                                                @selected(old('estado', $semana->estado) === $estado)>
                                                                {{ $estado }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    <div class="admin-status-dialog__actions">
                                                        <button class="btn btn-success" type="submit">Guardar</button>
                                                        <button class="btn btn-outline-secondary" type="button"
                                                            data-admin-status-close>
                                                            Cancelar
                                                        </button>
                                                    </div>
                                                </form>
                                            </dialog>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
