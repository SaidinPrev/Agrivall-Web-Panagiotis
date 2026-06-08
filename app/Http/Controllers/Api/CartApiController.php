<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartStoreRequest;
use App\Models\Producto;
use Illuminate\Http\JsonResponse;

class CartApiController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json($this->cartSummary());
    }

    public function store(CartStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        session(['cart' => $data['items']]);

        return response()->json([
            'message' => 'Carrito guardado correctamente',
            ...$this->cartSummary(),
        ]);
    }

    private function cartSummary(): array
    {
        $cart = session('cart', []);
        $productIds = array_column($cart, 'producto_id');

        $products = Producto::query()
            ->whereIn('id', $productIds)
            ->get()
            ->keyBy('id');

        $items = collect($cart)
            ->map(function (array $item) use ($products) {
                $product = $products->get($item['producto_id']);

                if (!$product) {
                    return null;
                }

                $quantity = (int) $item['cantidad'];

                return [
                    'producto' => $product,
                    'cantidad' => $quantity,
                    'subtotal' => $product->precio * $quantity,
                ];
            })
            ->filter()
            ->values();

        return [
            'items' => $items,
            'line_count' => $items->count(),
            'total' => $items->sum('subtotal'),
        ];
    }
}
