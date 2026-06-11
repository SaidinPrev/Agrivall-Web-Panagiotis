<?php

namespace App\Http\Controllers;

use App\Http\Requests\CasillaReservaRequest;
use App\Mail\CasillaReservaAdminMail;
use App\Models\SemanaCasilla;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class CasillaController extends Controller
{
    public function index()
    {
        $semanas = SemanaCasilla::query()
            ->orderBy('anio')
            ->orderBy('numero_semana')
            ->get();

        return view('casilla.index', [
            'semanas' => $semanas,
        ]);
    }

    public function store(CasillaReservaRequest $request)
    {
        $data = $request->validated();
        $semana = SemanaCasilla::query()->findOrFail($data['semana_casilla_id']);

        if ($semana->estado !== 'DISPONIBLE') {
            return redirect()
                ->route('casilla.index')
                ->with('casilla_error', __('site.status.week_unavailable'));
        }

        $semana->update(['estado' => 'PRE-RESERVA']);

        try {
            Mail::to(config('mail.admin.address'))->send(new CasillaReservaAdminMail($data, $semana));
        } catch (Throwable $exception) {
            $semana->update(['estado' => 'DISPONIBLE']);

            Log::error('Failed to send casilla reservation admin email.', [
                'semana_casilla_id' => $semana->id,
                'email' => $data['email'],
                'message' => $exception->getMessage(),
            ]);

            return redirect()
                ->route('casilla.index')
                ->with('casilla_error', __('site.status.form_temporarily_unavailable'));
        }

        return redirect()
            ->route('casilla.index')
            ->with('casilla_success', __('site.status.week_request_sent'));
    }
}
