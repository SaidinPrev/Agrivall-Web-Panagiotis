@extends('plantilla')

@section('titulo', __('site.meta.casilla_title'))

@section('contenido')
    @php
        $calendarWeeks = $semanas
            ->map(function ($semana) {
                $weekStart = \Carbon\CarbonImmutable::now()
                    ->locale(app()->getLocale())
                    ->setISODate($semana->anio, $semana->numero_semana)
                    ->startOfWeek();
                $weekEnd = $weekStart->endOfWeek();
                $monthLabel = ucfirst($weekStart->translatedFormat('F'));
                $dayRangeLabel = $weekStart->format('j') . '-' . $weekEnd->format('j');

                return [
                    'id' => $semana->id,
                    'estado' => trim((string) $semana->estado),
                    'precio' => $semana->precio,
                    'descriptor' => $semana->descriptor,
                    'numeroSemana' => $semana->numero_semana,
                    'anio' => $semana->anio,
                    'mondayDate' => $weekStart->toDateString(),
                    'sundayDate' => $weekEnd->toDateString(),
                    'label' => "{$monthLabel} - " . __('site.casilla_booking.week_label') . " {$semana->numero_semana} - {$dayRangeLabel}",
                ];
            })
            ->values();

        $availableWeeks = $calendarWeeks
            ->filter(fn(array $week) => mb_strtoupper(trim($week['estado'])) === 'DISPONIBLE')
            ->values();
        $selectedWeekId = old('semana_casilla_id', data_get($availableWeeks->first(), 'id'));
        $hasReservableWeeks = $availableWeeks->isNotEmpty();
    @endphp

    <section id="casilla-booking-page" class="casilla-booking-page">
        <div class="section-shell">
            <div class="booking-intro">
                <span>{{ __('site.casilla_booking.kicker') }}</span>
                <h1>{{ __('site.casilla_booking.title') }}</h1>
                <p>{{ __('site.casilla_booking.description') }}</p>
            </div>

            @if (session('casilla_success'))
                <div class="booking-alert is-success">{{ session('casilla_success') }}</div>
            @endif

            @if (session('casilla_error'))
                <div class="booking-alert is-error">{{ session('casilla_error') }}</div>
            @endif

            <div class="booking-layout">
                <div class="booking-request">
                    <div class="booking-calendar">
                        <div class="booking-calendar__header">
                            <strong>{{ __('site.casilla_booking.calendar_title') }}</strong>
                            <span>{{ __('site.casilla_booking.calendar_help') }}</span>
                        </div>
                        <div id="casilla-calendar" data-casilla-calendar data-weeks='@json($calendarWeeks)'></div>
                    </div>

                    <form class="booking-form" action="{{ route('casilla.store') }}" method="POST">
                        @csrf
                        <h2>{{ __('site.casilla_booking.request_title') }}</h2>
                        <label>
                            {{ __('site.casilla_booking.week') }}
                            <select name="semana_casilla_id" data-casilla-week-select required>
                                @forelse ($availableWeeks as $week)
                                    <option value="{{ $week['id'] }}" data-week-start="{{ $week['mondayDate'] }}"
                                        data-week-end="{{ $week['sundayDate'] }}" data-week-price="{{ $week['precio'] }}"
                                        @selected((string) $selectedWeekId === (string) $week['id'])>
                                        {{ $week['label'] }}
                                    </option>
                                @empty
                                    <option value="" disabled selected>{{ __('site.casilla_booking.no_weeks') }}</option>
                                @endforelse
                            </select>
                        </label>
                        <div class="booking-price" data-casilla-week-price>
                            <span>{{ __('site.casilla_booking.week_price') }}</span>
                            <strong>
                                @if ($selectedWeekId)
                                    {{ number_format((float) data_get($availableWeeks->firstWhere('id', (int) $selectedWeekId), 'precio', 0), 2) }} €
                                @else
                                    -
                                @endif
                            </strong>
                        </div>
                        <label>
                            {{ __('site.casilla_booking.name') }}
                            <input type="text" name="nombre" value="{{ old('nombre') }}" required>
                        </label>
                        <label>
                            {{ __('site.casilla_booking.email') }}
                            <input type="email" name="email" value="{{ old('email') }}" required>
                        </label>
                        <label>
                            {{ __('site.casilla_booking.phone') }}
                            <input type="tel" name="telefono" value="{{ old('telefono') }}">
                        </label>
                        <label>
                            {{ __('site.casilla_booking.notes') }}
                            <textarea name="observaciones">{{ old('observaciones') }}</textarea>
                        </label>
                        <button type="submit" @disabled(!$hasReservableWeeks)>{{ __('site.casilla_booking.send') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    @include('partials.footer')
@endsection
