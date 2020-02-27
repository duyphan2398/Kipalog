<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    /*Nếu là admin thì cho qua*/
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->user())
        {
            return $next($request);
        }
        return  redirect('/');;
    }
}
