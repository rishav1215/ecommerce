@extends('frontend.layout')

@section('title', 'Search Results')

@section('content')
<div class="container">
    <h3 class="mb-4">Search Results for: "{{ $query }}"</h3>

    @if($products->count())
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('uploads/products/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-price">₹{{ number_format($product->price, 2) }}</p>
                            <a href="{{ route('product.show', $product->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-warning">
            No products found matching your search.
        </div>
    @endif
</div>
@endsection
