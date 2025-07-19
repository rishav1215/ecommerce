<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function show(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        return view('checkout', compact('product'));
    }

    public function placeOrder(Request $request)
    {
        // Validate address inputs
        $request->validate([
            'address' => 'required',
            'city' => 'required',
            'pin' => 'required',
            'product_id' => 'required|exists:products,id'
        ]);

        // Order logic yahan likhna h (store in DB, send email etc.)

        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }
}
