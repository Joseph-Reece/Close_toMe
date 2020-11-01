<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::Admin;
    protected function authenticated(Request $request, $user)
    {
        if ($user->hasRole('superadministrator')) {
            return redirect('/admin');
        }
        if ($user->hasRole('doctor')) {
            return redirect('/admin');
        }

        if ($user->hasRole('receptionist')) {
            return redirect('/admin');
        }

        if ($user->hasRole('patient')) {
            return redirect('/admin');
        }
        if ($user->whereDoesntHaveRole()) {
            return redirect('/home');
        }



    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout', 'userLogout');
    }

    public function userLogout(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
