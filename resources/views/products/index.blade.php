@extends('layouts.app')

@section('title', 'Products')

<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    
    @stack('styles')
</head>

@section('content')
    <!-- Hero Section -->
    <div class="hero-section" style="background-color: #111; padding: 80px 0;">
        <h6>HOME / PRODUCTS</h6>
        <h1>Products</h1>
    </div>

    <div class="container-content">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <h6>
            Showing {{ $products->firstItem() }} of {{ $products->total() }} results
        </h6> <br>

        <div class="product"> 
            @foreach ($products as $product)
                <div class="product-item">
                    
                        <a href="{{ route('products.show', $product) }}">
                            <img src="{{ $product->image ? Storage::url($product->image) : asset('images/default.jpg') }}" class="img-fluid mb-3" alt="{{ $product->name }}">
                        </a>
                        <h5>{{ $product->name }}</h5>
                        <p>${{ number_format($product->price, 2) }}</p>

                        <!-- Add to Cart: Requires login -->
                        @if (Auth::check())
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-2">
                                @csrf
                                <button type="submit">Add to Cart</button>
                            </form>
                        @else
                            <p>
                                <a href="{{ route('login') }}">Add to Cart</a>
                            </p>
                        @endif

                        <!-- Edit/Delete: Only for logged-in admins -->
                        <!-- @if (Auth::check() && Auth::user()->is_admin)
                            <div class="auth">
                                <a href="{{ route('products.edit', $product) }}">Edit</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        @endif
                     -->
                </div>
            @endforeach

            
        </div>
    </div>
@endsection