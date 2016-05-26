<?php

namespace App\Http\Middleware;

use Closure;

class isAdmin
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
        if (auth()->check() && $request->user()-> == 1) {
            return $next($request);
        }
        // Jika diakses oleh bukan admin redrect ke "/"
        return redirect()->guest('/');
    }
}
