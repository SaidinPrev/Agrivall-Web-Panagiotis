@extends('plantilla')

@section('titulo', __('site.meta.checkout_title'))

@section('contenido')
    <section id="checkout-page" class="checkout-page">
        <div class="section-shell">
            <div class="checkout-intro">
                <h1>{{ __('site.checkout.title') }}</h1>
            </div>
            <div class="checkout-layout">
                <section class="checkout-form-card">
                    <h2>{{ __('site.checkout.customer_data') }}</h2>
                    <form action="{{ route('checkout.store') }}" method="POST" class="checkout-form">
                        @csrf
                        <div class="checkout-form__row">
                            <div class="checkout-form__column">
                                <h3 class="checkout-form__title">{{ __('site.checkout.payment') }}</h3>

                                <div class="payment-methods" aria-label="{{ __('site.checkout.payment_methods') }}">
                                    <label class="payment-method">
                                        <input type="radio" name="metodo_pago" value="bizum" checked>
                                        <span class="payment-method__content">
                                            <img src="{{ asset('imgs/Pago/bizum.png') }}" alt="Bizum"
                                                class="payment-method__image">
                                            <span>
                                                <strong>Bizum</strong>
                                                <small>{{ __('site.checkout.bizum_send_to') }}</small>
                                            </span>
                                        </span>
                                    </label>

                                    <label class="payment-method">
                                        <input type="radio" name="metodo_pago" value="transferencia">
                                        <span class="payment-method__content">
                                            <img src="{{ asset('imgs/Pago/transferencia-bancaria.png') }}"
                                                alt="Transferencia bancaria" class="payment-method__image">
                                            <span>
                                                <strong>{{ __('site.checkout.bank_transfer') }}</strong>
                                                <small>{{ __('site.checkout.bank_iban') }}</small>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="checkout-form__column">
                                <h3 class="checkout-form__title">{{ __('site.checkout.shipping_address') }}</h3>
                                <div class="input-box">
                                    <span>{{ __('site.checkout.name') }}</span>
                                    <input type="text" name="nombre_cliente" placeholder="Fernando Pellicer Rocher">
                                </div>
                                <div class="input-box">
                                    <span>{{ __('site.checkout.email') }} :</span>
                                    <input type="email" name="email_cliente" placeholder="ejemplo@ejemplo.com">
                                </div>
                                <div class="input-box">
                                    <span>{{ __('site.checkout.phone') }} :</span>
                                    <input type="tel" name="tlf_cliente" placeholder="600 000 000">
                                </div>
                                <div class="input-box">
                                    <span>{{ __('site.checkout.address') }}</span>
                                    <input type="text" name="direccion_envio" placeholder="Calle - Localidad">
                                </div>
                                <div class="input-box">
                                    <span>{{ __('site.checkout.city') }} :</span>
                                    <input type="text" placeholder="Alicante">
                                </div>
                                <div class="checkout-form__split">
                                    <div class="input-box">
                                        <span>{{ __('site.checkout.province') }} :</span>
                                        <input type="text" placeholder="Valencia">
                                    </div>
                                    <div class="input-box">
                                        <span>{{ __('site.checkout.postal_code') }} :</span>
                                        <input type="number" placeholder="46720">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="checkout-form__submit">{{ __('site.checkout.confirm') }}</button>
                    </form>
                </section>
                <aside class="checkout-summary-card">
                    <h2>{{ __('site.checkout.summary') }}</h2>
                    <ul class="checkout-summary__items">
                        @forelse ($cartLines as $line)
                            <li class="checkout-summary__item">
                                <div>
                                    <h3>{{ $line['producto']->nombre }} {{ $line['producto']->variedad }}</h3>
                                    <p>{{ $line['producto']->formato }} · {{ __('site.checkout.quantity') }}: {{ $line['cantidad'] }}</p>
                                </div>

                                <strong>{{ number_format($line['subtotal'], 2) }} €</strong>
                            </li>
                        @empty
                            <li>{{ __('site.checkout.empty') }}</li>
                        @endforelse
                    </ul>

                    <p class="checkout-summary__total">
                        {{ __('site.checkout.total') }}: {{ number_format($total, 2) }} €
                    </p>
                </aside>
            </div>
        </div>
    </section>
@endsection
@section('footer')
    @include('partials.footer')
@endsection
