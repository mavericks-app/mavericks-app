<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response=$next($request);

        $response->headers->set('Content-Security-Policy', "default-src *;script-src 'self' 'unsafe-eval' 'unsafe-inline' https://unpkg.com/  *.google.com;");
        $response->headers->set('Content-Security-Policy', "style-src 'self' *;");
        $response->headers->set('Content-Security-Policy', "default-src * data: 'unsafe-eval' 'unsafe-inline';");



        return $response;

    }
}
