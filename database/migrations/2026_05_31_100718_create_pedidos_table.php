<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_pedido');
            $table->string('nombre_cliente');
            $table->string('metodo_pago');
            $table->string('tlf_cliente');
            $table->string('email_cliente');
            $table->string('direccion_envio');
            $table->decimal('precio_pedido', 8, 2);
            $table->enum('estado', ['INICIADO', 'EN PROCESO', 'REPARTO', 'FINALIZADO'])->default('INICIADO');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
