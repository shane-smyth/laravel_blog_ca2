<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Green Thumb') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-[#FEFAE0] h-screen antialiased leading-none font-sans">
<div id="app">
    <header class="bg-secondary-green py-6 shadow-lg">
        <div class="container mx-auto flex justify-between items-center px-6">
            <div>
                <a href="{{ url('/') }}" class="text-2xl font-bold text-white no-underline hover:text-soft-green transition-colors duration-200">
                    Green Thumb
                </a>
            </div>
            <nav class="space-x-6 text-white text-lg font-medium">
                <a class="no-underline hover:underline hover:text-soft-green transition-colors duration-200" href="/">Home</a>
                <a class="no-underline hover:underline hover:text-soft-green transition-colors duration-200" href="/blog">Blog</a>
                @guest
                    <a class="no-underline hover:underline hover:text-soft-green transition-colors duration-200" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @if (Route::has('register'))
                        <a class="no-underline hover:underline hover:text-soft-green transition-colors duration-200" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                @else
                    <a href="{{ route('account') }}" class="no-underline hover:underline hover:text-soft-green transition-colors duration-200">
                        <span>{{ Auth::user()->name }}</span>
                    </a>

                    <a href="{{ route('logout') }}"
                       class="no-underline hover:underline hover:text-soft-green transition-colors duration-200"
                       onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        {{ csrf_field() }}
                    </form>
                @endguest
            </nav>
        </div>
    </header>

    <div>
        @yield('content')
    </div>

    <div>
        @include('layouts.footer')
    </div>
</div>
</body>
</html>
