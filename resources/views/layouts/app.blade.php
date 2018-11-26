<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SCB</title>

    <!-- Scripts -->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
</head>
<body >
    <div id="app">
            <nav class="navbar" role="navigation" aria-label="main navigation">
                    <div class="navbar-brand">
                      <a class="navbar-item" href="/">
                        SCE
                      </a>
                  
                      <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                        <span aria-hidden="true"></span>
                        <span aria-hidden="true"></span>
                        <span aria-hidden="true"></span>
                      </a>
                    </div>
                  
                    <div id="navbarBasicExample" class="navbar-menu">
                      <div class="navbar-start">

                      </div>
                  
                      <div class="navbar-end">
                        <div class="navbar-item">
                            @guest
                                <div class="buttons">
                                    <a class="button is-light" href="{{ route('login')}}">
                                            {{ __('Iniciar sesion') }}
                                    </a>
                                </div>
                            @else
                                <div class="buttons">
                                    @if(Auth::user()->hasRole('admin'))
                                        @if (Route::has('register'))
                                            <a class="button is-primary" href="{{ route('register') }}">
                                                {{ __('Registrar usuario') }}
                                            </a>
                                        @endif
                                    @endif
                                </div>
                                <div class="navbar-item has-dropdown is-hoverable">
                                        <a class="navbar-link">
                                                {{ Auth::user()->name }} <span class="caret"></span>
                                        </a>
                                
                                        <div class="navbar-dropdown">
                                                <div>
                                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                                            onclick="event.preventDefault();
                                                                            document.getElementById('logout-form').submit();">
                                                            {{ __('Logout') }}
                                                    </a>
                        
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                </div>
                                        </div>
                                </div>
                            @endguest
                        </div>
                      </div>
                    </div>
                  </nav>
       

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <footer class="footer">
            <div class="container">
                <div class="content has-text-centered">
                    <p>
                        <a href="">
                            <i class="fab fa-facebook-square fa-2x">PROYECTO DE SISTEMAS GESTORES DE BASES DE DATOS</i>
                        </a>
                    </p>
                    <p>
                        <a href="">
                            <i class="fab fa-twitter-square fa-2x">RICARDO MANUEL PEREZ PLATA</i>
                        </a>
                    </p>

                    <p>
                        <a href="https://bulma.io">
                            <img src="{{asset('img/myAvatar.png')}}" alt="Developer " width="128" height="24">
                        </a>
                    </p>
                </div>
            </div>
    </footer>
    <script src="{{ elixir('js/app.js') }}"></script> 
</body>
</html>
