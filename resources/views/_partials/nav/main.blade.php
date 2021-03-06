<header class="fixed-top w-100">
    {{-- @if (app()->environment() == 'testing')
        <div class="env-informer w-100">
            <div class="container h-100">
            <h5 class="text-center text-bold text-capitalize display-6">
                <i class="fas custom-fa fa-vial"></i> testing mode
            </h5>
            </div>
        </div>
    @endif --}}
    <nav class="navbar navbar-expand-md navbar-light py-0">
        <div class="container align-items-center py-0">
        <a href="{{ route('home') }}" class="navbar-brand d-flex">
            <span class="d-inline" style="width: 150px;height: 70px;">
                <img
                src="{{ asset('images/app/logo.png') }}"
                alt="logo"
                class="w-100 h-100"
                />
            </span>
        </a>

        <button
            class="navbar-toggler"
            data-toggle="collapse"
            data-target="#mainNav"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ml-auto d-flex align-items-center">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link text-uppercase {{ Nav::isRoute('home', 'nav-link-active') }}">
                    Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('organisations.index') }}" class="nav-link text-uppercase {{ Nav::isResource('organisations', NULL ,'nav-link-active') }}">
                    Organisations
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('sermons.index') }}" class="nav-link text-uppercase {{ Nav::isResource('sermons', NULL, 'nav-link-active') }}">
                    Sermons
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('profiles.index') }}" class="nav-link text-uppercase {{ Nav::isResource('profiles', NULL,'nav-link-active') }}">
                    Profiles
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link text-uppercase">
                    Resources
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route('about') }}" class="nav-link text-uppercase {{ Nav::isRoute('about', 'nav-link-active') }}">
                    About
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contact') }}" class="nav-link text-uppercase {{ Nav::isRoute('contact', 'nav-link-active') }}">
                    Contact
                    </a>
                </li>
                @guest
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link text-uppercase {{ Nav::isRoute('login', 'nav-link-active') }}">
                    <i class="fas custom-fa fa-sign-in-alt"></i> Log In
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link text-uppercase {{ Nav::isRoute('register', 'nav-link-active') }}">
                    <i class="fas custom-fa fa-user-plus"></i> Register
                    </a>
                </li>
                @else
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        @if (Auth::user()->profile_image)
                            <img src="{{ asset('storage/'.Auth::user()->profile_image) }}" alt="user-avatar" width="30" height="30" class="rounded-circle mr-1">
                        @else
                            <h6 class="p-2 d-inline text-center bg-info font-weight-bold rounded-circle mr-1">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)).strtoupper(substr(Auth::user()->surname, 0, 1)) }}
                            </h6>
                        @endif
                        Hello, {{ Auth::user()-> name }}
                    </a>
                    <div class="dropdown-menu dropdown-profile dropdown-menu-right">
                        <a href="{{ route('user.profile.index') }}" class="dropdown-item">
                            <i class="fas fa-user-circle mr-1"></i> Profile
                        </a>

                        {{-- <div class="dropdown-divider"></div> --}}

                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                                                                        document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt mr-1"></i> Log Out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
            </ul>
        </div>
        </div>
    </nav>
</header>
