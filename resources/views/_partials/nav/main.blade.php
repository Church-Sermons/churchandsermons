<nav class="navbar is-fixed-top has-shadow" role="navigation" aria-label="main navigation">
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

