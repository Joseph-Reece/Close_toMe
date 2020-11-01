<?php

namespace App\Http\Controllers;

use App;
use App\department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DepartmentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $department = department::all();
        return view('Departments.index')->with('departments' , $department);
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
        //first validate fields
        $this->validate($request, [
            'name' => 'required|string',
        ]);


        $post = new department();

        $post->name = $request->input('name');
        $post->doctors = $request->input('doctors');
        $post->save();

        return redirect('/department')->with('success' , 'Department added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\department  $department
     * @return \Illuminate\Http\Response
     */
    public function show($department)
    {
        $departments = department::find($department);
        $chats = department::find($department)->chats;
        $appointments = department::find($department)->appointment;
        $doctors = department::find($department)->doctors->count();

        $total_chats = $chats->count();
        $pending_chats = $chats->where('status','Pending')->count();
        $Replied_chats = $chats->where('status','Replied')->count();

        $total_appointments = $appointments->count();
        $pending_appointments = $appointments->where('status','Pending')->count();
        $missed_appointments = $appointments->where('status','Missed')->count();
        $complete_appointments = $appointments->where('status','Complete')->count();

        return view('Departments.show')
                ->with('doctors', $doctors)
                ->with('department', $departments)
                ->with('t_appointments', $total_appointments)
                ->with('p_appointments', $pending_appointments)
                ->with('m_appointments', $missed_appointments)
                ->with('c_appointments', $complete_appointments)

                ->with('t_chats', $total_chats)
                ->with('p_chats', $pending_chats)
                ->with('r_chats', $Replied_chats);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(department $department)
    {
        //
        return view('Departments.edit')->with('department', $department);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, department $department)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(department $department)
    {
        //
    }


}
