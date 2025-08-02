@extends('frontend.layout')

@section('content')
    <h2 class="text-xl font-bold mb-4">{{ $category->name }} Products</h2>
    <div class="grid grid-cols-3 gap-4">
        @forelse ($products as $product)
            <div class="border p-4">
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->price }}</p>
            </div>
        @empty
            <p>No products found in this category.</p>
        @endforelse
    </div>
@endsection
