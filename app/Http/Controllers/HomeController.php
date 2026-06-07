<?php

namespace App\Http\Controllers;

use App\Models\PostBlog;

class HomeController extends Controller
{
    public function index()
    {
        $latestPosts = PostBlog::query()
            ->with('tipoPost')
            ->latest('fecha_public')
            ->take(3)
            ->get();

        return view('home', [
            'latestPosts' => $latestPosts,
        ]);
    }
}
