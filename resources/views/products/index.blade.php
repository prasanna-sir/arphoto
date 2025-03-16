@extends('layouts.app')

@section('content')
    <h1>Products</h1>

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

    <a href="{{ route('products.create') }}" class="bg-blue-500 text-white p-2 mb-4 inline-block">Add New Product</a>

    <table class="min-w-full bg-white border">
        <thead>
            <tr class="bg-gray-100 border-b">
                <th class="py-2 px-4 border-r">Name</th>
                <th class="py-2 px-4 border-r">Price</th>
                <th class="py-2 px-4 border-r">Image</th>
                <th class="py-2 px-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr class="border-b">
                    <td class="py-2 px-4 border-r">{{ $product->name }}</td>
                    <td class="py-2 px-4 border-r">{{ $product->price }}</td>
                    <td class="py-2 px-4 border-r">
                        @if ($product->image)
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="product-image">
                        @else
                            No Image
                        @endif
                    </td>
                    <td class="py-2 px-4">
                        <a href="{{ route('products.show', $product) }}" class="text-blue-500 mr-2">View</a>
                        <a href="{{ route('products.edit', $product) }}" class="text-blue-500 mr-2">Edit</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;" class="mr-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination is commented out -->
    {{-- {{ $products->links() }} --}}

    <a href="{{ route('home') }}" class="bg-blue-500 text-white p-2 mt-4 inline-block">Back to Homepage</a>
@endsection