<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts & Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<!-- Top Navbar -->
<nav class="top-navbar">
    
        <a class="brand-logo" href="{{ url('/') }}">ARPhoto</a>
        <div class="bothmenu">
        <span class="user-menu">
            @if (Auth::check())
                <span class="username">Hello, {{ Auth::user()->name }}!</span>
                @if (Auth::user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="admin-link">Dashboard</a>
                @endif
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-btn">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
            @else
                <a href="/login" class="auth-link">Login</a> | <a href="/register" class="auth-link">Register</a>
            @endif
</span>
        <span class="container">
        <ul class="nav-menu">
            <a class="{{ Request::is('/') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
            <a class="{{ Request::is('products*') ? 'active' : '' }}" href="{{ route('products.index') }}">Products</a>
            <a class="{{ Request::is('aboutus') ? 'active' : '' }}" href="{{ route('aboutus') }}">About Us</a>
            <a class="{{ Request::is('contactus') ? 'active' : '' }}" href="{{ route('contactus') }}">Contact Us</a>
            <span class="cart-item">
                @if (Auth::check())
                <a href="{{ route('cart.index') }}" class="cart-link">
                    <i class="fas fa-shopping-cart"> </i> 
                    <span class="cart-count">{{ Auth::user()->cartItems->sum('quantity') }}</span>
                </a>
            @endif
            
            
            </span>
        
        </span>
        </div>
    
</nav>

<!-- Main Navigation Bar -->
<nav class="main-navbar">

<a href="#">All Category</a>
<a href="#">Ultra Premium Package</a>
<a href="#">Semi Premium Package</a>
<a href="#">Premium Package</a>
<a href="#">Micro Package</a>
    
</nav>

<div id="app">
    @yield('content')
</div>

<!-- Footer -->
<footer class="footer">
    <div class="container">
     
        
        <div class="footer-details">
            <div class="footer-column">
                <h5>AR PHOTO STUDIO</h5>
                <p>AR Studio, since 2009, offers wedding, portrait, product photography, event coverage, and more in Kathmandu.</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-tiktok"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="footer-column">
                <h5>Useful Links</h5>
                <a href="#">About Us</a><br>
                <a href="#">Contact Us</a><br>
                <a href="#">Products</a><br>
                <a href="#">Login</a><br>
                <a href="#">Sign Up</a>
            </div>
            <div class="footer-column">
                <h5>More Information</h5>
                <p>Contact us at <a href="mailto:arphoto8@gmail.com">arphoto8@gmail.com</a> or call <b>9849838812</b>.</p>
            </div>
        </div>
        <hr>
        <p>Copyright © 2025 AR Photo Studio - Designed by Navi Infosys</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    
</script>
</body>
</html>