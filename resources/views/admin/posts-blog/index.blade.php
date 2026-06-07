@extends('plantilla')

@section('titulo', 'Noticias | Admin AgriVall')

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
                        <h1 class="display-5 fw-bold mb-2">Noticias</h1>
                        <p class="lead text-secondary mb-0">Crea y gestiona las noticias que aparecen en el blog público.</p>
                    </div>
                    <a class="btn btn-success align-self-lg-center" href="{{ route('admin.posts-blog.create') }}">Nueva noticia</a>
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
                                    <th>Título</th>
                                    <th>Tipo</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($posts as $post)
                                    <tr>
                                        <td class="fw-bold">{{ $post->titulo }}</td>
                                        <td><span class="badge rounded-pill text-bg-success px-3 py-2">{{ $post->tipoPost->tipo }}</span></td>
                                        <td>{{ $post->fecha_public->format('d/m/Y') }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a class="btn btn-sm btn-success" href="{{ route('admin.posts-blog.edit', $post) }}">Editar</a>
                                                <form action="{{ route('admin.posts-blog.destroy', $post) }}" method="POST"
                                                    onsubmit="return confirm('¿Eliminar esta noticia?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-danger" type="submit">Eliminar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center text-secondary py-4" colspan="4">Todavía no hay noticias.</td>
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
