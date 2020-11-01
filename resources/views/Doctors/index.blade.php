@extends('layouts.app')

@include('include.AdminNav')

@section('content')
<div class="container">

    <div class="card border-info ">
        <div class="card-header bg-info">
            <a href="{{route('doctor.create')}}" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus-square "></i>  Add Doctor</a>

            <p class="card-title">Doctor' s table</p>
        </div>
        <div class="card-body">
            {{-- Doctor' s Table --}}
            @if (count($doctors)> 0)

            <div class="table-responsive">
                <table class="table table-borderless table-sm table-hover table-striped" id="myTable">
                    <thead class="bg-dark text-white">
                        <tr>
                            <td>User I.D</td>
                            <td>Doctor' s ID</td>
                            <td>First Name</td>
                            <td>Last Name</td>
                            <td>Department</td>
                            <td>Contact</td>
                            <td>Date of Birth</td>
                            <td>Gender</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($doctors as $item)
                        <tr>
                            <td>{{ $item->user_id }}</td>
                            <td> <a href="/doctor/{{ $item->id }}">{{  $item->doctor_id }}</a></td>
                            <td>{{ $item->fname }}</td>
                            <td>{{ $item->lname }}</td>
                            <td>{{ $item->department->name }}</td>
                            <td>{{ $item->contact }}</td>
                            <td>{{ $item->dob }}</td>
                            <td>{{ $item->gender }}</td>
                            <td>
                                <button class="btn btn-group">
                                    @role('doctor')
                                        <a href="/doctor/{{ $item->id }}/edit" class="btn btn-outline-success">Edit</a>
                                    @endrole

                                    @role('superadministrator|receptionist')
                                        <a href="/doctor/{{ $item->id }}" class="btn btn-outline-success">Show</a>
                                    @endrole

                                    {{ Form::open(['action'=>['DoctorsController@destroy' , $item->id], 'method'=>'POST', 'enctype'=>'multipart/form-data'])}}

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


