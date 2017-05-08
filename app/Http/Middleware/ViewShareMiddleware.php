<?php

namespace App\Http\Middleware;

use Closure;

class ViewShareMiddleware
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
        view()->share('currentUser', auth()->user());

        return $next($request);
    }
}
