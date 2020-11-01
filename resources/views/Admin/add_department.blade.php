@extends('layouts.app')

@include('include.AdminNav')

@section('content')
<div class="container ">
    <div class="card">
        <div class="card-body">
            {!! Form::open(['action'=>'DepartmentsController@store', 'method'=>'POST',  'enctype'=> 'multipart/form-data']) !!}

                <div class="form-row">

                    <div class="form-group col-md-7">
                        {!! Form::label('name', 'Department Name', ['class'=>'form-label']) !!}
                        {!! Form::text('name', '', ['class'=>'form-control']) !!}
                    </div>



                {!! Form::submit('Submit', ['class'=>'btn btn-outline-success col-md-4']) !!}


            {!! Form::close() !!}

        </div>
    </div>
</div>

@endsection


