@extends('layouts.app')

@include('include.AdminNav')
@php
    use Carbon\carbon;
@endphp

@section('content')

<div class="container">

   <div class="card border-info mb-3">
        <div class="card-header bg-info">
            <p class="card-title">Department Name: {{$department->name}}</p>

            <div class="entry-meta">
            <span class="px-2"><i class="fa fa-calendar-o"> Registration Date: {{Carbon::parse($department->updated_at)->format('D d, M Y')}}</i></span>
            </div>
        </div>
        <div class="card-body">
            <div class="card-deck">
                <div class="card border-info">
                    <div class="card-body">
                        <p class="card-title text-success border-bottom">Doctors</p>
                        <p class="card-text">Total No. of Doctors: {{$doctors}}</p>

                    </div>

                </div>

                <div class="card border-info">
                    <div class="card-body">

                        <p class="card-title text-success border-bottom">Appointments</p>
                        <p class="card-text">Total No. of Appointments: {{$t_appointments}}</p>
                        <p class="card-text">Total No. of Pending Appointments: {{ $p_appointments }}</p>
                        <p class="card-text">Total No. of Missed Appointments: {{ $m_appointments }}</p>
                        <p class="card-text">Total No. of Honoured Appointments: {{ $c_appointments }}</p>
                    </div>
                </div>

                <div class="card border-info">
                    <div class="card-body">

                        <p class="card-title text-success border-bottom">Chats</p>
                        <p class="card-text">Total No. of chats: {{ $t_chats }}</p>
                        <p class="card-text">Total No. Pending of Queries: {{$p_chats }}</p>
                        <p class="card-text">Total No. Replied of Queries: {{ $r_chats }}</p>
                    </div>
                </div>
            </div>



        </div>
   </div>

    <a href="{{route('department.index')}}" class="btn btn-sm btn-outline-secondary"><i class="fa fa-chevron-left"></i> Go Back</a>

</div>

@endsection
