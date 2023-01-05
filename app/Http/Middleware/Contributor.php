<?php

namespace App\Http\Middleware;

use Closure;

class Contributor
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
        if(empty(session('contributor'))){
            return redirect()->route('login.form');
        }
        else{
            return $next($request);
        }
    }
}
