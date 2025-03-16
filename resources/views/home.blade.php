@extends('layouts.app')

@section('content')
    <h1>Welcome to Arphoto</h1>

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

    <h2>Products</h2>

    <!-- Search Form -->
    <form method="GET" action="{{ route('home') }}" class="mb-4">
        <input type="text" name="search" value="{{ $query ?? '' }}" placeholder="Search by name..." class="border p-2">
        <button type="submit" class="bg-blue-500 text-white p-2">Search</button>
    </form>

    @if (Auth::check())
        <a href="{{ route('cart.index') }}" class="bg-green-500 text-white p-2 mb-4 inline-block">View Cart</a>
    @endif

    @if ($products->isEmpty())
        <p>No products available.</p>
    @else
        <div class="product-list grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($products as $product)
                <div class="product-item border rounded p-4 shadow">
                    <h3 class="text-xl font-bold">{{ $product->name }}</h3>
                    <p class="text-gray-600">Price: ${{ number_format($product->price, 2) }}</p>
                    @if ($product->image)
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="product-image">
                    @else
                        <p class="text-gray-500">No Image</p>
                    @endif
                    @if (Auth::check())
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-2">
                            @csrf
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add to Cart</button>
                        </form>
                    @else
                        <p class="text-gray-500 mt-2"><a href="{{ route('login') }}" class="text-blue-500">Add to Cart</a></p>
                    @endif
                </div>
            @endforeach
        </div>
      
    @endif

    <!-- <a href="{{ route('products.index') }}">View All Products </a> -->
@endsection