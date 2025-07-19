@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Product</h1>
        <a href="{{ route('admin.products.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Products
        </a>
    </div>

    <!-- Form Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Product Details</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <!-- Product Name -->
                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-primary">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name', $product->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-primary">Price</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₹</span>
                                </div>
                                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" 
                                       value="{{ old('price', $product->price) }}" min="0" step="0.01" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Category -->
                        {{-- <div class="form-group mb-4">
                            <label class="font-weight-bold text-primary">Category</label>
                            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                <option value="">Select category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <!-- Current Image -->
                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-primary">Current Image</label>
                            <div class="current-image-container">
                                @if($product->image)
                                    <img src="{{ asset('upload/products/' . $product->image) }}" 
                                         class="img-thumbnail current-image" alt="Current Product Image">
                                @else
                                    <div class="no-image-placeholder">
                                        <i class="fas fa-image fa-3x text-muted"></i>
                                        <p class="mt-2">No Image Available</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- New Image -->
                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-primary">Change Image</label>
                            <div class="custom-file">
                                <input type="file" name="image" 
                                       class="custom-file-input @error('image') is-invalid @enderror" 
                                       id="productImage" accept="image/*">
                                <label class="custom-file-label" for="productImage">Choose new image...</label>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="form-text text-muted">
                                Recommended size: 800x800px, Max file size: 2MB
                            </small>
                            <!-- New Image Preview -->
                            <div class="mt-3 text-center" id="imagePreviewContainer" style="display: none;">
                                <img id="imagePreview" class="img-thumbnail preview-image">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group mb-4">
                    <label class="font-weight-bold text-primary">Description</label>
                    <textarea name="description" rows="5" 
                              class="form-control @error('description') is-invalid @enderror" 
                              required>{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-save"></i>
                        </span>
                        <span class="text">Update Product</span>
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary ml-2">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .current-image-container {
        border: 1px dashed #ddd;
        padding: 15px;
        text-align: center;
        border-radius: 5px;
        background: #f9f9f9;
    }
    .current-image {
        max-height: 200px;
        max-width: 100%;
    }
    .no-image-placeholder {
        color: #6c757d;
        padding: 20px;
    }
    .preview-image {
        max-height: 200px;
        max-width: 100%;
    }
    .custom-file-label::after {
        content: "Browse";
    }
</style>

<script>
    // Show filename when file is selected
    document.getElementById('productImage').addEventListener('change', function(e) {
        var fileName = e.target.files[0] ? e.target.files[0].name : "Choose new image...";
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
        
        // Show preview if image selected
        if (e.target.files && e.target.files[0]) {
            const previewContainer = document.getElementById('imagePreviewContainer');
            const preview = document.getElementById('imagePreview');
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.style.display = 'block';
            }
            
            reader.readAsDataURL(e.target.files[0]);
        } else {
            document.getElementById('imagePreviewContainer').style.display = 'none';
        }
    });
</script>
@endsection