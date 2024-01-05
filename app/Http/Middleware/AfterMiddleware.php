<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AfterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        if (
            auth()->check()
            && $request->route()->getName() != 'logout'
        ) {
            $response->header('Authorization', 'Bearer '.auth()->user()->createToken('base_auth')->plainTextToken);
        }

        return $response;
    }
}
