<header class="fixed-top w-100">
    @if (app()->environment() == 'testing')
        <div class="env-informer w-100">
            <div class="container h-100">
            <h5 class="text-center text-bold text-capitalize display-6">
                <i class="fas custom-fa fa-vial"></i> testing mode
            </h5>
            </div>
        </div>
    @endif
    <nav class="navbar navbar-expand-md navbar-light bg-light py-2">
        <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand d-flex">
            <img
            src="{{ asset('images/candsedit.png') }}"
            alt="logo"
            height="50"
            width="50"
            class="mr-1"
            />
            <h4 class="font-weight-bold d-flex align-items-center">
                <span>&</span>
                <span class="d-flex flex-column">
                    <span>Church</span>
                    <span>Sermons</span>
                </span>
            </h4>
        </a>

        <button
            class="navbar-toggler"
            data-toggle="collapse"
            data-target="#mainNav"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link text-uppercase">
                Home
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('organisations.index') }}" class="nav-link text-uppercase">
                Organisations
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('sermons.index') }}" class="nav-link text-uppercase">
                Sermons
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('profiles.index') }}" class="nav-link text-uppercase">
                Profiles
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-uppercase">
                Resources
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-uppercase">
                About
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-uppercase">
                Contact
                </a>
            </li>
            @guest
            <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link text-uppercase">
                <i class="fas custom-fa fa-sign-in-alt"></i> Log In
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('register') }}" class="nav-link text-uppercase">
                <i class="fas custom-fa fa-user-plus"></i> Register
                </a>
            </li>
            @else
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        Hello, {{ Auth::user()-> name }}
                    </a>
                    <div class="dropdown-menu">
                        <a href="#" class="nav-link dropdown-item">
                            <i class="fas fa-user-circle mr-1"></i> Profile
                        </a>
                        <a href="#" class="dropdown-item nav-link">
                            <i class="fas fa-cog mr-1"></i> Settings
                        </a>
                        <span class="dropdown-divider"></span>
                        <a href="{{ route('logout') }}" class="nav-link dropdown-item" onclick="event.preventDefault();
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

