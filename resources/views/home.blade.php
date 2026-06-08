@extends('plantilla')
@section('titulo', __('site.meta.home_title'))
@section('contenido')

    @include('partials.hero')
    @include('partials.about')
    @include('partials.products')
    @include('partials.casilla')
    @include('partials.blog')
    @include('partials.contacto')
@endsection

@section('footer')
    @include('partials.footer')
@endsection
