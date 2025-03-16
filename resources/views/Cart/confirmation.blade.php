@extends('layouts.app')

@section('content')
    <h1>Order Confirmation</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <p>Thank you for your order! Your total is ${{ number_format($order->total, 2) }}.</p>
    <p>Payment Method: Cash on Delivery</p>
    <p>Status: {{ $order->status }}</p>
    <p>We will contact you for delivery details. <a href="{{ route('home') }}">Continue Shopping</a></p>
@endsection