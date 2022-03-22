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


<nav class="navbar navbar-expand-md navbar-dark shadow-sm bg-blue-dark py-10px">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Right Side Of Navbar -->
{{--            <ul class="navbar-nav ml-auto">--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="" class="text-light nav-link">Kaart</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="" class="text-light nav-link">Activiteiten</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="" class="text-light nav-link">Agenda</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="" class="text-light nav-link">Nieuws</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="" class="text-light nav-link">Over Ons</a>--}}
{{--                </li>--}}

{{--                <span class="text-light my-auto mx-3 font-size-100">|</span>--}}

{{--                <!-- Authentication Links -->--}}
{{--                @guest--}}
{{--                    @if (Route::has('register-organisation'))--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link text-light" href="{{ route('register-organisation') }}">Registreren</a>--}}
{{--                        </li>--}}
{{--                    @endif--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link text-light" href="{{ route('login') }}">Inloggen</a>--}}
{{--                    </li>--}}
{{--                @else--}}
{{--                    <li class="nav-item dropdown">--}}
{{--                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                            {{ Auth::user()->firstname }} <span class="caret"></span>--}}
{{--                        </a>--}}

{{--                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}
{{--                            <a class="dropdown-item" href="{{ route('portal.activities') }}">Mijn Activiteiten</a>--}}
{{--                            <a class="dropdown-item" href="{{ route('portal.events') }}">Mijn Evenementen</a>--}}

{{--                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">--}}
{{--                                Uitloggen--}}
{{--                            </a>--}}

{{--                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
{{--                                @csrf--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                @endguest--}}
{{--            </ul>--}}
        </div>
    </div>
</nav>

<main>
    @yield('content')
</main>

</body>
</html>
