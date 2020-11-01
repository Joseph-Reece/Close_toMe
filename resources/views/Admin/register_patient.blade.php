@extends('layouts.app')

@include('include.AdminNav')

@section('content')
<div class="container-fluid">

    {!! Form::open(['action'=>'PatientsController@store', 'method'=>'POST',  'enctype'=> 'multipart/form-data']) !!}

{{-- ID & Email --}}
        <div class="form-row">

            <div class="form-group col-md-4">
                {{ Form::label('ID ', 'Patient ID')}}
                {{ Form::text('patient_id', '', ['class'=>'form-control', 'placeholder'=> 'Patient ID'])}}
                <small class="text-muted">Enter National ID</small>
            </div>

            <div class="form-group col-md-4">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', '', ['class'=>'form-control', 'placeholder'=> 'Email']) !!}
            </div>
        </div>
{{-- Names --}}
        <div class="form-row">

            <div class="form-group col-md-4">
               {{ Form::label('fname ', 'First Name')}}
               {{ Form::text('fname', '', ['class'=>'form-control', 'placeholder'=> 'First Name', 'pattern'=>'[A-Za-z](?! |.* .{2,}).*[^ ]'])}}
           </div>

            <div class="form-group col-md-4">
               {{ Form::label('lname ', 'Last Name')}}
               {{ Form::text('lname', '', ['class'=>'form-control', 'placeholder'=> 'Last Name'])}}
           </div>
        </div>
{{-- Dob $ Address --}}
        <div class="form-row">

            <div class="form-group col-md-3">
               {{ Form::label('dob ', 'Date of Birth')}}
               {{ Form::date('dob', '', ['class'=>'form-control', 'min'=>'2020-01-01', 'placeholder'=> 'Date of Birth'])}}
           </div>

            <div class="form-group col-md-5">
               {{ Form::label('address ', 'Home Address')}}
               {{ Form::text('address', '', ['class'=>'form-control', 'placeholder'=> 'Address'])}}
           </div>
        </div>
{{-- Contact and Gender --}}
        <div class="form-row">

            <div class="form-group col-md-4">
                {!! Form::label('contact', 'Contact', ) !!}
                {!! Form::text('contact', '', ['class'=>'form-control', 'placeholder'=>'Contact']) !!}

            </div>


            <div class="form-check-inline" id="gender">

                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="male" name="gender" value="Male" class="custom-control-input" required>
                    <label class="custom-control-label" for="male">Male</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="female" name="gender" value="Female" class="custom-control-input">
                    <label class="custom-control-label" for="female">Female</label>
                </div>
            </div>

        </div>
        {!! Form::hidden('kin', '0', ['form-control']) !!}

        <div class="col-md-3">

            {!! Form::submit('Submit', ['class'=>'btn btn-outline-primary']) !!}
        </div>



    {!! Form::close() !!}

</div> 

@endsection


