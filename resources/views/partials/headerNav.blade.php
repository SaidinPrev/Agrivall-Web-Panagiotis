<header>
    <nav class="site-nav" aria-label="Navegación principal">
        <div class="site-nav__inner">
            <a class="site-nav__brand" href="#">
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
                        <a class="site-nav__link" href="#">Inicio</a>
                    </li>
                    <li class="site-nav__item">
                        <a class="site-nav__link" href="#productos">Productos</a>
                    </li>
                    <li class="site-nav__item">
                        <a class="site-nav__link" href="#casilla">La Casilla</a>
                    </li>
                    <li class="site-nav__item">
                        <a class="site-nav__link" href="#blog">Nuestro Blog</a>
                    </li>
                    <li class="site-nav__item">
                        <a class="site-nav__link" href="#contacto">Contacto</a>
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
