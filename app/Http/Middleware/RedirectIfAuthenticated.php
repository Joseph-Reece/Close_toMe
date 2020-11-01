<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // if guard is client redirect to client dashboard, if guard is web or default redirect to Home
        switch ($guard) {
            case 'client':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('client.dashboard');

                }
                break;

            default:
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('home');
                    // return redirect(RouteServiceProvider::HOME);
                }
                break;
        }
        return $next($request);
    }
}
