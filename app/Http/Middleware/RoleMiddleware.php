<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle($request, Closure $next, ...$roles)
    {
        // Pastikan sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Ambil role user dari kolom "level"
        $userRole = Auth::user()->level;

        // Cek apakah role user ada dalam daftar role yg diizinkan
        if (!in_array($userRole, $roles)) {
            return abort(403, 'Anda tidak memiliki akses!');
        }

        return $next($request);
    }
}
