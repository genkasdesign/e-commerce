<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\HttpFoundation\Response;

class EnsureStorageLink
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifier si le lien symbolique public/storage existe
        if (!file_exists(public_path('storage'))) {
            // S'il n'existe pas, le recréer
            Artisan::call('storage:link');
        }

        return $next($request);
    }
}