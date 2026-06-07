@extends('plantilla')

@section('titulo', 'Reservar La Casilla | AgriVall')

@section('contenido')
    @php
        $calendarWeeks = $semanas
            ->map(function ($semana) {
                $weekStart = \Carbon\CarbonImmutable::now()
                    ->locale('es')
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
                    'label' => "{$monthLabel} - Semana {$semana->numero_semana} - {$dayRangeLabel}",
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
                <span>Reserva por semanas</span>
                <h1>Disponibilidad de La Casilla</h1>
                <p>Consulta las semanas disponibles y envíanos una solicitud de pre-reserva. Te responderemos para confirmar los detalles.</p>
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
                            <strong>También puedes escogerla en el calendario</strong>
                            <span>Haz clic en cualquier día de una semana disponible y se seleccionará completa, de lunes a domingo.</span>
                        </div>
                        <div id="casilla-calendar" data-casilla-calendar data-weeks='@json($calendarWeeks)'></div>
                    </div>

                    <form class="booking-form" action="{{ route('casilla.store') }}" method="POST">
                        @csrf
                        <h2>Solicitar pre-reserva</h2>
                        <label>
                            Semana
                            <select name="semana_casilla_id" data-casilla-week-select required>
                                @forelse ($availableWeeks as $week)
                                    <option value="{{ $week['id'] }}" data-week-start="{{ $week['mondayDate'] }}"
                                        data-week-end="{{ $week['sundayDate'] }}" data-week-price="{{ $week['precio'] }}"
                                        @selected((string) $selectedWeekId === (string) $week['id'])>
                                        {{ $week['label'] }}
                                    </option>
                                @empty
                                    <option value="" disabled selected>No hay semanas disponibles en este momento</option>
                                @endforelse
                            </select>
                        </label>
                        <div class="booking-price" data-casilla-week-price>
                            <span>Precio de la semana</span>
                            <strong>
                                @if ($selectedWeekId)
                                    {{ number_format((float) data_get($availableWeeks->firstWhere('id', (int) $selectedWeekId), 'precio', 0), 2) }} €
                                @else
                                    -
                                @endif
                            </strong>
                        </div>
                        <label>
                            Nombre
                            <input type="text" name="nombre" value="{{ old('nombre') }}" required>
                        </label>
                        <label>
                            Email
                            <input type="email" name="email" value="{{ old('email') }}" required>
                        </label>
                        <label>
                            Teléfono
                            <input type="tel" name="telefono" value="{{ old('telefono') }}">
                        </label>
                        <label>
                            Observaciones
                            <textarea name="observaciones">{{ old('observaciones') }}</textarea>
                        </label>
                        <button type="submit" @disabled(!$hasReservableWeeks)>Enviar solicitud</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    @include('partials.footer')
@endsection
