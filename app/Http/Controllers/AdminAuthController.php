<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdminAuthController extends Controller
{
    public function create(Request $request): View|RedirectResponse
    {
        if ((bool) $request->session()->get('admin_authenticated', false)) {
            return redirect()->route('admin.pedidos.index');
        }

        return view('admin.auth.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $expectedUsername = config('admin.username');
        $expectedPasswordHash = config('admin.password_hash');

        $usernameIsValid = $credentials['username'] === $expectedUsername;
        $passwordIsValid = is_string($expectedPasswordHash)
            && Hash::check($credentials['password'], $expectedPasswordHash);

        if (!$usernameIsValid || !$passwordIsValid) {
            return back()
                ->withInput($request->except('password'))
                ->withErrors([
                    'username' => __('site.admin_auth.invalid_credentials'),
                ]);
        }

        $request->session()->put([
            'admin_authenticated' => true,
            'admin_username' => $expectedUsername,
        ]);
        $request->session()->regenerate();

        $request->session()->forget('url.intended');

        return redirect()->route('home');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->session()->forget([
            'admin_authenticated',
            'admin_username',
            'url.intended',
        ]);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('home')
            ->with('admin_auth_success', __('site.admin_auth.logout_success'));
    }
}
