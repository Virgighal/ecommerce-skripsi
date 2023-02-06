<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
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
        // return $next($request);
        if(!empty(auth()->user()) && auth()->user()->user_level == 'Admin') {
            return $next($request);
        }
   
        return redirect('/')->with('error', "You don't have admin access.");
    }
}