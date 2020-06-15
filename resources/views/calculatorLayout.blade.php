<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}" defer></script>
        @yield('head')
    </head>
    <body>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            @guest
            @if(Route::has('register'))
            <ul class="navbar-nav">
                <li class="nav-item {{ Request::path() === '/' ? 'active' : null }}">
                    <a class="nav-link" href="{{ route('welcome') }}">Home</a>
                </li>
                <li class="nav-item {{ Request::path() === 'overons' ? 'active' : ''}}">
                    <a class="nav-link" href="{{ route('overons') }}">Over ons</a>
                </li>
                <li class="nav-item {{ Request::path() === 'contact' ? 'active' : ''}}">
                    <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                </li>
            </ul>
            @endif
            @else
                    <ul class="navbar-nav">
                        <li class="nav-item {{ Request::path() === '/' ? 'active' : null }}">
                            <a class="nav-link" href="{{ route('welcome') }}">Home</a>
                        </li>
                        <li class="nav-item {{ Request::path() === 'visualisatie' ? 'active' : null }}">
                            <a class="nav-link" href="{{ route('visualisatie') }}">Visualisatie</a>
                        </li>
                        <li class="nav-item {{ Request::path() === 'overons' ? 'active' : ''}}">
                            <a class="nav-link" href="{{ route('overons') }}">Over ons</a>
                        </li>
                        <li class="nav-item {{ Request::path() === 'contact' ? 'active' : ''}}">
                            <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                        </li>
                    </ul>
            @endguest
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item {{ Request::path() === 'login' ? 'active' : ''}}">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Inloggen') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item {{ Request::path() === 'register' ? 'active' : ''}}">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registreren') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </nav>


        <div class="d-flex" id="wrapper">

            <!-- Sidebar -->
            <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading">Calculator selecteren</div>
            <div class="list-group list-group-flush">
                <a href="../../calculator/muur" class="list-group-item list-group-item-action bg-light">Muur</a>
                <a href="../../calculator/plafond" class="list-group-item list-group-item-action bg-light">Plafond</a>
                <a href="../../calculator/vloer" class="list-group-item list-group-item-action bg-light">Vloer</a>
                <a href="../../calculator/ruimte" class="list-group-item list-group-item-action bg-light">Ruimte</a>
                <a href="../../calculator/gebouw" class="list-group-item list-group-item-action bg-light">Gebouw</a>
                <a href="../../calculator" class="list-group-item list-group-item-action bg-light">Overzicht</a>
            </div>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">

            <div class="container-fluid">
                @yield('body')
            </div>
            </div>
            <!-- /#page-content-wrapper -->

        </div>
        <script>
            @yield('script')
        </script>
    </body>
</html>

