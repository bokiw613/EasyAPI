<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $permission
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        $user = Auth::user();

        // Menggunakan metode dari Spatie Laravel Permission
        if (!$user->can($permission)) {
            return redirect()->route('dashboard')->withErrors('Anda tidak memiliki izin untuk mengakses halaman ini.');
        }        

        return $next($request);
    }
}
