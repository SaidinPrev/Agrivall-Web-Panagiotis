@extends('plantilla')

@section('titulo', 'Editar semana | Admin AgriVall')

@push('styles')
    @vite('resources/sass/admin.scss')
@endpush

@section('contenido')
    <section class="admin-page py-5">
        <div class="container mt-5">
            <a class="btn btn-link text-success px-0 text-decoration-none" href="{{ route('admin.semanas-casilla.index') }}">
                Volver a semanas
            </a>

            <div class="card border-0 shadow-sm admin-card">
                <div class="card-body p-4">
                    <h1 class="h3 fw-bold mb-1">Semana {{ $semana->numero_semana }}</h1>
                    <p class="text-secondary">{{ $semana->descriptor }} · {{ $semana->anio }}</p>

                    <form action="{{ route('admin.semanas-casilla.update', $semana) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <label class="form-label fw-semibold" for="precio">Precio</label>
                        <input class="form-control mb-3" id="precio" name="precio" type="number" min="0" step="0.01"
                            value="{{ old('precio', $semana->precio) }}">

                        <label class="form-label fw-semibold" for="estado">Estado</label>
                        <select class="form-select mb-4" id="estado" name="estado">
                            @foreach (['DISPONIBLE', 'PRE-RESERVA', 'RESERVADO', 'NO DISPONIBLE'] as $estado)
                                <option value="{{ $estado }}" @selected(old('estado', $semana->estado) === $estado)>{{ $estado }}</option>
                            @endforeach
                        </select>

                        <button class="btn btn-success" type="submit">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
