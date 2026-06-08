<header>
    @php
        $cartLineCount = count(session('cart', []));
    @endphp
    <nav class="site-nav" aria-label="Navegación principal">
        <div class="site-nav__inner">
            <a class="site-nav__brand" href="{{ route('home') }}">
                <img src="{{ asset('imgs/logo.png') }}" alt="Agrivall logo">
            </a>
            <button class="site-nav__toggle" type="button" aria-controls="site-nav-panel" aria-expanded="false"
                aria-label="Abrir menú">
                <i class="fa-solid fa-bars" aria-hidden="true"></i>
            </button>
            <div class="nav-overlay"></div>
            <div class="site-nav__panel" id="site-nav-panel">
                <ul class="site-nav__list">
                    <li class="site-nav__item">
                        <a class="site-nav__link" href="{{ route('home') }}">Inicio</a>
                    </li>
                    <li class="site-nav__item">
                        <a class="site-nav__link" href="{{ route('shop.index') }}">Productos</a>
                    </li>
                    <li class="site-nav__item">
                        <a class="site-nav__link" href="{{ route('casilla.index') }}">La Casilla</a>
                    </li>
                    <li class="site-nav__item">
                        <a class="site-nav__link" href="{{ route('blog.index') }}">Nuestro Blog</a>
                    </li>
                    <li class="site-nav__item">
                        <a class="site-nav__link" href="{{ route('home') }}#contacto">Contacto</a>
                    </li>
                    <li class="site-nav__item site-nav__item--cart">
                        <button class="site-nav__link site-nav__cart-toggle" type="button" aria-expanded="false"
                            aria-controls="site-nav-cart-menu" data-cart-toggle>
                            <i class="fa-solid fa-cart-shopping" aria-hidden="true"></i>
                            <span
                                class="site-nav__cart-count{{ $cartLineCount === 0 ? ' is-empty' : '' }}"
                                data-cart-count>{{ $cartLineCount }}</span>
                            <span class="visually-hidden">Abrir carrito</span>
                        </button>
                        <div class="site-nav__cart-dropdown" id="site-nav-cart-menu" data-cart-dropdown>
                            <div class="site-nav__cart-summary" data-cart-summary>
                                <p>Tu carrito está vacío.</p>
                            </div>
                            <a class="site-nav__cart-link" href="{{ route('shop.index') }}">Ver tu carrito</a>
                        </div>
                    </li>
                    <li class="site-nav__item site-nav__item--dropdown">
                        <button class="site-nav__link site-nav__dropdown-toggle" type="button" aria-expanded="false"
                            aria-controls="site-nav-language-menu">
                            <i class="bi bi-globe"></i>
                        </button>
                        <ul class="site-nav__dropdown" id="site-nav-language-menu">
                            <li><a class="site-nav__dropdown-link" href="#">Valencià</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
