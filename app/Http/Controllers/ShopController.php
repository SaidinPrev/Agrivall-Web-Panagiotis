<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Http\Requests\HerbInquiryRequest;
use App\Mail\HerbInquiryAdminMail;
use App\Models\LineaPedido;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewOrderAdminMail;

class ShopController extends Controller
{
    public function index()
    {
        return view('shop.index');
    }

    public function checkout()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('shop.index');
        }

        $productIds = array_column($cart, 'producto_id');
        $products = Producto::query()
            ->whereIn('id', $productIds)
            ->get()
            ->keyBy('id');

        $cartLines = collect($cart)->map(function ($item) use ($products) {
            $product = $products->get($item['producto_id']);
            $quantity = $item['cantidad'];

            return [
                'producto' => $product,
                'cantidad' => $quantity,
                'subtotal' => $product->precio * $quantity,
            ];
        });
        $total = $cartLines->sum('subtotal');

        return view('checkout.index', [
            'cartLines' => $cartLines,
            'total' => $total,
        ]);
    }

    public function storeCheckout(CheckoutRequest $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('shop.index');
        }

        $data = $request->validated();
        $productIds = array_column($cart, 'producto_id');
        $products = Producto::query()
            ->whereIn('id', $productIds)
            ->get()
            ->keyBy('id');

        $cartLines = collect($cart)->map(function ($item) use ($products) {
            $product = $products->get($item['producto_id']);
            $quantity = $item['cantidad'];

            return [
                'producto' => $product,
                'cantidad' => $quantity,
                'subtotal' => $product->precio * $quantity,
            ];
        });
        $total = $cartLines->sum('subtotal');

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
        Mail::to(config('mail.admin.address'))->send(new NewOrderAdminMail($pedido));

        session()->forget('cart');

        return redirect()
            ->route('shop.index')
            ->with('order_success', 'Tu pedido ha sido registrado correctamente.');
    }

    public function storeHerbInquiry(HerbInquiryRequest $request)
    {
        $data = $request->validated();

        Mail::to(config('mail.admin.address'))->send(new HerbInquiryAdminMail($data));

        return redirect()
            ->route('shop.index', ['producto' => 'hierbas'])
            ->with('inquiry_success', 'Tu consulta sobre hierbas comestibles ha sido enviada correctamente.');
    }
}
