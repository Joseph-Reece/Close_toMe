@extends('layouts.blogLayout')


@section('content')
@php
    use Carbon\Carbon;

    $date= Carbon::parse( $posts->created_at  )->format('d M, Y')
@endphp
<div class="container">

    <div class="col-md-8">
        <div class="blog">
            <div class="blog-item">
            <img class="img-responsive img-blog" src="/storage/cover_images/{{ $posts->cover_image}}" alt="No image to show" width="50%">

                <div class="blog-content">
                    <h3>{{ $posts->title }}</h3>

                    <div class="entry-meta">
                        <span><i class="fa fa-user"></i>  {{$posts->user->name}} </span>
                        <span><i class="fa fa-folder-o"></i>  {{$posts->category }} </span>
                        <span><i class="fa fa-calendar-o"></i>  {{$date }} </span>
                    </div>
                    <div class="container">
                        <p> {{ $posts->body }}</p>
                    </div>


                </div>

            </div>
        </div>
        @permission('posts-create')
                <a href="{{route('posts.index')}}" class="btn btn-primary mt-2">Go Back</a>
        @endpermission
             @if(!\Illuminate\Support\Facades\Auth::guard('client')->check())
                <a href="{{route('posts.index')}}" class="btn btn-primary mt-2">Go Back</a>
            @endif
    </div>
</div>
@endsection
