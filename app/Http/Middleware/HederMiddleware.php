<?php

namespace App\Http\Middleware;

use Closure;

class HederMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $headers = apache_request_headers();
        $request->headers->set('Authorization', $headers['Authorization']);
        return $next($request);
    }
}
