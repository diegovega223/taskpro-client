<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        $accessToken = $request->session()->get('access_token');

        if (!$accessToken) {
            return route('login');
        }
        return route('project');
    }
}