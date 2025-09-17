<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Cookie;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $token = auth('api')->attempt($credentials);

        if (!$token) {
            return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }
        $user = JWTAuth::setToken($token)->toUser();

        if ($user->role !== 'admin') {
            return back()->withErrors(['email' => 'Access denied. Only admins can login.'])->withInput();
        }

        // Cookie for JWT
        $cookie = cookie(
            'token',        // cookie name
            $token,         // JWT token
            60,             // minutes
            '/',
            null,      // path, domain
            false,
            true,    // secure, httponly
            false,
            'lax'    // raw, sameSite
        );

        return redirect()->route('admin.dashboard')->withCookie($cookie);

        // // Redirect by role
        // $redirectTo = $user->role === 'admin'
        //     ? route('admin.dashboard')
        //     : route('user.dashboard');

        // // Use cookie() method with response object explicitly
        // return redirect($redirectTo)->withCookie($cookie);
    }

    public function logout(Request $request)
    {
        try {
            $token = $request->cookie('token');
            if ($token) {
                JWTAuth::setToken($token)->invalidate();
            }
        } catch (\Throwable $e) {
            // ignore
        }
        // Forget cookie
        $forget = Cookie::create('token', '', -1, '/', null, $request->isSecure(), true, false, 'lax');
        return redirect()->route('login')->withCookie($forget)->with('status', 'Logged out');
    }

    public function me(Request $request)
    {
        $token = $request->cookie('token');
        if (! $token) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }
        $user = JWTAuth::setToken($token)->authenticate();
        return response()->json($user);
    }

    public function refresh(Request $request)
    {
        $token = $request->cookie('token');
        if (! $token) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }
        $new = JWTAuth::setToken($token)->refresh();

        $minutes = config('jwt.ttl', 60);
        $cookie = cookie('token', $new, $minutes, '/', null, $request->isSecure(), true, false, 'lax');

        return back()->withCookie($cookie);
    }
}
