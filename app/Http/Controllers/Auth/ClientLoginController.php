<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesClients;


class ClientLoginController extends Controller
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

    use AuthenticatesClients;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */



    protected $redirectTo = RouteServiceProvider::Client;



    // Add guest:Client so that only logged out users can access

    public function __construct()
    {
        $this->middleware('guest:client')->except('logout');
    }


    public function logout(Request $request)
    {
        Auth::guard('client')->logout();
        return redirect()->route('index');
    }
}
