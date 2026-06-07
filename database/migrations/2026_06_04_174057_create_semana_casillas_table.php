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
        Schema::create('semana_casillas', function (Blueprint $table) {
            $table->id();
            $table->enum('estado', ['DISPONIBLE', 'PRE-RESERVA', 'RESERVADO', 'NO DISPONIBLE'])->default('DISPONIBLE');
            $table->decimal('precio', 8, 2)->nullable();
            $table->string('descriptor');
            $table->unsignedTinyInteger('numero_semana');
            $table->unsignedSmallInteger('anio');
            $table->timestamps();

            $table->unique(['numero_semana', 'anio']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semana_casillas');
    }
};
