<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $roles)
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }

        $user = Auth::user();
        if($user->role !== $roles){
            abort(403,'unauthorized action');
        }
        return $next($request);
    }
}
