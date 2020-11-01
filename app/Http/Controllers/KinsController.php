<?php

namespace App\Http\Controllers;

use App;
use App\kin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KinsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth:web,client');
        // $this->middleware('role:superadministrator');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kin = kin::all();
        return view('kin.index')->with('kin', $kin);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        // }
        $user = Auth::user();

        if ($user->isA('patient')) {

            return view('Client.addKin');
        }

        if ($user->hasRole('superadministrator|doctor|receptionist')) {
            # code...
            return view('Admin.register_kin');
        }

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();


        if ($user->isA('superadministrator|doctor|receptionist')) {

            //first validate fields
            $this->validate($request, [
                'email' => 'required|email',
                'name' => 'required|string',
                'contact' => 'required',
            ]);

            $patient = App\Client::find(Auth::user()->id)->patient;







            $post = new kin();
            $post->name = $request->input('name');
            $post->email = $request->input('email');
            $post->contact = $request->input('contact');
            $post->patient_id = $patient->id;


            $post->save();

            App\patient::where('id', $patient->id)->increment('kin');



            return redirect('/patient')->with('success', 'Next of Kin Added succesfully ');
        }

        if ($user->isA('patient')) {
            //first validate fields
            $this->validate($request, [
                'email' => 'required|email',
                'name' => 'required|string',
                'contact' => 'required',
            ]);

            $patient = App\Client::find($user->id)->patient;


            $post = new kin();
            $post->name = $request->input('name');
            $post->email = $request->input('email');
            $post->contact = $request->input('contact');
            $post->patient_id = $patient->id;


            $post->save();

            App\patient::where('id', $patient->id)->increment('kin');



            return redirect('/client')->with('success', 'Next of Kin Added succesfully ');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\kin  $kin
     * @return \Illuminate\Http\Response
     */
    public function show(kin $kin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\kin  $kin
     * @return \Illuminate\Http\Response
     */
    public function edit(kin $kin)
    {
        //
        $user = Auth::user();
        if ($user->owns($kin)) {
            # code...
            return view('Client.edit-kin')
                ->with('kin', $kin);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\kin  $kin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, kin $kin)
    {
        //
        $this->validate($request, [
            'email' => 'required|email',
            'name' => 'required|string',
            'contact' => 'required',
        ]);



        $post = $kin;
        $post->name = $request->input('name');
        $post->email = $request->input('email');
        $post->contact = $request->input('contact');

        $name = $request->input('name');


        $post->save();


        return redirect('/client')->with('success', " $name successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\kin  $kin
     * @return \Illuminate\Http\Response
     */


    public function destroy($kin)
    {
        //

        Kin::destroy($kin);


        return redirect('/client')->with('success', 'Kin deleted successfully');
    }
}
