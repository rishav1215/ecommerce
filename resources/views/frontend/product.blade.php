@extends('frontend.layout')

@section('title')
@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="card product-detail-card shadow-sm">
        <div class="row g-0">
            <!-- Product Images Gallery -->
            <div class="col-lg-6">
                <div class="product-gallery p-3">
                    <!-- Main Image -->
                    <div class="main-image mb-3 border rounded-3 overflow-hidden">
                        @if($product->image)
                            <img src="{{ asset('uploads/products/' . $product->image) }}" 
                                 class="img-fluid w-100" 
                                 id="mainProductImage" 
                                 alt="{{ $product->name }}"
                                 style="max-height: 500px; object-fit: contain;">
                        @else
                            <img src="https://via.placeholder.com/800x800?text=No+Image+Available" 
                                 class="img-fluid w-100" 
                                 id="mainProductImage" 
                                 alt="No Image"
                                 style="max-height: 500px; object-fit: contain;">
                        @endif
                    </div>
                    
                    <!-- Thumbnails -->
                    <div class="thumbnail-gallery d-flex flex-wrap gap-2">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 class="thumbnail-img active" 
                                 onclick="changeMainImage(this)"
                                 style="width: 80px; height: 80px; object-fit: cover; cursor: pointer; border: 2px solid #4e73df;">
                        @endif
                        <!-- Sample additional images - replace with your actual images -->
                        <img src="https://via.placeholder.com/200x200?text=Product+Angle" 
                             class="thumbnail-img" 
                             onclick="changeMainImage(this)"
                             style="width: 80px; height: 80px; object-fit: cover; cursor: pointer; border: 1px solid #ddd;">
                        <img src="https://via.placeholder.com/200x200?text=Close+Up" 
                             class="thumbnail-img" 
                             onclick="changeMainImage(this)"
                             style="width: 80px; height: 80px; object-fit: cover; cursor: pointer; border: 1px solid #ddd;">
                        <img src="https://via.placeholder.com/200x200?text=Package" 
                             class="thumbnail-img" 
                             onclick="changeMainImage(this)"
                             style="width: 80px; height: 80px; object-fit: cover; cursor: pointer; border: 1px solid #ddd;">
                    </div>
                </div>
            </div>
            
            <!-- Product Details -->
            <div class="col-lg-6">
                <div class="product-info p-4">
                    <h1 class="product-title mb-2">{{ $product->name }}</h1>
                    
                    <!-- Rating and Reviews -->
                    <div class="d-flex align-items-center mb-3">
                        <div class="rating-stars text-warning me-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="text-muted me-3">4.5 (24 reviews)</span>
                        <span class="text-success">
                            <i class="fas fa-check-circle"></i> In Stock
                        </span>
                    </div>
                    
                    <!-- Price -->
                    <div class="product-price mb-4">
                        <span class="current-price text-primary fw-bold fs-3">₹{{ number_format($product->price, 2) }}</span>
                        @if($product->original_price)
                            <span class="original-price text-muted text-decoration-line-through ms-2">₹{{ number_format($product->original_price, 2) }}</span>
                            <span class="discount-badge bg-danger text-white px-2 py-1 rounded ms-2 small">
                                {{ round(100 - ($product->price / $product->original_price * 100)) }}% OFF
                            </span>
                        @endif
                    </div>
                    
                    <!-- Highlights -->
                    <div class="product-highlights mb-4">
                        <h5 class="section-title">Key Features</h5>
                        <ul class="list-unstyled">
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i> Premium quality materials</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i> 1-year manufacturer warranty</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i> Free shipping on orders over ₹500</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i> Easy returns within 15 days</li>
                        </ul>
                    </div>
                    
                    <!-- Color Options (if applicable) -->
                    <div class="color-options mb-4">
                        <h5 class="section-title">Color</h5>
                        <div class="d-flex gap-2">
                            <div class="color-circle active" style="background-color: #4e73df;" title="Blue"></div>
                            <div class="color-circle" style="background-color: #000000;" title="Black"></div>
                            <div class="color-circle" style="background-color: #e74a3b;" title="Red"></div>
                            <div class="color-circle" style="background-color: #f6c23e;" title="Gold"></div>
                        </div>
                    </div>
                    
                    <!-- Size Options (if applicable) -->
                    <div class="size-options mb-4">
                        <h5 class="section-title">Size</h5>
                        <div class="d-flex flex-wrap gap-2">
                            <button class="btn btn-outline-secondary btn-sm size-option">S</button>
                            <button class="btn btn-outline-secondary btn-sm size-option active">M</button>
                            <button class="btn btn-outline-secondary btn-sm size-option">L</button>
                            <button class="btn btn-outline-secondary btn-sm size-option">XL</button>
                            <button class="btn btn-outline-secondary btn-sm size-option">XXL</button>
                        </div>
                    </div>
                    
                    <!-- Add to Cart -->
                    <div class="add-to-cart mb-4">
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <div class="row g-2">
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary quantity-btn" type="button" onclick="decreaseQuantity()">-</button>
                                        <input type="number" name="quantity" value="1" min="1" class="form-control text-center quantity-input">
                                        <button class="btn btn-outline-secondary quantity-btn" type="button" onclick="increaseQuantity()">+</button>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-primary w-100 py-2">
                                        <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Buy Now -->
        <div class="buy-now mb-4">
    <a href="{{ route('checkout.single', $product->id)}}" class="btn btn-danger w-100 py-2">
        <i class="fas fa-bolt me-2"></i> Buy Now
    </a>
