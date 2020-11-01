@extends('layouts.app')

@include('include.AdminNav')

@section('content')
<div class="container ">
    <div class="card">
        <div class="card-header">
            <h3>Add an Appointment</h3>
        </div>
        <div class="card-body">
            {!! Form::open(['action'=>'AppointmentsController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}

            <div class="form-row">
                <div class="form-group col-md-4 col-sm-6 ">

                    {!! Form::label('patient_id', 'Patient_id', ['class'=>'form-label']) !!}
                    {!! Form::text('patient_id', '', ['class'=>'form-control']) !!}

                </div>
                <div class="form-group col-md-4 col-sm-6 ">
                    {!! Form::label('department', "Department", ['class'=>'form-label']) !!}
                        <select name="department" id="department" class="custom-select">
                            <option value="" class="" selected disabled> -- Select Department -- </option>

                            @foreach ($departments as $item)

                            <option value="{{$item->id}}" class=""> {{$item->name}} </option>

                            @endforeach
                        </select>

                </div>


            </div>
            <div class="form-row">
                    <div class="form-group col-md-4 col-sm-6 ">
                        {!! Form::label('date', 'Choose the Date', ['class'=>'form-label']) !!}
                        {!! Form::date('date', '', ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group col-md-4 col-sm-6 ">
                        {!! Form::label('time', 'Time', ['class'=>'form-label']) !!}
                         <select name="time" id="time" class="custom-select">
                            <option value="" class="" selected disabled> -- Select desired time -- </option>
                            <option value="8:00:00" class=""> 8:00 AM - 10:00 AM</option>
                            <option value="11:00:00" class="">   11:00 AM - 1:00 PM</option>
                            <option value="14:00:00" class=""> 2:00 PM - 4:00 PM</option>
                        </select>
                    </div>
            </div>
            <div class="form-group">
                {!! Form::label('reason', 'Reason/Symptoms', ['class'=>'form-label']) !!}
                {!! Form::textarea('reason', '', ['class'=>'form-control']) !!}
            </div>

            <div class="form-group col-md-4 col-sm-6  ">
                {!! Form::submit('Submit', ['class'=>'btn btn-outline-primary ']) !!}
            </div>



            {!! Form::close() !!}
        </div>

    </div>
</div>


@endsection
