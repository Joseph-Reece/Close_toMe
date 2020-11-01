@extends('layouts.app')

@role('superadministrator|doctor|receptionist')
@include('include.AdminNav')
@endrole

@role('patient')
@include('include.Client-nav')
@endrole

@section('content')
<div class="container ">
    <div class="card border-info">
        <div class="card-header bg-info">
            <h3>Edit Appointment</h3>
        </div>
        <div class="card-body">
            {!! Form::open(['action'=>['AppointmentsController@update', $appointments->id], 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}


            <div class="form-row">
                @role('superadministrator|doctor|receptionist')
                <div class="form-group col-md-4 col-sm-6 ">

                     {!! Form::label('status', 'Status', ['class'=>'form-label']) !!}
                         <select name="status" id="status" class="custom-select">
                            <option value="{{$appointments->status}}" class="" selected disabled>{{$appointments->status}} </option>
                            <option value="Pending" class="">Pending</option>
                            <option value="Complete" class="">Complete</option>
                            <option value="Missed" class="">  Missed</option>
                        </select>

                </div>
                @endrole

                <div class="form-group col-md-4 col-sm-6 ">
                    {!! Form::label('department', "Department", ['class'=>'form-label']) !!}
                        <select name="department" id="department" class="custom-select">
                            <option value="{{ $appointments->department->id}}" class="" selected disabled> {{ $appointments->department->name}}</option>

                            @foreach ($departments as $item)

                            <option value="{{$item->id}}" class=""> {{$item->name}} </option>

                            @endforeach
                        </select>

                </div>

                @role('patient')
                <div class="form-group">
                    {!! Form::label('reason', 'Reason/Symptoms', ['class'=>'form-label']) !!}
                    {!! Form::textarea('reason', $appointments->reason, ['class'=>'form-control', 'required']) !!}
                </div>
                @endrole
            </div>

            <div class="form-row">
                    <div class="form-group col-md-4 col-sm-6 ">
                        {!! Form::label('date', 'Choose the Date', ['class'=>'form-label']) !!}
                        {!! Form::date('date', $appointments->appointment_date, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group col-md-4 col-sm-6 ">
                        {!! Form::label('time', 'Time', ['class'=>'form-label']) !!}
                         <select name="time" id="time" class="custom-select">
                            <option value="{{$appointments->appointment_time}}" class="" selected disabled>{{$appointments->appointment_time}} </option>
                            <option value="8:00:00" class=""> 8:00 AM - 10:00 AM</option>
                            <option value="11:00:00" class="">   11:00 AM - 1:00 PM</option>
                            <option value="14:00:00" class=""> 2:00 PM - 4:00 PM</option>
                        </select>
                    </div>
            </div>

            <div class="row container">

                    <div class="pull-left">
                        {!! Form::hidden('_method', 'PUT')!!}
                        {!! Form::submit('Submit', ['class'=>'btn btn-outline-primary']) !!}
                    </div>

                    <div class="pull-right">
                        <a href="{{route('appointment.index')}}" class="btn btn-outline-danger">Cancel</a>
                    </div>
                </div>



            {!! Form::close() !!}
        </div>

    </div>
</div>

@endsection
