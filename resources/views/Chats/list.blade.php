@extends('layouts.app')


@role('patient')
@include('include.Client-nav')
@endrole

 @role('doctor|receptionist|superadministrator')
@include('include.AdminNav')
@endrole

@section('content')
 @php
    use Carbon\Carbon;
@endphp

    @role('doctor|receptionist|superadministrator')
        <div class="container">
            <div class="card border-info">
                <div class="card-header bg-info">
                    Queries
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-stripped " id="myTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Chat I.D</th>
                                    <th>Patient I.D</th>
                                    <th>Query</th>
                                    <th>Department</th>
                                    <th>Sent date</th>
                                    <th>Status</th>
                                    <th>Post</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if (count($chat)>0)
                                    @foreach ($chat as $chat)
                                        <tr>
                                            <td>{{ $chat->id }}</td>
                                            <td>{{ $chat->client_id }}</td>
                                            <td>{{ $chat->query }}</td>
                                            <td>{{ $chat->department_id }}</td>
                                            <td>{{Carbon::parse($chat->created_at)->format('D, d M Y ')}} </td>
                                            <td>{{$chat->Status}}</td>
                                            <td>
                                                <a href="/chat/{{ $chat->id }}/edit" class="btn btn-outline-primary ">Reply</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
<br>
            <div class="card border-success">
                <div class="card-header bg-success">
                    Replied Queries
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-stripped " id="chat">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Chat I.D</th>
                                    <th>Patient I.D</th>
                                    <th>Query</th>
                                    <th>Department</th>
                                    <th>Sent date</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if (count($replied_chat)>0)
                                    @foreach ($replied_chat as $chat)
                                        <tr>
                                            <td>{{ $chat->id }}</td>
                                            <td>{{ $chat->client_id }}</td>
                                            <td>{{ $chat->query }}</td>
                                            <td>{{ $chat->department_id }}</td>
                                            <td>{{Carbon::parse($chat->created_at)->format('D, d M Y ')}} </td>
                                            <td>{{$chat->Status}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    @endrole

    @role('patient')

        <div class="container">

        <div class="card border-info">
            <div class="card-header bg-info">
                <h3 class="card-title">Queries</h3>
                <a href="{{route('chat.create')}}" class="btn btn-primary"><i class="fa fa-plus-square-o"></i> Add Chat</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-info" id="patTable">
                        <thead class="thead-light">
                            <th>#</th>
                            <th>Query</th>
                            <th>Target Department</th>
                            <th>Status</th>
                            <th>Post Date</th>
                            <th>Manage</th>
                        </thead>
                        <tbody>
                            @if (count($replied_chat)>0)

                            @foreach ($replied_chat as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->query}}</td>
                                <td>{{$item->department->name }}</td>
                                <td>{{$item->Status }}</td>
                                <td>{{Carbon::parse($item->created_at)->format('D d, M Y H:i:s T')}}</td>
                                <td><a href="/chat/{{$item->id}}/edit" class="btn btn-primary btn-sm">Edit</a></td>
                            </tr>

                            @endforeach
                            @endif
                        </tbody>
                    </table>

            </div>
            </div>
        </div>

    @endrole
@endsection


