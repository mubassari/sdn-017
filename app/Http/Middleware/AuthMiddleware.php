<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next, $ability)
    {
        $auth_role = Auth::check() && Auth::user() ? Auth::user()->roles[0]->slug : null;
        $super_admin = Auth::check() && strcasecmp(Auth::user()->roles[0]->slug, 'super-admin') === 0;
    
        // Allow super-admin to access all pages
        if ($super_admin) {
            return $next($request);
        }

        $ability = explode('|', $ability);
    
        if (Auth::check() && !in_array($auth_role, $ability)) {
            return redirect()->intended(route('admin.index'))->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Anda tidak memiliki akses ke laman ini!'
            ]);
        }
    
        return $next($request);
    }    
}