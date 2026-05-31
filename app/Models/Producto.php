<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'variedad',
        'formato',
        'precio',
        'imagen',
        'stock',
        'disponible',
        'compra_online',
    ];
}
