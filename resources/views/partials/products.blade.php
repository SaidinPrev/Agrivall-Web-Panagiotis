<section id="productos" class="products-section">
    <div class="section-shell">
        <div class="products-intro">
            <span class="products-kicker">{{ __('site.products.kicker') }}</span>
            <h2>{{ __('site.products.title') }}</h2>
            <p>{{ __('site.products.body') }}</p>
        </div>

        <div class="products-grid">
            <article class="product-card">
                <div class="product-card__media">
                    <img src="{{ asset('imgs/cherries.jpg') }}" alt="{{ __('site.products.catalog.cherries.alt') }}">
                    <div class="product-card__body">
                        <h3>{{ __('site.products.catalog.cherries.title') }}</h3>
                        <p>{{ __('site.products.catalog.cherries.description') }}</p>
                        <a href="{{ route('shop.index', ['producto' => 'Cereza']) }}" class="product-card__link">{{ __('site.products.catalog.cherries.cta') }}</a>
                    </div>
                </div>
            </article>

            <article class="product-card">
                <div class="product-card__media">
                    <img src="{{ asset('imgs/walnuts.jpg') }}" alt="{{ __('site.products.catalog.walnuts.alt') }}">
                    <div class="product-card__body">
                        <h3>{{ __('site.products.catalog.walnuts.title') }}</h3>
                        <p>{{ __('site.products.catalog.walnuts.description') }}</p>
                        <a href="{{ route('shop.index', ['producto' => 'Nuez']) }}" class="product-card__link">{{ __('site.products.catalog.walnuts.cta') }}</a>
                    </div>
                </div>
            </article>

            <article class="product-card">
                <div class="product-card__media">
                    <img src="{{ asset('imgs/apricots.jpg') }}" alt="{{ __('site.products.catalog.apricots.alt') }}">
                    <div class="product-card__body">
                        <h3>{{ __('site.products.catalog.apricots.title') }}</h3>
                        <p>{{ __('site.products.catalog.apricots.description') }}</p>
                        <a href="{{ route('shop.index', ['producto' => 'Albaricoque']) }}" class="product-card__link">{{ __('site.products.catalog.apricots.cta') }}</a>
                    </div>
                </div>
            </article>

            <article class="product-card">
                <div class="product-card__media">
                    <img src="{{ asset('imgs/herbVariety.jpg') }}" alt="{{ __('site.products.catalog.herbs.alt') }}">
                    <div class="product-card__body">
                        <h3>{{ __('site.products.catalog.herbs.title') }}</h3>
                        <p>{{ __('site.products.catalog.herbs.description') }}</p>
                        <a href="{{ route('shop.index', ['producto' => 'hierbas']) }}" class="product-card__link">{{ __('site.products.catalog.herbs.cta') }}</a>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>
