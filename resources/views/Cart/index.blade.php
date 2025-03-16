@extends('layouts.app')

@section('content')
    <h1>Your Cart</h1>

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

    @if ($cartItems->isEmpty())
        <p>Your cart is empty.</p>
    @else
        <table class="min-w-full bg-white border">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="py-2 px-4 border-r">Product</th>
                    <th class="py-2 px-4 border-r">Price</th>
                    <th class="py-2 px-4 border-r">Quantity</th>
                    <th class="py-2 px-4 border-r">Total</th>
                    <th class="py-2 px-4">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $cartItem)
                    <tr class="border-b">
                        <td class="py-2 px-4 border-r">{{ $cartItem->product->name }}</td>
                        <td class="py-2 px-4 border-r">${{ number_format($cartItem->product->price, 2) }}</td>
                        <td class="py-2 px-4 border-r">
                            <form action="{{ route('cart.decrease', $cartItem) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit">-</button>
                            </form>
                            {{ $cartItem->quantity }}
                            <form action="{{ route('cart.increase', $cartItem) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit">+</button>
                            </form>
                        </td>
                        <td class="py-2 px-4 border-r">${{ number_format($cartItem->product->price * $cartItem->quantity, 2) }}</td>
                        <td class="py-2 px-4">
                            <form action="{{ route('cart.remove', $cartItem) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500" onclick="return confirm('Are you sure?')">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            <p class="text-xl font-bold">Total: ${{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity), 2) }}</p>
            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-green-500 text-white p-2 mt-2">Checkout (Cash on Delivery)</button>
            </form>
        </div>
    @endif

    <a href="{{ route('home') }}" class="bg-blue-500 text-white p-2 mt-4 inline-block">Continue Shopping</a>
@endsection