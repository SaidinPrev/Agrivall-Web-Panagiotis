@extends('plantilla')

@section('titulo', 'Tipos de post | Admin AgriVall')

@push('styles')
    @vite('resources/sass/admin.scss')
@endpush

@section('contenido')
    <section class="admin-page py-5">
        <div class="container mt-5">
            <div class="admin-hero card border-0 shadow-sm mb-4">
                <div class="card-body p-4 p-lg-5 d-flex flex-column flex-lg-row justify-content-between gap-3">
                    <div>
                        <p class="text-uppercase fw-bold text-success small mb-2">Blog</p>
                        <h1 class="display-5 fw-bold mb-2">Tipos de post</h1>
                        <p class="lead text-secondary mb-0">Gestiona las categorías de noticias.</p>
                    </div>
                    <a class="btn btn-success align-self-lg-center" href="{{ route('admin.tipo-posts.create') }}">Nuevo tipo</a>
                </div>
            </div>

            @if (session('status_success'))
                <div class="alert alert-success">{{ session('status_success') }}</div>
            @endif

            <div class="card border-0 shadow-sm admin-card">
                <div class="card-body p-0">
                    <table class="table table-hover align-middle mb-0 admin-table">
                        <thead class="table-light">
                            <tr>
                                <th>Tipo</th>
                                <th>Noticias</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tipos as $tipo)
                                <tr>
                                    <td class="fw-bold">{{ $tipo->tipo }}</td>
                                    <td>{{ $tipo->posts_count }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a class="btn btn-sm btn-success" href="{{ route('admin.tipo-posts.edit', $tipo) }}">Editar</a>
                                            <form action="{{ route('admin.tipo-posts.destroy', $tipo) }}" method="POST"
                                                onsubmit="return confirm('¿Eliminar este tipo?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger" type="submit">Eliminar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
