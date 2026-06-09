<div class="site-footer__inner section-shell">
    <div class="site-footer__top">
        <div class="site-footer__intro">
            <h2>{{ __('site.footer.title') }}</h2>
            <p class="site-footer__lead">{{ __('site.footer.lead') }}</p>
            <a href="{{ route('home') }}#contacto" class="site-footer__cta">
                {{ __('site.footer.cta') }}
                <span class="site-footer__cta-icon"><i class="fa-solid fa-arrow-right"></i></span>
            </a>
        </div>

        <div class="site-footer__nav">
            <div class="site-footer__column">
                <h3>AgriVall</h3>
                <a href="{{ route('home') }}#sobre-nosotros">{{ __('site.footer.about') }}</a>
                <a href="{{ route('home') }}#productos">{{ __('site.footer.products') }}</a>
                <a href="{{ route('home') }}#casilla">{{ __('site.footer.casilla') }}</a>
            </div>

            <div class="site-footer__column">
                <h3>{{ __('site.footer.explore') }}</h3>
                <a href="{{ route('home') }}#blog">{{ __('site.footer.blog') }}</a>
                <a href="{{ route('home') }}#contacto">{{ __('site.footer.contact') }}</a>
            </div>

            <div class="site-footer__column">
                <h3>{{ __('legal.links.heading') }}</h3>
                <a href="{{ route('legal.privacy') }}">{{ __('legal.links.privacy') }}</a>
                <a href="{{ route('legal.cookies') }}">{{ __('legal.links.cookies') }}</a>
                <a href="{{ route('legal.notice') }}">{{ __('legal.links.legal_notice') }}</a>
            </div>
        </div>
    </div>

    <div class="site-footer__bottom">
        <p>&copy; AgriVall 2026. {{ __('site.footer.rights') }}</p>

        <div class="site-footer__socials" aria-label="{{ __('site.footer.socials') }}">
            <a href="#" aria-label="Facebook">
                <i class="fa-brands fa-facebook-f"></i>
            </a>
            <a href="#" aria-label="Instagram">
                <i class="fa-brands fa-instagram"></i>
            </a>
        </div>
    </div>
</div>
