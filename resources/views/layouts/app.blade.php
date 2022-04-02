<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{config('app.name')}} {{ !empty($title) ? ' | ' . $title : ''}}</title>

    <!-- styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="{{asset('js/app.js')}}" defer></script>
</head>
<body>
<nav class="shadow-lg mainNav">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex justify-between">
            <div class="flex md:flex items-center space-x-1">
                <div>
                    <a href="{{route('home')}}" class="py-4 px-2 text-blue-500 font-semibold">Home</a>
                </div>
            </div>
            <div class="hidden md:flex items-center space-x-1">
                @canany(['read/write', 'company'])
                    <a href="{{ route('packages.log') }}"
                       class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300">Register
                        package</a>
                @endcanany
                @can('read/write')
                    <a href="{{ route('packages.labels') }}"
                       class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300">Labels</a>
                    <a href="{{ route('packages.labels.print') }}"
                       class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300">Print
                        labels</a>
                @endcan

                @auth
                    <a href=""
                       class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300">Welcome, {{ auth()->user()->first_name }}</a>

                    <form method="POST" action="{{route('logout')}}">
                        @csrf
                        <button type="submit"
                                class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300">
                            Log out
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300">Login</a>
                    <a href="{{ route('register') }}"
                       class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300">Register</a>
                @endauth
            </div>
            <div class="mr-10 flex md:hidden">
                <button class="inline-flex items-center justify-center p-2 rounded-md text-dark">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em"
                         width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path d="M32 96v64h448V96H32zm0 128v64h448v-64H32zm0 128v64h448v-64H32z">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
<main class="mb-1">
    @yield('content')
</main>
</body>
</html>
