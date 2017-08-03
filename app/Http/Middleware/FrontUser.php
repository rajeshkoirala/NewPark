<?php

namespace App\Http\Middleware;

use App\Libraries\SiteVisit;
use Auth;
use Closure;

class FrontUser
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

        if ( Auth::check() && (Auth::user()->user_type == 3) )
        {
            return $next($request);
        }

        return redirect('/');
    }
}
