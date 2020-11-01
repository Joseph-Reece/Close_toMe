<?php

namespace App\Http\Controllers\Auth;

use App\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class ClientRegisterController extends Controller
{
    // add guest:client so that only a logged out user can access
    public function __construct()
    {
        $this->middleware('guest:client');
    }

    public function showRegistrationForm()
    {
        return view('auth.client-register');
    }

    public function register(Request $request)
    {
        // Validate form data
        $this->validate(
            $request,
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:clients'],
                'password' => ['required', 'string', 'min:8', 'confirmed']
            ]
        );


        // Create client user
        try {
            $client = Client::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $client->attachRole('patient');
            // return $client;

            // Log the client in
            Auth::guard('client')->loginUsingId($client->id);
            return redirect()->route('client.dashboard');
        } catch (\Exception $e) {
            return redirect()->back()->withInput($request->only('name', 'email'));
        }
    }
}
