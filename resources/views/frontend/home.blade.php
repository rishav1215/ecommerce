@extends('frontend.layout')

@section('title', 'Home')
@section('content')
    <div class="container-fluid">
        <!-- Hero Banner -->
        <div class="row mb-4">
            <div class="container my-5">
                <div class="col-12">
                    <div class="card bg-dark text-white border-0 rounded-4 shadow">
                        <img src="{{ asset('upload/products/banner.avif') }}" class="card-img object-fit-cover" alt="Banner"
                            style="height: 400px; opacity: 0.8;">
                        <div class="card-img-overlay d-flex align-items-center justify-content-center">
                            <div class="text-center">
                                <h1 class="card-title display-3 fw-bold text-uppercase text-shadow">Summer Sale</h1>
                                <p class="card-text lead fs-4 mb-4">Up to <span class="fw-bold text-warning">50% OFF</span>
                                    on selected items</p>
                                <a href="" class="btn btn-lg btn-warning fw-semibold px-5 py-2 shadow-sm">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Categories -->
        {{-- <div class="row mb-4">
            <div class="col-12">
                <h4 class="fw-bold mb-3">Shop by Category</h4>
                <div class="row">
                    <div class="col-md-2 col-6 mb-3">
                        <div class="card h-100">
                            <img src="https://via.placeholder.com/200x150?text=Electronics" class="card-img-top"
                                alt="Electronics">
                            <div class="card-body text-center">
                                <h6 class="card-title">Electronics</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-6 mb-3">
                        <div class="card h-100">
                            <img src="https://via.placeholder.com/200x150?text=Fashion" class="card-img-top" alt="Fashion">
                            <div class="card-body text-center">
                                <h6 class="card-title">Fashion</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-6 mb-3">
                        <div class="card h-100">
                            <img src="https://via.placeholder.com/200x150?text=Home" class="card-img-top" alt="Home">
                            <div class="card-body text-center">
                                <h6 class="card-title">Home</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-6 mb-3">
                        <div class="card h-100">
                            <img src="https://via.placeholder.com/200x150?text=Beauty" class="card-img-top" alt="Beauty">
                            <div class="card-body text-center">
                                <h6 class="card-title">Beauty</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-6 mb-3">
                        <div class="card h-100">
                            <img src="https://via.placeholder.com/200x150?text=Toys" class="card-img-top" alt="Toys">
                            <div class="card-body text-center">
                                <h6 class="card-title">Toys</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-6 mb-3">
                        <div class="card h-100">
                            <img src="https://via.placeholder.com/200x150?text=Sports" class="card-img-top" alt="Sports">
                            <div class="card-body text-center">
                                <h6 class="card-title">Sports</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- All Products -->
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="fw-bold">All Products</h4>
                    <div>
                        <select class="form-select form-select-sm" style="width: auto;">
                            <option>Sort by: Featured</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                            <option>Newest Arrivals</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    @forelse ($products as $product)
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                            <div class="card h-100">
                                @if($product->image)
                                    <img src="{{ asset('uploads/products/' . $product->image) }}" class="card-img-top"
                                        alt="{{ $product->name }}">
                                @else
                                    <img src="https://via.placeholder.com/400x220?text=No+Image" class="card-img-top"
                                        alt="No Image">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-price">₹{{ number_format($product->price, 2) }}</p>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('product.show', $product->id) }}"
                                            class="btn btn-sm btn-outline-primary">View Details</a>
                                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-primary">Add to Cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-warning">No products available.</div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection