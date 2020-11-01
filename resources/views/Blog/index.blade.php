@extends('layouts.app')


@include('include.AdminNav')
@php
    use Carbon\Carbon;
@endphp

@section('content')

    <div class="container">
     <div class="d-flex justify-content-between flex-wrap flex-md-nowrap  align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Blog Posts</h1>

            @permission('posts-create')
            <a href="/posts/create" class="btn btn-success"><i class="fa fa-plus-square-o"></i> Create a Post</a>
            @endpermission


          </div>

          <div class="row">

            <div class="col-sm-8 col-sm-pull-4">
                <div class="blog">
                    @if (count($posts) >0)

                    @foreach ($posts as $post)

                        <div class="blog-item py-2 {{$post->category }} ">
                            <img class="img-responsive img-blog" src="/storage/cover_images/{{ $post->cover_image}}" alt="No image to show" width="50%">
                            <div class="blog-content">
                                <h3><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h3>

                                <div class="entry-meta">
                                    <span><i class="fa fa-user"></i>  {{$post->user->name}} </span>
                                    <span><i class="fa fa-folder-o"></i>  {{$post->category }} </span>
                                    <span><i class="fa fa-calendar-o"></i>  {{ Carbon::parse( $post->created_at  )->format('D d M, Y H:i:s T') }} </span>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">

                                        <a class=" btn btn-sm btn-outline-success" href="/posts/{{ $post->id }}">Read more  <i class=" fa fa-caret-right"> </i></a>
                                    </div>
                                    @isAbleToAndOwns('posts-delete', $post)
                                    <div class="col-md-3">
                                        <a class=" btn btn-sm btn-outline-secondary" href="/posts/{{ $post->id }}/edit"><i class=" fa  fa-pencil"> </i>  Edit </a>
                                    </div>
                                    <div class="col-md-3 ">

                                        {{-- Delete form --}}

                                                {{ Form::open(['action'=>['PostsController@destroy' , $post->id], 'method'=>'POST', ])}}

                                                {!! Form::hidden('_method', 'DELETE' )!!}

                                                {!! Form::submit('Delete', ['class'=>'btn btn-sm btn-outline-danger ']) !!}

                                                {!! Form::close() !!}
                                    </div>
                                    @endOwns



                                </div>


                            </div>

                        </div><!--/.blog-item-->

                    @endforeach
                    {{ $posts->links() }}
                    @endif

                </div>
            </div>

             <div class="col-sm-4  col-sm-push-8">
                <div class="widget search">
                    <form role="form">
                        <div class="input-group">
                            <input type="text" class="form-control" autocomplete="off" disabled placeholder="Search">
                            <span class="input-group-btn input-group-append">
                                <button class="btn btn-danger" type="button"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                </div><!--/.search-->

                <div class="widget ads">
                    <div class="row">
                        <div class="col-sm-6">
                            <img src="{{ asset('images\slides\1.jpg') }}" class="d-block w-100" alt="...">
                        </div>

                        <div class="col-sm-6">
                            <img src="{{ asset('images\slides\2.jpg') }}" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <p> </p>
                    <div class="row">
                        <div class="col-sm-6">
                            <img src="{{ asset('images\slides\5.jpg') }}" class="d-block w-100" alt="...">
                        </div>

                        <div class="col-sm-6">
                            <img src="{{ asset('images\slides\4.jpg') }}" class="d-block w-100" alt="...">
                        </div>
                    </div>
                </div><!--/.ads-->

                <div class="widget categories">
                    <h3>Blog Categories</h3>
                    <div class="row">
                        <div class=" about-text col-sm-6">
                            <ul class="withArrow">
                                <li class="animated lightSpeedIn "><span class="fa fa-angle-right"></span>Develop</li>
                                <li class="animated lightSpeedIn "><span class="fa fa-angle-right"></span>General</li>
                                <li class="animated lightSpeedIn "><span class="fa fa-angle-right"></span>Procurement</li>
                                <li class="animated lightSpeedIn "><span class="fa fa-angle-right"></span>Charity</li>
                            </ul>
                        </div>
                    </div>
                </div><!--/.categories-->
                <div class="widget mb-3">
                    <h3>Tag Cloud</h3>
                    <ul class="tag-cloud">
                        <li><a class="btn btn-sm btn-primary" href="#">CSS3</a></li>
                        <li><a class="btn btn-sm btn-primary" href="#">HTML5</a></li>
                        <li><a class="btn btn-sm btn-primary" href="#">WordPress</a></li>
                        <li><a class="btn btn-sm btn-primary" href="#">Joomla</a></li>
                        <li><a class="btn btn-sm btn-primary" href="#">Drupal</a></li>
                        <li><a class="btn btn-sm btn-primary" href="#">Bootstrap</a></li>
                        <li><a class="btn btn-sm btn-primary" href="#">jQuery</a></li>
                        <li><a class="btn btn-sm btn-primary" href="#">Tutorial</a></li>
                        <li><a class="btn btn-sm btn-primary" href="#">Update</a></li>
                    </ul>
                </div><!--/.tags-->

                 <div class="widget">
                    <h5 class="widgetheading">Social Network</h5>
                    <ul class="social-network">
                        <li><a class="btn btn-info" href="#" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a class="btn btn-primary" href="#" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a class="btn btn-secondary" href="#" data-placement="top" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                        <li><a class="btn btn-warning" href="#" data-placement="top" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>
                        <li><a class="btn btn-danger" href="#" data-placement="top" title="Google plus"><i class="fa fa-google-plus"></i></a>
                        </li>
                    </ul>
                </div>
            </div>



          </div>


    </div>
@endsection
