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
    <body class="has-navbar-fixed-top">
        <nav class="navbar is-danger is-fixed-top" role="navigation" aria-label="main navigation">
            @guest
                @if(Route::has('register'))

                    <div class="navbar-menu">
                        <div class="navbar-start">
                            <a class="navbar-item" href="{{ route('welcome') }}">Home</a>
                            <a class="navbar-item" href="{{ route('overons') }}">Over ons</a>
                            <a class="navbar-item" href="{{ route('contact') }}">Contact</a>
                        </div>

                    </div>
                @endif
            @else
                <div class="navbar-menu" >
                    <div class="navbar-start">
                        <a class="navbar-item" href="{{ route('calculator') }}">calculator</a>
                        <a class="navbar-item" href="{{ route('calculator') }}">overzicht</a>
                        <a class="navbar-item" href="{{ route('cms') }}">cms</a>
                        <a class="navbar-item" href="{{ route('contact') }}">contact</a>
                    </div>
                </div>
            @endguest
            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        @guest
                            <a class="button is-danger is-light" href="{{ route('login') }}">{{ __('Inloggen') }}</a>
                            @if (Route::has('register'))
                                <a class="button is-danger is-light" href="{{ route('register') }}">{{ __('Registreren') }}</a>
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
                    </div>
                </div>
            </div>
        </nav>

        <div class="section">
            <div class="columns is-1">
                <div class="column is-one-quarter">
                    <aside class="menu">

                        <!-- Sidebar -->
                        <p class="menu-label">
                            Calculator selecteren
                        </p>
                        <ul class="menu-list">
                            <li><a href="../../calculator/muur" >Muur</a></li>
                            <li><a href="../../calculator/plafond" >Plafond</a></li>
                            <li><a href="../../calculator/vloer" >Vloer</a></li>
                            <li><a href="../../calculator/ruimte" >Ruimte</a></li>
                            <li><a href="../../calculator/gebouw" >Gebouw</a></li>
                        </ul>
                        <p class="menu-label">
                            Gecreëerd
                        </p>
                        <ul class="menu-list">
                            <li><a href="/calculator">Overzicht</a></li>
                        </ul>
                        <!-- /#sidebar-wrapper -->
                    </aside>
                </div>
                    <!-- Page Content -->
                    <div class="column is-three-quarters">
                        @yield('body')
                    </div>
                    <!-- /#page-content-wrapper -->
                    <script>
                        @yield('script')
                    </script>
            </div>
        </div>
    </body>
</html>

