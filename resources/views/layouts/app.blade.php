<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     @vite(['resources/sass/app.scss'])
</head>
<body class="antialiased">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">ARPhoto</a>
        <div class="navbar-nav">
        @if (Auth::check())
            <p>Hello, {{ Auth::user()->name }}!</p>
            @if (Auth::user()->is_admin)
            <p>you are admin</p>
                <a href="{{ route('products.index') }}" class="custom-button primary-button">Manage Products</a>
            @else
                
            @endif
            <a href="#" class="custom-button link-button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="display-none">
                @csrf
            </form>
        @else
            <a href="/login" class="custom-button link-button">Login</a> | <a href="/register" class="custom-button link-button">Register</a>
        @endif
        </div>
    </div>
    <a href="{{ route('aboutus') }}">About Us</a>
    <a href="{{route('contactus')}}">Contact us</a>
    
</nav>
    <div id="app">
        @yield('content')
    </div>
    
    @vite(['resources/js/app.js'])
</body>
</html>