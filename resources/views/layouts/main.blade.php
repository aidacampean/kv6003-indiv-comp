<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TravelPlanner</title>

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
                    <h5 class="nav-link my-0 mr-md-auto font-weight-normal site-title">
                        <a href="{{ route('home') }}">
                            <span class="highlight-text">T</span>ravel<span class="highlight-text">P</span>lanner
                        </a>
                    </h5>
                    <nav class="text-white my-2 my-md-0 mr-md-3 pt-2">
                        <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                            <li class="text-white nav-item text-center {{ $section == 'home' ? 'active' : '' }}">
                                <i class="fa-solid fa-house fa-xl mt-4"></i>
                                <a href="{{ route('home') }}" class="nav-link">
                                    <!-- <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#home"></use></svg> -->
                                    Home
                                </a>
                            </li>
                            <li class="nav-item text-center {{ $section == 'create-trip' ? 'active' : '' }}">
                                <i class="fa-solid fa-suitcase fa-xl mt-4"></i>
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
                                <i class="fa-solid fa-user fa-xl mt-4"></i>
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->username }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item text-secondary {{ $section == 'my-account' ? 'active' : '' }}" href="{{ route('my-account') }}">My Account</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                <a class="dropdown-item text-secondary " href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </header>

            <div class="p-5 container-fluid">
                {{ Breadcrumbs::render() }}
                @yield('content')
            </div>
        </div>
    </body>
</html>