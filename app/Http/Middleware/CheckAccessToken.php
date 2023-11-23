<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class CheckAccessToken
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('access_token')) {
            $cookies = $request->cookies;

            foreach ($cookies->keys() as $cookieName) {
                Cookie::queue(Cookie::forget($cookieName));
            }
            return redirect('login');
        }
        return $next($request);
    }
}
