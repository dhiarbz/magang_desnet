<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $roles)
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Ambil user yang sudah login
        $user = Auth::guard('web')->user();
        // Cek apakah role sesuai (mendukung banyak role, misalnya 'admin|manager')
        $allowedRoles = explode('|', $roles);
        if (!in_array($user->role, $allowedRoles)) {
            abort(403, 'Unauthorized action');
        }

        return $next($request);
    }
}
