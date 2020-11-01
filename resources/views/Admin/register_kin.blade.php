@extends('layouts.app')

@extends('include.AdminNav')


@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            {!! Form::open(['action'=>'KinsController@store', 'method'=>'POST',  'enctype'=> 'multipart/form-data']) !!}

               <div class="form-group col-md-4 col-sm-4">
                    {!! Form::label('patient', 'Patient ID', ['class'=>'form-label']) !!}
                    {!! Form::text('patient', '', ['class'=>'form-control']) !!}
                    <small class="text-muted">Patient whom the Kin belongs to</small>
                </div>
           
                
                <hr>
                <div class="form-row">

                    <div class="form-group col-md-7">
                        {!! Form::label('name', 'Kin Name', ['class'=>'form-label']) !!}
                        {!! Form::text('name', '', ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group col-md-4">
                        {!! Form::label('email', 'Email', ['class'=>'form-label']) !!}
                        {!! Form::text('email', '', ['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('contact', 'Contact', ['class'=>'form-label']) !!}
                    {!! Form::text('contact', '', ['class'=>'form-control']) !!}
                </div>

                {!! Form::submit('Submit', ['class'=>'btn btn-outline-success col-md-4']) !!}


            {!! Form::close() !!}

        </div>
    </div>
</div>

@endsection

