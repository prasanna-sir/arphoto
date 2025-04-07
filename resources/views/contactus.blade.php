@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

    <div class="container">
        @if (Auth::check())
            <p style="color:black;">Hello, {{ Auth::user()->name }}!</p>
            
            <h1>Contact Us</h1>
            <div class="contact-wrapper">
                <!-- Contact Form -->
                <form method="POST" action="{{ route('contactus.store') }}" class="contact-form">
                    @csrf
                    <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    
                    <textarea name="message" placeholder="Message" required>{{ old('message') }}</textarea>
                    @error('message')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    
                    <button type="submit">Send</button>
                </form>

                <!-- Google Map -->
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3002.3169837848327!2d85.33292947462922!3d27.746424573768333!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1949f3159e3d%3A0x159b9c3ea2b057d6!2sNarayani%20Nursery%2C%20Basundhara%2C%20Dhapasi%20Marg%2C%20Kathmandu%2044600!5e1!3m2!1sen!2snp!4v1742535379693!5m2!1sen!2snp" >
               
                    </iframe>
                </div>
            </div>
        @else
        <div class="contactauth">
            <p style="color:black;">Login to continue</p>
            <a href="{{ route('login') }}" class="custom-button link-button">Login</a> 
            <a href="{{ route('register') }}" class="custom-button link-button">Register</a>
            </div>
        @endif
    </div>
@endsection