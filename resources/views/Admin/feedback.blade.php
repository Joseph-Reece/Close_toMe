@extends('layouts.app')

@include('include.AdminNav')
@php
    use Carbon\carbon;
@endphp

@section('content')
    <div class="card-border-info">
        <div class="card-header bg-info">
            <h4 class="card-title">Feedback</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-condensed table-hover table-striped" id="myTable">
                    <thead class="thead-dark">
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Post Date</th>
                    </thead>
                    <tbody>
                        @if (count($feedback)>0)
                        @foreach ($feedback as $item)
                        <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->message }}</td>
                        <td>{{ Carbon::parse($item->created_at)->format('D d, M Y') }}</td>
                        </tr>

                        @endforeach

                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
