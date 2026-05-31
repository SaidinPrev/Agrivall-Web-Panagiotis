<?php

use App\Http\Controllers\Api\ProductoApiController;
use Illuminate\Support\Facades\Route;

Route::get('/productos', [ProductoApiController::class, 'index'])->name('api.productos.index');
