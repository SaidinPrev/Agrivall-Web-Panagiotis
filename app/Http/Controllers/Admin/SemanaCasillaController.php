<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SemanaCasilla;
use Illuminate\Http\Request;

class SemanaCasillaController extends Controller
{
    public function index()
    {
        $semanas = SemanaCasilla::query()
            ->orderBy('anio')
            ->orderBy('numero_semana')
            ->get();

        return view('admin.semanas-casilla.index', [
            'semanas' => $semanas,
        ]);
    }

    public function edit(SemanaCasilla $semana)
    {
        return view('admin.semanas-casilla.edit', [
            'semana' => $semana,
        ]);
    }

    public function update(Request $request, SemanaCasilla $semana)
    {
        $data = $request->validate([
            'estado' => 'required|in:DISPONIBLE,PRE-RESERVA,RESERVADO,NO DISPONIBLE',
            'precio' => 'nullable|numeric|min:0',
        ]);

        $semana->update($data);

        return redirect()
            ->route('admin.semanas-casilla.index')
            ->with('status_success', 'Semana actualizada correctamente.');
    }
}