</div>

                    
                    <!-- Delivery Info -->
                    <div class="delivery-info border-top pt-3">
                        <div class="row">
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-truck me-2 text-muted"></i>
                                    <div>
                                        <small class="text-muted">Delivery</small>
                                        <p class="mb-0 small">2-4 business days</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-undo me-2 text-muted"></i>
                                    <div>
                                        <small class="text-muted">Returns</small>
                                        <p class="mb-0 small">15 days easy return</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Product Tabs -->
    <div class="product-tabs mt-4">
        <ul class="nav nav-tabs" id="productTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab">Description</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="specifications-tab" data-bs-toggle="tab" data-bs-target="#specifications" type="button" role="tab">Specifications</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab">Reviews (24)</button>
            </li>
        </ul>
        <div class="tab-content p-3 border border-top-0 rounded-bottom bg-white" id="productTabsContent">
            <div class="tab-pane fade show active" id="description" role="tabpanel">
                <h5>Product Description</h5>
                <p>{{ $product->description }}</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam euismod, nisl eget aliquam ultricies, nunc nisl aliquet nunc, quis aliquam nisl nunc eu nisl. Nullam euismod, nisl eget aliquam ultricies, nunc nisl aliquet nunc, quis aliquam nisl nunc eu nisl.</p>
            </div>
            <div class="tab-pane fade" id="specifications" role="tabpanel">
                <h5>Technical Specifications</h5>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th width="30%">Brand</th>
                            <td>Premium Brand</td>
                        </tr>
                        <tr>
                            <th>Model</th>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <th>Material</th>
                            <td>High-quality materials</td>
                        </tr>
                        <tr>
                            <th>Dimensions</th>
                            <td>10 x 5 x 2 inches</td>
                        </tr>
                        <tr>
                            <th>Weight</th>
                            <td>500 grams</td>
                        </tr>
                        <tr>
                            <th>Warranty</th>
                            <td>1 year manufacturer warranty</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="reviews" role="tabpanel">
                <h5>Customer Reviews</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card bg-light p-3 text-center">
                            <h2 class="text-primary mb-0">4.5</h2>
                            <div class="rating-stars text-warning mb-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <p class="small text-muted">Based on 24 reviews</p>
                            <button class="btn btn-primary btn-sm">Write a Review</button>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="review-list">
                            <!-- Sample Review 1 -->
                            <div class="review-item border-bottom pb-3 mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="fw-bold">John D.</div>
                                    <small class="text-muted">2 days ago</small>
                                </div>
                                <div class="rating-stars text-warning mb-2 small">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <p class="mb-0">Excellent product! Exceeded my expectations. The quality is superb and it arrived earlier than expected.</p>
                            </div>
                            
                            <!-- Sample Review 2 -->
                            <div class="review-item border-bottom pb-3 mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="fw-bold">Sarah M.</div>
                                    <small class="text-muted">1 week ago</small>
                                </div>
                                <div class="rating-stars text-warning mb-2 small">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <p class="mb-0">Very good product overall, but the color was slightly different than shown in the pictures.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Related Products -->
  <div class="related-products mt-5">
    <h4 class="mb-4">You May Also Like</h4>
    <div class="row">
        @forelse($relatedProducts as $related)
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <img src="{{ asset('uploads/products/' . $related->image) }}" class="card-img-top" alt="{{ $related->name }}">
                <div class="card-body">
                    <h6 class="card-title">{{ $related->name }}</h6>
                    <p class="card-price text-primary fw-bold">₹{{ number_format($related->price) }}</p>
                    <div class="rating-stars text-warning small mb-2">
                       {{---reting --}}
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i><i class="far fa-star"></i>
                    </div>
                    <a href="{{ route('product.show', $related->id) }}" class="btn btn-outline-primary btn-sm w-100">View Details</a>
                </div>
            </div>
        </div>
        @empty
        <p class="text-muted px-3">No related products found.</p>
        @endforelse
    </div>
