<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>@yield('titulo')</title>
    @php
        $frontendTranslations = [
            'shop' => [
                'format' => __('site.shop.format'),
                'available' => __('site.shop.available'),
                'unavailable' => __('site.shop.unavailable'),
                'cart_title' => __('site.shop.cart_title'),
                'cart_empty' => __('site.shop.cart_empty'),
                'remove' => __('site.shop.remove'),
                'total' => __('site.shop.total'),
                'checkout' => __('site.shop.checkout'),
                'cannot_load' => __('site.shop.cannot_load'),
                'herb_alt' => __('site.shop.herb_alt'),
                'herb_title' => __('site.shop.herb_title'),
                'herb_description' => __('site.shop.herb_description'),
                'name' => __('site.shop.name'),
                'email' => __('site.shop.email'),
                'phone' => __('site.shop.phone'),
                'message' => __('site.shop.message'),
                'send_inquiry' => __('site.shop.send_inquiry'),
                'herb_note_title' => __('site.shop.herb_note_title'),
                'herb_note_description' => __('site.shop.herb_note_description'),
                'configurator_title' => __('site.shop.configurator_title'),
                'product' => __('site.shop.product'),
                'variety' => __('site.shop.variety'),
                'quantity' => __('site.shop.quantity'),
                'add_to_cart' => __('site.shop.add_to_cart'),
                'feedback_invalid_quantity' => __('site.shop.feedback_invalid_quantity'),
                'feedback_no_stock' => __('site.shop.feedback_no_stock'),
                'feedback_added' => __('site.shop.feedback_added'),
                'product_names' => trans('site.products.product_names'),
            ],
        ];
    @endphp
    <script>
        window.Agrivall = {
            locale: @json(app()->getLocale()),
            translations: @json($frontendTranslations),
        };
    </script>
    @vite(['resources/sass/app.scss', 'resources/js/bootstrap.js'])
    @stack('styles')
</head>

<body>
    @include('partials.headerNav')
    <main>
        <a href="#" class="back-to-top">
            <i class="fa-solid fa-arrow-up"></i>
        </a>
        @yield('contenido')
    </main>

    <footer>
        @yield('footer')
    </footer>

    @if (session('order_success') || session('inquiry_success'))
        <div class="flash-modal" data-flash-modal>
            <div class="flash-modal__card">
                <h2>{{ session('order_success') ? __('site.flash.order_registered') : __('site.flash.inquiry_sent') }}</h2>
                <p>{{ session('order_success') ?? session('inquiry_success') }}</p>
                <button type="button" data-flash-close>{{ __('site.flash.close') }}</button>
            </div>
        </div>
    @endif

</body>

</html>
