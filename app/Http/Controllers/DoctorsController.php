<?php

namespace App\Http\Controllers;

use App\doctor;
use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DoctorsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $doctor = doctor::all();
        $department = App\department::all();

        return view('Doctors.index')
            ->with('doctors', $doctor)
            ->with('departments', $department);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $department = App\department::all();
        $user = App\User::whereDoesntHaveRole()->get();

        return view('Doctors.add')
            ->with('user', $user)
            ->with('departments', $department);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //first Validate input
        $this->validate($request, [
            'doctor_id' => 'required|string|unique:doctors,doctor_id',
            'user_id' => 'required|string|unique:doctors,user_id',
            'fname' => 'required|string',
            'lname' => 'required|string',
            'address' => 'required|string',
            'contact' => 'required|string',
            'dob' => 'required|string',
            'gender' => 'required',
            'department' => 'required',
        ]);

        // validate user doesnt exist
        $doc = $request->input('user_id');
        $doctor = App\User::find($doc);

        $post = new doctor;

        $post->doctor_id = $request->input('doctor_id');
        $post->user_id = $request->input('user_id');
        $post->fname = $request->input('fname');
        $post->lname = $request->input('lname');
        $post->department_id = $request->input('department');
        $post->dob = $request->input('dob');
        $post->contact = $request->input('contact');
        $post->address = $request->input('address');
        $post->gender = $request->input('gender');

        $post->save();



        $doctor->attachRole('doctor');
        $doctor->detachRole('user');

        // redirect to Doctor Homepage
        return redirect('/doctor')->with('success', 'Doctor Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(doctor $doctor)
    {

        return view('Doctors.show')
            ->with('doctors', $doctor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(doctor $doctor)
    {
        //
        $user = Auth::user();
        if ($user->owns($doctor)) {
            # code...
            $department = ('App\department')::all();

            return view('Doctors.edit')
                ->with('doc', $doctor)
                ->with('departments', $department);
        } else {
            abort(403);
        }


        // return doctor::find($doctor);
        // return view('Doctors.edit');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, doctor $doctor)
    {

        // first Decrement Number of Doctors in departments Table
        $getDept = $doctor->department;

        App\department::where('id', '=', $getDept)->decrement('doctors');

        //first Validate input
        $this->validate($request, [
            'doctor_id' => 'required|string',
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|string',
            'contact' => 'required|string',
            'address' => 'required|string',
            'dob' => 'required|string',
            'gender' => 'required',
            'department' => 'required',
        ]);


        // Get the department name to save

        $id = $request->input('department');

        $dept_name = App\department::find($id);


        $post = $doctor;

        $post->doctor_id = $request->input('doctor_id');
        $post->fname = $request->input('fname');
        $post->lname = $request->input('lname');
        $post->department_id = $request->input('department');
        $post->dob = $request->input('dob');
        $post->contact = $request->input('contact');
        $post->address = $request->input('address');
        $post->gender = $request->input('gender');

        $post->save();

        // return view('Patient.edit');
        $dept = $request->input('department');

        return redirect('/doctor')->with('success', 'Details Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy($doctor)
    {
        //
        if (Auth::user()->hasRole('superadministrator')) {


            doctor::destroy($doctor);

            return redirect()->back()->with('success', 'Deleted Successflly');
        } else {
            abort(403);
        }
    }
}
