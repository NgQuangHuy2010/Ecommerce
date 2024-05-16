<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockRoutes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('login') && $request->method() == 'GET') {
            return redirect('/');
        }
        if ($request->is('register') && $request->method() == 'GET') {
            return redirect('/');
        }
        return $next($request);
    }
}
