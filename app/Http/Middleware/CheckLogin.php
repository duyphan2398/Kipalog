<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    /*Nếu đăng nhập rồi thì KHÔNG cho qua*/
    public function handle($request, Closure $next)
    {
        if (Auth::user()|| Auth::guard('admin')->user()) {
            return redirect()->back();
        }
        return $next($request);
    }
}
