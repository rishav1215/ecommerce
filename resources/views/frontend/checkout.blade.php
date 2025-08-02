<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Place Order</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Font Awesome for icons --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body>

    <div class="container py-5">
        <h2 class="mb-4 text-center">🧾 Place Your Order</h2>

        <div class="row g-4">
            {{-- Left: Customer Form --}}
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Customer Details</h5>
                        <form action="{{ route('order.place') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" name="phone" required>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Shipping Address</label>
                                <textarea class="form-control" name="address" rows="3" required></textarea>
                            </div>

                            <form action="{{ route('order.place') }}" method="POST">
                                @csrf
                                @if(isset($product))
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                @endif
                            <button class="btn btn-success">place order</button>
                            </form>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Right: Cart Summary --}}
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Order Summary</h5>

                        @php $total = 0; @endphp
                        @if(isset($cart))
                            {{-- Cart Checkout --}}
                            @foreach($cart as $productId => $item)
                                @php
                                    $product = \App\Models\Product::find($productId);
                                    $quantity = $item['quantity'] ?? 1;
                                    $subtotal = $product->price * $quantity;
                                    $total += $subtotal;
                                @endphp

                                <div class="d-flex justify-content-between border-bottom py-2">
                                    <div>
                                        <strong>{{ $product->name }}</strong>
                                        <div class="text-muted small">Qty: {{ $quantity }}</div>
                                    </div>
                                    <div>₹{{ number_format($subtotal, 2) }}</div>
                                </div>
                            @endforeach
                        @elseif(isset($product))
                            {{-- Single Product Checkout --}}
                            @php
                                $quantity = 1;
                                $subtotal = $product->price * $quantity;
                                $total = $subtotal;
                            @endphp
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <div>
                                    <strong>{{ $product->name }}</strong>
                                    <div class="text-muted small">Qty: {{ $quantity }}</div>
                                </div>
                                <div>₹{{ number_format($subtotal, 2) }}</div>
                            </div>
                        @endif

                        <div class="d-flex justify-content-between mt-3 fw-bold fs-5">
                            <span>Total:</span>
                            <span>₹{{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>