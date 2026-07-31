<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Proses login
        $request->authenticate();

        // Regenerasi session
        $request->session()->regenerate();

        // Ambil data user yang login
        $user = Auth::user();

        // Redirect berdasarkan role
        if ($user->role === 'admin_utama') {
            return redirect()->route('admin.utama');
        }

        if ($user->role === 'admin_user') {
            return redirect()->route('admin.user');
        }

        if ($user->role === 'user') {
            return redirect()->route('user.dashboard');
        }

        // Jika role tidak dikenali
        Auth::logout();

        return redirect('/login')->with('error', 'Role tidak dikenali.');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
