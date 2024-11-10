<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIpAddress
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $whitelistedIps = ['127.0.0.1', '192.168.1.1'];

        if (!in_array($request->ip(), $whitelistedIps)) {
            return response('Your IP is not allowed.', 403);
        }

        return $next($request);
    }
}
