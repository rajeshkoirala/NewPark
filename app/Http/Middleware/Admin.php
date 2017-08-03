<?php

namespace App\Http\Middleware;

use App\Libraries\SiteVisit;
use Auth;
use Closure;

class Admin
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
        if ( Auth::check() && (Auth::user()->user_type == 1 || Auth::user()->user_type == 2) )
        {
            return $next($request);
        }

        return redirect('/');
    }
}
