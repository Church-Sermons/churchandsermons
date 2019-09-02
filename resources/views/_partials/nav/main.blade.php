<header class="fixed-top w-100">
    @if (app()->environment() == 'testing')
    <div class="env-informer w-100 py-1">
      <div class="container">
        <h4 class="text-center text-bold text-capitalize display-6">
          <i class="fas custom-fa fa-vial"></i> testing mode
        </h4>
      </div>
    </div>
    @endif
    <nav class="navbar navbar-expand-md navbar-light bg-light py-2">
      <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand">
          <img
            src="{{ asset('images/candsedit.png') }}"
            alt="logo"
            height="50"
            width="50"
          />
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
              <a href="#" class="nav-link text-uppercase">
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

{{-- <nav class="navbar is-fixed-top has-shadow" role="navigation" aria-label="main navigation">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="{{ route('home') }}">
                <img src="{{ asset('images/churchandsermons.png') }}" width="112" height="200">
            </a>

            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="appNavbar">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div id="appNavbar" class="navbar-menu">
            <div class="navbar-start">
                <a href="{{ route('organisations.index') }}" class="navbar-item">Organisations</a>
                <a href="#" class="navbar-item">Sermons</a>
                <a href="#" class="navbar-item">Resources</a>
                <a href="{{ route('profiles.index') }}" class="navbar-item">Profiles</a>
            </div>

            <div class="navbar-end">
                @guest
                <a href="{{ route('login') }}" class="navbar-item">
                    Log In
                </a>
                <a href="{{ route('register') }}" class="navbar-item">
                    Register
                </a>

                @else
                <div class="navbar-item has-dropdown is-hoverable">

                    <a href="#" class="navbar-link">
                        Hey {{ Auth::user()->name }}
                    </a>
                    <div class="navbar-dropdown">
                        <a href="#" class="navbar-item">
                            <i class="fas fa-user-circle m-r-5"></i> Profile
                        </a>
                        <a href="#" class="navbar-item">
                            <i class="fas fa-bell m-r-5"></i> Notifications
                        </a>
                        <a href="#" class="navbar-item">
                            <i class="fas fa-cog m-r-5"></i>Settings
                        </a>
                        <hr class="navbar-divider">
                        <a href="{{ route('logout') }}" class="navbar-item" onclick="event.preventDefault();
                                                                            document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt m-r-5"></i> Log Out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <hr class="navbar-divider">
                        @auth
                            @foreach (Auth::user()->organisations as $organisation)
                                <a href="{{ route('organisations.show', $organisation->id) }}" class="navbar-item">
                                    <figure class="image is-32x32 m-r-5">
                                        <img src="{{ asset('/storage/'.$organisation->logo) }}" class="is-rounded" alt="logo-image">
                                    </figure>
                                    <p>{{ $organisation->name }}</p>
                                </a>
                            @endforeach
                        @endauth
                    </div>
                </div>
                @endguest
            </div>
        </div>
    </div>
</nav>
 --}}
