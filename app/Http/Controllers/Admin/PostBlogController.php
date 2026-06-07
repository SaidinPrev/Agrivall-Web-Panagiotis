<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostBlogRequest;
use App\Models\PostBlog;
use App\Models\TipoPost;

class PostBlogController extends Controller
{
    public function index()
    {
        $posts = PostBlog::query()
            ->with('tipoPost')
            ->latest('fecha_public')
            ->get();

        return view('admin.posts-blog.index', [
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        return view('admin.posts-blog.create', [
            'tipos' => TipoPost::query()->orderBy('tipo')->get(),
            'post' => new PostBlog(),
        ]);
    }

    public function store(PostBlogRequest $request)
    {
        PostBlog::create([
            ...$request->validated(),
            'fecha_public' => now()->toDateString(),
        ]);

        return redirect()
            ->route('admin.posts-blog.index')
            ->with('status_success', 'Noticia creada correctamente.');
    }

    public function edit(PostBlog $post)
    {
        return view('admin.posts-blog.edit', [
            'post' => $post,
            'tipos' => TipoPost::query()->orderBy('tipo')->get(),
        ]);
    }

    public function update(PostBlogRequest $request, PostBlog $post)
    {
        $post->update($request->validated());

        return redirect()
            ->route('admin.posts-blog.index')
            ->with('status_success', 'Noticia actualizada correctamente.');
    }

    public function destroy(PostBlog $post)
    {
        $post->delete();

        return redirect()
            ->route('admin.posts-blog.index')
            ->with('status_success', 'Noticia eliminada correctamente.');
    }
}
