@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <div class="hero-section" style="background-color: #111; padding: 80px 0;">
        <h6>ADMIN</h6>
        <h1>Dashboard</h1>

        <!-- Navigation Links -->
        <div class="nav-links" style="text-align: center; margin-top: 20px;">
            <a href="#products" class="nav-link">Product Details</a>
            <a href="#orders" class="nav-link">Order Details</a>
            <a href="#contacts" class="nav-link">Contact Details</a>
        </div>
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

        <!-- Products Section -->
        <div id="products">
            <h2>Products</h2>
            <a href="{{ route('products.create') }}" class="btn-add">Add New Product</a>
            <table class="dashboard-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>${{ number_format($product->price, 2) }}</td>
                            <td>
                                @if ($product->image)
                                    <img src="{{ Storage::url($product->image) }}" class="product-image" alt="{{ $product->name }}">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('products.edit', $product) }}" class="btn-edit">Edit</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Orders Section -->
        <div id="orders">
            <h2>Orders</h2>
            <table class="dashboard-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user ? $order->user->name : 'Unknown User' }}</td>
                            <td>${{ number_format($order->total, 2) }}</td>
                            <td>{{ $order->status }}</td>
                            <td>
                                <form action="{{ route('orders.update', $order) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    </select>
                                </form>
                            </td>
                            <!-- <td><form action="{{ route('products.destroy', $product) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                </form></td> -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Contact Messages Section -->
        <div id="contacts">
            <h2>Contact Messages</h2>
            <table class="dashboard-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->message }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Back to Top Button -->
        <button id="backToTop" class="back-to-top" onclick="scrollToTop()">Scroll To Top</button>
    </div>

    <!-- JavaScript for Smooth Scrolling for nav links like product details, contact details etc -->
    <script>
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const sectionId = this.getAttribute('href').substring(1);
                const section = document.getElementById(sectionId);
                if (section) {
                    section.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        // JavaScript for Back to Top Button
        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Show/Hide Back to Top Button on Scroll
        window.addEventListener('scroll', function () {
            const backToTopButton = document.getElementById('backToTop');
            if (window.scrollY > 300) { // Show button after scrolling 300px
                backToTopButton.style.display = 'block';
            } else {
                backToTopButton.style.display = 'none';
            }
        });
    </script>
@endsection