@extends('layouts.app')

@include('include.AdminNav')

@section('content')

<div class="container">

    <div class="card border-info">
        <div class="card-header bg-info">
            @permission('patients-create')

            <a href="{{route('patient.create')}}" class="btn btn-sm btn-primary float-right "><i class="fa fa-plus-square "></i> Add patient</a>
            @endpermission

            <h4 class="card-title">Patient's Table</h4>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-condensed table-sm table-hover" id="patdoc">
                    <thead class="thead-dark">
                        <th>#</th>
                        <th>Patient ID</th>
                        <th>First Name</th>
                        <th>Second Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @if (count($patients)> 0)
                        @foreach ($patients as $patient)
                        <tr>
                            <td>{{ $patient->id }}</td>
                            <td><a href="/patient/{{ $patient->id }}">{{ $patient->personal_id }}</a></td>
                            <td>{{ $patient->fname }}</td>
                            <td>{{ $patient->lname }}</td>
                            <td>{{ $patient->email }}</td>
                            <td class="flex justify-end  border-b border-gray-200 text-sm leading-5 font-medium">
                                 <a href="/patient/{{ $patient->id }}/edit" class=" pull-left btn btn-primary">Edit</a>
                            </td>
                        </tr>

                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
