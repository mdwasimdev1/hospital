<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */


     public function handle(Request $request, Closure $next, $role)
    {
        try {
            $token = $request->cookie('token'); // or $request->bearerToken()

            if (!$token) {
                abort(401, 'Unauthorized: token missing');
            }

            // Authenticate the token
            $user = JWTAuth::setToken($token)->toUser();

            if (!$user) {
                abort(401, 'Unauthorized: invalid token');
            }

            // Set the user on the JWT guard so auth()->user() works
            auth()->guard('api')->setUser($user);

        } catch (\Throwable $e) {
            abort(401, 'Unauthorized: session expired');
        }

        
        $user = auth()->guard('api')->user();


        if (!$user || $user->role !== $role) {
            abort(403, 'Unauthorized: insufficient role');
        }

        return $next($request);
    }
}
