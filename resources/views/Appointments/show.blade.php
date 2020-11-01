@extends('layouts.app')

@include('include.AdminNav')

@php
use Carbon\Carbon;

@endphp


@section('content')

<div class="container-fluid">

    <div class="card border-info">
        <div class="card-header bg-info">
            <h3> Appointment Details</h3>
            <div class="entry-meta">
                <span class="px-1"><i class="fa fa-user"></i> Name  {{$appointments->patient->fname}}  {{$appointments->patient->lname}} </span>
                <span class="px-1"><i class="fa fa-calendar-o"></i> Date {{Carbon::now()->format('d M, Y')}} </span>
            </div>
        </div>
        <div class="card-body">

            <div class="form-row">
                <div class="form-group col-md-4 col-sm-6 ">
                    <p class="card-title border-bottom">Reason</p>
                    <p class="card-text">
                        {{$appointments->reason}}
                    </p>

                </div>
            </div>
        </div>
    </div>
<br>
    <div class="card border-success">
        <div class="card-header bg-success">
            <h3>Diagnosis And Prescription</h3>
        </div>
        <div class="card-body">
            {!! Form::open(['action'=>'PrescriptionsController@store', 'method'=>'post', 'enctype'=>'multipart/form-data']) !!}
            {!! Form::hidden('patient_id', $appointments->patient_id) !!}
            {!! Form::hidden('appointment_id', $appointments->id) !!}


                <div class="form-group ">

                        {!! Form::label('diagnosis', 'Diagnosis') !!}
                        {!! Form::textarea('diagnosis', '' ,['class'=>'form-control']) !!}
                </div>

                <div class="form-group">

                        {!! Form::label('prescription', 'Prescription') !!}
                        {!! Form::textarea('prescription', '' ,['class'=>'form-control']) !!}
                </div>



            {!! Form::submit('Submit', ['class'=>' btn btn-success']) !!}
            {!! Form::close() !!}
        </div>
    </div>

</div>
@endsection
