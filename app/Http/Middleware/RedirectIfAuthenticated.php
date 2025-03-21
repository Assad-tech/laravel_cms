<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        foreach ($guards as $guard) {
            if ($guard == "admin" && Auth::guard($guard)->check()) {
                return redirect()->route('admin.dashboard');
            }

            if ($guard == "web" && Auth::guard($guard)->check()) {
                return redirect()->route('user.home');
            }

            // dd(Auth::guard());

            // if (is_string($guard) && Auth::guard($guard)->check()) {
            //     return redirect('/');
            // }
        }

        // Pass the request to the next middleware or application
        return $next($request);
    }
}
