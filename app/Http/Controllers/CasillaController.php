<?php

namespace App\Http\Controllers;

use App\Http\Requests\CasillaReservaRequest;
use App\Mail\CasillaReservaAdminMail;
use App\Models\SemanaCasilla;
use Illuminate\Support\Facades\Mail;

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

        Mail::to(config('mail.admin.address'))->send(new CasillaReservaAdminMail($data, $semana));

        return redirect()
            ->route('casilla.index')
            ->with('casilla_success', __('site.status.week_request_sent'));
    }
}
