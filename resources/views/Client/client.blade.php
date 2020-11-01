@extends('layouts.client-app')

@include('include.Client-nav')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Personal Details Registration</div>

                    <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="container">


        {!! Form::open(['action'=>'PatientsController@store', 'method'=>'POST',  'enctype'=> 'multipart/form-data']) !!}

                {{-- Known Data --}}
                {!! Form::hidden('client_id', Auth::user()->id) !!}
                {!! Form::hidden('email', Auth::user()->email) !!}
                {!! Form::hidden('fname', Auth::user()->name) !!}



        {{-- ID & Email --}}
        <div class="form-row border-bottom py-1">

                <div class="form-group col-md-4">
                    {{ Form::label('ID ', 'Patient ID')}}
                    {{ Form::text('patient_id', '', ['class'=>'form-control', 'placeholder'=> 'Patient ID'])}}
                    <small class="text-muted">Enter National ID Number</small>
                </div>
                {{-- Names --}}
                 <div class="form-group disabled col-md-4">
                    {{ Form::label('fname ', 'First Name')}}
                    {{ Form::text('fname', Auth::user()->name, ['class'=>'form-control', 'placeholder'=> 'First Name', 'disabled'])}}
                </div>

                <div class="form-group col-md-4">
                    {{ Form::label('lname ', 'Last Name')}}
                    {{ Form::text('lname', '', ['class'=>'form-control', 'placeholder'=> 'Last Name'])}}
                </div>

            </div>
        {{-- Dob $ Address --}}
        <div class="form-row border-bottom py-1">

            <div class="form-group col-md-3">
                {{ Form::label('dob ', 'Date of Birth')}}
                {{ Form::date('dob', '', ['class'=>'form-control',  'placeholder'=> 'Date of Birth'])}}
                </div>

                <div class="form-group col-md-5">
                    {{ Form::label('address ', 'Home Address')}}
                    {{ Form::text('address', '', ['class'=>'form-control', 'placeholder'=> 'Address'])}}
                </div>

                <div class="form-group col-md-4">
                    {{ Form::label('email ', 'Email')}}
                    {{ Form::text('email', Auth::user()->email, ['class'=>'form-control', 'disabled'])}}
                </div>
            </div>
            {{-- Contact and Gender --}}
            <div class="form-row">

                <div class="form-group col-md-4">
                    {!! Form::label('contact', 'Contact', ) !!}
                    <div class="input-group mb-0">
                        <div class="input-group-prepend">
                            <span class="input-group-text">+254</span>
                        </div>
                        {!! Form::text('contact', '', ['class'=>'form-control', 'placeholder'=>'Contact']) !!}
                    </div>

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


                    </div>


                </div>
            </div>
         </div>
    </div>




@endsection
