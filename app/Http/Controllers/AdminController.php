<?php

namespace App\Http\Controllers;

use App\User;
use App;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class AdminController extends Controller
{

    use LaratrustUserTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('role:superadministrator|doctor|receptionist');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now()->format('Y-m-d');
        $user = Auth::user();

        $doctors = User::whereRoleIs(['doctor'])->get();
        $receptionist = User::whereRoleIs(['receptionist'])->get();
        $admin = User::whereRoleIs(['superadministrator'])->get();
        $docDetails = User::find($user->id)->doctor;
        $Details = User::find($user->id);
        $users = User::all();
        $patient = App\patient::all();
        $doctor =  App\doctor::all();
        $appointments = App\appointment::all();
        $prescriptions = User::find($user->id)->prescriptions;
        if ($user->isA('receptionist|superadministrator')) {
            # code...
            return view('admin.index')
                ->with('users', $users)
                ->with('patients',$patient)
                ->with('Cdoctors',$doctors)
                ->with('receptionist', $receptionist)
                ->with('admin', $admin)
                ->with('doctors', $doctor)
                ->with('details', $Details);
        }

        if ($user->isA('doctor')) {

            $department = App\User::find($user->id)->doctor->department_id;

            $app = App\appointment::where([
                ['user_id', $user->id],
                ['status', 'Complete']

            ])->count();

            $nowApp = App\appointment::where([
                ['appointment_date', $now],
                ['status', 'Pending']

            ])->count();

            $noreply = App\Chat::where([
                ['Status', 'Pending'],
                ['department_id', $department]
            ])->count();

            $replied = App\Chat::where([
                ['Status', 'Replied'],
                ['department_id', $department]
            ])->count();

            return view('admin.index')
                ->with('patients', $patient)
                ->with('Cdoctors', $doctors)
                ->with('doctors', $doctor)
                ->with('appointments', $app)
                ->with('t_appointments', $nowApp)
                ->with('no_chat', $noreply)
                ->with('rep_chat', $replied)
                ->with('detail', $Details)
                ->with('prescriptions', $prescriptions)
                ->with('details', $docDetails);

                // return $replied;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
      

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if (Auth::user()->hasRole('superadministrator')) {


            User::destroy($id);

            return redirect()->back()->with('success', 'Deleted Successflly');
        }else {
            abort(403);
        }

    }
}
