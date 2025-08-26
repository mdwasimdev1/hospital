<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;


class JwtCookieAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $token = $request->cookie('token'); // must match login
            if (!$token) {
                return redirect()->route('login')
                    ->withErrors(['message' => 'Please log in']);
            }
            $user = JWTAuth::setToken($token)->toUser();

            if (!$user) {
                return redirect()->route('login')
                    ->withErrors(['message' => 'Session expired, please log in']);
            }

            // Attach user to request
            auth()->guard('api')->setUser($user);
        } catch (\Throwable $e) {
            return redirect()->route('login')
                ->withErrors(['message' => 'Session expired, please log in']);
        }

        return $next($request);
    }
}
