<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@if (Auth::check())
    <p>Hello, {{ Auth::user()->name }}!</p>
  
    <h1>Contact Us</h1>
    <form method="POST" action="{{ route('contactus.store') }}">
        @csrf 
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <textarea name="message" placeholder="Message" required></textarea>
        <button type="submit">Send</button></form>.




    @else
    <p> login to continue </p>
    <a href="/login" class="custom-button link-button">Login</a> | <a href="/register" class="custom-button link-button">Register</a>
    @endif
</body>
</html>