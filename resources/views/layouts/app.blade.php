<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{config('app.name')}} {{ !empty($title) ? ' | ' . $title : ''}}</title>

    <!-- styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-dark shadow-sm bg-blue-dark py-10px">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    @canany(['read/write', 'company'])
                        <li class="nav-item">
                            <a href="{{ route('packages.log') }}" class="text-light nav-link">Register package</a>
                        </li>
                    @endcanany

                    <span class="text-light my-auto mx-3 font-size-100">|</span>

                    @auth
                        <li class="nav-item">
                            <a href="" class="text-light nav-link">Welcome, {{ auth()->user()->first_name }}</a>
                        </li>

                        <form method="POST" action="{{route('logout')}}">
                            @csrf
                            <button type="submit">Log out</button>
                        </form>
                    @else
                        <li class="nav-item">
                            <a href="{{route('login')}}" class="text-light nav-link">Login</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('register')}}" class="text-light nav-link">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
</div>
</body>
</html>
