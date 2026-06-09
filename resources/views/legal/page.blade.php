@extends('plantilla')

@php
    $content = trans("legal.pages.$page");
@endphp

@section('titulo', $metaTitle)

@section('contenido')
    <section class="legal-page">
        <div class="section-shell">
            <div class="legal-page__intro">
                <span>{{ __('legal.common.eyebrow') }}</span>
                <h1>{{ $content['title'] }}</h1>
                <p>{{ $content['lead'] }}</p>
                <p class="legal-page__updated">{{ __('legal.common.updated') }}</p>
            </div>

            <div class="legal-page__content">
                @foreach ($content['sections'] as $section)
                    <article class="legal-page__section">
                        <h2>{{ $section['heading'] }}</h2>

                        @foreach ($section['paragraphs'] as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach

                        @if (!empty($section['list']))
                            <ul>
                                @foreach ($section['list'] as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('footer')
    @include('partials.footer')
@endsection
