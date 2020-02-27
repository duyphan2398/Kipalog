<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class CheckIsNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    /*Nếu là admin thì KHÔNG cho qua*/
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->user())
        {
            return redirect('/');
        }
        return $next($request);
    }
}
