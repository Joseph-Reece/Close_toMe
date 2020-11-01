@extends('layouts.app')

@role('superadministrator|doctor|receptionist')
@include('include.AdminNav')
@endrole

@role('patient')
@include('include.Client-nav')
@endrole

@section('content')
<div class="container">

    <h4>Edit Patient Information</h4>

    {!! Form::open(['action'=>['PatientsController@update', $patients->id], 'method'=>'POST',  'enctype'=> 'multipart/form-data']) !!}

{{-- ID & Email --}}
        <div class="form-row">

            <div class="form-group col-md-4">
                {{ Form::label('ID ', 'Patient ID')}}
                {{ Form::text('patient_id', $patients->personal_id, ['class'=>'form-control', 'placeholder'=> 'Patient ID'])}}
                <small class="text-muted">Enter National ID</small>
            </div>

            <div class="form-group col-md-4">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', $patients->email, ['class'=>'form-control', 'placeholder'=> 'Email']) !!}
            </div>
        </div>
{{-- Names --}}
        <div class="form-row">

            <div class="form-group col-md-4">
               {{ Form::label('fname ', 'First Name')}}
               {{ Form::text('fname', $patients->fname, ['class'=>'form-control', 'placeholder'=> 'First Name', 'pattern'=>'[A-Za-z](?! |.* .{2,}).*[^ ]'])}}
           </div>

            <div class="form-group col-md-4">
               {{ Form::label('lname ', 'Last Name')}}
               {{ Form::text('lname', $patients->lname, ['class'=>'form-control', 'placeholder'=> 'Last Name'])}}
           </div>
        </div>
{{-- Dob $ Address --}}
        <div class="form-row">

            <div class="form-group col-md-3">
               {{ Form::label('dob ', 'Date of Birth')}}
               {{ Form::date('dob', $patients->dob, ['class'=>'form-control', 'placeholder'=> 'Date of Birth'])}}
           </div>

    <div class="form-group col-md-5">
               {{ Form::label('address ', 'Home Address')}}
               {{ Form::text('address', $patients->address, ['class'=>'form-control', 'placeholder'=> 'Address'])}}
           </div>
        </div>
{{-- Contact and Gender --}}
        <div class="form-row">

            <div class="form-group col-md-4">
                {!! Form::label('contact', 'Contact', ) !!}
                {!! Form::text('contact', $patients->contact, ['class'=>'form-control', 'placeholder'=>'Contact']) !!}

            </div>


            <div class="form-group col-md-4">
                {!! Form::label('gender', "Gender", ['class'=>'form-label']) !!}
                <select name="gender" id="gender" class="custom-select">
                    <option value="{{$patients->gender }}" selected disabled> --Select your Gender-- </option>
                    <option value="Male" class=""> Male </option>
                    <option value="Female" class=""> Female </option>
                </select>
            </div>

        </div>

        <div class="row">

            <div class="pull-left">
                {{ Form::hidden('_method', 'PUT')}}

                {!! Form::submit('Submit', ['class'=>'btn btn-outline-primary']) !!}
            </div>
            @role('superadministrator|doctor|receptionist')
            <div class="pull-right">
                <a href="{{route('patient.index')}}" class="btn btn-outline-danger">Cancel</a>
            </div>
            @endrole

            @role('patient')
            <div class="pull-right">
                <a href="{{route('client.dashboard')}}" class="btn btn-outline-danger">Cancel</a>
            </div>
            @endrole
        </div>

    {!! Form::close() !!}

</div>
@endsection
