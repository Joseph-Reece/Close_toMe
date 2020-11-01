@extends('layouts.app')

@include('include.AdminNav')

@section('content')
    {!! Form::open(['action'=>'DoctorsController@store', 'method'=>'post', 'enctype'=>'multipart/form-data']) !!}

        <div class="card">
            <div class="card-header">
                Doctor Registration
            </div>
            <div class="card-body">
                <div class="form-row">

                    <div class="form-group col-md-2">
                        {!! Form::label('user_id', "User ID", ['class'=>'form-label']) !!}
                        <select name="user_id" id="user_id" class="custom-select">
                            <option value="" class="" selected disabled> User </option>

                            @foreach ($user as $item)

                            <option value="{{$item->id}}" class=""> {{$item->name}} </option>

                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        {!! Form::label('doctor_id', "Doctor's National ID", ['class'=>'form-label']) !!}
                        {{--  {!! Form::text('doctor_id', '', ['class'=>'form-control']) !!}  --}}
                        {!! Form::number('doctor_id', '', ['class'=>'form-control']) !!}
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group col-md-5">
                        {!! Form::label('fname', "First Name", ['class'=>'form-label']) !!}
                        {!! Form::text('fname', '', ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group col-md-5">
                        {!! Form::label('lname', "Last Name", ['class'=>'form-label']) !!}
                        {!! Form::text('lname', '', ['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-5">
                        {!! Form::label('contact', "Contact", ['class'=>'form-label']) !!}
                        {!! Form::text('contact', '', ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group col-md-5">
                        {!! Form::label('address', "Address", ['class'=>'form-label']) !!}
                        {!! Form::text('address', '', ['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-5">
                        {!! Form::label('dob', "Date of Birth", ['class'=>'form-label']) !!}
                        {{ Form::date('dob', '', ['class'=>'form-control'])}}
                    </div>

                    <div class="form-group col-md-5">
                        {!! Form::label('gender', "Gender", ['class'=>'form-label']) !!}
                        <select name="gender" id="gender" class="custom-select">
                            <option value="" class="" selected disabled> Gender </option>
                            <option value="Male" class=""> Male </option>
                            <option value="Female" class=""> Female </option>
                        </select>
                    </div>
                </div>

                <hr>

                <div class="form-group col-md-4">
                    {!! Form::label('department', "Department", ['class'=>'form-label']) !!}
                        <select name="department" id="department" class="custom-select">
                            <option value="" class="" selected disabled> Department </option>

                            @foreach ($departments as $item)

                            <option value="{{$item->id}}" class=""> {{$item->name}} </option>

                            @endforeach
                        </select>
                </div>

                <div class="form-group col-md-4">
                    {!! Form::submit('Submit', ['class'=>'btn btn-outline-primary']) !!}
                </div>


            </div>
        </div>
    {!! Form::close() !!}
@endsection
