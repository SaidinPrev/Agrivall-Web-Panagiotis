<?php

namespace App\Http\Controllers;

use App\Models\PostBlog;
use App\Models\TipoPost;

class BlogController extends Controller
{
    public function index()
    {
        $posts = PostBlog::query()
            ->with('tipoPost')
            ->latest('fecha_public')
            ->paginate(9);

        $tipos = TipoPost::query()->orderBy('tipo')->get();

        return view('blog.index', [
            'posts' => $posts,
            'tipos' => $tipos,
        ]);
    }

    public function show(PostBlog $post)
    {
        $post->load('tipoPost');

        return view('blog.show', [
            'post' => $post,
        ]);
    }
}
