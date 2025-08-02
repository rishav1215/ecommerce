<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
 public function place(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'phone' => 'required',
        'address' => 'required|string',
    ]);

    // Handle single product checkout
    if ($request->has('product_id')) {
        $product = Product::findOrFail($request->product_id);
        
        // Create order with this single product
        // Your order creation logic here
        
        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }

    // Handle cart checkout
    $cart = session('cart', []);
    if (empty($cart)) {
        return back()->with('error', 'Cart is empty!');
    }

    // Save order to DB (your logic here)

    // Clear cart
    session()->forget('cart');

    return redirect()->route('home')->with('success', 'Order placed successfully!');
}
}
