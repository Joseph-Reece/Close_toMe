@extends('layouts.app')

@include('include.AdminNav')

@php
use Carbon\Carbon;

@endphp
@section('content')
    <div class="container-fluid">

    <a href="/doctor" class="btn btn-outline-primary"><i class="fa fa-chevron-left"></i> Go Back</a>
    <hr>



    <div class="card border-info">
        <div class="card-header bg-info ">
            <p class="card-title"><i class="fa fa-user"></i> Name:  {{ $doctors->fname}}  {{$doctors->lname }} </p  >

            <div class="entry-meta">
                <span class="px-1"><i class="fa fa-calendar-o"></i> Registration Date: {{Carbon::parse( $doctors->created_at)->format('D d M, Y H:i:s')}} </span>
            </div>
        </div>
        <div class="card-body">

            <div class="card-deck">
                <div class="card border-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title border-bottom text-success">Account Details</h5>
                        <p class="card-text">Personal I.D: {{ $doctors->doctor_id }} </p>
                        <p class="card-text">Department: {{ $doctors->department->name }}  </p>
                        <p class="card-text">Address: {{ $doctors->address }} </p>
                        <p class="card-text">Contact: {{$doctors->contact}}  </p>
                        <p class="card-text">Gender: {{$doctors->gender}}  </p>
                        <p class="card-text">Date Of Birth: {{Carbon::parse( $doctors->dob)->format('D d M, Y')}}  </p>
                        <a href="{{route('doctor.edit',$doctors->id)}}" class="btn btn-outline-success">Edit details</a>
                    </div>
                </div>

            </div>


        </div>
    </div>


@endsection
