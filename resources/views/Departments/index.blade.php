@extends('layouts.app')

@include('include.AdminNav')

@section('content')
<div class="container">
     <div class="card border-info col-md-4 col-sm-8">
        <div class="card-body">
            {!! Form::open(['action'=>'DepartmentsController@store', 'method'=>'POST',  'enctype'=> 'multipart/form-data']) !!}


                    <div class="form-group">
                        {!! Form::label('name', 'Department Name', ['class'=>'form-label']) !!}
                        {!! Form::text('name', '', ['class'=>'form-control', 'auto-focus'=>'true']) !!}
                    </div>


                    {!! Form::submit('Submit', ['class'=>'btn btn-outline-success']) !!}
                </div>


            {!! Form::close() !!}

        </div>
    </div>
    <br>


    @if (count($departments)> 0)
    <div class="table-responsive">
        <table class="table table-stripped table-borderless table-hover" id="myTable">
            <thead scope="row" class="bg-dark text-white">
                <tr>
                    <td>#</td>
                    <td>Name</td>
                    <td>Action</td>
                    <td>Manage</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($departments as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td><a href="/department/{{ $item->id }}" class="btn btn-outline-primary fa fa-edit"> Details</a></td>
                    <td><a href="/department/{{ $item->id }}/edit" class="btn btn-outline-primary fa fa-edit"> Edit</a></td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>

    @endif


</div>
@endsection

