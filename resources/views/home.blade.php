@extends('layouts.app')

@section('content')

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
    <head>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    </head>
<!----------------------------------------------------------------------------Hero Sectio -------------------------------------------------->
<div class="hero-section ">
    
    <div class="overlay"></div>

    <div class="container ">
        <div class="left-content">
            <!-- ----------------------------------------------------------------------Left Content--------------------------------------------->
            <div >
                <h1 >PHOTOGRAPHY STUDIO</h1>
                <h4>SINCE 2009</h4>

                <!--------------------------------------------------------------------- Search Bar-------------------------------------------- -->
                <div class="input">
                    <form action="{{ route('home') }}" method="GET">
                        <input type="text" name="search" placeholder="Search by Products" value="{{ request('search') }}">
                        <button type="submit">
                            <i class="fas fa-search"></i> 
                        </button>
                    </form>
                </div>


                <!------------------------------------------------------------------------- Buttons --------------------------------------------->
                <div class="service ">
                    <a href="#" >Printing</a>
                    <a href="#" >Framing</a>
                    <a href="#" >Designing</a>
                </div>
            </div>

            <!------------------------------------------------------------------ Book Now Section (Right) --------------------------------------------------------------------------------------->
            <div class="contact-details">
                <div class="book-now">
                    <h3 >BOOK NOW</h3>
                    <p><i class="fas fa-phone"></i> 9849838812</p>
                    <p><i class="fab fa-whatsapp"></i> Whatsapp</p>
                    <p><i class="fas fa-envelope"></i> arphoto8@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!------------------------------------------------------------------------------------------ Categories Section --------------------------------------------------------------------------------->
{{-- <div class="container my-5">
    <div class="row text-center">
        <div class="col-md-3">
            <div class="p-3 bg-light shadow-sm rounded">
                <h5 class="text-warning">Frame Design</h5>
                <p>We have more than 30 years of experience in frame designing.</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 bg-light shadow-sm rounded">
                <h5 class="text-warning">Photo Design</h5>
                <p>We offer you unique and creative photo design services.</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 bg-light shadow-sm rounded">
                <h5 class="text-warning">Certificate Design</h5>
                <p>We provide professional certificate design services.</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 bg-light shadow-sm rounded">
                <h5 class="text-warning">Canvas/Wall Mural</h5>
                <p>We create customized canvas and wall murals.</p>
            </div>
        </div>
    </div>
</div> --}}

    <h2>Products</h2>

    <!-- Search Form -->
    {{-- <form method="GET" action="{{ route('home') }}" class="mb-4">
        <input type="text" name="search" value="{{ $query ?? '' }}" placeholder="Search by name..." class="border p-2">
        <button type="submit" class="bg-blue-500 text-white p-2">Search</button>
    </form> --}}

  

    @if ($products->isEmpty())
        <p>No products available.</p>
    @else
        <div class="product-list">
            @foreach ($products as $product)
                <div class="product-item">
                    
                    
                    @if ($product->image)
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="product-image">
                    @else
                        <p >No Image</p>
                    @endif
                    <h3 >{{ $product->name }}</h3>
                    <p >Price: ${{ number_format($product->price, 2) }}</p>
                    @if (Auth::check())
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-2">
                            @csrf
                            <button type="submit" >Add to Cart</button>
                        </form>
                    @else
                        <p><a href="{{ route('login') }}">Add to Cart</a></p>
                    @endif
                </div>
            @endforeach
        </div>
      
    @endif

    <!-- <a href="{{ route('products.index') }}">View All Products </a> -->
@endsection