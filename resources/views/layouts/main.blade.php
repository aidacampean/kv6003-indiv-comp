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

                <div class="d-flex flex-column flex-md-row align-items-center py-1 px-md-4 mb-3 bg-dark text-white box-shadow">
                    <h5 class="my-0 mr-md-auto font-weight-normal">TravelPlanner</h5>
                    <nav class="my-2 my-md-0 mr-md-3">
                        <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                            <li class="nav-item  text-center {{ $section == 'home' ? 'active' : '' }}">
                                <i class="fa-solid fa-house fa-xl"></i>
                                <a href="{{ route('home') }}" class="nav-link">
                                    <!-- <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#home"></use></svg> -->
                                    Home
                                </a>
                            </li>
                            <li class="nav-item text-center {{ $section == 'create-trip' ? 'active' : '' }}">
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
                            <li>
                                 
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                            <a class="ml-auto" href="{{ route('logout') }}" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                            </a>
                        </ul>
                    </nav>
                </div>
            </header>

            <div class="p-5 container">
                @yield('content')
            </div>
            
        </div>
    </body>
</html>