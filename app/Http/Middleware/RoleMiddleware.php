<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            abort(403, 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();

        // cek user punya role
        if (!$user->role) {
            abort(403, 'Anda belum memiliki role.');
        }

        // karena role berupa string
        if (!in_array($user->role, $roles)) {
            abort(403, 'Anda tidak memiliki hak akses.');
        }

        return $next($request);
    }
}
