<header class="navbar main-header d-flex justify-content-center align-items-lg-baseline">


    <div class="logopart">
        <a class="navbar-brand" href="{{ route('frontend.home') }}"><img src="{{ asset('dist/images/logo-iqurius-trans.png') }}"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    <nav class="main-nav navbar-expand-md navbar-dark bg-dark ">
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Student</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Parent</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">School</a>
                </li>
                <li class="nav-item {{ strcmp(url()->current(), route('frontend.practice')) == 0 ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('frontend.practice') }}">Assessment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Ref & Earn</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Ask a Doubt</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
            </ul>
        </div>
    </nav>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="loginregbtn">
        @guest('user')
        <ul>
            <li><button type="button" class="btn" data-toggle="modal" data-target="#loginmodal">
                  Login</button></li>
            <li><button type="button" class="btn" data-toggle="modal" data-target="#signupmodal">
                    Sign Up</button></li>
            <li style="display: none"><button type="button" class="btn" data-toggle="modal" data-target="#signupmodal">
            Sign Up</button></li>
        </ul>
        @endguest
        @auth('user')
        <ul>
            <li>
                <a href="#" class="btn">
                    {{ \Illuminate\Support\Facades\Auth::guard('user')->user()->first_name }} {{ \Illuminate\Support\Facades\Auth::guard('user')->user()->last_name }}
                </a>
                <a data-widget="control-sidebar" data-slide="true" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" role="button">
                    <i class="fas fa-sign-out-alt" data-toggle="tooltip" title="Logout"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
        @endauth

    </div>
</header>
