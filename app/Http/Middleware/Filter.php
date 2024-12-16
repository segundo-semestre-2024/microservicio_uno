<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Filter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('X-API-Key');
        $expectedApiKey = env('API_KEY');
        if ($apiKey !== $expectedApiKey) {
            return response()->json([
                'message' => 'Acceso denegado. Clave API incorrecta.'
            ], 403);
        }
        return $next($request);
    }

}
