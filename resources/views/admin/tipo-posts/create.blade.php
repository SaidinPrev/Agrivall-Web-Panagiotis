@extends('plantilla')

@section('titulo', 'Nuevo tipo | Admin AgriVall')

@push('styles')
    @vite('resources/sass/admin.scss')
@endpush

@section('contenido')
    <section class="admin-page py-5">
        <div class="container mt-5">
            <div class="card border-0 shadow-sm admin-card">
                <div class="card-body p-4">
                    <h1 class="h3 fw-bold mb-4">Nuevo tipo de post</h1>
                    <form action="{{ route('admin.tipo-posts.store') }}" method="POST">
                        @csrf
                        <label class="form-label fw-semibold" for="tipo">Tipo</label>
                        <input class="form-control mb-4" id="tipo" name="tipo" value="{{ old('tipo') }}" required>
                        <button class="btn btn-success" type="submit">Crear</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
