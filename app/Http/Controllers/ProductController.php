<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $product = new Product;
    $product->name = $request->name;
    $product->price = $request->price;

    // 🟨 Image upload logic
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/products'), $filename); // 👈 public/uploads/products/
        $product->image = $filename;
    }

    $product->save();

    return redirect()->route('products.index')->with('success', 'Product added successfully.');
}



    // Homepage
    public function index()
    {
        $products = Product::latest()->get();
        return view('frontend.home', compact('products'));
    }

        // Product Detail
        public function show($id)
    {
        $product = Product::findOrFail($id);

        $relatedProducts = Product::where('category_id', $product->category_id)
                            ->where('id', '!=', $id)
                            ->latest()
                            ->take(4)
                            ->get();

        return view('frontend.product', compact('product', 'relatedProducts'));
    }


    // Cart Page (dummy for now)
  

    // Checkout Page (protected)
    public function checkout()
    {
        return view('frontend.checkout');
    }
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function cart()
    {
        return view('frontend.cart');
    }

    public function updateCart(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Cart updated successfully');
        }
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Item removed from cart');
    }

    // Checkout Page with Single Product
public function checkoutSingle($id)
{
    $product = Product::findOrFail($id);
    return view('frontend.checkout', compact('product'));
}

// Place Order Logic
public function placeOrder(Request $request)
{
    $request->validate([
        'address' => 'required',
        'city' => 'required',
        'pin' => 'required',
        'product_id' => 'required|exists:products,id',
    ]);

    // ✅ Here you can save order in DB (example purpose only)
    // Order::create([...]);

    return redirect()->route('home')->with('success', 'Order placed successfully!');
}



}
