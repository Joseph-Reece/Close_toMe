@extends('layouts.app')

@include('include.AdminNav')

@section('content')
<div class="container">

    {!! Form::open(['action'=>'PostsController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}

    <div class="form-group col-md-5">
        {!! Form::label('category', 'Category', ['class'=>'form-label']) !!}
        @php
            $list = [
                'General' => 'General',
                'Development' =>'Development',
                'Procurement' => 'Procurement',
                'Charity' => 'Charity',

            ];

        @endphp
        {!! Form::select('category', $list, 0, ['class'=>'custom-select']) !!}
    </div>


    {!! Form::label('title', 'Title', ['class'=>'form-label']) !!}
    {!! Form::text('title', '', ['class'=>'form-control']) !!}

    {!! Form::label('body', 'Body', ['class'=>'form-label']) !!}
    {!! Form::textarea('body', '', ['class'=>'form-control']) !!}
    <br>

    {!! Form::file('cover_image', ['class'=>'form-control col-md-4']) !!}

    <br>
    {!! Form::submit('Submit', ['class'=> 'btn btn-outline-primary col-md-4']) !!}


    {!! Form::close() !!}
</div>
@endsection
