<section id="casilla" class="casilla-section">
    <div class="casilla-media">
        <img src="{{ asset('imgs/casilla.png') }}" alt="{{ __('site.casilla_home.image_alt') }}">
    </div>

    <div class="casilla-overlay">
        <div class="casilla-content casilla-reveal">
            <h2>{{ __('site.casilla_home.title') }}</h2>
            <p>{{ __('site.casilla_home.body') }}</p>
            <a href="{{ route('casilla.index') }}" class="casilla__link">{{ __('site.casilla_home.cta') }}</a>
        </div>
    </div>
</section>
