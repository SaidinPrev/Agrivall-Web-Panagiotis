<section class="container-fluid px-0" id="hero">
    <div id="carouselCrossfade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselCrossfade" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselCrossfade" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselCrossfade" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ 'imgs/cherryFlowers.jpg' }}" class="d-block w-100" alt="Cherry flowers">
                <div class="hero-description flores">
                    <h1>El sabor auténtico de nuestra tierra</h1>
                    <div class="hero-bottom">
                        <h6>Trabajamos la tierra con cuidado para ofrecer un producto cercano, honesto y lleno de sabor
                        </h6>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ 'imgs/mano.jpg' }}" class="d-block w-100" alt="Cherry flowers">
                <div class="hero-description mano">
                    <h1>Fruta ecológica</h1>
                    <div class="hero-bottom">
                        <h6>Cosechada con cariño y respeto</h6>
                        <a href="#productos" class="hero-btn hero-btn-primary">Ver productos</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ 'imgs/casilla.jpg' }}" class="d-block w-100" alt="Cherry flowers">
                <div class="hero-description casaRural">
                    <h1>Tu refugio entre cerezos</h1>
                    <div class="hero-bottom">
                        <h6>Una casa rural rodeada de naturaleza para desconectar con calma.</h6>
                        <a href="#casilla" class="hero-btn hero-btn-secondary">Reserva la casilla</a>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselCrossfade"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselCrossfade"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>
</section>
