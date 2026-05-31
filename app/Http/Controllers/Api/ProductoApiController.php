<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;

class ProductoApiController extends Controller
{
    public function index()
    {
        $productos = Producto::query()
            ->where('compra_online', true)
            ->orderBy('nombre')
            ->orderBy('variedad')
            ->orderBy('formato')
            ->get();

        return response()->json($productos);
    }
}
