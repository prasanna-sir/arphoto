<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="/styles.css">
    <title>Add Product</title>
</head>
<body>
    <h1>Add a Product</h1>
    <form action="/products" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="pname">Product Name</label>
        <input type="text" name="name" placeholder="Product name"><br>
        <label for="pprice">Product Price</label>
        <input type="number" name="price" placeholder="Price" step="0.01"><br>
        <label for="pdesc">Product Description</label>
        <textarea name="description" placeholder="Description"></textarea><br>
        <input type="file" name="image"><br>
        <button type="submit">Save</button>
    </form>
    <a href="/products">Back</a>
    
</body>
</html>