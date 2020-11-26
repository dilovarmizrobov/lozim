<?php

namespace App\Http\Middleware;

use Closure;
use Gate;

class CustomerMiddleware
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
        if (Gate::denies('is_customer')) return redirect(route('guest.index'));

        return $next($request);
    }
}
