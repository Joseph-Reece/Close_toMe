<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;


class ClientController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:client');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function details()
    {
        return view('Client.client');
    }


    public function index()
    {
        //get the record from patients table

        $user = Auth::user()->id;

        $chat = App\Client::find($user)->chats;
        $details = App\client::find($user)->patient;
        $kin = App\client::find($user)->kin;
        $appointment = App\client::find($user)->appointment;
        $notifications = App\client::find($user)->unreadNotifications;

        $prescriptions = App\client::find($user)->prescriptions;

        $num =$notifications->count();


        if ($details) {
            return view('Client.dashboard')
                ->with('kin', $kin)
                ->with('appointment', $appointment)
                ->with('notification', $notifications)
                ->with('num', $num)
                ->with('prescriptions', $prescriptions)
                ->with('details', $details);
        }else {
            return view('Client.client');
        }





       
    }
}
