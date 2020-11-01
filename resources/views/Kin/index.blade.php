@extends('layouts.app')

@include('include.AdminNav')

@section('content')
<div class="container">
    <div class="container text-center text-black">
        <h3>Next of kin management</h3>
    </div>
     <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                Kin Registration form
            </div>
            <div class="card-body">
                {!! Form::open(['action'=>'KinsController@store', 'method'=>'POST',  'enctype'=> 'multipart/form-data']) !!}

                            <div class="form-group">
                                {!! Form::label('patient', 'Patient ID', ['class'=>'form-label']) !!}
                                {!! Form::text('patient', '', ['class'=>'form-control']) !!}
                                <small class="text-muted">Patient whom the Kin belongs to</small>
                            </div>
                            <hr>
                            <div class="form-row">

                                <div class="form-group ">
                                    {!! Form::label('name', 'Kin Name', ['class'=>'form-label']) !!}
                                    {!! Form::text('name', '', ['class'=>'form-control']) !!}
                                </div>

                                <div class="form-group ">
                                    {!! Form::label('email', 'Email', ['class'=>'form-label']) !!}
                                    {!! Form::text('email', '', ['class'=>'form-control']) !!}
                                </div>
                            </div>

                            <div class="form-group ">
                                {!! Form::label('contact', 'Contact', ['class'=>'form-label']) !!}
                                {!! Form::text('contact', '', ['class'=>'form-control']) !!}
                            </div>

                            {!! Form::submit('Submit', ['class'=>'btn btn-outline-success ']) !!}


                {!! Form::close() !!}

            </div>
        </div>

    </div>

    <br>
    @if (count($kin)>0)
    <div class="table-responsive">
        <table class="table table-striped table-sm table-hover" id="kin_table" >
            <thead class="bg-dark text-white">
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Contact</td>
                    <td>Patient</td>
                    <td>Register Date</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($kin as $item)
                   <tr>
                       <td>{{ $item->id  }}</td>
                       <td>{{ $item->name  }}</td>
                       <td>{{ $item->email  }}</td>
                       <td>{{ $item->contact  }}</td>
                       <td>{{ $item->patient_id  }}</td>
                       <td>{{ $item->created_at  }}</td>
                       {{-- <td><a class="btn btn-sm btn-outline-danger" href="/kin/{{ $item->id }}"><i class="fa fa-trash"></i> &nbsp Delete</a></td> --}}
                       <td>
                            {{ Form::open(['action'=>['KinsController@destroy' , $item->id], 'method'=>'POST', 'class'=>'float-right' ])}}

                            {!! Form::hidden('_method', 'DELETE' )!!}

                            {!! Form::submit('Delete', ['class'=>'btn btn-outline-danger']) !!}

                            {!! Form::close() !!}
                        </td>
                   </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @endif

    <br>

</div>

@endsection



