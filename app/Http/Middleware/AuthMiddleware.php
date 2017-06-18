<?php

namespace ZoondEngine\Http\Middleware;

use Closure;

class AuthMiddleware
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
        if(!$request->session()->has('email'))
        {
          return redirect('auth/login')->with([
            'msg' => 'Вы должны авторизоваться !',
            'style' => 'red'
          ]);
        }
        return $next($request);
    }
}
