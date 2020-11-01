@extends('layouts.app')

@include('include.AdminNav')
@php
use Carbon\Carbon;

@endphp

@section('content')
<div class="container-fluid">
    <div class="card border-info">
        <div class="card-header bg-info ">
            <p class="card-title"><i class="fa fa-user"></i> Name:  {{ $patient->fname}}  {{$patient->lname }} </p  >

            <div class="entry-meta">
                <span class="px-1"><i class="fa fa-calendar-o"></i> Registration Date: {{Carbon::parse( $patient->created_at)->format('D d M, Y H:i:s')}} </span>
            </div>
        </div>
        <div class="card-body">

            <div class="card-deck">
                <div class="card border-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title border-bottom text-success">Account Details</h5>
                        <p class="card-text">Personal I.D: {{ $patient->personal_id }} </p>
                        <p class="card-text">Email: {{ $patient->email }}  </p>
                        <p class="card-text">Address: {{ $patient->address }} </p>
                        <p class="card-text">Contact: {{$patient->contact}}  </p>
                        <p class="card-text">Gender: {{$patient->gender}}  </p>
                        <p class="card-text">Date Of Birth: {{Carbon::parse( $patient->dob)->format('D d M, Y')}}  </p>
                        <a href="{{route('patient.edit',$patient->id)}}" class="btn btn-outline-success">Edit details</a>
                    </div>
                </div>

                @if (count($kin)>0)
                    @foreach ($kin as $kin)
                    <div class="card border-success mb-3">
                        <div class="card-body">
                            <p class="card-title border-bottom text-success">Next of Kin</p>
                            <p class="card-text">I.D: {{ $kin->id }}  </p>
                            <p class="card-text">Name: {{ $kin->name }} </p>
                            <p class="card-text">Contact: {{ $kin->contact }}  </p>
                            <p class="card-text">Email: {{ $kin->email }}  </p>

                        </div>
                    </div>
                    @endforeach
                @endif

            </div>


        </div>
    </div>
<br>
    <div class="card border-secondary">
        <div class="card-header text-info">
            <p class="card-title">Recent Activity <span class="fa fa-bell-o"></span></p>
        </div>
        <div class="card-body">
            <div class="card-deck">
                {{--  Chats Card  --}}
                <div class="card border-success mb-3">
                    <div class="card-body">
                        <p class="card-title border-bottom text-success">Recent Chat</p>

                    </div>
                </div>

                {{--  Appointments Card  --}}
                <div class="card border-success mb-3">
                    <div class="card-body">
                        <p class="card-title border-bottom text-success">Latest Appointment</p>
                        <p class="card-text">Appointment I.D: {{$appointment->id}}</p>
                        <p class="card-text"><span class="fa fa-anchor"> Status:</span>  {{$appointment->status}}</p>
                        <p class="card-text"><span class="fa fa-calendar-o"> Date:</span> {{Carbon::parse( $appointment->appointment_date)->format('D d M, Y')}}</p>
                        <p class="card-text"><span class="fa fa-clock-o"> Time:</span> {{Carbon::parse( $appointment->appointment_time)->format('D d M, Y')}}</p>
                        <p class="card-text"><span class="fa fa-folder-o"> Department:</span> {{$appointment->department->name}}</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
<br>
    <a href="{{route('patient.index')}}" class="btn btn-sm btn-outline-primary"><i class="fa fa-chevron-left"></i> Go Back</a>

</div>



@endsection


