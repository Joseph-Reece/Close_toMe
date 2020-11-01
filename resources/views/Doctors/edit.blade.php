@extends('layouts.app')

@include('include.AdminNav')

@section('content')
<div class="container">
    {!! Form::open(['action'=>['DoctorsController@update', $doc->id], 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
         <div class="card">
            <div class="card-header">
                Doctor Registration
            </div>
            <div class="card-body">
                <div class="form-row">

                    <div class="form-group col-md-4">
                        {!! Form::label('doctor_id', "Doctor' s ID", ['class'=>'form-label']) !!}
                        {!! Form::text('doctor_id', $doc->doctor_id, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group col-md-6">
                        {!! Form::label('email', "Email", ['class'=>'form-label']) !!}
                        {!! Form::text('email', $doc->email, ['class'=>'form-control']) !!}
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group col-md-5">
                        {!! Form::label('fname', "First Name", ['class'=>'form-label']) !!}
                        {!! Form::text('fname', $doc->fname, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group col-md-5">
                        {!! Form::label('lname', "Last Name", ['class'=>'form-label']) !!}
                        {!! Form::text('lname', $doc->lname, ['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-5">
                        {!! Form::label('contact', "Contact", ['class'=>'form-label']) !!}
                        {!! Form::text('contact', $doc->contact, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group col-md-5">
                        {!! Form::label('address', "Address", ['class'=>'form-label']) !!}
                        {!! Form::text('address', $doc->address, ['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-5">
                        {!! Form::label('dob', "Date of Birth", ['class'=>'form-label']) !!}
                        {{ Form::date('dob', $doc->dob, ['class'=>'form-control', 'min'=>'2020-01-01'])}}
                    </div>

                    <div class="form-group col-md-5">
                        {!! Form::label('gender', "Gender", ['class'=>'form-label']) !!}
                        <select name="gender" id="gender" class="custom-select">
                            <option value="" class="" selected disabled> --{{$doc->gender }}-- </option>
                            <option value="Male" class=""> Male </option>
                            <option value="Female" class=""> Female </option>
                        </select>
                    </div>
                </div>

                <hr>

                <div class="form-group col-md-4">
                    {!! Form::label('department', "Department", ['class'=>'form-label']) !!}
                        <select name="department" id="department" class="custom-select">
                            <option value="" class="" selected disabled> --{{ $doc->department->name }}--</option>

                            @foreach ($departments as $item)

                            <option value="{{$item->id}}" class=""> {{$item->name}} </option>

                            @endforeach
                        </select>
                </div>

                <div class="form-group col-md-4">
                    {{ Form::hidden('_method', 'PUT')}}
                    {!! Form::submit('Submit', ['class'=>'btn btn-outline-primary']) !!}
                </div>


            </div>
        </div>
    {!! Form::close() !!}
</div>
@endsection
