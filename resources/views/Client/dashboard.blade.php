@extends('layouts.client-app')

@include('include.Client-nav')

@section('content')
@php
    use Carbon\Carbon;
@endphp
    {{-- display Notifications --}}
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>
    @if (count($notification)>0)
<div class="btn-group dropright">
  <button type="button" class="btn btn-secondary">
    Notifications
  </button>
  <button type="button" class="btn btn-primary  dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="sr-only">Toggle Dropright</span>
        <i class="fa fa-bell animated headShake"></i><i class="text-red-500 " style="color: red">{{$num }}</i>
  </button>
  <div class="dropdown-menu">
    <!-- Dropdown menu links -->
    @foreach ($notification as $item)
        <a class="dropdown-item" href="#">You have an appointment on:  {{Carbon::parse($item->data['AppointmentDate'])->format('D d M, Y')}}</a>
    @endforeach

  </div>
</div>
<p></p>



@endif
<div class="card-deck">
  <div class="card border-success mb-3">
    <div class="card-body">
      <h5 class="card-title text-success border-bottom">Account Details</h5>
      <p class="card-text">Full Name: {{ $details->fname }} {{ $details->lname }} </p>
      <p class="card-text">Email: {{ $details->email }}  </p>
      <p class="card-text">Address: {{ $details->address }} </p>
      <p class="card-text">Contact: {{ $details->contact }}  </p>
      <a href="{{route('patient.edit', $details->id)}}" class="btn btn-outline-success ">Edit details</a>
    </div>
  </div>

  <div class="card border-primary mb-3">
    <div class="card-body">
      <h5 class="card-title text-primary border-bottom">Upcoming Appointments</h5>
      @if (count($notification)>0)

      @foreach ($notification as $item)

          <p class="card-text">Appointment Date: {{ carbon::parse($item->data['AppointmentDate'])->format('D d M, Y') }} </p>
          <p class="card-text">Appointment Time:  {{ carbon::parse($item->data['AppointmentTime'])->format('H:i:s T') }}</p>

      @endforeach
      @else
      <p class="card-text">You have no Upcoming Appointments</p>
      <a href="{{route('appointment.create')}}" class="btn btn-success">Book an Appointment now</a>

      @endif
    </div>
  </div>
  <div class="card border-info mb-3">
    <div class="card-body">
      <h5 class="card-title text-info border-bottom">Prescriptions</h5>

      @if (count($prescriptions)>0)
      @foreach ($prescriptions as $prescriptions)

      <p class="card-text">Appointment I.D: {{$prescriptions->appointment_id}}</p>
      <p class="card-text">Diagnosis: {{$prescriptions->diagnosis}}</p>
      <p class="card-text">Prescription: {{$prescriptions->prescription}}</p>
      @endforeach
      @endif

    </div>
  </div>
</div>



<div class="card border-info">
    <div class="card-header bg-info">
        <a href="{{  route('kin.create')  }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus-circle"></i> Add </a>
        <h4 class="card-title">Next of kin</h4>
    </div>
    <div class="card-body">

         <div class="table-responsive">
            <table class="table table-striped table-sm table-hover" id="" >
                <thead class="bg-dark text-white">
                    <tr>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Contact</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @if (count($kin)>0)
                    @foreach ($kin as $kin)
                    <tr>
                    <td><a href="/kin/{{$kin->id}}/edit">{{ $kin->name  }}</a></td>
                        <td>{{ $kin->email  }}</td>
                        <td>{{ $kin->contact  }}</td>
                         <td>
                            {{ Form::open(['action'=>['KinsController@destroy' , $kin->id], 'method'=>'POST', 'class'=>'py-0' ])}}

                            {!! Form::hidden('_method', 'DELETE' )!!}

                            {!! Form::submit('Delete', ['class'=>'btn btn-outline-danger']) !!}

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
@endsection

@section('footer')



@endsection
