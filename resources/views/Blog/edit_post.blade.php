@extends('layouts.app')

@include('include.AdminNav')

@section('content')
<div class="container">
    <h4>Edit Post</h4>
    {{ Form::open(['action'=> ['PostsController@update', $post->id], 'method'=>'POST' , 'enctype'=> 'multipart/form-data']) }}

        <div class="form-group">
            <img src="/storage/cover_images/{{ $post->cover_image}}" alt="No image to show" width="50%">
        </div>
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
            {!! Form::select('category', $list, $post->category, ['class'=>'custom-select']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title', $post->title, ['class'=>'form-control'])!!}
        </div>

        <div class="form-group">
            {!! Form::label('body', 'Body')!!}
            {!! Form::textarea('body', $post->body, ['class'=>'form-control'])!!}
        </div>

        <div class="form-group">
            {!! Form::file('cover_image', ['class'=>'form-control col-md-4']) !!}
        </div>

        {!! Form::hidden('_method', 'PUT')!!}
        {!! Form::submit('Submit', ['class' =>'btn btn-outline-primary col-md-4']) !!}

    {{ Form::close()}}

   
</div>
@endsection
