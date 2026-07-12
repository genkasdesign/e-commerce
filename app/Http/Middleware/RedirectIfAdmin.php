<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->isAdmin()) {
            return redirect()->route('admin.products.index')->with('error', 'Accès réservé aux clients.');
        }
        return $next($request);
    }
}