@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/cart.css')}}">
<br>
<div class="container ">
    <h1 class="text">Your Cart</h1>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

    @if ($cartItems->isEmpty())
        <p class="error">Your cart is empty.</p>
        <a href="{{ route('home') }}" class="continueshopping">Continue Shopping</a>
    @else
        <div class="carttable">
            <table class="tb">
                <thead>
                    <tr >
                        <th >Product</th>
                        <th >Price</th>
                        <th >Quantity</th>
                        <th >Total</th>
                        <th >Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $cartItem)
                        <tr>
                            <td >{{ $cartItem->product->name }}</td>
                            <td >${{ number_format($cartItem->product->price, 2) }}</td>
                            <td>
                                <form action="{{ route('cart.decrease', $cartItem) }}" method="POST">
                                    @csrf
                                    <button type="submit" >-</button>
                                </form>
                                <span class="qunatity">{{ $cartItem->quantity }}</span>
                                <form action="{{ route('cart.increase', $cartItem) }}" method="POST">
                                    @csrf
                                    <button type="submit">+</button>
                                </form>
                            </td>
                            <td >${{ number_format($cartItem->product->price * $cartItem->quantity, 2) }}</td>
                            <td >
                                <form action="{{ route('cart.remove', $cartItem) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="total">
            <p >Total: ${{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity), 2) }}</p>
            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <button type="submit">Checkout (Cash on Delivery)</button>
            </form>
        </div>
    @endif
</div> <br>
@endsection
