@extends('plantilla')

@section('titulo', 'Editar noticia | Admin AgriVall')

@push('styles')
    @vite('resources/sass/admin.scss')
@endpush

@section('contenido')
    <section class="admin-page py-5">
        <div class="container mt-5">
            <div class="card border-0 shadow-sm admin-card">
                <div class="card-body p-4">
                    <h1 class="h3 fw-bold mb-4">Editar noticia</h1>
                    <form action="{{ route('admin.posts-blog.update', $post) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.posts-blog.partials.form', ['post' => $post, 'tipos' => $tipos])
                        <button class="btn btn-success" type="submit">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
