<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'description' => 'nullable',
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
         $categories = Category::all();
        $products = Product::latest()->get();
        return view('frontend.home', compact('products', 'categories'));
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


         $categories = Category::all();
        return view('frontend.product', compact('product', 'relatedProducts', 'categories'));
    }


    // Cart Page (dummy for now)
  

    // Checkout Page (protected)
   public function checkout()
{
    $cart = session('cart', []);

    if (empty($cart)) {
        return redirect()->route('home')->with('error', 'Your cart is empty.');
    }

    $firstProductId = array_key_first($cart); // pehla product id
    $product = Product::find($firstProductId);
       $cart = session('cart', []);

    if (!$product) {
        return redirect()->route('cart.view')->with('error', 'Product not found.');
    }

    return view('frontend.checkout', compact('product', ));
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
    
    // Create a temporary cart array with just this product
    $cart = [
        $id => [
            'quantity' => 1,
            'price' => $product->price,
            // Add other necessary fields
        ]
    ];
    
    return view('frontend.checkout', [
        'cart' => $cart,
        'product' => $product
    ]);
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


public function categoryProducts($slug)
{
    $category = Category::where('slug', $slug)->firstOrFail();
    $products = Product::where('category_id', $category->id)->get();

    $categories = Category::all(); // For sidebar
    return view('frontend.category', compact('category', 'products', 'categories'));
}


public function search(Request $request)
{
    $query = $request->input('query');

    $products = Product::where('name', 'LIKE', "%{$query}%")
                    ->orWhere('description', 'LIKE', "%{$query}%")
                    ->get();

    return view('frontend.search_results', compact('products', 'query'));
}


}
