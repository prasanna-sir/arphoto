<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>
    <h1>Edit Product</h1>
    <form action="/products/{{ $product->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $product->name }}"><br>
        <input type="number" name="price" value="{{ $product->price }}" step="0.01"><br>
        <textarea name="description">{{ $product->description }}</textarea><br>
        <input type="file" name="image"><br>
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="100">
        @else
            <p>No image available</p>
        @endif
        <br>
        <button type="submit">Update</button>
    </form>
    <a href="/products">Back</a>
</body>
</html>