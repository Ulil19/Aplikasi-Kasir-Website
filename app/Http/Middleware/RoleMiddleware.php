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
     * @param  Closure(Request): (Response)  $next
     * @param string $role
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Add your role-checking logic here
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Anda harus login dengan akun yang valid untuk mengakses halaman ini.');
        }

        if (Auth::user()->role !== $role) {
            abort(403, 'Akses Ditolak!. Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}
