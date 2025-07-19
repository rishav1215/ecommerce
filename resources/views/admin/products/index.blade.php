@extends('admin.layout')

@section('content')
    <h2>All Products</h2>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-2">Add New</a>
  <table class="table table-bordered">
    <tr><th>ID</th><th>Image</th><th>Title</th><th>Price</th><th>Action</th></tr>
    @foreach($products as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>
            @if($product->image)
                <img src="{{ asset('uploads/products/' . $product->image) }}" width="50">
            @endif
        </td>
        <td>{{ $product->name }}</td>
        <td>₹{{ $product->price }}</td>
        <td>
            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline-block">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection
