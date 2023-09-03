<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckModeratorOrAdmin
{
    /**
     * Vérifie que l'utilisateur connecté est Administateur ou Modérateur  (role_id === 4 ou 3).
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role_id === 3 || auth()->user()->role_id === 4) {
            return $next($request);
        }
        return redirect()->route('index');
    }
}
