<section id="productos" class="products-section">
    <div class="section-shell">
        <div class="products-intro">
            <span class="products-kicker">Nuestros productos</span>
            <h2>Sabores de temporada cultivados con cuidado</h2>
            <p>
                Cada producto nace del mismo compromiso: cercanía, respeto por la tierra y calidad en el momento justo
                de la cosecha.
            </p>
        </div>

        <div class="products-grid">
            <article class="product-card">
                <div class="product-card__media">
                    <img src="{{ asset('imgs/cherries.jpg') }}" alt="Cerezas ecológicas">
                    <div class="product-card__body">
                        <h3>Cerezas</h3>
                        <p>Fruta delicada y de temporada, recolectada con cuidado para conservar todo su sabor.</p>
                        <a href="{{ route('shop.index', ['producto' => 'Cereza']) }}" class="product-card__link">Comprar</a>
                    </div>
                </div>
            </article>

            <article class="product-card">
                <div class="product-card__media">
                    <img src="{{ asset('imgs/walnuts.jpg') }}" alt="Nueces ecológicas">
                    <div class="product-card__body">
                        <h3>Nueces</h3>
                        <p>Un fruto lleno de matices, cultivado con paciencia y respeto por el ritmo natural del campo.
                        </p>
                        <a href="{{ route('shop.index', ['producto' => 'Nuez']) }}" class="product-card__link">Comprar</a>
                    </div>
                </div>
            </article>

            <article class="product-card">
                <div class="product-card__media">
                    <img src="{{ asset('imgs/apricots.jpg') }}" alt="Albaricoques ecológicos">
                    <div class="product-card__body">
                        <h3>Albaricoques</h3>
                        <p>Dulces, aromáticos y llenos de luz, cosechados en su mejor momento de maduración.</p>
                        <a href="{{ route('shop.index', ['producto' => 'Albaricoque']) }}" class="product-card__link">Comprar</a>
                    </div>
                </div>
            </article>

            <article class="product-card">
                <div class="product-card__media">
                    <img src="{{ asset('imgs/herbVariety.jpg') }}" alt="Hierbas aromáticas">
                    <div class="product-card__body">
                        <h3>Hierbas comestibles</h3>
                        <p>Variedades frescas y llenas de carácter para quienes buscan sabor y proximidad en su cocina.
                        </p>
                        <a href="{{ route('shop.index', ['producto' => 'hierbas']) }}" class="product-card__link">Consultar</a>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>
