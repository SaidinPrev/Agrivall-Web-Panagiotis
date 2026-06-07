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
        Schema::create('post_blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_post_id')->constrained('tipo_posts')->cascadeOnDelete();
            $table->date('fecha_public');
            $table->string('imagen')->nullable();
            $table->text('noticia');
            $table->string('titulo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_blogs');
    }
};
