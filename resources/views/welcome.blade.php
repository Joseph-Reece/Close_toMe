<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'OutpatientMs') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/animate.js') }}" defer></script>
    <script src="{{ asset('js/custom.js') }}" defer></script>
    <script src="{{ asset('js/jquery.dataTables.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('DataTables-1.10.20/css/jquery.dataTables.css') }}" rel="stylesheet">
</head>
<body  data-spy="scroll" data-target="#navbar" data-offset="0">
    <div id="app">

        {{-- Top bar --}}
    <header class="topbar">
          <div class="container">

              <div class="row">
                  <!-- Social icons -->
                  <div class="col-sm-3">
                          <ul class="social-network">
                              <li><a href="#" class="" id=""><i class="fa fa-twitter"></i></a></li>
                              <li><a href="#" class="" id=""><i class="fa fa-linkedin"></i></a></li>
                              <li><a href="#" class="" id=""><i class="fa fa-facebook"></i></a></li>
                              <li><a href="#" class="" id=""><i class="fa fa-pinterest"></i></a></li>
                              <li><a href="#" class="" id=""><i class="fa fa-google-plus"></i></a></li>

                          </ul>
                  </div>

              </div>
          </div>
    </header>
    {{-- End Top bar --}}
    <header class="sticky-top">

        {{-- Navbar --}}
         <nav id="navbar" class="navbar sticky-top navbar-expand-md  bg-light navbar-light p-0 shadow ">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">OUTPATIENT MANAGEMENT SYSTEM</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav scroller px-2 mr-auto">
                            <li class="nav-item  ">
                                <a class="nav-link" href="#carousel"> Home <span class="sr-only">(current)</span></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#services" class="scrollTo">Services</a>
                            </li>

                             <li class="nav-item">
                                <a class="nav-link" href="#aboutUs">About Us</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#contact"> Contact Us</a>
                            </li>



                        </ul>
                    </div>
                </div>
                <ul class="navbar-nav px-2 ml-auto">
                    @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('client.login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('client.register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif

                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>


                                @if(\Illuminate\Support\Facades\Auth::guard('client')->check())
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('client.logout') }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('client-logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="client-logout-form" action="{{ route('client.logout') }}" method="POST"
                                                style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                @else
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('user.logout') }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('user-logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="user-logout-form" action="{{ route('user.logout') }}" method="POST"
                                                style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                @endif
                            </li>
                        @endguest
                </ul>
            </nav>
        {{-- End of NavBar --}}

    </header>

<section id="carousel">
    {{-- Carousel --}}
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active col-sm-12">
                    <img src="{{ asset('images\slides\1.jpg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block ">
                        <h3 class=" head ">Medical Counseling</h3>
                        <p class="">You can trust us</p>
                        <a href="{{ url('/client/register') }}" class="btn btn-primary">Book an Appointment with us</a>
                    </div>
                </div>
                <div class="carousel-item col-sm-12">
                    <img src="{{ asset('images\slides\2.jpg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h3 class="">Qualified Doctors</h3>
                        <p class="">You can trust us</p>
                    </div>

                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    {{-- End of Carousel  --}}

</section>

    {{-- Services section --}}
    <section id="services" class="colord">
        <div class="container">
            <div class="row">

                <div class=" col-md-12">
                    <div class="aligncenter">
                        <h2 class="aligncenter">24/7 Service</h2>This hospital in Murang'a offers 24-hour emergency medical
                        care services<br /> Open 24 hours
                    </div>
                    <br>
                </div>

            </div>
            <div class="row">
                <!-- Item 1 -->
                <div class="col-md-4 box text-center">
                    <div class="b1">
                        <i class="circle icon"><img src="{{ asset('images\services\Ent.png')  }}" alt=""></i>
                        <h3><u>ENT</u></h3>
                        <p>The Hospital has highly skilled doctors who are fully equipped with latest technologies ready to
                            perform
                            endospic nasal surgeries, skull based surgeries, ear and colchea implant.
                            Treatment of ear, nose and throat conditions in adults and children, along with problems in hearing and
                            deafness, ringing in the ears, cancers of the ENT are treated.</p>
                    </div>
                </div>
                <!-- End Item 1 -->

                <!-- Item 2 -->
                <div class="col-md-4 box text-center">
                    <div class="b1">
                        <i class="circle icon"><img src="{{ asset('images\services\gen.png')  }}" alt=""></i>
                        <h3><u>GENERAL CHECKUP</u></h3>
                        <p>General Medicine or Internal Medicine is one of the department which is considered to be the base
                            specialty and its assistance is sought by all super specialities.
                            General Medicine or Internal Medicine is the specialty dealing with prevention, diagnosis 's treatment
                            of
                            diseases. </p>
                    </div>
                </div>
                <!-- End Item 2 -->

                <!-- Item 3 -->
                <div class="col-md-4 box text-center">
                    <div class="b1">
                        <i class="circle icon"><img src="{{ asset('images\services\heart.jpg')  }}" alt=""></i>
                        <h3><u>HEART</u></h3>
                        <p>We are Providing the best in Cardiac care in Nyeri County with countless life saving breakthroughs.
                            We are adequately equipped to take care of any heart relates emergency and complications with our most
                            advanced centers for cardiology. </p>
                    </div>
                </div>
                <!-- End Item 3 -->
            </div>

            <div class="row">
                <!-- Item 4 -->
                <div class="col-md-4 box text-center">
                    <div class="b1">
                        <i class="circle icon"><img src="{{ asset('images\services\derm.jpg')  }}" alt=""></i>
                        <h3><u>DERMATOLOGY</u></h3>
                        <p>The Department of Dermatology offers a comprehensive state-of-the-art skin care diagnostics and
                            treatment.
                            The department provides a wide variety of speciality services in paediatric, surgical, medical and
                            cosmetic dermatology. </p>
                    </div>
                </div>
                <!-- End Item 4 -->

                <!-- Item 5 -->
                <div class="col-md-4 box text-center">
                    <div class="b1">
                        <i class="circle icon"><img src="{{ asset('images\services\brain.jpg')  }}" alt=""></i>
                        <h3><u>NEROLOGY</u></h3>
                        <p>The Department of Neurology is committed to integrating their exceptional medical expertise, technology
                            and innovation to offer best in class treatments.
                            The department is staffed leading panel of surgeons, doctors and nursing staff who offer cutting-edge
                            diagnosis using the latest neuroimaging techniques. </p>
                    </div>
                </div>
                <!-- End Item 5 -->

                <!-- Item 6 -->
                <div class="col-md-4 box text-center">
                    <div class="b1">
                    <i class="circle iconpstylr"><img src="{{ asset('images\services\kid.jpg')  }}" alt=""></i>
                        <h3><u>KIDS CARE</u></h3>
                        <p>We provide initial consultation and on-going comprehensive care, for infants, children, adolescents
                            and young adults.
                            Our team of specialized nurses and clinical social workers, are dedicated to provide the best care for
                            patients and support their families.</p>
                    </div>
                </div>
                <!-- End Item 6 -->
            </div>


        </div>
    </section>
    {{-- End Services section --}}

    {{-- About section --}}
    <section class="section-padding gray-bg" id="aboutUs">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h2>About Us</h2>
                        <p>Curabitur aliquet quam id dui posuere blandit. Donec sollicitudin molestie malesuada Pellentesque
                            <br>ipsum id orci porta dapibus. Vivamus suscipit tortor eget felis porttitor volutpat.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm 6">
                    <div class="about-text">
                        <p>Grids is a responsive Multipurpose Template. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Curabitur aliquet quam id dui posuere blandit. Donec sollicitudin molestie malesuada. Pellentesque in
                            ipsum id orci porta dapibus. Vivamus suscipit tortor eget felis porttitor volutpat.</p>

                        <ul class="withArrow">
                            <li class="animated lightSpeedIn "><span class="fa fa-angle-right"></span> Lorem ipsum dolor sit amet
                            </li>
                            <li class="animated lightSpeedIn delay-1s"><span class="fa fa-angle-right"></span> consectetur
                                adipiscing
                                elit</li>
                            <li class="animated lightSpeedIn delay-2s"><span class="fa fa-angle-right"></span> Curabitur aliquet
                                quam
                                id dui
                            </li>
                            <li class="animated lightSpeedIn delay-3s"><span class="fa fa-angle-right"></span> Donec sollicitudin
                                molestie
                                malesuada.</li>
                        </ul>

                        <a href="#" class="btn btn-primary ">Learn More</a>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6">
                    <div class="about-image">
                    <img src="{{ asset('images\services\GateMH.png') }}" alt="About Images">
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End About section --}}

    {{--  =====Contact Section====  --}}
    <section class="section-padding " id="contact">
        <div class="col-md-12">
            <div class="section-title text-center">
                <h2>Contact Form</h2>
                <p class="text-info">We'd love to get some feedback from you</p>
            </div>
            <div class="container">

               {!! Form::open(['action'=>'FeedbacksController@store', 'method'=>'post', 'enctype'=>'multipart/form-data']) !!}
                <div class="py-1">

                    <div class="form-row">
                        <div class="form-group px-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Name</div>
                                </div>
                                {!! Form::text('name', '', ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group px-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Email</div>
                                </div>
                                {!! Form::email('email', '', ['class'=>'form-control']) !!}
                            </div>
                        </div>


                    </div>
                    <div class="form-row">

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Message</div>
                                </div>
                                {!! Form::textarea('message', '', ['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    {!! Form::submit('Send', ['class'=>'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>


    </section>

    @include('include.footer')

    </div>


</body>
</html>



