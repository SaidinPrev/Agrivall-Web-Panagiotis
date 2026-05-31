<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartStoreRequest;

class CartApiController extends Controller
{
    public function store(CartStoreRequest $request)
    {

        $data = $request->validated();

        session(['cart' => $data['items']]);

        return response()->json([
            'message' => 'Carrito guardado correctamente'
        ]);
    }
}
