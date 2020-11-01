@extends('layouts.client-app')

@include('include.Client-nav')

@section('content')
<div class="container">
    <div class="card col-md-8">
        <div class="card-body">
            {!! Form::open(['action'=>'KinsController@store', 'method'=>'POST',  'enctype'=> 'multipart/form-data', 'class'=>'was-validated']) !!}


                    <div class="form-group col-md-7">
                        {!! Form::label('name', 'Kin Name', ['class'=>'form-label']) !!}
                        {!! Form::text('name', '', ['class'=>'form-control ', 'required']) !!}
                    </div>

                    <div class="form-group col-md-4">
                        {!! Form::label('email', 'Email', ['class'=>'form-label']) !!}
                        {!! Form::text('email', '', ['class'=>'form-control', 'required']) !!}
                    </div>

                <div class="form-group col-md-4">
                    {!! Form::label('contact', 'Contact', ['class'=>'form-label']) !!}
                    {!! Form::text('contact', '', ['class'=>'form-control', 'required']) !!}
                </div>

                {!! Form::submit('Submit', ['class'=>'btn btn-outline-success col-md-4']) !!}


            {!! Form::close() !!}

        </div>
    </div>
</div>


@endsection
