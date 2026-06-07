<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoPostRequest;
use App\Models\TipoPost;

class TipoPostController extends Controller
{
    public function index()
    {
        $tipos = TipoPost::query()
            ->withCount('posts')
            ->orderBy('tipo')
            ->get();

        return view('admin.tipo-posts.index', [
            'tipos' => $tipos,
        ]);
    }

    public function create()
    {
        return view('admin.tipo-posts.create');
    }

    public function store(TipoPostRequest $request)
    {
        TipoPost::create($request->validated());

        return redirect()
            ->route('admin.tipo-posts.index')
            ->with('status_success', 'Tipo de post creado correctamente.');
    }

    public function edit(TipoPost $tipoPost)
    {
        return view('admin.tipo-posts.edit', [
            'tipoPost' => $tipoPost,
        ]);
    }

    public function update(TipoPostRequest $request, TipoPost $tipoPost)
    {
        $tipoPost->update($request->validated());

        return redirect()
            ->route('admin.tipo-posts.index')
            ->with('status_success', 'Tipo de post actualizado correctamente.');
    }

    public function destroy(TipoPost $tipoPost)
    {
        $tipoPost->delete();

        return redirect()
            ->route('admin.tipo-posts.index')
            ->with('status_success', 'Tipo de post eliminado correctamente.');
    }
}
