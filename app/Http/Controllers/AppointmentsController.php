<?php

namespace App\Http\Controllers;

use App;
use App\appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Mail;
use App\Mail\RequestRecieved;

use App\Notifications\AppointmentBooked;
use Illuminate\Support\Facades\Notification;



class AppointmentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web,client');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $now = Carbon::now()->format('Y-m-d');
        $user = Auth::user();
        $id = $user->id;

        if ($user->isA('superadministrator|doctor|receptionist')) {
            # code...
            $department = App\User::find($id)->doctor->department_id;

            $pending_appointments = appointment::where([
                ['department_id', $department],
                ['status','Pending'],
                ['appointment_date', $now]
                ])->get();

            $missed_appointments = appointment::where([
                ['department_id', $department],
                ['status','Missed']
                ])->get();

            $complete_appointments = appointment::where([
                ['department_id', $department],
                ['user_id', $id],
                ['status','Complete'],
                ])->get();

            return view('Appointments.index')
                ->with('m_appointments', $missed_appointments)
                ->with('c_appointments', $complete_appointments)
                ->with('appointments', $pending_appointments);
        }

        if ($user->isA('patient')) {
            # code...
            $patient_id = App\patient::where('client_id', $id)->pluck("id");
            $pending_appointment = appointment::where([
                ['patient_id', $patient_id],
                ['status', 'Pending']

            ])->get();

            $missed_appointment = appointment::where([
                ['patient_id', $patient_id],
                ['status', 'Missed']

            ])->get();

            $complete_appointment = appointment::where([
                ['patient_id', $patient_id],
                ['status', 'Complete']

            ])->get();

            return view('Appointments.index')
                ->with('m_appointment', $missed_appointment)
                ->with('c_appointment', $complete_appointment)
                ->with('appointment', $pending_appointment);
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
        $patient = App\patient::all();
        $department = App\department::all();


        $user = Auth::user();

        if ($user->hasRole('patient')) {
            # code...
            return view('Client.add-appointment')
                ->with('patient', $patient)
                ->with('departments', $department);
        }


        if ($user->hasRole('superadministrator|doctor|receptionist')) {
            # code...
            return view('Admin.add_appointment')
                ->with('patient', $patient)
                ->with('departments', $department);
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
        //
        # code...
        $user = Auth::user();
        if ($user->hasRole('superadministrator|doctor|receptionist')) {
            # code...
            $this->validate($request, [
                'patient_id' => 'required',
                'department' => 'required',
                'date' => 'required|after_or_equal:today',
                'time' => 'required',
                'reason' => array(
                    'required',
                    'regex:/[a-zA-Z][^0-9]\s[a-zA-Z][^0-9]/u'
                ),
            ]);


            $patient = $request->input('patient_id');

            $exist = DB::table('patients')
                ->where('id', '=', $patient)
                ->exists();

            if ($exist) {
                # code...
                $post = new appointment;

                $post->patient_id = $request->input('patient_id');
                $post->department_id = $request->input('department');
                $post->appointment_date = $request->input('date');
                $post->appointment_time = $request->input('time');
                $post->status = 'Pending';
                $post->reason = $request->input('reason');

                $post->save();


                Mail::to($request->user())->send(new RequestRecieved($post));

                Notification::send($request->user(), new AppointmentBooked($post));

                return redirect('/admin')->with('success', 'Appointment booked successfully');
            } else {
                # code...
                return redirect()->back()->with('error', 'Patient does not exist');
            }
        }



        if ($user->hasRole('patient')) {
            # code...
            $this->validate($request, [
                'department' => 'required',
                'date' => 'required|after_or_equal:today',
                'time' => 'required',
                'reason' => array(
                    'required',
                    'regex:/[a-zA-Z][^0-9]\s[a-zA-Z][^0-9]/u'
                ),
            ]);


            $patient = App\client::find(Auth::user()->id)->patient;

            $email = App\client::find(Auth::user()->id)->patient;



            # code...
            $post = new appointment;

            $post->patient_id = $patient->id;
            $post->department_id = $request->input('department');
            $post->appointment_date = $request->input('date');
            $post->appointment_time = $request->input('time');
            $post->reason = $request->input('reason');

            $post->save();





            Mail::to($request->user())->send(new RequestRecieved($post));

            Notification::send($request->user(), new AppointmentBooked($post));




            return redirect('/client')->with('success', 'Appointment booked successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(appointment $appointment)
    {
        //
        // Get the patient involved

        $details = App\patient::find($appointment->patient_id);

        return view('Appointments.show')
            ->with('appointments', $appointment)
            ->with('patient', $details);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(appointment $appointment)
    {
        //
        $department = App\department::all();

        return view('Appointments.edit')
            ->with('departments', $department)
            ->with('appointments', $appointment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, appointment $appointment)
    {
        //
        # code...
        $user = Auth::user();
        if ($user->hasRole('superadministrator|doctor|receptionist')) {
            # code...
            $this->validate($request, [
                'department' => 'required',
                'date' => 'required|after_or_equal:today',
                'time' => 'required',
            ]);



            # code...
            $post = $appointment;

            $post->department_id = $request->input('department');
            $post->appointment_date = $request->input('date');
            $post->status = $request->input('status');
            $post->appointment_time = $request->input('time');


            $post->save();



            // Mail::to($request->user())->send(new RequestRecieved($post));

            Notification::send($request->user(), new AppointmentBooked($post));

            return redirect('/appointment')->with('success', 'Appointment saved successfully');
        }



        if ($user->hasRole('patient')) {
            # code...
            $this->validate($request, [
                'department' => 'required',
                'date' => 'required|after_or_equal:today',
                'time' => 'required',
                'reason' => array(
                    'required',
                    'regex:/[a-zA-Z][^0-9]\s[a-zA-Z][^0-9]/u'
                ),
            ]);


            $patient = App\client::find(Auth::user()->id)->patient;

            $email = App\client::find(Auth::user()->id)->patient;



            # code...
            $post = $appointment;

            $post->patient_id = $patient->id;
            $post->department_id = $request->input('department');
            $post->appointment_date = $request->input('date');
            $post->appointment_time = $request->input('time');
            $post->reason = $request->input('reason');

            $post->save();





            Mail::to($request->user())->send(new RequestRecieved($post));

            Notification::send($request->user(), new AppointmentBooked($post));


            return redirect('/client')->with('success', 'Appointment booked successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(appointment $appointment)
    {
        //
    }
}
