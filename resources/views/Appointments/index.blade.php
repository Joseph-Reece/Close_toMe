@extends('layouts.app')

@php
    use Carbon\carbon;
@endphp

@role('superadministrator|doctor|receptionist')
@include('include.AdminNav')

@section('content')
<div class="container">
    <div class="card border-info">
        <div class="card-header bg-info">
            <a href="/appointment/create" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus-square "></i> add appointment</a>
            <h4>Pending Appointments</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless table-striped table-hover" id="pending_table">
                    <thead class="thead-dark">
                            <th>#</th>
                            <th>Patient ID</th>
                            <th>Department ID</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Reason</th>
                            <th>Manage</th>
                            @role('doctor')
                            <th>Action</th>
                            @endrole
                    </thead>
                    <tbody>
                        @if (count($appointments) >0)
                            @foreach ($appointments as $appointments)
                            <tr>
                                <td>{{ $appointments->id }}</td>
                                <td>{{ $appointments->patient_id }}</td>
                                <td>{{ $appointments->department_id }}</td>
                                <td>{{ $appointments->status }}</td>
                                <td>{{ $appointments->appointment_date }}</td>
                                <td>{{ $appointments->appointment_time }}</td>
                                <td>{{ $appointments->reason }}</td>
                                <td><a href="/appointment/{{ $appointments->id }}/edit" class="btn btn-outline-info">Reschedule</a></td>
                                @role('doctor')
                                <td><a href="/appointment/{{ $appointments->id }}" class="btn btn-outline-primary">Start Session</a></td>
                                @endrole
                            </tr>

                            @endforeach
                            @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<br>

    <div class="card border-warning">
        <div class="card-header bg-warning">
            <h4>Missed Appointments</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless table-striped table-hover" id="myTable">
                    <thead class="text-white bg-dark">
                        <tr>
                            <td>#</td>
                            <td>Patient ID</td>
                            <td>Department ID</td>
                            <td>Status</td>
                            <td>Date</td>
                            <td>Time</td>
                            <td>Reason</td>
                            <td>Manage</td>
                            @role('doctor')
                            <td>Action</td>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($m_appointments) >0)
                            @foreach ($m_appointments as $appointments)
                            <tr>
                                <td>{{ $appointments->id }}</td>
                                <td>{{ $appointments->patient_id }}</td>
                                <td>{{ $appointments->department_id }}</td>
                                <td>{{ $appointments->status }}</td>
                                <td>{{ $appointments->appointment_date }}</td>
                                <td>{{ $appointments->appointment_time }}</td>
                                <td>{{ $appointments->reason }}</td>
                                <td><a href="/appointment/{{ $appointments->id }}/edit" class="btn btn-outline-info">Reschedule</a></td>
                                @role('doctor')
                                <td><a href="/appointment/{{ $appointments->id }}" class="btn btn-outline-primary">Start Session</a></td>
                                @endrole
                            </tr>

                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <br>

    <div class="card border-success">
        <div class="card-header bg-success">
            <h4>Complete Appointments</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless table-striped table-hover" id="complete_table">
                    <thead class="text-white bg-dark">
                        <tr>
                            <td>#</td>
                            <td>Patient ID</td>
                            <td>Status</td>
                            <td>Date</td>
                            <td>Time</td>
                            <td>Reason</td>

                        </tr>
                    </thead>
                    <tbody>
                        @if (count($c_appointments) >0)
                            @foreach ($c_appointments as $appointments)
                            <tr>
                                <td>{{ $appointments->id }}</td>
                                <td>{{ $appointments->patient_id }}</td>
                                <td>{{ $appointments->status }}</td>
                                <td>{{ $appointments->appointment_date }}</td>
                                <td>{{ $appointments->appointment_time }}</td>
                                <td>{{ $appointments->reason }}</td>

                            </tr>

                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
@endrole

@role('patient')
@include('include.Client-nav')

@section('content')
<div class="card border-info">
    <div class="card-header bg-info">
        <h4>Pending Appointments</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-borderless table-hover table-striped" id="pending_table">
            <thead class="thead-light">
                <th>#</th>
                <th>Appointment Date</th>
                <th>Appointment time</th>
                <th>Appointment Status</th>
                <th>Appointment reason</th>
                <th>Manage</th>

            </thead>
            <tbody>
                @if (count($appointment)>0)
                @foreach ($appointment as $item)
                <tr>

                    <td>{{$item->id}}</td>
                    <td>{{carbon::parse($item->appointment_date)->format('D d, M Y')}}</td>
                    <td>{{carbon::parse($item->appointment_time)->format('H:i:s T')}}</td>
                    <td>{{$item->status}}</td>
                    <td>{{$item->reason}}</td>
                    <td><a href="/appointment/{{ $item->id }}/edit" class="btn btn-outline-info">Reschedule</a></td>
                </tr>

                @endforeach

                @endif

            </tbody>
        </table>
    </div>

    </div>
</div>

<br>

<div class="card border-warning">
    <div class="card-header bg-warning">
        <h4>Missed Appointments</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-borderless table-hover table-striped" id="missed_table">
            <thead class="thead-light">
                <th>#</th>
                <th>Appointment Date</th>
                <th>Appointment time</th>
                <th>Appointment Reason</th>
                <th>Appointment Status</th>
            </thead>
            <tbody>
                @if (count($m_appointment)>0)
                @foreach ($m_appointment as $item)
                <tr>

                    <td>{{$item->id}}</td>
                    <td>{{carbon::parse($item->appointment_date)->format('D d, M Y')}}</td>
                    <td>{{carbon::parse($item->appointment_time)->format('H:i:s T')}}</td>
                    <td>{{$item->reason}}</td>
                    <td>{{$item->status}}</td>
                </tr>

                @endforeach

                @endif

            </tbody>
        </table>
    </div>

    </div>
</div>
<br>
<div class="card border-success">
    <div class="card-header bg-success">
        <h4> Honoured Appointments</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-borderless table-hover table-striped" id="complete_table">
            <thead class="thead-light">
                <th>#</th>
                <th>Appointment Date</th>
                <th>Appointment time</th>
                <th>Appointment Reason</th>
                <th>Appointment Status</th>
            </thead>
            <tbody>
                @if (count($c_appointment)>0)
                @foreach ($c_appointment as $item)
                <tr>

                    <td>{{$item->id}}</td>
                    <td>{{carbon::parse($item->appointment_date)->format('D d, M Y')}}</td>
                    <td>{{carbon::parse($item->appointment_time)->format('H:i:s T')}}</td>
                    <td>{{$item->reason}}</td>
                    <td>{{$item->status}}</td>
                </tr>

                @endforeach

                @endif

            </tbody>
        </table>
    </div>

    </div>
</div>

@endsection
@endrole
