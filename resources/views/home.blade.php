@extends('plantilla')
@section('titulo', 'AgriVall')
@section('contenido')


    <section id="hero">
        <h1>El sabor auténtico de nuestra tierra</h1>
        <p>Agricultura ecológica, cosecha responsable y sabor auténtico desde el corazón de la Vall de la Gallinera.</p>
        <img src="{{ 'imgs/cerezos-vall-gallinera-1024x512.jpg' }}" alt="Arboles de cerezos"><br>
        <a class="actions" href="">Saber más</a>
    </section>

    <section id="intro">
        <article id="sobre-nosotros">
            <h2>Un poco sobre nosotros</h2>
            <p><strong>AgriVall</strong> es una empresa familiar dedicada al cultivo ecológico, desde 1994. Y por supuesto
                estamos
                certificados en el <strong>CAECV (ES-ECO-020-CV)</strong> desde 2006 con el número de operador <strong>CV
                    1568 PV</strong></p>
        </article>
        <article id="mision">
            <h3>La nuestra misión</h3>
            <p>Nuestro compromiso es ofrecer productos <strong>de calidad y de proximidad</strong> a nuestros clientes,
                siempre respetando y cuidando el medio ambiente. </p>
        </article>
        <article id="vision">
            <h3>La nuestra visión</h3>
            <p>Aspiramos ser referentes en la producción ecológica de cereza y el resto de nuestro producto y contribuir
                <strong>al desarollo económico y social</strong> de las zonas rurales en peligro de despoblación.
            </p>
        </article>
    </section>

    <section id="productos">
        <h2>Nuestros productos</h2>
        <article class="producto p1">
            <img src="imgs/cerezas.png" alt="Foto de cerezas">
            <a class="actions" href="">Ver producto</a>
        </article>
        <article class="producto p2">
            <img src="imgs/nueces.png" alt="Foto de nueces">
            <a class="actions" href="">Ver producto</a>
        </article>

        <article class="producto p3">
            <img src="imgs/albaricoques.jpg" alt="Foto de albaricoques">
            <a class="actions" href="">Ver producto</a>
        </article>
    </section>

    <section id="hierbas">
        <h2>¿Eres profesional de hosteleria?</h2>
        <p>Eleva tus platos con nuestras hierbas comestibles!</p>
        <img src="imgs/hierbas.png" alt="Foto del campo">
        <a href="" class="actions btn-hierbas">Ver catálogo</a>
    </section>

    <section id="casilla">
        <h2>Escápate y relájate en nuestra casilla rural rodeada de cerezos</h2>
        <p>
            Disfruta de unos días de descanso en un entorno natural único.
            Una casilla recién reformada, perfecta para desconectar y respirar tranquilidad.
        </p>
        <img src="imgs/fachada.jpg" alt="Foto de la fachada de la casilla">
        <a href="#contacto" class=" actions btn-casilla">Ver disponibilidad</a>
    </section>

    <section id="blog">
        <h2>Nuestro Blog</h2>
        <p>
            Si te apasiona la agricultura ecológica y quieres descubrir
            novedades, consejos y curiosidades del sector,
            este espacio es para ti.
        </p>
        <a href="/blog" class="actions btn-blog">Ver nuestro blog</a>
    </section>

@endsection

@section('footer')
    <div id="footer_top">
        <div id="footer_social">
            <a href=""><i class="fa-brands fa-facebook fa-2xl" style="color: #49673f;"></i></a>
            <a href=""><i class="fa-brands fa-instagram fa-2xl" style="color: #49673f;"></i></a>
        </div>
        <div id="footer_contacto">
            <a href="">Contácta con nosotros <i class="fa-solid fa-arrow-down fa-rotate-270"
                    style="color: #49673f;"></i></a>
        </div>
        <div id="footer_blog">
            <h4>No te pierdas nuestras novedades</h4>
            <a href="">Entra al nuestro blog <i class="fa-solid fa-arrow-down fa-rotate-270"
                    style="color: #49673f;"></i></a>
        </div>
    </div>
    <div id="footer_body">
        <a class="footer_logo" href="#"><img src="imgs/logo.png" alt="logo"></a>
        <ul>
            <li><a href="">Sobre nosotros</a></li>
            <li><a href="">Contacto</a></li>
            <li><a href="">Productos</a></li>
            <li><a href="">Reservas "Casilla"</a></li>
            <li><a href="">Blog</a></li>
        </ul>
    </div>
    <div id="footer_bottom">
        <p><strong>© AgriVall</strong></p>
        <a href="">Aviso Legal</a>
        <a href="">Política de Cookies</a>
        <a href="">Política de Privacidad</a>
        <img src="imgs/caecv.png" alt="caecv">
    </div>


    </div>
@endsection
