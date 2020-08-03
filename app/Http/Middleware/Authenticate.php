<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            $a = [
                'email' => 'test@test.com',
                'password' => 'test'
            ];
            dd(auth()->attempt($a));

            return route('login');
        }
    }
}
