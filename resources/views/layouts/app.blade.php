<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('images/emdn.png') }}" type="image/x-icon">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('/images/emdn.png') }}" width="20" height="25" class="d-inline-block align-top" alt="">
                    {{ config('app.name', 'MINDEF') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if (Auth::user()->hasRole('Administrador'))
                                        <a class="dropdown-item" href="{{route('eventos.index')}}">
                                            Admin
                                        </a>
                                        <a class="dropdown-item" href="{{route('eventos.validar')}}">
                                            Verificar QR
                                        </a>

                                    @endif

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
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="alert alert-info alert-dismissible">
                        Si tiene algún inconveniente en el registro o generación de código QR, favor de comunicarse a los números siguientes:
                        <ul>
                            <li><span class="font-weight-bold">DIRECCIÓN DE RELACIONES CIVILES Y MILITARES:</span> 4497-4119, 4497-4118</li>
                            <li><span class="font-weight-bold">COMANDO DE INFORMÁTICA Y TECNOLOGÍA:</span> 44974318 </li>
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            @yield('banner')
            <div class="row">
                <div class="py-2 mt-2 col-12">
                    @yield('botones')

                </div>
                <main class="py-1 mt-2 col-12">
                    @yield('content')
                </main>
            </div>
        </div>
        @yield('modal')
        <footer class="container text-center mt-0">
            <div class="row justify-content-center">
                <div class="col-12 lead" style="font-size: .8rem">Comando de Informática y Tecnología {{ date('Y') }} &copy;</div>
            </div>
        </footer>
    </div>

    @yield('scripts')
    <script src="https://kit.fontawesome.com/aa8c0a31ec.js" crossorigin="anonymous"></script>

</body>
</html>
