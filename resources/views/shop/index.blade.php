@extends('plantilla')

@section('titulo', __('site.meta.shop_title'))

@section('contenido')
    <section id="shop-page" class="shop-page">
        <div class="section-shell">
            <div class="shop-page__intro">
                <span class="shop-page__kicker">{{ __('site.shop.kicker') }}</span>
                <h1>{{ __('site.shop.title') }}</h1>
                <p>{{ __('site.shop.description') }}</p>
            </div>

            <div class="shop-page__layout">
                <section class="shop-page__catalog" aria-label="{{ __('site.shop.catalog_aria') }}">
                    <div id="shop-products-root">
                        <p>{{ __('site.shop.loading_products') }}</p>
                    </div>
                </section>

                <aside class="shop-page__cart" aria-label="{{ __('site.shop.cart_aria') }}">
                    <div id="shop-options-root">
                        <p>{{ __('site.shop.loading_options') }}</p>
                    </div>

                    <div id="shop-cart-root">
                        <h2>{{ __('site.shop.cart_title') }}</h2>
                        <p>{{ __('site.shop.cart_empty') }}</p>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    @include('partials.footer')
@endsection
