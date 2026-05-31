<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $fillable = [
        'fecha_pedido',
        'nombre_cliente',
        'metodo_pago',
        'tlf_cliente',
        'email_cliente',
        'direccion_envio',
        'precio_pedido',
        'estado'
    ];

    public function lineas()
    {
        return $this->hasMany(LineaPedido::class, 'pedido_id');
    }
}
