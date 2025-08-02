<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/search', [ProductController::class, 'search'])->name('product.search');

// Product Routes
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// Cart Routes
        // Route::get('/cart', [ProductController::class, 'cart'])->name('cart.view');
        // Route::post('/add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('cart.add');
        // Route::post('/cart/update', [ProductController::class, 'updateCart'])->name('cart.update');
        // Route::get('/cart/remove/{id}', [ProductController::class, 'removeFromCart'])->name('cart.remove');

// Checkout Routes
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [ProductController::class, 'checkout'])->name('checkout');
    Route::get('/checkout/{id}', [ProductController::class, 'checkoutSingle'])->name('checkout.single');
    Route::post('/checkout/place-order', [ProductController::class, 'placeOrder'])->name('checkout.place');
});

// Auth Routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminController::class, 'login'])->name('admin.login.submit');
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('products', [AdminProductController::class, 'index'])->name('admin.products.index');
    Route::get('products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::post('products/store', [AdminProductController::class, 'store'])->name('admin.products.store');
    Route::get('products/{id}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('products/{id}', [AdminProductController::class, 'update'])->name('admin.products.update');
    Route::delete('products/{id}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');
    Route::get('users', [AdminProductController::class, 'showUsers'])->name('admin.users');

    // Category CRUD
    Route::resource('categories', \App\Http\Controllers\CategoryController::class)->names('admin.categories');
});

// Filter products by category
Route::get('/category/{id}', [\App\Http\Controllers\CategoryController::class, 'filter'])->name('category.product');
Route::get('/category/{slug}', [ProductController::class, 'categoryProducts'])->name('category.show');



Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');


Route::post('/place-order', [OrderController::class, 'place'])->name('order.place');
