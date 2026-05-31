<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::query()
            ->latest()
            ->get();

        return view('admin.pedidos.index', [
            'pedidos' => $pedidos,
        ]);
    }

    public function show(Pedido $pedido)
    {
        $pedido->load('lineas.producto');

        return view('admin.pedidos.show', [
            'pedido' => $pedido,
        ]);
    }

    public function updateEstado(Request $request, Pedido $pedido)
    {
        $data = $request->validate([
            'estado' => 'required|in:INICIADO,EN PROCESO,REPARTO,FINALIZADO',
        ]);

        $pedido->update([
            'estado' => $data['estado'],
        ]);

        return redirect()
            ->route('admin.pedidos.show', $pedido)
            ->with('status_success', 'Estado del pedido actualizado correctamente.');
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();

        return redirect()
            ->route('admin.pedidos.index')
            ->with('status_success', 'Pedido eliminado correctamente.');
    }
}
