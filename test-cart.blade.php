<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Test - Anti Diet Club</title>
</head>
<body>
    <h1>Cart Test Page</h1>
    <p>Testing cart functionality...</p>
    <ul>
        <li><a href="/cart">View Cart</a></li>
        <li><a href="/cart/checkout">Checkout</a></li>
    </ul>

    <h2>Add to Cart Test Form</h2>
    <form action="/cart/add" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="1">
        <input type="hidden" name="quantity" value="1">
        <button type="submit">Add Product 1 to Cart</button>
    </form>

    <?php if(session('success')): ?>
        <p style="color: green;">{{ session('success') }}</p>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <p style="color: red;">{{ session('error') }}</p>
    <?php endif; ?>
</body>
</html>