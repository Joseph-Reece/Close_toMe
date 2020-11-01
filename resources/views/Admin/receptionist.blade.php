@extends('layouts.app')

@include('include.AdminNav')

@section('content')
<div class="container">

    <div class="card border-info ">
        <div class="card-header bg-info">
            <a href="{{route('receptionists.create')}}" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus-square "></i>  Add receptionist</a>

            <p class="card-title">receptionist' s table</p>
        </div>
        <div class="card-body">
            {{-- receptionist' s Table --}}

            <div class="table-responsive">
                <table class="table table-borderless table-sm table-hover table-striped" id="myTable">
                    <thead class="bg-dark text-white">
                        <tr>
                            <td>User I.D</td>
                            <td>receptionist' s ID</td>
                            <td>Contact</td>
                            <td>Date of Birth</td>
                            <td>Gender</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($receptionists)> 0)
                        @foreach ($receptionists as $item)
                        <tr>
                            <td>{{ $item->user_id }}</td>
                            <td> <a href="/receptionist/{{ $item->id }}">{{  $item->receptionist_id }}</a></td>
                            <td>{{ $item->contact }}</td>
                            <td>{{ $item->dob }}</td>
                            <td>{{ $item->gender }}</td>
                            <td>
                                <button class="btn btn-group">
                                    <a href="/receptionist/{{ $item->id }}/edit" class="btn btn-outline-success">Edit</a>

                                    <a href="/receptionist/{{ $item->id }}" class="btn btn-outline-success">Show</a>

                                    {{ Form::open(['action'=>['receptionistsController@destroy' , $item->id], 'method'=>'POST', 'enctype'=>'multipart/form-data'])}}

                                    {!! Form::hidden('_method', 'DELETE' )!!}

                                    {!! Form::submit('Delete', ['class'=>'btn btn-outline-danger']) !!}

                                    {!! Form::close() !!}
                                </button>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>

            @endif

        </div>
    </div>


</div>
@endsection


