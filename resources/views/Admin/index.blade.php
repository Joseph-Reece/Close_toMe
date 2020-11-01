@extends('layouts.app')

@include('include.AdminNav')
@php
    use Carbon\carbon;
@endphp


@section('content')

    <div class="container">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
          </div>

        {{-- NavTabs --}}
        @role('receptionist|superadministrator')
            <div class="card border-info mb-3">
                <div class="card-header bg-info">Admin User's Table</div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-condensed table-sm table-hover" id="myTable">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>

                            </thead>
                            <tbody>
                                @if (count($admin)> 0)
                                @foreach ($admin as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>

                                    <td class="flex justify-end  border-b border-gray-200 text-sm leading-5 font-medium">
                                    <a href="/admin/{{$user->id}}/edit" class="pull-left btn btn-primary">Edit</a>

                                        {{ Form::open(['action'=>['AdminController@destroy' , $user->id], 'method'=>'POST', 'enctype'=>'multipart/form-data'])}}

                                        {!! Form::hidden('_method', 'DELETE' )!!}

                                        {!! Form::submit('Delete', ['class'=>'pull-right btn btn-sm btn-outline-danger']) !!}

                                        {!! Form::close() !!}
                                    </td>

                                </tr>

                                @endforeach



                                @endif
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>

            <div class="card border-success mb-3">
                <div class="card-header bg-success">Doctors User's Table</div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-condensed table-sm table-hover" id="kin_table">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>

                            </thead>
                            <tbody>
                                @if (count($Cdoctors)> 0)
                                @foreach ($Cdoctors as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>

                                    <td class="flex justify-end  border-b border-gray-200 text-sm leading-5 font-medium">
                                    <a href="/admin/{{$user->id}}/edit" class="pull-left btn btn-primary">Edit</a>

                                        {{ Form::open(['action'=>['AdminController@destroy' , $user->id], 'method'=>'POST', 'enctype'=>'multipart/form-data'])}}

                                        {!! Form::hidden('_method', 'DELETE' )!!}

                                        {!! Form::submit('Delete', ['class'=>'pull-right btn btn-sm btn-outline-danger']) !!}

                                        {!! Form::close() !!}
                                    </td>

                                </tr>

                                @endforeach



                                @endif
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>

            <div class="card border-primary mb-3">
                <div class="card-header bg-primary">Receptionist User's Table</div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-condensed table-sm table-hover" id="complete_table">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>

                            </thead>
                            <tbody>
                                @if (count($receptionist)> 0)
                                @foreach ($receptionist as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>

                                    <td class="flex justify-end  border-b border-gray-200 text-sm leading-5 font-medium">
                                    <a href="/admin/{{$user->id}}/edit" class="pull-left btn btn-primary">Edit</a>

                                        {{ Form::open(['action'=>['AdminController@destroy' , $user->id], 'method'=>'POST', 'enctype'=>'multipart/form-data'])}}

                                        {!! Form::hidden('_method', 'DELETE' )!!}

                                        {!! Form::submit('Delete', ['class'=>'pull-right btn btn-sm btn-outline-danger']) !!}

                                        {!! Form::close() !!}
                                    </td>

                                </tr>

                                @endforeach



                                @endif
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>

        @endrole

        @role('doctor')

                <div class="card border-success mb-3">
                    <div class="card-header border-bottom bg-success">
                        <h5 class="card-title ">Name: {{ $details->fname }} {{ $details->lname }}</h5>
                        <div class="entry-meta">
                            <span><i class="fa fa-folder-o"></i>  {{$details->department->name }} </span>
                            <span><i class="fa fa-calendar-o"></i>  {{ Carbon::parse( $details->created_at  )->format('D d M, Y H:i:s T') }} </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-deck">
                            <div class="card border-success">
                                <div class="card-body">
                                    <p class="card-title text-success border-bottom">Account Details   </p>
                                    <p class="card-text text-dark">Email: {{ $detail->email }}  </p>
                                    <p class="card-text text-dark">Address: {{ $details->address }} </p>
                                    <p class="card-text text-dark">Contact: {{ $details->contact }}  </p>
                                    <a href="{{route('doctor.edit', $details->id)}}" class="btn btn-outline-success mb-1">Edit details</a>
                                </div>
                            </div>
                            <div class="card border-success">
                                <div class="card-body">
                                    <p class="card-title text-success border-bottom">Appointment Activities:   </p>
                                    <p class="card-text text-dark">Your Completion Record: <span class="badge badge-info">{{ $appointments }}</span>  Appointments</p>
                                    <p class="card-text text-dark">Your Department has: <span class="badge badge-info">{{ $t_appointments }}</span> Appointments Pending Today</p>
                                    <a href="{{route('appointment.index')}}" class="btn btn-sm btn-outline-success"> <span class="fa fa-sign-out"></span> Appointments Page</a>
                                </div>
                            </div>
                            <div class="card border-success">
                                <div class="card-body">
                                    <p class="card-title text-success border-bottom">Query Activities:   </p>
                                    <p class="card-text text-dark">Departmental Reply  Record: <span class="badge badge-info">{{ $rep_chat }}</span>  Chats</p>
                                    <p class="card-text text-dark">Your Department has: <span class="badge badge-info">{{ $no_chat }}</span> Chats Pending </p>
                                    <a href="{{route('chat.index')}}" class="btn btn-sm btn-outline-success"> <span class="fa fa-sign-out"></span> Chats Page</a>
                                </div>
                            </div>
                        </div>


                        <div class="mb-3">

                        </div>

                        <div class="mb-3">


                        </div>

                    </div>
                </div>

        @endrole



</div>


{{--  sidebar  --}}

@endsection





