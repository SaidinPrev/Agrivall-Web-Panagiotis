@extends('plantilla')

@section('titulo', __('site.meta.login_title'))

@section('contenido')
    <section class="admin-login-page">
        <div class="section-shell">
            <div class="admin-login-page__intro">
                <h1>{{ __('site.admin_auth.title') }}</h1>
                <p>{{ __('site.admin_auth.description') }}</p>
            </div>

            <div class="admin-login-card">
                @if (session('admin_auth_error'))
                    <p class="admin-login-alert">{{ session('admin_auth_error') }}</p>
                @endif

                @if ($errors->any())
                    <ul class="admin-login-errors">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form class="admin-login-form" action="{{ route('admin.login.store') }}" method="POST">
                    @csrf
                    <label>
                        {{ __('site.admin_auth.username') }}
                        <input type="text" name="username" value="{{ old('username') }}" required>
                    </label>

                    <label>
                        {{ __('site.admin_auth.password') }}
                        <input type="password" name="password" required>
                    </label>

                    <button type="submit">{{ __('site.nav.login') }}</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    @include('partials.footer')
@endsection