</div>

</div>

<style>
    .product-detail-card {
        border: none;
    }
    
    .section-title {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        color: #495057;
    }
    
    .quantity-btn {
        width: 40px;
    }
    
    .quantity-input {
        max-width: 60px;
    }
    
    .color-circle {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        cursor: pointer;
        border: 2px solid transparent;
    }
    
    .color-circle.active {
        border-color: #495057;
    }
    
    .color-circle:hover {
        border-color: #495057;
    }
    
    .size-option {
        min-width: 40px;
    }
    
    .size-option.active {
        background-color: #4e73df;
        color: white;
    }
    
    .thumbnail-img {
        transition: all 0.3s;
    }
    
    .thumbnail-img:hover {
        border-color: #4e73df !important;
    }
    
    .thumbnail-img.active {
        border-color: #4e73df !important;
    }
    
    .rating-stars {
        letter-spacing: 2px;
    }
    
    .current-price {
        color: #4e73df;
    }
    
    .original-price {
        color: #6c757d;
    }
    
    .discount-badge {
        font-size: 0.8rem;
    }
    
    .nav-tabs .nav-link {
        color: #495057;
        font-weight: 500;
    }
    
    .nav-tabs .nav-link.active {
        color: #4e73df;
        font-weight: 600;
    }
</style>

<script>
    // Change main image when thumbnail is clicked
    function changeMainImage(element) {
        const mainImage = document.getElementById('mainProductImage');
        mainImage.src = element.src;
        
        // Update active thumbnail
        document.querySelectorAll('.thumbnail-img').forEach(img => {
            img.classList.remove('active');
            img.style.border = '1px solid #ddd';
        });
        
        element.classList.add('active');
        element.style.border = '2px solid #4e73df';
    }
    
    // Quantity controls
    function increaseQuantity() {
        const input = document.querySelector('.quantity-input');
        input.value = parseInt(input.value) + 1;
    }
    
    function decreaseQuantity() {
        const input = document.querySelector('.quantity-input');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }
    
    // Color selection
    document.querySelectorAll('.color-circle').forEach(circle => {
        circle.addEventListener('click', function() {
            document.querySelectorAll('.color-circle').forEach(c => {
                c.classList.remove('active');
            });
            this.classList.add('active');
        });
    });
    
    // Size selection
    document.querySelectorAll('.size-option').forEach(option => {
        option.addEventListener('click', function() {
            document.querySelectorAll('.size-option').forEach(btn => {
                btn.classList.remove('active');
                btn.classList.add('btn-outline-secondary');
            });
            this.classList.add('active');
            this.classList.remove('btn-outline-secondary');
        });
    });
</script>
@endsection