<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        if (!Auth::check()) {
            abort(403, 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();

        // Pastikan user memiliki role
        if (!$user->role) {
            abort(403, 'Anda tidak memiliki role.');
        }

        // Cek apakah role user memiliki permission yang diminta
        if (!$user->role->permissions->contains('name', $permission)) {
            abort(403, 'Anda tidak memiliki hak akses.');
        }

        return $next($request);
    }
}
