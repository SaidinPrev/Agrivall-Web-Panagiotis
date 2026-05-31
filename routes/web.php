<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CartApiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Admin\PedidoController as AdminPedidoController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/comprar', [ShopController::class, 'index'])->name('shop.index');
Route::post('/cart', [CartApiController::class, 'store'])->name('cart.store');
Route::get('/checkout', [ShopController::class, 'checkout'])->name('checkout.index');
Route::post('/checkout', [ShopController::class, 'storeCheckout'])->name('checkout.store');
Route::post('/consulta-hierbas', [ShopController::class, 'storeHerbInquiry'])->name('herbs.inquiry.store');

//Admin

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/pedidos', [AdminPedidoController::class, 'index'])->name('pedidos.index');
    Route::get('/pedidos/{pedido}', [AdminPedidoController::class, 'show'])->name('pedidos.show');
    Route::patch('/pedidos/{pedido}/estado', [AdminPedidoController::class, 'updateEstado'])->name('pedidos.update-estado');
    Route::delete('/pedidos/{pedido}', [AdminPedidoController::class, 'destroy'])->name('pedidos.destroy');
});
