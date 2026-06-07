<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostBlog extends Model
{
    protected $fillable = [
        'tipo_post_id',
        'fecha_public',
        'imagen',
        'noticia',
        'titulo',
    ];

    protected $casts = [
        'fecha_public' => 'date',
    ];

    public function tipoPost()
    {
        return $this->belongsTo(TipoPost::class);
    }
}
