<?php

namespace App\Http\Middleware;

use App\StaticString;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isLogin = $request->session()->exists(StaticString::SESSION_ISLOGIN);
        if ($isLogin) {
            return $next($request);
        } else {
            return redirect()->route('index-login');
        }
    }
}
