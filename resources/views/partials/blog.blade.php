<section id="blog" class="blog-section">
    <div class="section-shell">
        <div class="blog-head">
            <div class="blog-heading">
                <span class="blog-kicker">{{ __('site.blog_home.kicker') }}</span>
                <h2>{{ __('site.blog_home.title') }}</h2>
            </div>

            <a href="{{ route('blog.index') }}" class="blog__link">{{ __('site.blog_home.cta') }}</a>
        </div>

        <div class="blog-grid">
            @forelse ($latestPosts ?? collect() as $post)
                <article class="blog-card">
                    <div class="blog-card__meta">
                        <div class="blog-card__tag">{{ $post->tipoPost->tipo }}</div>
                        <div class="blog-card__date">{{ $post->fecha_public->format('d/m/Y') }}</div>
                    </div>

                    <div class="blog-card__media">
                        <img src="{{ asset($post->imagen ?? 'imgs/cherries.jpg') }}" alt="{{ $post->titulo }}">
                    </div>

                    <div class="blog-card__body">
                        <h3>{{ $post->titulo }}</h3>
                        <p>{{ \Illuminate\Support\Str::limit($post->noticia, 155) }}</p>
                        <a href="{{ route('blog.show', $post) }}" class="blog__link">{{ __('site.blog_home.read_more') }}</a>
                    </div>
                </article>
            @empty
                <p>{{ __('site.blog_home.empty') }}</p>
            @endforelse
        </div>
    </div>
</section>
