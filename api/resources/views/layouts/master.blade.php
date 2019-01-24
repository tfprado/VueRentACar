<!DOCTYPE html>
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
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a href="/projects" class="nav-link">View Projects</a>
                        </li>
                        <li class="nav-item">
                            <a href="/projects/create" class="nav-link">Create a Project</a>
                        </li>
                        <li class="nav-item">
                            <a href="/scheduler" class="nav-link">Scheduler Demo</a>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost:8000" class="nav-link">October CMS</a>
                        </li>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @if( auth()->check() )
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" href="#">Hi {{ auth()->user()->username }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/logout-kensington">Log Out</a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="/login-kensington">Log In</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/register-kensington">Register</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/telescope">Debug</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
