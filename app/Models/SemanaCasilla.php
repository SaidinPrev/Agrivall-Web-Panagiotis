<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SemanaCasilla extends Model
{
    protected $fillable = [
        'estado',
        'precio',
        'descriptor',
        'numero_semana',
        'anio',
    ];
}
