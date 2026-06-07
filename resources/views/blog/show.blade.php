@extends('plantilla')

@section('titulo', $post->titulo . ' | AgriVall')

@section('contenido')
    <article id="blog-post-page" class="blog-post-page">
        <div class="section-shell">
            <a href="{{ route('blog.index') }}" class="blog__link">Volver al blog</a>
            <div class="blog-post__hero">
                <span>{{ $post->tipoPost->tipo }} · {{ $post->fecha_public->format('d/m/Y') }}</span>
                <h1>{{ $post->titulo }}</h1>
                <img src="{{ asset($post->imagen ?? 'imgs/cherries.jpg') }}" alt="{{ $post->titulo }}">
            </div>
            <div class="blog-post__content">
                <p>{{ $post->noticia }}</p>
            </div>
        </div>
    </article>
@endsection

@section('footer')
    @include('partials.footer')
@endsection
