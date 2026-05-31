@extends('plantilla')

@section('titulo', 'Finalizar pedido | AgriVall')

@section('contenido')
    <section id="checkout-page" class="checkout-page">
        <div class="section-shell">
            <div class="checkout-intro">
                <h1>Finalizar pedido</h1>
            </div>
            <div class="checkout-layout">
                <section class="checkout-form-card">
                    <h2>Datos del cliente</h2>
                    <form action="{{ route('checkout.store') }}" method="POST" class="checkout-form">
                        @csrf
                        <div class="row">
                            <div class="column">
                                <h3 class="title">Pago</h3>

                                <div class="payment-methods" aria-label="Métodos de pago">
                                    <label class="payment-method">
                                        <input type="radio" name="metodo_pago" value="bizum" checked>
                                        <span class="payment-method__content">
                                            <img src="{{ asset('imgs/Pago/bizum.png') }}" alt="Bizum"
                                                class="payment-method__image">
                                            <span>
                                                <strong>Bizum</strong>
                                                <small>Enviar a: 600 000 000</small>
                                            </span>
                                        </span>
                                    </label>

                                    <label class="payment-method">
                                        <input type="radio" name="metodo_pago" value="transferencia">
                                        <span class="payment-method__content">
                                            <img src="{{ asset('imgs/Pago/transferencia-bancaria.png') }}"
                                                alt="Transferencia bancaria" class="payment-method__image">
                                            <span>
                                                <strong>Transferencia bancaria</strong>
                                                <small>IBAN: ES00 0000 0000 0000 0000 0000</small>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="column">
                                <h3 class="title">Dirección de envío</h3>
                                <div class="input-box">
                                    <span>Nombre y Apellidos</span>
                                    <input type="text" name="nombre_cliente" placeholder="Fernando Pellicer Rocher">
                                </div>
                                <div class="input-box">
                                    <span>Email :</span>
                                    <input type="email" name="email_cliente" placeholder="ejemplo@ejemplo.com">
                                </div>
                                <div class="input-box">
                                    <span>Teléfono :</span>
                                    <input type="tel" name="tlf_cliente" placeholder="600 000 000">
                                </div>
                                <div class="input-box">
                                    <span>Dirección</span>
                                    <input type="text" name="direccion_envio" placeholder="Calle - Localidad">
                                </div>
                                <div class="input-box">
                                    <span>Población :</span>
                                    <input type="text" placeholder="Alicante">
                                </div>
                                <div class="flex">
                                    <div class="input-box">
                                        <span>Provincia :</span>
                                        <input type="text" placeholder="Valencia">
                                    </div>
                                    <div class="input-box">
                                        <span>CP :</span>
                                        <input type="number" placeholder="46720">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn">Confirmar pedido</button>
                    </form>
                </section>
                <aside class="checkout-summary-card">
                    <h2>Resumen del pedido</h2>
                    <ul class="checkout-summary__items">
                        @forelse ($cartLines as $line)
                            <li class="checkout-summary__item">
                                <div>
                                    <h3>{{ $line['producto']->nombre }} {{ $line['producto']->variedad }}</h3>
                                    <p>{{ $line['producto']->formato }} · Cantidad: {{ $line['cantidad'] }}</p>
                                </div>

                                <strong>{{ number_format($line['subtotal'], 2) }} €</strong>
                            </li>
                        @empty
                            <li>Su carrito está vacío</li>
                        @endforelse
                    </ul>

                    <p class="checkout-summary__total">
                        Total: {{ number_format($total, 2) }} €
                    </p>
                </aside>
            </div>
        </div>
    </section>
@endsection
@section('footer')
    @include('partials.footer')
@endsection
