<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LineaPedido extends Model
{
    protected $table = 'linea_pedido';

    protected $fillable = [
        'pedido_id',
        'producto_id',
        'cantidad',
        'formato',
        'precio_unitario'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
