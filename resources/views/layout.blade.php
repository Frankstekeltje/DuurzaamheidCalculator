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

        @yield('body')

        {{-- <footer class="page-footer fixed-bottom font-small bg-dark text-white pt-4">
            <div class="container-fluid text-center text-md-left">
                <div class="row">
                    <div class="col-sm-6 col-md-8">
                        <h5 class="text-uppercase">Footer Content</h5>
                        <p>Here you can use rows and columns to organize your footer content.</p>
                    </div>
                    <hr class="clearfix w-100 d-md-none pb-3">
                    <div class="col-6 col-md-4">
                        <h5 class="text-uppercase">Links</h5>
                        <ul class="list-unstyled">
                            <li>
                                <a href="{{ route('welcome') }}">home</a>
                            </li>
                            <li>
                                <a href="{{ route('overons') }}">overons</a>
                            </li>
                            <li>
                                <a href="{{ route('contact') }}">contact</a>
                            </li>
                            <li>
                                <a href="{{ route('login') }}">Inloggen</a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}">Registeren</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-copyright text-center py-3">© 2020 Copyright
            </div>
        </footer> --}}

        <script>
            @yield('script')
        </script>
    </body>
</html>
