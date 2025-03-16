<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - ARPhoto</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
                @error('password')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <div>
                <button type="submit">Login</button>
            </div>
        </form>
    </div>
</body>
</html>