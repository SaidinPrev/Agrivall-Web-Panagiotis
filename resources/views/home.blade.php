@extends('plantilla')
@section('titulo', 'AgriVall')
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
