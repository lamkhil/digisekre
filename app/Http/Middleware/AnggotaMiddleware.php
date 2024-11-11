<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AnggotaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()?->is_admin === 'Supervisor') {
            return redirect()->route('filament.admin.pages.dashboard');
        }

        if (Auth::user()?->nik == null && $request->route()->getName() != 'filament.anggota.pages.register-data') {
            return redirect()->route('filament.anggota.pages.register-data');
        }
        return $next($request);
    }
}
