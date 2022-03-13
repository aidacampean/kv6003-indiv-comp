<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Travelplanner</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@200;300;400&display=swap" rel="stylesheet">    
</head>
    <body>
        <div id="app">
            <header>
                <div class="header d-flex flex-column flex-md-row align-items-center text-white background pt-3 px-md-4 box-shadow">
                    <h5 class="my-0 mr-md-auto font-weight-normal">TravelPlanner</h5>
                    <nav class="text-white my-2 my-md-0 mr-md-3 pt-2">
                        <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                            <li class="text-white nav-item text-center {{ $section == 'home' ? 'active' : '' }}">
                                <i class="fa-solid fa-house fa-xl"></i>
                                <a href="{{ route('home') }}" class="nav-link">
                                    <!-- <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#home"></use></svg> -->
                                    Home
                                </a>
                            </li>
                            <li class="nav-item text-center text-green {{ $section == 'create-trip' ? 'active' : '' }}">
                                <i class="fa-solid fa-suitcase fa-xl"></i>
                                <a href="{{ route('create-trip') }}" class="nav-link">
                                    <!-- <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#speedometer2"></use></svg>
                                    -->
                                    Plan a Trip
                                </a>
                            </li>
                            <!-- <li>
                            <a href="" class="nav-link">
                                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#table"></use></svg>
                                Trips
                            </a>
                            </li> -->
                            <li class="nav-item text-center dropdown">
                                <i class="fa-solid fa-user fa-xl"></i>
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                User
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#">My Details</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                <a class="dropdown-item text center" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </header>

            <div class="p-5 container-fluid">
                @yield('content')
            </div>
            
        </div>
    </body>
</html>