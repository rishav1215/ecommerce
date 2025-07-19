<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Your Shopping Cart</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @php $cart = session('cart', []); @endphp

    @if($cart)
    <table class="table">
        <thead>
            <tr>
                <th>Product</th><th>Quantity</th><th>Price</th><th>Total</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @foreach($cart as $id => $item)
            @php $total = $item['price'] * $item['quantity']; $grandTotal += $total; @endphp
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>
                    <form action="{{ route('cart.update') }}" method="POST" class="d-flex">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" class="form-control w-50">
                        <button class="btn btn-sm btn-primary ms-2">Update</button>
                    </form>
                </td>
                <td>₹{{ $item['price'] }}</td>
                <td>₹{{ $total }}</td>
                <td>
                    <a href="{{ route('cart.remove', $id) }}" class="btn btn-sm btn-danger">Remove</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Total: ₹{{ $grandTotal }}</h4>
    <a href="{{ url('/checkout') }}" class="btn btn-success">Proceed to Checkout</a>
    @else
        <p>Your cart is empty!</p>
    @endif
</div>
</body>
</html>
