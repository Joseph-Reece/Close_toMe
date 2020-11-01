
@role('superadministrator|doctor|receptionist')

 <nav class="navbar navbar-dark sticky-top bg-dark  p-0 shadow " id="Adm">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-2" href="#">
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

{{--  SIDEBAR  --}}
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
    <div class="sidebar-sticky pt-3">
    <ul class="nav flex-column">
        <li class="nav-item ">
            <a class="nav-link  " href="/admin"> <i class="fa fa-home"></i> Dashboard <span class="sr-only">(current)</span></a>
        </li>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Manage</span>
        </h6>
        @permission('doctors-create')
         <li class="nav-item ">
            <a class="nav-link px-3" href="{{route('doctor.index')}}"><i class="fa fa-users"></i> Doctors</a>
        </li>

         <li class="nav-item ">
            <a class="nav-link px-3" href="{{route('receptionists.index')}}"><i class="fa fa-users"></i> Receptionist</a>
        </li>

         <li class="nav-item ">
            <a class="nav-link px-3" href="{{route('department.index')}}"><i class="fa fa-folder"></i> Departments</a>
        </li>

        @endpermission


        <li class="nav-item ">
            <a class="nav-link px-3" href="{{route('patient.index')}}"><i class="fa fa-users"></i> Patients</a>
        </li>
        @role('superadministrator')
        <li class="nav-item ">
            <a class="nav-link px-3" href="{{route('feedback.index')}}"><i class="fa fa-users"></i> Feedback</a>
        </li>
        @endrole
        @role('doctor')
            <li class="nav-item ">
                <a class="nav-link px-3" href="{{route('appointment.index')}}"><i class="fa fa-book"></i> Appointment</a>
            </li>

            <li class="nav-item ">
                <a class="nav-link px-3" href="{{route('chat.index')}}"><i class="fa fa-phone-square"></i> chat </a>
            </li>
        @endrole


        <li class="nav-item ">
            <a class="nav-link px-3" href="/posts"><i class="fa fa-edit"></i> Blog</a>
        </li>
    </ul>

    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Forms</span>
    </h6>
    @role('superadministrator|receptionist')
    <ul class="nav flex-column mb-2">
            <li class="nav-item ">
            <a class="nav-link px-3" href="{{route('patient.create')}}"> <span class="fa fa-plus"></span> Patient Registration </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link px-3" href="{{route('doctor.create')}}"> <span class="fa fa-plus"></span> Doctor Registration </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link px-3" href="{{route('kin.create')}}"><span class="fa fa-plus"></span> kin Registration </a>
            </li>
        @endrole
        @permission('receptionists-create')
        <li class="nav-item ">
            <a class="nav-link px-3" href="{{route('receptionists.create')}}"><span class="fa fa-plus"></span> Receptionist Registration </a>
        </li>
        @endpermission

        @role('doctor')
         <li class="nav-item ">
         <a class="nav-link px-3" href="{{route('appointment.create')}}"><span class="fa fa-plus"></span> Add Appointment </a>
        </li>
        @endrole

    </ul>
    </div>
</nav>
@endrole




