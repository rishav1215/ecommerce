@extends('frontend.layout')

@section('title', 'Cart')

@section('content')
    <div class="container">
        <h2 class="mb-4">Your Shopping Cart</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

        @if(count($cart) > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>SubTotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($cart as $id => $item)
                            @php $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal; @endphp
                            <tr>
                                <td class="align-middle">
                                    <img src="{{ asset('uploads/products/' . $item['image']) }}" width="60" class="img-thumbnail">
                                </td>
                                <td class="align-middle">{{ $item['name'] }}</td>
                                <td class="align-middle">₹{{ number_format($item['price'], 2) }}</td>
                                <td class="align-middle">{{ $item['quantity'] }}</td>
                                <td class="align-middle">₹{{ number_format($subtotal, 2) }}</td>
                                <td class="align-middle">
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end fw-bold">Total:</td>
                            <td colspan="2" class="fw-bold">₹{{ number_format($total, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Continue Shopping
                </a>
                <a href="{{ route('checkout') }}" class="btn btn-primary">
                    Proceed to Checkout <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        @else
            <div class="alert alert-warning">
                <i class="fas fa-shopping-cart me-2"></i> Your cart is empty.
                <a href="{{ route('home') }}" class="alert-link">Start shopping</a>
            </div>
        @endif
    </div>
@endsection