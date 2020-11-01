<?php

namespace App\Http\Controllers;

use App\patient;
use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class PatientsController extends Controller
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

        $patient = patient::all();
        return view('patient.index')->with('patients', $patient);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Admin.register_patient');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // [A-Za-z].(?! |.* .{2,}).*[^]
        //firt validate fields
        $this->validate($request, [
            'patient_id' => 'required|int',
            'email' => 'required|email',
            'fname' => 'required|string',
            'lname' => 'required|string',
            'dob' => 'required',
            'address' => 'required',
            'contact' => 'required|int',
            'gender' => 'required',

        ]);

        $mail = $request->input('email');
        $id = $request->input('patient_id');

        $valid = patient::where('email', '=', $mail)
            ->orWhere('personal_id', '=', $id)
            ->doesntExist();

        $client =  $request->input('client_id');

        $client_name = App\Client::find($client);

        if ($valid) {

            //add the new record


            $post = new patient();
            $post->fname = $request->input('fname');
            $post->lname = $request->input('lname');
            $post->personal_id = $request->input('patient_id');
            $post->client_id = $request->input('client_id');
            $post->email = $request->input('email');
            $post->contact = $request->input('contact');
            $post->address = $request->input('address');
            $post->gender = $request->input('gender');
            $post->dob = $request->input('dob');
            $post->kin = $request->input('kin');

            $post->save();






            if ('auth:client') {
                # code...
                return redirect('/client')->with('success', 'Details Added succesfully ');
            }else {
                return redirect('/patient')->with('success', 'Patient Added succesfully ');
            }

        } else {

            // return redirect('/patient/create')->with('error', 'ID. is already taken ');
            return redirect()->back()->with('error', 'Email Or ID. is already taken ');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show($patient)
    {

        // Get prescriptions
        $appointment = patient::find($patient)->appointment->last();

        $nextOfKin = patient::find($patient)->kins;

        $patient = patient::find($patient);

        return view('patient.show')
            ->with('patient', $patient)
            ->with('kin', $nextOfKin)
            ->with('appointment', $appointment);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(patient $patient)
    {
        //
        $user = Auth::user();
        if ($user->isA('patient')) {
            # code...
            if ($user->owns($patient)) {
                # code...
                return view('Patient.edit')
                    ->with('patients', $patient);
            }else {
                abort(403);
            }
        }

        if ($user->isA('superadministrator|doctor|receptionist')) {
            # code...
            return view('Patient.edit')
                ->with('patients', $patient);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, patient $patient)
    {

        //first validate fields
        $this->validate($request, [
            'patient_id' => 'required|int',
            'email' => 'required|email',
            'fname' => 'required|string',
            'lname' => 'required|string',
            'dob' => 'required|before_or_equal:today',
            'address' => 'required',
            'contact' => 'required|int',
            'gender' => 'required',
        ]);

        $mail = $request->input('email');
        $id = $request->input('patient_id');

        $valid = patient::where('email', '=', $mail)
            ->orWhere('personal_id', '=', $id)
            ->doesntExist();



            //add the new record


            $post = $patient;
            $post->fname = $request->input('fname');
            $post->lname = $request->input('lname');
            $post->personal_id = $request->input('patient_id');
            $post->email = $request->input('email');
            $post->contact = $request->input('contact');
            $post->address = $request->input('address');
            $post->gender = $request->input('gender');
            $post->dob = $request->input('dob');
            // $post->kin = $request->input('kin');

            $post->save();



            return redirect('/client')->with('success', 'Information Updated succesfully ');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(patient $patient)
    {
        //

        $patient->delete();

        DB::table('kins')
            ->where('patient_id', '=', $patient)
            ->delete();



        return redirect('/patient')->with('success', 'Patient successfully deleted ');
    }
}
