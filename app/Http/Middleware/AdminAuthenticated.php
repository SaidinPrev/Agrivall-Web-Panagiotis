<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!(bool) $request->session()->get('admin_authenticated', false)) {
            $request->session()->put('url.intended', $request->fullUrl());

            return redirect()
                ->route('admin.login')
                ->with('admin_auth_error', __('site.admin_auth.login_required'));
        }

        return $next($request);
    }
}
