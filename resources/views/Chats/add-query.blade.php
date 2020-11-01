@extends('layouts.client-app')

@include('include.Client-nav')

@section('content')
    <div class="container">
        {!! Form::open(['action'=>'ChatsController@store', 'method'=>'post', 'enctype'=>'multipart/form-data']) !!}

        <div class="form-group col-md-4">

            {!! Form::label('department', 'Target Department', ['class'=>'form-label']) !!}
            <select name="department" id="" class="custom-select form-control">
                @if (count($department)>0)
                    <option value="" class="disabled selected">Select Target Department</option>
                    @foreach ($department as $item)
                        <option value="{{ $item->id }}">{{$item->name}}</option>
                    @endforeach

            @endif
            </select>
        </div>
        <div class="form-group">
            {!! Form::label('query', 'Query', ['class'=>'form-label']) !!}
            {!! Form::textarea('query', '', ['class'=>'form-control']) !!}
        </div>

        <div class="col-md-3">
            {!! Form::submit('Submit query', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
