<?php

namespace App\Http\Controllers;

use App\prescription;
use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrescriptionsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web,client');
        // $this->middleware('role:superadministrator|administrator|user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $this->validate($request, [
            'diagnosis'=>'required',
            'prescription'=>'required'

        ]);

        $user = Auth::user()->id;
        $app_id = $request->input('appointment_id');
        $post = new prescription;


        $post->doctor_id = $user;
        $post->patient_id = $request->input('patient_id');
        $post->appointment_id = $app_id;
        $post->diagnosis = $request->input('diagnosis');
        $post->prescription = $request->input('prescription');

        $post->save();

        App\appointment::where('id', $app_id)->update(
            ['status'=>'Complete', 'user_id' => $user ],
        );

       return redirect()->route('appointment.index')->with('success', 'Appointment Session Complete');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function show(prescription $prescription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function edit(prescription $prescription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, prescription $prescription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function destroy(prescription $prescription)
    {
        //
    }
}
