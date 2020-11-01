<?php

namespace App\Http\Controllers;

use App;
use App\receptionist;
use Illuminate\Http\Request;

class ReceptionistsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $receptionist = receptionist::all();
        return view('Admin.receptionist')->with('receptionists', $receptionist);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = App\User::whereDoesntHaveRole()->get();

        return view('Admin.add_receptionist')->with('users', $user);
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
            'receptionist_id' => 'required|string|unique:receptionists,receptionist_id',
            'user_id' => 'required',
            'address' => 'required|string',
            'contact' => 'required|string',
            'dob' => 'required|string',
            'gender' => 'required',
        ]);

        $receptionist = $request->input('user_id');
        $rec = App\User::find($receptionist);

        $post = new receptionist;

        $post->receptionist_id = $request->input('receptionist_id');
        $post->user_id = $request->input('user_id');
        $post->dob = $request->input('dob');
        $post->contact = $request->input('contact');
        $post->address = $request->input('address');
        $post->gender = $request->input('gender');

        $post->save();



        $rec->attachRole('receptionist');

        // redirect to Doctor Homepage
        return redirect('/admin')->with('success', 'Receptionist Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\receptionist  $receptionist
     * @return \Illuminate\Http\Response
     */
    public function show(receptionist $receptionist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\receptionist  $receptionist
     * @return \Illuminate\Http\Response
     */
    public function edit(receptionist $receptionist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\receptionist  $receptionist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, receptionist $receptionist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\receptionist  $receptionist
     * @return \Illuminate\Http\Response
     */
    public function destroy(receptionist $receptionist)
    {
        //
    }
}
