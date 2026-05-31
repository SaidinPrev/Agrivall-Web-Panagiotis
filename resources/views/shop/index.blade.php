@extends('plantilla')

@section('titulo', 'Comprar | AgriVall')

@section('contenido')
    <section id="shop-page" class="shop-page">
        <div class="section-shell">
            <div class="shop-page__intro">
                <span class="shop-page__kicker">Compra directa</span>
                <h1>Elige tus productos</h1>
                <p>
                    Selecciona producto, variedad, formato y cantidad. Después podrás revisar tu carrito antes de confirmar el pedido.
                </p>
            </div>

            <div class="shop-page__layout">
                <section class="shop-page__catalog" aria-label="Selector de productos">
                    <div id="shop-products-root">
                        <p>Cargando productos...</p>
                    </div>
                </section>

                <aside class="shop-page__cart" aria-label="Carrito de compra">
                    <div id="shop-options-root">
                        <p>Cargando opciones...</p>
                    </div>

                    <div id="shop-cart-root">
                        <h2>Tu carrito</h2>
                        <p>Añade productos para empezar tu pedido.</p>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    @include('partials.footer')
@endsection
