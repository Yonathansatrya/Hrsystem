<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Cek apakah user login adalah admin
        if (Auth::check() && Auth::user()->isAdmin()) {
            return $next($request);
        }

        // Jika user bukan admin, redirect ke halaman yang sesuai
        return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
