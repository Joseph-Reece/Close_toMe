@extends('layouts.client-app')

@include('include.Client-nav')

@section('content')
     <div class="main">
          <div class="card">
        <div class="card-body">
            {!! Form::open(['action'=>['KinsController@update', $kin->id], 'method'=>'POST',  'enctype'=> 'multipart/form-data']) !!}

                <div class="form-row">

                    <div class="form-group col-md-7">
                        {!! Form::label('name', 'Kin Name', ['class'=>'form-label']) !!}
                        {!! Form::text('name', $kin->name, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group col-md-4">
                        {!! Form::label('email', 'Email', ['class'=>'form-label']) !!}
                        {!! Form::text('email', $kin->email, ['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('contact', 'Contact', ['class'=>'form-label']) !!}
                    {!! Form::text('contact', $kin->contact, ['class'=>'form-control']) !!}
                </div>

                <div class="col-md-3">
                    {{ Form::hidden('_method', 'PUT')}}

                    {!! Form::submit('Submit', ['class'=>'btn btn-outline-primary']) !!}
                </div>


            {!! Form::close() !!}

        </div>
    </div>
     </div>
@endsection
