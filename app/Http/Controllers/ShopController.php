<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Http\Requests\HerbInquiryRequest;
use App\Mail\HerbInquiryAdminMail;
use App\Models\LineaPedido;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewOrderAdminMail;
use Throwable;

class ShopController extends Controller
{
    public function index()
    {
        return view('shop.index');
    }

    public function checkout()
    {
        $cartSummary = $this->cartSummary();

        if ($cartSummary['items']->isEmpty()) {
            return redirect()->route('shop.index');
        }

        return view('checkout.index', [
            'cartLines' => $cartSummary['items'],
            'total' => $cartSummary['total'],
        ]);
    }

    public function storeCheckout(CheckoutRequest $request)
    {
        $cartSummary = $this->cartSummary();

        if ($cartSummary['items']->isEmpty()) {
            return redirect()->route('shop.index');
        }

        $data = $request->validated();
        $cartLines = $cartSummary['items'];
        $total = $cartSummary['total'];

        $pedido = DB::transaction(function () use ($data, $cartLines, $total) {
            $pedido = Pedido::create([
                'fecha_pedido' => now()->toDateString(),
                'nombre_cliente' => $data['nombre_cliente'],
                'metodo_pago' => $data['metodo_pago'],
                'tlf_cliente' => $data['tlf_cliente'],
                'email_cliente' => $data['email_cliente'],
                'direccion_envio' => $data['direccion_envio'],
                'precio_pedido' => $total,
                'estado' => 'INICIADO',
            ]);

            foreach ($cartLines as $line) {
                LineaPedido::create([
                    'pedido_id' => $pedido->id,
                    'producto_id' => $line['producto']->id,
                    'cantidad' => $line['cantidad'],
                    'formato' => $line['producto']->formato,
                    'precio_unitario' => $line['producto']->precio,
                ]);
            }
            return $pedido;
        });

        $pedido->load('lineas.producto');

        try {
            Mail::to(config('mail.admin.address'))->send(new NewOrderAdminMail($pedido));
        } catch (Throwable $exception) {
            Log::error('Failed to send new order admin email.', [
                'pedido_id' => $pedido->id,
                'message' => $exception->getMessage(),
            ]);
        }

        session()->forget('cart');

        return redirect()
            ->route('shop.index')
            ->with('order_success', __('site.status.order_registered'));
    }

    public function storeHerbInquiry(HerbInquiryRequest $request)
    {
        $data = $request->validated();

        try {
            Mail::to(config('mail.admin.address'))->send(new HerbInquiryAdminMail($data));
        } catch (Throwable $exception) {
            Log::error('Failed to send herb inquiry admin email.', [
                'email' => $data['email'],
                'message' => $exception->getMessage(),
            ]);

            return redirect()
                ->route('shop.index', ['producto' => 'hierbas'])
                ->with('inquiry_error', __('site.status.form_temporarily_unavailable'));
        }

        return redirect()
            ->route('shop.index', ['producto' => 'hierbas'])
            ->with('inquiry_success', __('site.status.herb_inquiry_sent'));
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

        // Keep only valid product lines in the persisted session cart.
        session([
            'cart' => $items->map(function (array $item) {
                return [
                    'producto_id' => $item['producto']->id,
                    'cantidad' => $item['cantidad'],
                ];
            })->all(),
        ]);

        return [
            'items' => $items,
            'total' => $items->sum('subtotal'),
        ];
    }
}
