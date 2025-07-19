<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Checkout</h2>

    <div class="card mb-4">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('uploads/products/' . $product->image) }}" class="img-fluid rounded-start" alt="{{ $product->name }}">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->description }}</p>
                    <p class="card-text fw-bold text-success">₹{{ $product->price }}</p>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('checkout.place') }}">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <input type="text" name="address" placeholder="Shipping Address" class="form-control mb-2" required>
        <input type="text" name="city" placeholder="City" class="form-control mb-2" required>
        <input type="text" name="pin" placeholder="PIN Code" class="form-control mb-3" required>
        <button class="btn btn-success w-100 py-2">Place Order</button>
    </form>
</div>
</body>
</html>
