<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="./"><img class="d-inline-block" src="images/tjulogo.png" width="100"
                alt="logo" /><span class="fw-bold text-primary ms-2"></span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span> Menu
        </button>


        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ Request::is('/') ? 'active ' : '' }}"><a href="/" class="nav-link">Home</a>
                </li>
                <li class="nav-item {{ Request::is('about') ? 'active ' : '' }}"><a href="/about"
                        class="nav-link">About</a></li>
                <li class="nav-item {{ Request::is('pesantiket') ? 'active ' : '' }}"><a href="/pesantiket"
                        class="nav-link">Pesan Ticket</a></li>
                <li class="nav-item {{ Request::is('contact') ? 'active ' : '' }}"><a href="/contact"
                        class="nav-link">Contact</a></li>
                @auth
                <li class="nav-item d-flex align-items-center {{ Request::is('dashboard') ? 'active' : '' }}">
                    <a href="/users/{{ Auth::id() }}" class="nav-link d-flex align-items-center" style="{{ Request::is('users*') ? 'color: white' : '' }}">
                        @if (Auth::check() && Auth::user()->image && file_exists(public_path(Auth::user()->image)))
                            <img src="{{ asset(Auth::user()->image) }}" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover; margin-right: 8px;" alt="{{ Auth::user()->name }}">
                        @else
                            <img src="{{ asset('images/default.png') }}" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover; margin-right: 8px;" alt="{{ Auth::user()->name }}">
                        @endif
                        <span>{{ Auth::user()->name }}</span>
                    </a>
                </li>

                @else
                    <li class="nav-item {{ Request::is('register') ? 'active ' : '' }}"><a href="/register"
                            class="nav-link">Register</a></li>
                    <li class="nav-item {{ Request::is('login') ? 'active ' : '' }}"><a href="/login"
                            class="nav-link">Login</a></li>
                @endauth

            </ul>
        </div>
    </div>
</nav>