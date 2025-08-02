@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Product</h1>
        <a href="{{ route('admin.products.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Products
        </a>
    </div>

    <!-- Form Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Product Information</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <!-- Product Name -->
                        <div class="form-group mb-4">
                            <label for="name" class="font-weight-bold text-primary">Product Title</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                                   placeholder="Enter product name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="form-group mb-4">
                            <label for="price" class="font-weight-bold text-primary">Price</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₹</span>
                                </div>
                                <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" 
                                       placeholder="0.00" min="0" step="0.01" value="{{ old('price') }}" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="form-group mb-4">
                            <label for="category" class="font-weight-bold text-primary">Category</label>
                            <select name="category_id" id="category" class="form-control @error('category_id') is-invalid @enderror" required>
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <!-- Product Image -->
                        <div class="form-group mb-4">
                            <label for="image" class="font-weight-bold text-primary">Product Image</label>
                            <div class="custom-file">
                                <input type="file" name="image" id="image" 
                                       class="custom-file-input @error('image') is-invalid @enderror" 
                                       accept="image/*" onchange="previewImage(this)">
                                <label class="custom-file-label" for="image">Choose file...</label>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="form-text text-muted">
                                Recommended size: 800x800px, Max file size: 2MB
                            </small>
                            <!-- Image Preview -->
                            <div class="mt-3 text-center" id="imagePreviewContainer" style="display: none;">
                                <img id="imagePreview" class="img-thumbnail" style="max-height: 200px;">
                            </div>
                        </div>

                        <!-- Stock Quantity -->
                        <div class="form-group mb-4">
                            <label for="stock" class="font-weight-bold text-primary">Stock Quantity</label>
                            <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" 
                                   placeholder="Available quantity" min="0" value="{{ old('stock', 0) }}" required>
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group mb-4">
                    <label for="description" class="font-weight-bold text-primary">Description</label>
                    <textarea name="description" id="description" rows="4" 
                              class="form-control @error('description') is-invalid @enderror" 
                              placeholder="Detailed product description">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Add Product</span>
                    </button>
                    <button type="reset" class="btn btn-secondary ml-2">Reset Form</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Show filename when file is selected
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = document.getElementById("image").files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });

    // Image preview function
    function previewImage(input) {
        const previewContainer = document.getElementById('imagePreviewContainer');
        const preview = document.getElementById('imagePreview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.style.display = 'block';
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            previewContainer.style.display = 'none';
        }
    }
</script>
@endsection