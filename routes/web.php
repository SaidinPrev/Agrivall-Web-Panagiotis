<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CartApiController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CasillaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Admin\PedidoController as AdminPedidoController;
use App\Http\Controllers\Admin\PostBlogController as AdminPostBlogController;
use App\Http\Controllers\Admin\SemanaCasillaController as AdminSemanaCasillaController;
use App\Http\Controllers\Admin\TipoPostController as AdminTipoPostController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/comprar', [ShopController::class, 'index'])->name('shop.index');
Route::post('/cart', [CartApiController::class, 'store'])->name('cart.store');
Route::get('/checkout', [ShopController::class, 'checkout'])->name('checkout.index');
Route::post('/checkout', [ShopController::class, 'storeCheckout'])->name('checkout.store');
Route::post('/consulta-hierbas', [ShopController::class, 'storeHerbInquiry'])->name('herbs.inquiry.store');
Route::get('/reservar-casilla', [CasillaController::class, 'index'])->name('casilla.index');
Route::post('/reservar-casilla', [CasillaController::class, 'store'])->name('casilla.store');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post}', [BlogController::class, 'show'])->name('blog.show');

//Admin

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/pedidos', [AdminPedidoController::class, 'index'])->name('pedidos.index');
    Route::get('/pedidos/{pedido}', [AdminPedidoController::class, 'show'])->name('pedidos.show');
    Route::patch('/pedidos/{pedido}/estado', [AdminPedidoController::class, 'updateEstado'])->name('pedidos.update-estado');
    Route::delete('/pedidos/{pedido}', [AdminPedidoController::class, 'destroy'])->name('pedidos.destroy');
    Route::get('/semanas-casilla', [AdminSemanaCasillaController::class, 'index'])->name('semanas-casilla.index');
    Route::get('/semanas-casilla/{semana}/edit', [AdminSemanaCasillaController::class, 'edit'])->name('semanas-casilla.edit');
    Route::put('/semanas-casilla/{semana}', [AdminSemanaCasillaController::class, 'update'])->name('semanas-casilla.update');
    Route::resource('tipo-posts', AdminTipoPostController::class)->parameters(['tipo-posts' => 'tipoPost'])->except(['show']);
    Route::resource('posts-blog', AdminPostBlogController::class)->parameters(['posts-blog' => 'post'])->except(['show']);
});
