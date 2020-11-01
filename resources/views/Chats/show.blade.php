@extends('layouts.client-app')

@php
    use Carbon\Carbon;
@endphp

@role('patient')
@include('include.Client-nav')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header">
                Chats
            </div>
            <div class="card-body">
                <table>


                        <tr>
                            <td></td>
                        </tr>

                </table>
            </div>
        </div>
        {!! Form::open(['action'=>['ChatsController@update', $chat->id], 'method'=>'post', 'enctype'=>'multipart/form-data']) !!}

        <div class="form-group col-md-4">

            {!! Form::label('department', 'Choose the Target Department', ['class'=>'form-label']) !!}
            <select name="department" id="" class="custom-select form-control">
                @if (count($departments)>0)
                    <option value="{{$chat->department_id}}" disabled selected>{{$chat->department->name}}</option>
                    @foreach ($departments as $item)
                        <option value="{{ $item->id }}">{{$item->name}}</option>
                    @endforeach

            @endif
            </select>
        </div>
        <div class="form-group">
            {!! Form::label('query', 'Query', ['class'=>'form-label']) !!}
            {!! Form::textarea('query', $chat->query, ['class'=>'form-control']) !!}
        </div>

        <div class="row container">
            {!! Form::hidden('_method', 'PUT')!!}
            {!! Form::submit('Submit query', ['class'=>'btn btn-primary']) !!}

            <a href="{{route('chat.index')}}" class="btn btn-outline-danger">Cancel</a>
        </div>
        {!! Form::close() !!}
    </div>

@endsection
@endrole


{{-- This Part is not Visible to Staff --}}
 @role('doctor|receptionist|superadministrator')
@include('include.AdminNav')

@section('content')
 <div class="container">

    <div class="card border-info mb-3">
            <div class="card-header bg-info">
                <p class="card-title  ">Query Details</p>
                <div class="entry-meta">
                    <span><i class="fa fa-user-o"></i> Client Name: {{$chat->client->name }} </span>
                    <span><i class="fa fa-folder"></i> Department: {{$chat->department->name }} </span>
                    <span><i class="fa fa-calendar-o"></i> Posted on: {{Carbon::parse( $chat->created_at  )->format('d M, Y') }} </span>
                </div>

            </div>
        <div class="card-body">
            <p class="card-text">{{$chat->query}}</p>
        </div>
    </div>
    <div class="card border-success mb-3">
        <div class="card-header bg-success">
                <p class="card-title ">Reply to Query</p>
                <div class="entry-meta">
                    <span><i class="fa fa-calendar-o"></i>  {{carbon::now()->format('d M, Y') }} </span>
                </div>

            </div>
            <div class="card-body">

                {!! Form::open(['action'=>['ChatsController@update', $chat->id], 'method'=>'post', 'enctype'=>'multipart/form-data']) !!}
                <div class="alert alert-info">Change Department or proceed to Reply</div>

                {!! Form::label('department', 'Choose the Target Department', ['class'=>'form-label']) !!}

                <select name="department" id="" class="custom-select form-control">
                    @if (count($departments)>0)
                        <option value="{{$chat->department_id}}" disabled selected>{{$chat->department->name}}</option>
                        @foreach ($departments as $item)
                            <option value="{{ $item->id }}">{{$item->name}}</option>
                        @endforeach
                     @endif
                </select>

                <div class="form-group col-md-4">
                    {!! Form::label('response', 'Response', ['class'=>'form-label']) !!}
                    {!! Form::textarea('response', '', ['class'=>'form-control']) !!}
                </div>



                <div class="row container">
                    <div class="">
                        {!! Form::hidden('_method', 'PUT')!!}
                        {!! Form::submit('Submit', ['class' =>'btn btn-outline-primary']) !!}
                    </div>
                <a href="{{route('chat.index')}}" class="btn btn-outline-danger">Cancel</a>


                </div>
                {!! Form::close() !!}
            </div>
    </div>

    </div>

@endsection
@endrole






