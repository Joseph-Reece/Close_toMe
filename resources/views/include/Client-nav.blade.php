 <nav class="navbar navbar-dark sticky-top bg-dark  p-0 shadow " id="Adm">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-2" href="{{ url('/') }}">
            {{ config('app.name', 'OutpatientMs') }}
        </a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

 <ul class="navbar-nav px-2 ml-auto">
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link btn-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>


                @if(\Illuminate\Support\Facades\Auth::guard('client')->check())
                    <div class="dropdown-menu " aria-labelledby="navbarDropdown">
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


<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
    {{-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><span class="fa fa-chevron-circle-left"></span>close</a> --}}
    {{-- <div class="sidebar-sticky text-light pt-3"> --}}
    <ul class="nav flex-column">
         <li class="nav-item ">
            <a class="nav-link text-light " href="/client"> <i class="fa fa-home"></i> Dashboard</a>
        </li>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-5 mb-1 text-muted">
            <span>Manage</span>
        </h6>


        <li class="nav-item">
            <a class="nav-link" href="{{ route('appointment.index')}}">
                <span class="fa fa-book"></span>
                Appointments
            </a>

        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{  route('chat.index')  }}">
                <span class="fa fa-phone-square"></span>
                Chat
            </a>
        </li>




    </ul>

    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Forms</span>
    </h6>
    <ul class="nav flex-column mb-2">
        <li class="nav-item">
            <a class="nav-link" href="{{route('appointment.create')}}">
                <span class="fa fa-plus"></span>
                Add Appointment
            </a>
        </li>

        <li class="nav-item">
        <a class="nav-link" href="{{route('chat.create')}}">
            <span class="fa fa-plus"></span>
            Add Chat
        </a>
        </li>

        <li class="nav-item">
        <a class="nav-link" href="{{  route('kin.create')  }}">
                <span class="fa fa-plus"></span>
                Next of Kin
            </a>

        </li>

    </ul>
    {{-- </div> --}}
</nav>





