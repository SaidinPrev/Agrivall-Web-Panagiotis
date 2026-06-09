<header>
    @php
        $cartLineCount = count(session('cart', []));
    @endphp
    <nav class="site-nav" aria-label="{{ __('site.nav.main_navigation') }}">
        <div class="site-nav__inner">
            <a class="site-nav__brand" href="{{ route('home') }}">
                <img src="{{ asset('imgs/logo.png') }}" alt="Agrivall logo">
            </a>
            <button class="site-nav__toggle" type="button" aria-controls="site-nav-panel" aria-expanded="false"
                aria-label="{{ __('site.nav.open_menu') }}">
                <i class="fa-solid fa-bars" aria-hidden="true"></i>
            </button>
            <div class="nav-overlay"></div>
            <div class="site-nav__panel" id="site-nav-panel">
                <ul class="site-nav__list">
                    <li class="site-nav__item">
                        <a class="site-nav__link" href="{{ route('home') }}">{{ __('site.nav.home') }}</a>
                    </li>
                    <li class="site-nav__item">
                        <a class="site-nav__link" href="{{ route('shop.index') }}">{{ __('site.nav.products') }}</a>
                    </li>
                    <li class="site-nav__item">
                        <a class="site-nav__link" href="{{ route('casilla.index') }}">{{ __('site.nav.casilla') }}</a>
                    </li>
                    <li class="site-nav__item">
                        <a class="site-nav__link" href="{{ route('blog.index') }}">{{ __('site.nav.blog') }}</a>
                    </li>
                    <li class="site-nav__item">
                        <a class="site-nav__link" href="{{ route('home') }}#contacto">{{ __('site.nav.contact') }}</a>
                    </li>
                    <li class="site-nav__item site-nav__item--cart">
                        <button class="site-nav__link site-nav__cart-toggle" type="button" aria-expanded="false"
                            aria-controls="site-nav-cart-menu" data-cart-toggle>
                            <i class="fa-solid fa-cart-shopping" aria-hidden="true"></i>
                            <span
                                class="site-nav__cart-count{{ $cartLineCount === 0 ? ' is-empty' : '' }}"
                                data-cart-count>{{ $cartLineCount }}</span>
                            <span class="visually-hidden">{{ __('site.nav.open_cart') }}</span>
                        </button>
                        <div class="site-nav__cart-dropdown" id="site-nav-cart-menu" data-cart-dropdown>
                            <div class="site-nav__cart-summary" data-cart-summary>
                                <p>{{ __('site.header_cart.empty') }}</p>
                            </div>
                            <a class="site-nav__cart-link" href="{{ route('shop.index') }}">{{ __('site.header_cart.view_cart') }}</a>
                        </div>
                    </li>
                    <li class="site-nav__item site-nav__item--dropdown">
                        <button class="site-nav__link site-nav__dropdown-toggle" type="button" aria-expanded="false"
                            aria-controls="site-nav-language-menu">
                            <i class="bi bi-globe"></i>
                        </button>
                        <ul class="site-nav__dropdown" id="site-nav-language-menu">
                            <li>
                                <a class="site-nav__dropdown-link"
                                    href="{{ route('locale.switch', ['locale' => 'es', 'redirect' => request()->fullUrl()]) }}"
                                    @if (app()->getLocale() === 'es') aria-current="true" @endif>
                                    {{ __('site.locale.spanish') }}
                                </a>
                            </li>
                            <li>
                                <a class="site-nav__dropdown-link"
                                    href="{{ route('locale.switch', ['locale' => 'ca', 'redirect' => request()->fullUrl()]) }}"
                                    @if (app()->getLocale() === 'ca') aria-current="true" @endif>
                                    {{ __('site.locale.valencian') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
