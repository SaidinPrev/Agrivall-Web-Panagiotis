@extends('plantilla')

@section('titulo', 'Blog | AgriVall')

@section('contenido')
    <section id="blog-page" class="blog-page">
        <div class="section-shell">
            <div class="blog-page__intro">
                <span>Noticias</span>
                <h1>Bienvenidos a nuestro blog</h1>
                <p>Actualidad, cultivos, ecología y experiencias alrededor de la Vall de la Gallinera.</p>
            </div>

            <div class="blog-grid">
                @forelse ($posts as $post)
                    <article class="blog-card">
                        <div class="blog-card__meta">
                            <div class="blog-card__tag">{{ $post->tipoPost->tipo }}</div>
                            <div class="blog-card__date">{{ $post->fecha_public->format('d/m/Y') }}</div>
                        </div>
                        <div class="blog-card__media">
                            <img src="{{ asset($post->imagen ?? 'imgs/cherries.jpg') }}" alt="{{ $post->titulo }}">
                        </div>
                        <div class="blog-card__body">
                            <h2>{{ $post->titulo }}</h2>
                            <p>{{ \Illuminate\Support\Str::limit($post->noticia, 180) }}</p>
                            <a href="{{ route('blog.show', $post) }}" class="blog__link">Leer noticia</a>
                        </div>
                    </article>
                @empty
                    <p>No hay noticias publicadas todavía.</p>
                @endforelse
            </div>

            {{ $posts->links() }}
        </div>
    </section>
@endsection

@section('footer')
    @include('partials.footer')
@endsection
