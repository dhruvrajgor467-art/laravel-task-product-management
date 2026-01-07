<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">MyApp</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('show.login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('show.register') }}">Register</a>
                    </li>
                @else
                    <li class="nav-item">
                        <span class="nav-link">Hi, {{ Auth::user()->name }}</span>
                    </li>

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-link nav-link">Logout</button>
                        </form>
                    </li>
                @endguest

            </ul>
        </div>
    </div>
</nav>
