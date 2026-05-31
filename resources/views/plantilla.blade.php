<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stack('styles')
    <title>@yield('titulo')</title>
    @vite(['resources/sass/app.scss', 'resources/js/bootstrap.js'])
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
                <h2>{{ session('order_success') ? 'Pedido registrado' : 'Consulta enviada' }}</h2>
                <p>{{ session('order_success') ?? session('inquiry_success') }}</p>
                <button type="button" data-flash-close>Cerrar</button>
            </div>
        </div>
    @endif

</body>

</html>
